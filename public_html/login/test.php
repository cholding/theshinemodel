<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<style>

body {
    padding-top: 60px;
}

.container-fluid {
    background-color: aqua;
}



.colcol {
    border: 1px solid black;
    /*height: 200px;*/
}

nav {
    background-color: darkblue;
}

@media(max-width:34em) {
    body {
        padding-top: 30px;
    }
    .navbar .navbar-nav>.nav-item {
        float: none;
        margin-left: .1rem;
    }
    .navbar .navbar-nav {
        float: none !important;
    }
    .navbar .collapse.in,
    .navbar .collapsing {
        clear: both;
    }
}

</style>
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-fixed-top navbar-dark ">
            <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#mainmenu"> ☰</button>

            <a href="#" class="navbar-brand">Discoveryvip</a>
            <div class="collapse navbar-toggleable-xs" id="mainmenu">
                <ul class="nav navbar-nav pull-md-right">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link active">Contact</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Products</a></li>

                </ul>
            </div>
        </nav>

        

    </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>