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




}	
?>
