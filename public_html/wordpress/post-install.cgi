#!/usr/bin/perl -w

use strict ;

=cut

 Discontinued  using  https://api.wordpress.org/secret-key/1.1/ because  
 our servers not accepting  self signed key.    2013-07-15

Instead generated our own randomised keys and salts

# Gets generated random phrases and puts them in wp-config.php

my $cmd = 'wget  https://api.wordpress.org/secret-key/1.1/ -O - -o /dev/null' ;

open SECRET, "$cmd |" or die "Can't connect to secret phrase generator: $!" ;
my @secret = <SECRET> ;
close SECRET ;

# @secret has just four elements which are for AUTH_KEY, SECURE_AUTH_KEY, LOGGED_IN_KEY, and NONCE_KEY
# we want four more to correspond to AUTH_SALT, SECURE_AUTH_SALT, LOGGED_IN_SALT, and NONCE_SALT
# so do it again. (Note if Wordpress change it to add the other four elements the code will still work as is.)

$cmd = 'wget  https://api.wordpress.org/secret-key/1.1/ -O - -o /dev/null' ;

open SECRET, "$cmd |" or die "Can't connect to secret phrase generator: $!" ;
my @secret2 = <SECRET> ;
close SECRET ;

foreach ( @secret2 ) {
    $_ =~ s/_KEY/_SALT/ ;
    push( @secret, $_ ) ;
}

=cut

sub mksalt {
        my @good_chars=('a' .. 'z', 'A' .. 'Z', 0 .. 9, '#', '^', '!', '(',
                ')', '-', '=', '_', '+', '/');
        return join("", map {$good_chars[int rand @good_chars]} (0 .. 63));
}
open CONFIG, "< ./wp-config.php" or die "Can't open config file for reading: $!" ;
my @config = <CONFIG> ;
close CONFIG ;

my $count = 0 ;
chmod 0666, "./wp-config.php" ;
open CONFIG, "> ./wp-config.php" or die "Can't open config file for writing: $!" ;
foreach my $line ( @config ) {
    if ( $line =~ m/XXXXXXX/ ) {
        my $salt = mksalt() ;
        $line =~ s/XXXXXXX/$salt/ ;
    }
        print CONFIG "$line" ;
}
close CONFIG ;
chmod 0600, "./wp-config.php" ;

# bot control:
my $robotfile = (getpwuid($>))[7] . '/public_html/robots.txt';
my $text = "User-agent: *\nCrawl-delay: 2\n";
if ( -f $robotfile ){
        open my $fh, "+<$robotfile" or goto outside;
        my @contents = <$fh>;
	grep (/^Crawl-delay/, @contents) ? close $fh : print $fh "\n$text";
        close $fh;
} else {
        open my $fh, ">$robotfile" or goto outside;
        print $fh $text;
        close $fh;
        }
outside:
exit 0;
