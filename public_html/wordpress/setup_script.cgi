#!/usr/bin/perl

# N.B.  This setup_script.cgi is specific to windows/wordpress
#       Do not use it for other installations.

use strict ;
use warnings ;
use CGI ;
use Config ;
die unless $ENV{ HTTP_HOST } ;

# Control debug output - 1 = debug/testing; 0 = live run
my $testmode = 0 ;

open( STDERR, "> ./debug.log" ) if $testmode ;

sub track {    #  little routine to print a trace 
    return unless $testmode ;
    my ( $file, $line, $msg ) = @_ ;
    use File::Basename ;
    $file = basename ( $file ) ;
    $msg = ( defined( $msg ) ) ? $msg : '' ;
    print STDERR "$file\[$line\]: $msg\n" ;
}

my $failed = 0 ;
( my $cwd = $0 ) =~ s/^(.*)\\.*?$/$1/ ;
my $cgi = new CGI ;
( my $un = $ENV{ PATH_TRANSLATED } ) =~ s/(?:.*\\home|D:\\Sites)\\([^\\]+)\\.*/$1/ ;

#  request_path and request_path_short
#
# The use of $cgi->script_name has been discontinued because on some times, it
# has a value such as http://example.com/chosen_directory/setup_script.cgi
# and at other times a value such as /chosen_directory/setup_script.cgi.
#
# Instead the request_path is determined from the current working directory
# when this program is initially run.
# request_path has form /XXXX/ or /
# request_path_short has form /XXXX or /
( my $unix_cwd           = $cwd )      =~ s#\\#/#g ;
( my $escaped_cwd        = $cwd )      =~ s#\\#\\\\#g ;
( my $request_path_short = $unix_cwd ) =~ s#^.*/(?:public_html|web/content)(/|$)#/# ;
( my $request_path = $request_path_short ) .= '/' ;

if ( $request_path eq '//' ) {    # installing to root directory
    $request_path = '/' ;
}

sub mkpassword {
    my @good_chars = ( 'a' .. 'z', 'A' .. 'Z', 0 .. 9, '#', '^', '!', '(', ')', '-', '=', '_', '+', '/' ) ;
    return join( "", map { $good_chars[ int rand @good_chars ] } ( 0 .. 7 ) ) ;
}
use POSIX ;
( my $sslname = ( POSIX::uname () )[ 1 ] ) =~ s/\..*// ;
$sslname .= ".secure-secure.co.uk" ;

my $http_host = $cgi->virtual_host ;
$http_host =~ s#^http://## ;
$http_host =~ s#^www\.## ;

my %static_args = map {
  chomp;
  split(/=/, $_, 2)
} <DATA>;

my %config = (
               cwd                => $cwd,
               escaped_cwd        => $escaped_cwd,
               http_host          => $http_host,
               request_path       => $request_path,
               request_path_short => $request_path_short,
               password           => mkpassword,
               user               => $Config{ 'd_getpwuid_r' } ? scalar getpwuid( $> ) : $un,
               dbuser     => $static_args{dbuser} || scalar( $cgi->param ( "dbuser" ) ),
               dbpassword => $static_args{dbpassword} || scalar( $cgi->param ( "dbpassword" ) ),
               dbhost => $static_args{dbhost} || scalar( $cgi->param ( "dbhost" ) ) || "localhost",
               ssl_host   => $sslname,
             ) ;

if ( -r "$cwd/_inone.tar" ) {
    require Archive::Tar ;
    my $tar = Archive::Tar->new ;

    $tar->read ( "$cwd/_inone.tar", 0 ) ;
    $tar->extract () ;
    unlink "$cwd/_inone.tar" ;
}

if ( -r "$cwd/_inone.zip" ) {
    require Archive::Zip ;
    my $zip = Archive::Zip->new () ;
    $zip->read ( "$cwd/_inone.zip" ) ;
    $zip->extractTree ("", "$cwd/") ;
    unlink "$cwd/_inone.zip" ;
}

#  This functionality is done in extend:/home/heart/hostcp/public_html/install.cgi

