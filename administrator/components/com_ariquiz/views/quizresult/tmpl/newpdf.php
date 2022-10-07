<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

$con=mysqli_connect("localhost","voseji","2wsxzaQ1!s","jamiya");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<?php
$a=$this->sid;

	$query = AriDBUtils::getQuery();
		$query->select(array(
			'IF(S.BankVersionId = 0, S.QuestionVersionId, S.BankVersionId) AS BaseQuestionVersionId',
			'S.Data AS UserData',
			'S.InitData',
			'S.QuestionIndex',
			'S.QuestionId',
			'S.StatisticsId',
			'S.Score AS UserScore',
			'S.AttemptCount',
			'IF(QV2.QuestionId,QV2.AttemptCount,QV.AttemptCount) AS MaxAttemptCount',
			'IF(QV2.QuestionId,QV2.OnlyCorrectAnswer,QV.OnlyCorrectAnswer) AS OnlyCorrectAnswer',
			'IFNULL(IF(QV.Score, QV.Score, QV2.Score), 0.00) AS MaxScore',
			'IF(QV2.QuestionId,QV2.Question,QV.Question) AS Question',
			'IF(QV2.QuestionId,QV2.Note,QV.Note) AS QuestionNote',
			'IF(QV2.QuestionId,QV2.Data,QV.Data) AS QuestionData',
			'IF(QV2.QuestionId, QV2.QuestionTypeId',
			'QV.QuestionTypeId) AS QuestionTypeId',
			'QT.ClassName AS QuestionClassName',
			'QT.QuestionType',
			'QC.CategoryName',
			'S.ElapsedTime AS TotalTime', 
			'SP.PageTime AS QuestionTime', 
			'SI.TotalTime AS QuizTotalTime',
			'SI.TicketId' 
		));
		$query->from('#__ariquizstatisticsinfo SI');
		$query->innerJoin('#__ariquizstatistics S ON SI.StatisticsInfoId = S.StatisticsInfoId');
		$query->innerJoin('#__ariquizstatistics_pages SP ON SP.PageId = S.PageId');
		$query->innerJoin('#__ariquizquestionversion QV ON S.QuestionVersionId = QV.QuestionVersionId');
		$query->leftJoin('#__ariquizquestionversion QV2 ON S.BankVersionId = QV2.QuestionVersionId');
		$query->innerJoin('#__ariquizquestiontype QT ON IFNULL(QV2.QuestionTypeId, QV.QuestionTypeId) = QT.QuestionTypeId');
		$query->leftJoin('#__ariquizquestioncategory QC ON S.QuestionCategoryId = QC.QuestionCategoryId');
		$query->where('SI.StatisticsInfoId = ' . $a);

?>
<?php
$html="<p>Hi</p>";
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
$dompdf->render();

$output = $dompdf->output();
$filename="KK.pdf";
// $dir = __DIR__ . "/results"; 
file_put_contents("$filename", $output);
// echo $aa;
?>
