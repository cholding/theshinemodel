<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Production Page';

//include header template
require('layout/header.php'); 
?>

<div class="container">

	<div class="row" >

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<div class-"row">
				<div class="col-md-9">
					<h2 class="opaquetitle">Production page</h2>
				</div>	
			</div>	
			<div class-"row">	
				<div class="col-md-9 ">
				<p><a class="opaquetitle" href='logout.php'>Logout</a>                 <a class="opaquetitle" href='/index.html'><b>HOME</b></a></p>
				</div>
			</div>	
			<div class-"row">	
				<div class="col-md-12 ">
				<h3 class="opaquetitle">Welcome to the producion page at <a href='/index.html'><img src="/images/kwiken.png" alt="KwiKen" style="height:20px;margin-top:0"></a>  from here you can do admin tasks</h3>
			</div>
			</div>	
				
				<br>
				

		</div>
	</div>


</div>

<?php 
//include header template
require('layout/footer.php'); 
?>