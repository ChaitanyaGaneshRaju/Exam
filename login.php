<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/south-street/jquery-ui.css">
<link rel="stylesheet" href="css/login.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
if(isset($_POST['submit'])){
    echo '
            <script>
            jQuery(function($) {    
                $( function() {
                    $( "#dialog" ).dialog();
                } );
              });
            </script>
            ';
}
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($email=='chaitanyaraju2000@gmail.com'&&$password=='LordRama@123'){
        session_start();
        $_SESSION['admin']='chaitanya';
        header("location:admin.php");
    }
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Exam";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $result = $conn->query("SELECT name,email,password,login FROM Users WHERE email = '".$email."' AND  password = '".$password."'");
        $row = $result->fetch_assoc();
        if( $result->num_rows > 0 )
        { 
            session_start();
            $_SESSION['username']=$row["name"];
            $_SESSION['email']=$row["email"];
            if($row["login"]==1){
                header("location:given.php");
            }
            else{
                $sql = "UPDATE Users SET Login=1 WHERE email='".$email."'";
            if (mysqli_query($conn, $sql)) {
                header("location:index.php");
              }
            }
        }
        else{
            echo '
            <script>
            jQuery(function($) {    
                $( function() {
                    $("#dialog").html("Invalid Credentials");
                    $( "#dialog" ).dialog();
                } );
              });
            </script>
            ';
        }
    }
}

?>

<head>
<link rel = "icon" href ="img/jntuk.png">
<title>Login</title>
</head>
<div class="transp"></div>
<div class="login-reg-panel">
	<div class="login-info-box">
		<h2>Have an account?</h2>
        <p>You can Login here</p>
		<label id="label-register" for="log-reg-show">Login</label>
		<input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
	</div>
							
	<div class="register-info-box">
		<h2>Don't have an account?</h2>
		<p>You can Register here</p>
		<label type="button" id="label-login" for="log-login-show">Register</label>
		<input type="radio" name="active-log-panel" id="log-login-show">
    </div>
							
	<div class="white-panel">
        <img id="logo" src="img/jntuk.png" alt="JNTUK-Logo">
		<div class="login-show">
                <h5>LOGIN</h5>
                <form action="login.php" method="POST">
                   <input type="text" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="submit" name="login" value="Login">
                </form>
                <a href="">Forgot password?</a>
        </div>
		<div class="register-show">                
            <h5>REGISTER</h5>
            <form id="myform" action="login.php" method="POST">
                <input type="text" placeholder="User Name" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="tel" placeholder="10-Digit Phone Number" name="phone" pattern="[0-9]{10}" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirm" required>
                <input type="submit" value="Register" name="submit" >
            </form>
		</div>
    </div>
</div>

<div id="dialog" title="UCEN_JNTUK says...">
      <p></p>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

$(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function() {
    if($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut(); 
        $('.login-info-box').fadeIn();
        
        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');
        
    }
    else if($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();
        
        $('.white-panel').removeClass('right-log');
        
        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
</script>

<?php
if(isset($_POST['submit'])){
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password2 = $_POST['confirm'];
if (!empty($username) || !empty($password) || !empty($password2) || !empty($email) || !empty($phone)) {
    if($password!=$password2){
        echo '
            <script>
            jQuery(function($) {
                $( function() {
                    $("#dialog").html("Passwords doesn\'t match");
                } );
              });
            </script>
            ';
    }
    else{
        $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Exam";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From Users Where email = ? Limit 1";
     $INSERT = "INSERT Into Users (`name`, `password`, `email`, `phone`) values(?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssi", $username, $password, $email, $phone);
      if($stmt->execute()){
        echo '
            <script>
            jQuery(function($) {
                $( function() {
                    $("#dialog").html("Registration Successful, You can login now");
                } );
              });
            </script>
            ';
        $oldmask = umask(0);
        system("mkdir users/$email");
        system("mkdir users/$email/question1");
        system("mkdir users/$email/question2");
        system("mkdir users/$email/question3");
        system("mkdir users/$email/question4");
        system("cp questions/Question1.c users/$email/question1/");
        system("cp questions/Question2.cpp users/$email/question2/");
        system("cp questions/Question3.java users/$email/question3/");
        system("cp questions/Question4.py users/$email/question4/");
      }
      else{
          echo $stmt->error;
      }
     } else {
      echo '
            <script>
            jQuery(function($) {
                $( function() {
                    $("#dialog").html("Email id has already existed");
                } );
              });
            </script>
            ';
     }
     $conn->close();
    }
    }
} else {
 echo "All field are required";
 die();
}
}
unset($_POST);
?>