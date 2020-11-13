<?php
session_start();

if(isset($_SESSION['admin'])){

    session_destroy();
    header("location:login.php");
}

if(isset($_SESSION['username'])){
    session_destroy();

    $email=$_SESSION['email'];

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Exam";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {

    $path = __DIR__."/users/$email/question1";

    $result1=exec("cmp outputs/Question1.txt $path/output.txt;echo $?");

    $path = __DIR__."/users/$email/question2";

    $result2=exec("cmp outputs/Question2.txt $path/output.txt;echo $?");

    $path = __DIR__."/users/$email/question3";

    $result3=exec("cmp outputs/Question3.txt $path/output.txt;echo $?");

    $path = __DIR__."/users/$email/question4";

    $result4=exec("cmp outputs/Question4.txt $path/output.txt;echo $?");


    $insert="UPDATE Users SET result1='$result1', result2='$result2',result3='$result3',result4='$result4' WHERE email='$email'";

    $insert_query=$conn->query($insert) or $conn->error;

    }
    ?>
    

<style>
  body{
    background-color: white;
    overflow-y: hidden;
  }img{
  border-radius: 0.5cm;
  width:25%;
  height:50%;
  
}
h1,h2{
  color:rgb(95,16,13);
}

</style>
<link rel = "icon" href ="img/jntuk.png">
<title>Thank you</title>
<body>
<center>
  <img src="img/jntuk.png" alt="This is an animated gif image, but it does not move"/>
  <h1>Thank you for being a part of speCSEr<sub>2K19</sub></h1>
  <h2>Your examination has been completed</h2>
  <h2>Your can leave the lab now</h2>
</center>
</body>
<script>
localStorage.removeItem("time");
</script>
<?php
header( "refresh:60;url=login.php");
?>
    
    <?php
}
else{
    header("location:login.php");
}
?>