sub recurse_fix {
    my $dir = shift ;
    opendir DIR, $dir or die( $failed = 1 ) ;
    my @ditems = readdir DIR ;
    closedir DIR ;
    for my $update_file ( grep { m/\.install-template$/ } @ditems ) {

        ( my $output_file = $update_file ) =~ s/\.install-template$// ;
        unless ( open IFILE, "<", "$dir/$update_file" ) {
            $failed = 1 ;
            last ;
        }
        my $mode = ( stat IFILE )[ 2 ] ;
        unless ( open OFILE, ">", "$dir/$output_file" ) {
            $failed = 1 ;
            last ;
        }
        my $line ;
        while ( ( !$failed ) and $line = <IFILE> ) {
            $line =~ s/\[\* (\w+) \*\]/$config{$1}/g ;
            print OFILE $line ;
        }
        close OFILE ;
        close IFILE ;
        unlink "$dir/$update_file" ;
        chmod $mode, "$dir/$output_file" ;
    } ## end for my $update_file ( grep...
    for ( @ditems ) {
        next if /^\.\.?$/ ;
        if ( $_ eq '.gitdummy' ) {    # delete files whose sole function is to get an empty directory
                                      # when using git for code control.
                                      # see README for more explanation
            unlink "$dir/.gitdummy" ;
            next ;
        }
        if ( -d "$dir/$_" ) {
            recurse_fix ( "$dir/$_" ) ;
        }
    }
} ## end sub recurse_fix

recurse_fix ( $cwd ) ;
my $success ;
if ( $failed == 1 ) {
    die ;
}
$success = 1 ;

# Set permissions to something safe:  e-mail 6/3/2008 - suggested by Jarrod
#     directories 711
# Change only the installation directory $cwd.  It is the only one the user
# could have set incorrectly since it must be empty for installation and all other files are
# copied in by this program.

chmod 0711, "$cwd" ;

# Get generated random phrases and puts them in wp-config.php

my @secret ;
for ( my $n = 0 ; $n < 8 ; $n++ ) {
    my $part1 = mkpassword ;
    $part1 .= mkpassword ;
    $part1 .= mkpassword ;
    $part1 .= mkpassword ;
    push( @secret, $part1 ) ;
}
track ( __FILE__, __LINE__, "@secret" ) if $testmode ;

open CONFIG, "< $cwd/wp-config.php" or die "Can't open config file for reading: $!" ;
my @confdata = <CONFIG> ;
close CONFIG ;
track ( __FILE__, __LINE__ ) if $testmode ;

my $count = 0 ;
open CONFIG, "> $cwd/wp-config.php" or die "Can't open config file for writing: $!" ;
foreach my $line ( @confdata ) {
    track ( __FILE__, __LINE__, "$line" ) if $testmode ;
    if ( $line =~ m/XXXXXX/ ) {
        $line =~ s/XXXXXX/$secret[$count++]/ ;
        track ( __FILE__, __LINE__, "$line" ) if $testmode ;
    }
    else {
        track ( __FILE__, __LINE__, "$line" ) if $testmode ;
    }
    print CONFIG "$line" ;
}
close CONFIG ;

#if($cwd!~/^[A-Z]/) {
  # Change perms on wp-config.php to be NOT world accessible.  chmod does not work
  # directly from .cgi or .php scripts with a windows server.  Instead we use icacls.exe
  # (see http://technet.microsoft.com/en-us/library/cc753525(WS.10).aspx) for
  # documentation.  We access icacls through Windows PowerShell.
  #track ( __FILE__, __LINE__, "about to call icacls" ) if $testmode ;
  #open( PS, "PowerShell icacls.exe wp-config.php /deny Everyone:RX |" ) or die "Can't open PowerShell: $!" ;
  #my @acl = <PS> ;    # We don't need this info except to debug but the IO causes
                      # the PowerShell command to run.  
                      # It takes up to 30 seconds to complete this command which can add to
                      # the installation time.
  #close PS ;
#}

print $cgi->header ( "text/plain" ) ;
print "$config{password}\n" ;
close( STDOUT ) ;

sub END {

    unlink $0 if ( $success && ( $testmode == 0 )) ;
}
__DATA__
dbhost=localhost
dbpassword=wYTJxrW!6
dbtype=mysql
dbuser=web203-a-wor-ydy
