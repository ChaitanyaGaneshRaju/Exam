<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
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
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <link rel="stylesheet" href="codemirror/addon/hint/show-hint.css">
    <script src="codemirror/addon/hint/show-hint.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>

    <link rel="stylesheet" href="css/com.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Instructions</title>
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
                            <a href="index.php" class="active">Instructions<span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="question-1.php" >Digit Frequency <span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="question-2.php">First Come First Serve<span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="question-3.php">Stack Data Structure<span id="label" class="pull-right"></span></a>
                        </li>

                        <li>
                            <a href="question-4.php">Duplicate Elements<span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="help.php">Help<span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="logout.php">Logout<span id="label" class="pull-right"></span></a>
                        </li>
                    </div>
                </ul>
    	    </div>   
            <div class="flex content" id="content">

                <div class="col-md-12 " id="col1">
                    <div class="panel panel-default" id="panel">
                        <div class="panel-heading"><h3><b>Instructions</b></h3><p id="demo"></p></div>
                        <div id="panelbody">
                        <p id="name"><?php echo "Welcome ".$_SESSION['username'].",";?></p>
                        <h4>Before Starting The Exam:</h4>
                        1. First 10min are for reading the instructions. <br />
                        2. Please verify that your name is correct.
                            If not, contact the available faculty in your room.<br/>
                        3. If any tabs were opened, kindly close all those.<br />
                        4. Discussion with others is stricktly prohibited.<br />
                        5. Sharing your code with others is stricktly prohibited<br />
                        6. Finally, Have a sheet of paper to work on.<br />

                        <br />

                        <h4>General Instructions:</h4>
                        1. Total duration of the exam is 2hrs 10min.<br />
                        2. The clock has already been running.<br />
                        3. The count down timer in the question pallet will display 
                           the remaining time availabe for you to complete the exam. <br />
                        4. When the timer reaches to zero, the examination will end it self.
                           You need not to worry regarding the submission.<br />
                        5. You can click on Run button to run the code.<br />

                        <br />

                        <h4>While Taking The Exam:</h4>
                        1. The input to the code is directly given through the variable.<br />
                        2. Standard input to the program through keyboard shouldn't considered by the system.<br />
                        3. Since this is coding and debugging stage, try to remove all the bugs that had given in the editor.<br />
                        4. If you got cleared all the bugs and want to leave, then you can logout.<br />
                        5. Keep all these instructions in the mind. Move on.
                        <br />
                        </div>
                    </div>
                </div>  
                <div id="dialog" title="UCEN_JNTUK says...">
                    <p>Only 10 minutes left for the completion of your Examination.</p>
                </div>
            </div>
		</div>
    </div>
    
</div>
            <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
    
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <script>
        var countDownDate = localStorage.getItem("time");
        
        if (!countDownDate) {
            var today = new Date();
            var fewhours = today.setMinutes(today.getMinutes() + 130);
            localStorage.setItem("time", fewhours);
            // Get time one more time
            countDownDate = localStorage.getItem("time");
        }

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML =hours + ":" +
                minutes + ":" + seconds;
            
                if(hours==0&&minutes==10&&seconds==0)
                {
                    $( function() {
                        $( "#dialog" ).dialog();
                    } );
                }

            // If the count down is over, write some text 
            if (distance < 0) {
                // clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                localStorage.removeItem("time");
                window.location.replace("logout.php");
            }
        }, 1000);
    </script>

    </body>
</html>

