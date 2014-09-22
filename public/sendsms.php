<?php
require_once 'oneapi/client.php';

# example:initialize-sms-client
$smsClient = new SmsClient("mbwilo", "YWtzx5PH");
# ----------------------------------------------------------------------------------------------------

$conn = mysql_connect("localhost","root","kevdom");
mysql_select_db("cancer");
$query = mysql_query('select * from notification WHERE status="pending"');
while($row = mysql_fetch_array($query)){
#   example:prepare-message-without-notify-url
    if(strtotime($row['next_visit'])-strtotime(date('Y-m-d')) <= 86400 ){
        $smsMessage = new SMSRequest();
        $smsMessage->senderAddress = "CECAP-PROGRAM";
        $smsMessage->address = "+255".substr($row['phone_number'],1);
        $smsMessage->message = $row['message'];
# ----------------------------------------------------------------------------------------------------

# example:send-message
        $smsMessageSendResult = $smsClient->sendSMS($smsMessage) or die();
        if($smsMessageSendResult){
        $query = mysql_query('UPDATE notification SET status="sent" WHERE id="'.$row['id'].'"');
        }
# ----------------------------------------------------------------------------------------------------
    }

}