<?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                $link = mysqli_connect("localhost", "voseji", "2wsxzaQ1!s", "jamiya");
                // Check connection
                if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                ?>
<?php
  $i=1;
  $a=$_GET['registration_number'];
  $score=$_GET['score'];
  $maxscore=$_GET['maxscore'];
  $sql="Select zcmrq_ariquizstatisticsinfo.*, za.QuizName, zu.* from zcmrq_ariquizstatisticsinfo
    JOIN zcmrq_ariquiz za on zcmrq_ariquizstatisticsinfo.QuizId = za.QuizId
         JOIN zcmrq_users zu ON zcmrq_ariquizstatisticsinfo.UserId=zu.id
         WHERE zu.username='".$a."'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);
$fname=$row["name"];
$infoID=$row["StatisticsInfoId"];
$quizname=$row["QuizName"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Result Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Blooms Academy, Abuja</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>

      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <img src="logo.png" width="50%"   style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;"/><br/>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="login.php">Logout</a></li>

      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        
        <table border="1" width="100%" style="border-collapse: collapse">
            <tr>
                <td><h4>Student Name: </h4></td>
                <td><h4><?php echo $fname ?></h4></td>
</tr>
            <tr>
                <td><h4>Subject: </h4></td>
                <td><h4><?php echo $quizname ?></h4></td>
</tr>

            <tr>
                <td><h4>Score: </h4></td>
                <td><h4><b><?php echo $score ?>/<?php echo $maxscore ?></b></h4></td>
</tr>

</table>
      </div>
  
   
      </div>

        <div class="col-sm-9">
          <div class="well">
<?php
  $i=1;
  $a=$_GET['infoID'];

  $sql="SELECT DISTINCTROW zcmrq_ariquizquestionversion.Question, zcmrq_ariquizquestionversion.Data as Data, zcmrq_ariquizstatistics.StatisticsId, zcmrq_ariquizstatisticsinfo.UserId, zcmrq_users.*, za.QuizName FROM zcmrq_ariquizstatistics
JOIN zcmrq_ariquizquestionversion ON zcmrq_ariquizquestionversion.QuestionId=zcmrq_ariquizstatistics.QuestionId
JOIN zcmrq_ariquizstatisticsinfo ON zcmrq_ariquizstatistics.StatisticsInfoId=zcmrq_ariquizstatisticsinfo.StatisticsInfoId
JOIN zcmrq_users ON id = zcmrq_ariquizstatisticsinfo.UserId
JOIN zcmrq_ariquiz za on zcmrq_ariquizstatisticsinfo.QuizId = za.QuizId
WHERE zcmrq_ariquizstatistics.StatisticsInfoId='".$a."'";


 if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){

                    echo "<table border='1' id='example2' style='border-collapse:collapse;' align='center' width='50%' class='table table-striped table-bordered mb-0'>";
									echo "<thead>";
                                    echo "<tr>";
									echo "<th>&nbsp;&nbsp;SN</th>";
                                    echo "<th>&nbsp;&nbsp;Question</th>";
                                    // echo "<th>&nbsp;&nbsp;STUDENT NAME</th>";
                                //    echo "<th>&nbsp;&nbsp;SCORE</th>";
								
                                   echo "</tr>";
                                   echo "</thead>";
                                //    echo "</table>";
                                   while($row = mysqli_fetch_array($result)){
                                        //include "count_one_sale.php";
                                      
                                        $question=$row['Question'];
                                        $data=$row["Data"];
//                                     $xml = $data;

// $dom = new \DOMDocument('1.0');
// $dom->preserveWhiteSpace = false;
// $dom->formatOutput = true;
// $dom->loadXML($xml);
// $xml_pretty = $dom->saveXML();

// $xml_data = simplexml_load_string($xml) or 
// die("Error: Object Creation failure");
//                                     foreach ($xml_data->children() as $data2)
// {
// echo "<td>" . $data2 . "</td>";


// }	

									echo "<tr>";
									echo "<td>  &nbsp;&nbsp;" .$i++."</td>";
                                    echo "<td>  &nbsp;&nbsp;" .$question."<br/>";
                                    $xml = $data;
$opt="A";
$dom = new \DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml);
$xml_pretty = $dom->saveXML();

$xml_data = simplexml_load_string($xml) or 
die("Error: Object Creation failure");
                                    foreach ($xml_data->children() as $data2)
{
echo $opt++ ."" . $data2 ;


}				
echo "</td>";
echo "</tr>";
								}
		
								echo "</table>";



                echo "</div>";
              echo "</div>";
                // Free result set
                mysqli_free_result($result);
                }
                else{
                echo "No records matching your query were found.";
                }
                } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
                // Close connection

                mysqli_close($link);

// $loc_id=$row["loc_id"];
?>
          </div>
        </div>
      </div>

   
      </div>
    </div>
  </div>
</div>

</body>
</html>
