<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
        parent::__construct();

        $this->_db = $db;
    }

    private function get_user_hash($username){	

        try {
            $stmt = $this->_db->prepare('SELECT password FROM members WHERE username = :username AND active="Yes" ');
            $stmt->execute(array('username' => $username));

            $row = $stmt->fetch();
            return $row['password'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
    }

    public function login($username,$password){

        $hashed = $this->get_user_hash($username);

        if($this->password_verify($password,$hashed) == 1){

            $_SESSION['loggedin'] = true;

            return true;
        } 	
    }

    public function logout(){
        $_SESSION['loggedin'] == false;
        session_destroy();
    }

    public function is_logged_in(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }		
    }
    public function gettype($username){

        try {
            $stmt = $this->_db->prepare('SELECT username, membertype FROM members WHERE username = :username AND active="Yes" ');
            $stmt->execute(array('username' => $username));

            $row = $stmt->fetch();
            return $row['membertype'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
    }

    public function getuserid($username){

        try {
            $stmt = $this->_db->prepare('SELECT username, memberID FROM members WHERE username = :username AND active="Yes" ');
            $stmt->execute(array('username' => $username));

            $row = $stmt->fetch();
            return $row['memberID'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
    }
    public function getfullname($memberID)
    {
        //'SELECT C1.first_name, C1.last_name, M1.email FROM contacts AS C1 INNER JOIN members AS M1 ON C1.MemberID = M1.memberID WHERE M1.memberID = :memberid;')
        try {
            $stmt = $this->_db->prepare('SELECT first_name, middle_name, last_name FROM contacts WHERE MemberID = :memberid;');

            $stmt->execute(array('memberid' => $memberID));

            $row = $stmt->fetch();

            return $row['first_name'] ." " .$row['last_name'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage() .' -' .$memberID .' in getfullname</p>';
        }
    }
    public function getfirstname($memberID)
    {
        //'SELECT C1.first_name, C1.last_name, M1.email FROM contacts AS C1 INNER JOIN members AS M1 ON C1.MemberID = M1.memberID WHERE M1.memberID = :memberid;')
        try {
            $stmt = $this->_db->prepare('SELECT first_name FROM contacts WHERE MemberID = :memberid;');

            $stmt->execute(array('memberid' => $memberID));

            $row = $stmt->fetch();

            return $row['first_name'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage() .' -' .$memberID .' in getfirstname</p>';
        }
    }
    public function getlastname($memberID)
    {
        //'SELECT C1.first_name, C1.last_name, M1.email FROM contacts AS C1 INNER JOIN members AS M1 ON C1.MemberID = M1.memberID WHERE M1.memberID = :memberid;')
        try {
            $stmt = $this->_db->prepare('SELECT last_name FROM contacts WHERE MemberID = :memberid;');

            $stmt->execute(array('memberid' => $memberID));

            $row = $stmt->fetch();

            return $row['last_name'];

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage() .' -' .$memberID .' in getlastname</p>';
        }
    }
    public function getemail($memberID)
    {
        //'SELECT C1.first_name, C1.last_name, M1.email FROM contacts AS C1 INNER JOIN members AS M1 ON C1.MemberID = M1.memberID WHERE M1.memberID = :memberid;')
        try {
            $stmt = $this->_db->prepare('SELECT email FROM contacts  WHERE MemberID = :memberid;');

            $stmt->execute(array('memberid' => $memberID));

            $row = $stmt->fetch();

            return $row['email'] ;

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage() .' -' .$memberID .' in getfirstname</p>';
        }
    }
    public function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
        $file = $path.$filename;
        $file_size = filesize($file);
        $handle = fopen($file, "rb");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $header = "From: ".$from_name." <".$from_mail.">\r\n";
        $header .= "Reply-To: ".$replyto."\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        $header .= "This is a multi-part message in MIME format.\r\n";
        $header .= "--".$uid."\r\n";
        $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $header .= $message."\r\n\r\n";
        $header .= "--".$uid."\r\n";
        $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
        $header .= "Content-Transfer-Encoding: base64\r\n";
        $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
        $header .= $content."\r\n\r\n";
        $header .= "--".$uid."--";
        if (mail($mailto, $subject, "", $header)) {
            echo "mail send ... OK"; // or use booleans here
        } else {
            echo "mail send ... ERROR!";
        }
    }
    

    public function updateUserProfile($aryFields, $memberid) {

        $commit = true;
        $proceed = false;

        //Create a stdclass object to contain important information
        $return = new stdclass;
        $return->message = "Problem updating the profile";
        $return->success = false;

//         //insert into database with a prepared statement
//            $stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
//            $stmt->execute(array(
//                ':username' => $_POST['username'],
//                ':password' => $hashedpassword,
//                ':email' => $_POST['email'],
//                ':active' => $activasion
//            ));
//            $id = $db->lastInsertId('memberID');
        
        // the update info statements
        $q1 = 'SELECT visible
                FROM appointments
	             WHERE id= :memberid';

        $q2 = 'UPDATE appointments
				SET username =:username
				WHERE id=:memberid';

        $q3 = 'UPDATE contacts
	             SET first_name = 0
                 
	             WHERE id= :memberid';

        try{

            //Initiate a transaction
            $db->beginTransaction(); 

            //Check the appointment is available before proceeding
            $stmt1 = $db->prepare($q1);
            if($stmt1) {
                $stmt1->execute(array("memberid" => $memberid));

                //Get  the value of the visibility column and check it is '1' or visible
                while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $visible = $row['visible'];
                }

                //If the appointment is available, proceed with the booking
                if($visible == 1) $proceed = true;

                if($proceed) {

                    $stmt2 = $db->prepare($q2);
                    if($stmt2) {
                        $stmt2->execute(array(":username" => $username, ":appt_uid" => $appt_uid));
                        //Check that the username column was updated, otherwise don't commit
                        if ($stmt2->rowCount() <= 0) $commit = false;
                    }

                    $stmt3 = $db->prepare($q3);
                    if($stmt3) {
                        $stmt3->execute(array(":appt_uid" => $appt_uid));
                        //Check that the visibility column was updated, otherwise don't commit
                        if($stmt3->rowCount() <= 0 ) $commit = false;
                    }

                }
            }

        } catch(PDOException $e) { //If the update or select query fail, we can't commit any changes to the database
            $return->message = "Error Message:  " . $e->getMessage();
            $commit = false;
        }

        //Based on the value of $commit, decide whether to call rollback or commit
        if(!$commit){
            $db->rollback();
        } else {
            $db->commit();
            $return->message = "Visibility updated successfully";
            $return->success = true;
        }

        //Send this information back to the JavaScript, encoded as json
        return json_encode($return);

    }

    



}	
?>
