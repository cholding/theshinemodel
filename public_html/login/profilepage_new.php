<?php 


defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));

//include config
require_once(SITE_ROOT.'/login/includes/config.php');



//if not logged in redirect to login page
if( !$user->is_logged_in() ){ header('Location: login.php'); } 

//if form has been submitted process it
if(isset($_POST['update'])){


    //if no errors have been created carry on
    if(!isset($error)){

        //load the new details into an array

        $aryCopyProfile [0]['first_name']=$_POST['f_name'];
        $aryCopyProfile [0]['last_name']=$_POST['l_name'];
        $aryCopyProfile [0]['username']=$_POST['username'];
        $aryCopyProfile [0]['email']=$_POST['email'];
        //        $aryCopyProfile [0]['mobile_phone']=$_POST['mobilephone'];
        //        $aryCopyProfile [0]['other_phone']=$_POST['otherphone'];
        $aryCopyProfile [0]['address1']=$_POST['add1'];
        $aryCopyProfile [0]['address2']=$_POST['add2'];
        $aryCopyProfile [0]['postcode']=$_POST['postcode'];
        $aryCopyProfile [0]['city']=$_POST['city'];
        $aryCopyProfile [0]['countrycode']=$_POST['country'];
        //        $aryCopyProfile [0]['postzipcode']=$_POST['postzipcode'];
        $tmpcc=$_POST['country'];
        $aryCopyProfile [0]['country']=$user->getCountry($tmpcc,'country');
        //        
        $message = $aryCopyProfile [0]['first_name'];
        echo("<script>console.log('First name: ".$aryCopyProfile [0]['first_name']."');</script>");
        echo("<script>console.log('Last name: ".$aryCopyProfile [0]['last_name']."');</script>");
        echo("<script>console.log('Email: ".$aryCopyProfile [0]['email']."');</script>");
        echo("<script>console.log('Username: ".$aryCopyProfile [0]['username']."');</script>");
        echo("<script>console.log('Address1: ".$aryCopyProfile [0]['address1']."');</script>");
        echo("<script>console.log('Address2: ".$aryCopyProfile [0]['address2']."');</script>");
        echo("<script>console.log('Postcode: ".$aryCopyProfile [0]['postcode']."');</script>");
        echo("<script>console.log('City: ".$aryCopyProfile [0]['city']."');</script>");
        echo("<script>console.log('Country: ".$aryCopyProfile [0]['country']."');</script>");
        echo("<script>console.log('Countrycode: ".$aryCopyProfile [0]['country']."');</script>");
        echo("<script>console.log('ID: ".$_SESSION['memberid']."');</script>");
        $memberid=$_SESSION['memberid'];

        //---------------------------------
        //start the update
        // the update info statements
        $q1 = 'UPDATE members SET email=:email WHERE memberID=:memberid';
        echo("<script>console.log('Q1: ".$q1."');</script>");

        $q2 = 'UPDATE contacts SET first_name=:firstname,last_name=:lastname,email=:email,address1=:address1,address2=:address2,city=:city,country=:country,countrycode=:countrycode,postzipcode=:postzipcode WHERE MemberID=:memberid';
        echo("<script>console.log('Q2: ".$q2."');</script>");

        try
        {
            //Initiate a transaction
            $db->beginTransaction(); 

            //Check the appointment is available before proceeding
            $stmt1 = $db->prepare($q1);
            if($stmt1) 
            {
                // set paramater values
                $username = $aryCopyProfile [0]['username'];
                $email = $aryCopyProfile [0]['email'];
                $memberid = $memberid;

                //                $stmt1->bindParam(':username', $username,PDO::PARAM_STR);
                $stmt1->bindParam(':email', $email,PDO::PARAM_STR);
                $stmt1->bindParam(':memberid', $memberid,PDO::PARAM_STR);


                $stmt1->execute();
                $proceed = true;
            }
            if($proceed) 
            {

                $stmt2 = $db->prepare($q2);
                if($stmt2) {

                    // update a row
                    $firstname = $aryCopyProfile [0]['first_name'];
                    $lastname = $aryCopyProfile [0]['last_name'];
                    $email = $aryCopyProfile [0]['email'];
                    $address1 = $aryCopyProfile [0]['address1'];
                    $address2 = $aryCopyProfile [0]['address2'];
                    $city = $aryCopyProfile [0]['city'];
                    $country = $aryCopyProfile [0]['country'];
                    $postzipcode =$aryCopyProfile [0]['postcode'];
                    $countrycode=$aryCopyProfile [0]['countrycode'];
                    $memberid = $memberid;

                    $stmt2->bindParam(':firstname', $firstname,PDO::PARAM_STR);
                    $stmt2->bindParam(':lastname', $lastname,PDO::PARAM_STR);
                    $stmt2->bindParam(':email', $email,PDO::PARAM_STR);
                    $stmt2->bindParam(':address1', $address1,PDO::PARAM_STR);
                    $stmt2->bindParam(':address2', $address2,PDO::PARAM_STR);
                    $stmt2->bindParam(':city', $city,PDO::PARAM_STR);
                    $stmt2->bindParam(':country', $country,PDO::PARAM_STR);
                    $stmt2->bindParam(':countrycode', $countrycode,PDO::PARAM_STR);
                    $stmt2->bindParam(':postzipcode', $postzipcode,PDO::PARAM_STR);
                    $stmt2->bindParam(':memberid', $memberid,PDO::PARAM_STR);


                    $stmt2->execute();

                    $commit = true;
                }
            } // end proceed


        } catch(PDOException $e) { //If the update or select query fail, we can't commit any changes to the database
            echo("<script>console.log('error: ". $e->getMessage()."');</script>"); 
            $commit = false;
        } // end try
        //Based on the value of $commit, decide whether to call rollback or commit

        if(!$commit){
            $db->rollback();
        } else {
            $db->commit();
        } // end commit
        //after update head to the memberpage
        header('Location: memberpage.php');

    } // end isset error

} else {

    $memberid=$_SESSION['memberid'];

    $stmt = $db->prepare('SELECT contacts.first_name,contacts.last_name,contacts.mobile_phone,contacts.other_phone,contacts.address1,contacts.address2,contacts.city,contacts.country,contacts.countrycode,contacts.postzipcode,members.username,members.email FROM contacts INNER JOIN members ON contacts.MemberID = members.memberID WHERE members.memberID = :memberid');

    $stmt->bindParam(':memberid',$memberid,PDO::PARAM_INT);

    try{
        $stmt->execute();



    }catch(PDOException $e){
        echo ErrorHandle($e);

    }
    //fetch all into an array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $aryCopyProfile = $result;

    $arrlength=count($result);

    $login_firstname=$result [0]["first_name"];
    $login_lastname=$result [0]['last_name'];
    $login_username=$result [0]['username'];
    $login_email=$result [0]['email'];
    $login_mobile=$result [0]['mobile_phone'];
    $login_otherphone=$result [0]['other_phone'];
    $login_add1=$result [0]['address1'];
    $login_add2=$result [0]['address2'];
    $login_city=$result [0]['city'];
    $login_country=$result [0]['country'];
    $login_countrycode=$result [0]['countrycode'];
    $login_postzipcode=$result [0]['postzipcode'];

    echo("<script>console.log('Country: ".$tmpcc."');</script>");
    echo("<script>console.log('code: ".$login_countrycode."');</script>");

} // end of else 


//define page titlekiu
$title = 'SHINE Login';

//include header template
require('layout/header.php'); 

?>
<script>
    //    console.log($login_firstname);
    //    console.log($login_mobile);

</script>

<div class="container_bg">

     <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <form class="form-horizontal" role="form">
        <fieldset>

          <!-- Form Name -->
          <legend>Address Details</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 1" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 2</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 2" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">City</label>
            <div class="col-sm-10">
              <input type="text" placeholder="City" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">State</label>
            <div class="col-sm-4">
              <input type="text" placeholder="State" class="form-control">
            </div>

            <label class="col-sm-2 control-label" for="textinput">Postcode</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Post Code" class="form-control">
            </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Country</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Country" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
    <script>
        // this function enables the update button on a keyup
        function myFunction(val) {
            $( document ).ready(function() {
                console.log( "ready!" + val );

                $( "#update" ).prop( "disabled", false);

            });
        }



    </script>



    <?php 
    //include header template
    require('layout/footer.php'); 
    ?>