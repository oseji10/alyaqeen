<?php
$api_key = '660e4e66e8e1426888e7d867ea7e1ef5';
$api_url = 'https://api.pdfmark.com/pdf';
//$email_to='vctroseji@gmail.com';
//$payload = '{
  //"url" : "https://bloomsacademy.sch.ng/",
//}';
$payload = '{
 "url" : "https://google.com",
  "email_to" : "vctroseji@gmail.com, rayiyk36@gmail.com",
"email_subject": "Blooms Academy Student Result",
"email_body": "You are receving this email because you are the parent/ward of $fullname. Please see below his/her result for: $subject",
"temporary" : true
}';
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_HTTPHEADER => array(
    'key: ' . $api_key
  ),
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $payload
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>
