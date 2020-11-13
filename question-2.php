
<?php

session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}


$flag=0;
if(isset($_POST['submit'])){
  $code=$_POST['codearea'];   
  $email=$_SESSION['email'];
  $path = __DIR__."/users/$email/question2";
  $Saved_File = fopen($path.'/Question2.cpp', 'w');
  fwrite($Saved_File, $code);
  fclose($Saved_File);
  $oldmask = umask(0);
  $run=shell_exec("g++ $path/Question2.cpp -o $path/Question2 2> $path/error.txt");
  
  if ( '' == file_get_contents( "$path/error.txt" ) ){
      $flag=1;
  }
  else{
    $flag=2;
    $text ="\/opt\/lampp\/htdocs\/Exam\/users\/".$email."\/question2\/";
    system("sed -i 's/$text//g' users/$email/question2/error.txt");
  }

}

function displayerror(){
    global $flag;
    global $path;
    if($flag==0){
        echo "<pre> Click Run button to run the program</pre>";
    }

    else if($flag==1){
        echo "<pre>".shell_exec("$path/Question2;$path/Question2 > $path/output.txt")."</pre>";
        echo "<pre>Program has been successfully executed</pre>";
        system("cmp outputs/Question2.txt $path/output.txt > $path/diff.txt");
        if (file_get_contents( "$path/diff.txt" ) ){
        
            echo "<pre class=\"bg-danger text-white\">Your output didn't matched with the desired one.</pre>";
        }
        else{
            echo "<pre class=\"bg-success text-white\">Your output got matched</pre>";
        }
    }
    else if($flag==2){
        $file = fopen($path."/error.txt", "r");
        echo '<pre>';
        while(($line = fgets($file)) !== false) {
          echo $line ;
        }
        echo '</pre>';
        fclose($file);
    }
}

function getcontent($file){
  echo file_get_contents($file);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="codemirror/addon/hint/show-hint.css">
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="codemirror/theme/icecoder.css">
    <link rel="stylesheet" href="css/Question.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/blitzer/jquery-ui.css">
    <title>Question 2</title>
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
                            <a href="index.php">Instructions<span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="question-1.php">Digit Frequency <span id="label" class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="question-2.php" class="active">First Come First Serve<span id="label" class="pull-right"></span></a>
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

                <div class="col-md-6 split" id="col1">
                    <div class="panel panel-default" id="panel">
                        <div class="panel-heading"><h4>First Come First Serve</h4></div>
                        <div id="panelbody">

                        Given n processes with their burst times, the task is to find average waiting time and average turn around time using FCFS scheduling algorithm.<br /> <br />
                        First in, first out (FIFO), also known as first come, first served (FCFS), is the simplest scheduling algorithm. FIFO simply queues processes in the order that they arrive in the ready queue.<br /> <br />
                        In this, the process that comes first will be executed first and next process starts only after the previous gets fully executed.<br />
                        Here we are considering that arrival time for all processes is 0.<br />

                        <br />
                        <b>How to compute the times?</b><br /> 
                        <li>
                            Completion Time: Time at which process completes its execution.
                        </li>
                        <li>
                        Turn Around Time: Time Difference between completion time and arrival time. 
                        <ul><li>Turn Around Time = Completion Time – Arrival Time</li></ul>
                        </li>
                        <li>
                        Waiting Time(W.T): Time Difference between turn around time and burst time.
                        </li>
                        <li>
                        Waiting Time = Turn Around Time – Burst Time
                        </li>
                        The first line contains a string,<i><b>num</b></i>  which is the given number.<br />
                        <br />
                        <b> In this post, we have assumed arrival times as 0, so turn around and completion times are same. </b><br />
                        <pre><img src="img/fcfs.png" width="400" height="250" /></pre>
                        <b>Sample Output :</b><br />
                        <pre>Processes  Burst time  Waiting time  Turn around time
 1		15	 0		 15
 2		10	 15		 25
 3		20	 25		 45
 4		40	 45		 85
 5		5	 85		 90
Average waiting time = 34
Average turn around time = 52</pre>
                        <b>Actual Output:</b><br />
                        <pre>Processes  Burst time  Waiting time  Turn around time
 1		10	 0		 10
 2		5	 10		 15
 3		8	 15		 23
Average waiting time = 8.33333
Average turn around time = 16</pre>
                        </div>
                    </div>
                </div>  





                <div class="col-md-6 split" id="col2">
                    <div class="panel panel-default" id="panel">
                        <div class="panel-heading d-flex"><p id="demo" ></p>
                        <form id="myform" class="ml-auto" method="post">
                            <button data-target="codearea" id="run-btn" name="submit" type="submit"><span>Run<span></button>
                        </div>
                        <div id="panelbody">
                            <textarea id="codearea" name="codearea"><?php echo getcontent("users/".$_SESSION['email']."/question2/Question2.cpp")?></textarea> 
                        </div>
                        </form>
                        <pre frameborder="0" name="Editor"><?php displayerror()?></pre>
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
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/addon/hint/show-hint.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
        theme: "icecoder"
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
            document.getElementById("demo").innerHTML = hours + ":" +
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

