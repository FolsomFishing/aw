<?php

//Generic mail function that builds headers, and CC's the from sender
function sendEmail($emailTo, $subject, $body, $emailFrom = "aoty@anglingwes.com") {
    if ($emailTo && $emailFrom && $subject && $body) {
        //build the headers
        $headers = 'To: ' . $emailTo . "\r\n";
        $headers .= 'From: ' . $emailFrom . "\r\n";
        $headers .= 'Cc: ' . $emailFrom . "\r\n";
        mail($emailTo, $subject, $body, $headers);
    }
}

?>
