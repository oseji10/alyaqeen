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
            <script language="javascript">
        function emailCurrentPage(){
            window.location.href="mailto:?subject="+document.title+"&body="+escape(window.location.href);
        }
    </script>
<div class="aq-quiz-result" id="print">
<button class="btn btn-white" onclick="printDiv('card-print')" style="background-color:green; color:white"><i class="fa fa-print fa-lg"></i> Print/Save To PDF</button><br/><br/> 

<button class="btn btn-white" onclick="emailCurrentPage()" style="background-color:green; color:white"><i class="fa fa-print fa-lg"></i> Email</button><br/><br/>

<a href="javascript:emailCurrentPage()">Mail this page!</a>

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


<?php  $html=$this->dtQuestions->render(); ?>


</div>

<input type="hidden" name="StatisticsInfoId" value="<?php echo $this->sid; ?>" />

<?php
include_once ("socketlabs-php-main/InjectionApi/src/includes.php");
//or if using composer: include_once ('./vendor/autoload.php');

use Socketlabs\SocketLabsClient;
use Socketlabs\Message\BasicMessage;
use Socketlabs\Message\EmailAddress;

$serverId = 36540;
$injectionApiKey = "Sp85Ngd6DGo7x3XBj9b4";

$client = new SocketLabsClient($serverId, $injectionApiKey);
$email="vctroseji@gmail.com";
$message = new BasicMessage();
$aa=file_get_contents($this->dtQuestions->render());

$message->subject = "Blooms Academy Abuja - Student Assessment Result";
//$message->htmlBody = "<html>Please find result for your child/ward $name below.</html>";
$message->htmlBody = ("This".$aa); 
$message->plainTextBody = "This is the Plain Text Body of my message.";

$message->from = new EmailAddress("info@bloomsacademy.com");
$message->addToAddress($email);
//$att = \Socketlabs\Message\Attachment::createFromPath( "results/"."/$filename");
//$message->attachments[] = $att;
$response = $client->send($message);

echo "<p><img src='images/Blooms_Logo.jpg' width='10%'/></p>";
echo "<p>A PDF version of this result has been successfully sent to: $email, the official email address of $name's parents/guardians.<a href='rez.php'> <br/>Click Her To Go Back To Previous Page</a></p>"

?>
<?php  $html=$this->dtQuestions->render(); ?>

