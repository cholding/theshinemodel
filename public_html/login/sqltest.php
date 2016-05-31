<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){


} 

$text=$kwiken->search_fulltext('whippet');

//get the email form the account name
		$username='cholding';
		$stmt = $db->prepare("SELECT c1.first_name, c1.last_name, m1.email FROM contacts AS c1 INNER JOIN members as m1 ON c1.MemberID= m1.memberID WHERE m1.username= :username");
		$stmt->execute(array(':username' => $username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['m1.email'])){
			$error[] = 'Email provided is already in use.';
		} 
		echo 'The email is ' .$row['email'];
		


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
					<h3> The result is <?php echo $text ?>  thanks <h3>
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