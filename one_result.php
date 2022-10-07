<a id="saveAsPdfBtn" href="https://www.sejda.com/html-to-pdf">Save as PDF</a>
<script>
document.getElementById('saveAsPdfBtn').addEventListener('click', function(e){
  var pageUrl = encodeURIComponent(window.location.href);
  var opts = ['save-link=' + pageUrl, 'pageOrientation=auto'];
  window.open('https://www.sejda.com/html-to-pdf?' + opts.join('&'));
  e.preventDefault();
});
</script>
<?php
ob_start();
?>
<?php
$servername = "localhost";
$username = "voseji";
$password = "2wsxzaQ1!s";
$dbname = "jamiya";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$score=$_GET['s'];
$sid=$_GET['sid'];
$fullname=$_GET['fullname'];
$subject=$_GET['subject'];
$qid=$_GET['QuizId'];
$username=$_GET['username'];


$htm="<h4>Student Name:&nbsp;".$fullname."</h4>
<h4>Student ID:&nbsp;".$username."</h4>
<h4>Subject:&nbsp;".$subject."</h4>
<h4>Score:&nbsp;".$score."</h4>"
;

$sql = "SELECT DISTINCTROW zcmrq_ariquizquestionversion.Question, zcmrq_ariquizquestionversion.Data as Data, zcmrq_ariquizstatistics.StatisticsId, zcmrq_ariquizstatisticsinfo.UserId FROM zcmrq_ariquizstatistics 
JOIN zcmrq_ariquizquestionversion ON zcmrq_ariquizquestionversion.QuestionId=zcmrq_ariquizstatistics.QuestionId
JOIN zcmrq_ariquizstatisticsinfo ON zcmrq_ariquizstatistics.StatisticsInfoId=zcmrq_ariquizstatisticsinfo.StatisticsInfoId
WHERE zcmrq_ariquizstatistics.StatisticsInfoId='".$sid."'";
$result = $conn->query($sql);

$i="1";
$numbring="1";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $que=$row["Question"];
    $data=$row["Data"];
    
$xml = $data;

$dom = new \DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml);
$xml_pretty = $dom->saveXML();

$xml_data = simplexml_load_string($xml) or 
die("Error: Object Creation failure");

echo "<p>" .$que."</p>";
foreach ($xml_data->children() as $data2)
{
//$oop .=$data2;

$mm=  $data2. "<br/>";
echo $mm;
}

//$opt=A;

//$html2 .="";

//"<p>" .$que."</p>";




      
    }
} else {
    echo "0 results";
}







$conn->close();
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$band="{$htm}{$html2}";
$dompdf->loadHtml($band);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

$output = $dompdf->output();
$filename="{$username}{$qid}.pdf";
// $dir = __DIR__ . "/results"; 
file_put_contents("results/"."$filename", $output);
// echo $aa;
?>

