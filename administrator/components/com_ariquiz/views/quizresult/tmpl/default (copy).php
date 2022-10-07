<?php



$con=mysqli_connect("localhost","voseji","2wsxzaQ1!s","jamiya");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<?php
$a=$this->sid;
$sql = "SELECT zcmrq_ariquizstatisticsinfo.*, zcmrq_users.name, zcmrq_ariquiz.QuizName FROM zcmrq_ariquizstatisticsinfo 
JOIN zcmrq_users ON zcmrq_users.id=zcmrq_ariquizstatisticsinfo.UserId
JOIN zcmrq_ariquiz ON zcmrq_ariquiz.QuizId=zcmrq_ariquizstatisticsinfo.QuizId
-- JOIN zcmrq_ariquizstatistics ON zcmrq_ariquizstatistics.StatisticsInfoId=zcmrq_ariquizstatisticsinfo.StatisticsInfoId
WHERE StatisticsInfoId='".$a."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$UserId=$row["UserId"];
$name=$row["name"];
$QuizName=$row["QuizName"];
//$Score=$row["Score2"];


$sql2 = "SELECT SUM(zcmrq_ariquizstatistics.Score) AS Score2 FROM zcmrq_ariquizstatistics WHERE StatisticsInfoId='".$a."'";
$result2=mysqli_query($con,$sql2);
$row2=mysqli_fetch_assoc($result2);
$Score2=$row2["Score2"];


?>
<?php
/*
 *
 * @package		ARI Quiz
 * @author		ARI Soft
 * @copyright	Copyright (c) 2011 www.ari-soft.com. All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
 * 
 */

(defined('_JEXEC') && defined('ARI_FRAMEWORK_LOADED')) or die;
?>
<script>
   function printDiv(print) {
     var printContents = document.getElementById('print').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        </script>
<div class="aq-quiz-result" id="print">
<button class="btn btn-white" onclick="printDiv('card-print')" style="background-color:green; color:white"><i class="fa fa-print fa-lg"></i> Print/Save To PDF</button><br/><br/>
<table style="border-collapse:collapse" border="1" width="100%">
<tr>
        <td><h3>Student Name: </h3></td>
        <td><h3><?php echo $name; ?></h3></td>
</tr>
<tr>
        <td><h3>Subject: </h3></td>
        <td><h3><?php echo $QuizName; ?></h3></td>
</tr>
<tr>
        <td><h3>Total Score: </h3></td>
        <td><h3><?php echo $Score2; ?></h3></td>
</tr>
</table>


<?php 
$rr=$this->dtQuestions->render(); 
$html="
<table style='border-collapse:collapse' border='1' width='100%'>
<tr>
        <td><h3>Student Name: </h3></td>
        <td><h3>$name</h3></td>
</tr>
<tr>
        <td><h3>Subject: </h3></td>
        <td><h3>$QuizName</h3></td>
</tr>
<tr>
        <td><h3>Total Score: </h3></td>
        <td><h3>$Score2</h3></td>
</tr>
</table>
$rr
";
 $this->dtQuestions->render(); 
 ?>


</div>

<input type="hidden" name="StatisticsInfoId" value="<?php echo $this->sid; ?>" />

<?php
//$html="<p>Hi</p>";
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
//$dompdf->$this->dtQuestions->render();
$dompdf->render();

$output = $dompdf->output();
$filename="$name.pdf";
// $dir = __DIR__ . "/results"; 
file_put_contents("/var/www/html/var/www/cbt/administrator/components/com_ariquiz/views/quizresult/tmpl/results2/"."$filename", $output);
// echo $aa;
?>

