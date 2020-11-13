<?php

session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}

$flag=1;
if(isset($_POST['all'])){
    $flag=1;
}
if(isset($_POST['qualified'])){
    $flag=2;
}

if(isset($_POST['notqualified'])){
    $flag=3;
}



function get(){

    global $flag;
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Exam";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if($flag==1){
        $result = $conn->query("SELECT * FROM Users");
        dispaly($result);
    }
    if($flag==2){
        $result = $conn->query("SELECT * FROM Users WHERE result1=0 AND result2=0 OR result1=0 AND result3=0 OR result1=0 AND result4=0 OR result2=0 AND result3=0 OR result2=0 AND result4=0 OR result3=0 AND result4=0");
        dispaly($result);
    }

    if($flag==3){
        $result = $conn->query("SELECT * FROM Users EXCEPT SELECT * FROM Users WHERE result1=0 AND result2=0 OR result1=0 AND result3=0 OR result1=0 AND result4=0 OR result2=0 AND result3=0 OR result2=0 AND result4=0 OR result3=0 AND result4=0");
        dispaly($result);
    }
    
}

function dispaly($result)
{
    echo "<pre>";
    echo '<table class="table table-sm table-bordered table-dark bg-dark">';
    echo '
    <thead class="thead-dark">
            <tr>
            <th scope="col">S.No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">phone</th>
            <th scope="col">password</th>
            <th scope="col">Result1</th>
            <th scope="col">Result2</th>
            <th scope="col">Result3</th>
            <th scope="col">Result4</th>
            <th scope="col">Question1</th>
            <th scope="col">Output1</th>
            <th scope="col">Question2</th>
            <th scope="col">Output2</th>
            <th scope="col">Question3</th>
            <th scope="col">Output3</th>
            <th scope="col">Question4</th>
            <th scope="col">Output4</th>
            </tr>
        </thead>
        <tbody>
        ';
    $count=1;
    while ($queryRow = $result->fetch_array()) {
        echo "<tr>";
        echo "<td>$count</td>";
        for($i = 0; $i < $result->field_count-1; $i++){
            echo "<td>$queryRow[$i]</td>";
        }
        $path = "users/$queryRow[1]/question1";
        echo '<td><a href="'.$path.'/Question1.c">Question1.c</a></td>';
        echo '<td><a href="'.$path.'/output.txt">output1.txt</a></td>';

        $path = "users/$queryRow[1]/question2";
        echo '<td><a href="'.$path.'/Question2.cpp">Question2.cpp</a></td>';
        echo '<td><a href="'.$path.'/output.txt">output2.txt</a></td>';

        $path = "users/$queryRow[1]/question3";
        echo '<td><a href="'.$path.'/Question3.java">Question3.java</a></td>';
        echo '<td><a href="'.$path.'/output.txt">output3.txt</a></td>';

        $path = "users/$queryRow[1]/question4";
        echo '<td><a href="'.$path.'/Question4.py">Question4.py</a></td>';
        echo '<td><a href="'.$path.'/output.txt">output4.txt</a></td>';
        echo "</tr>";
        $count+=1;
    }
    echo '
    </tbody>
    </table>';
    echo "</pre>";
}
?>


<!Doctype html>
<html>
    <head>
         <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel = "icon" href ="img/jntuk.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    
    
    <link rel="stylesheet" href="codemirror/theme/ambiance.css">
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <link rel="stylesheet" href="codemirror/addon/hint/show-hint.css">
    <script src="codemirror/addon/hint/show-hint.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>
    <title>Admin</title>
    </head>
    <body>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row" >
		<div class="wrapper">
    	    <div class="side-bar">
                <ul>
                    <div class="row">
                        <li class="menu-head">
                            <a id="head-text" href="#">UCEN_JNTUK 
                            </a>

                            <a>
                            <img class="push_menu pull-right" id="logo" src="img/jntuk.png" alt="JNTUK-Logo">
                            </a>
                        </li>
                    </div>
                    <div class="menu">
                        <li>
                            <a href="ind2.php" class="active">Users<span id="label" class="pull-right"><b>U</b></span></a>
                        </li>
                        <li>
                            <a href="logout.php">Logout<span id="label" class="pull-right"><b>L</b></span></a>
                        </li>
                    </div>
                </ul>
    	    </div>   
            <div class="flex content" id="content">

                <div class="col-md-12 " id="col1">
                    <div class="panel panel-default" id="panel">
                        <div class="panel-heading"><h3><b>Users</b></h3></div>
                        <div id="panelbody">
                        <form action="admin.php" method="post">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <input type="submit" class="btn btn-secondary" value="All" name="all" >
                                <input type="submit" class="btn btn-secondary" value="Qualified" name="qualified">
                                <input type="submit" class="btn btn-secondary" value="Not Qualified" name="notqualified">
                            </div>
                        </form>
                        <?php get()?>
                        </div>
                        </div>
                    </div>
                </div>  

            </div>
		</div>
    </div>
    
</div>
            <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
    
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script>$(document).ready(function(){
        $(".push_menu").click(function(){
                $(".wrapper").toggleClass("active");
                
        });
    });
    </script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script>
        const codemirrorEditor = CodeMirror.fromTextArea(document.getElementById('codearea'), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-csrc",
        theme: "ambiance"
        });
    </script>
    </body>
</html>