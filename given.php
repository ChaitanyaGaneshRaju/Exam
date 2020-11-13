<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
?>
<style>
  body{
    background-color: white;
    overflow-y: hidden;
  }
img{
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
  <h2>You have already given the Exam</h2>
  <h2>You can't login again</h2>
</center>
</body>
<?php
header( "refresh:60;url=login.php");
?>