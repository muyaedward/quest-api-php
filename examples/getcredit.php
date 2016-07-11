<?php

include '../Questsms/Questsms.php';

error_reporting(E_ALL ^ E_NOTICE);

$ws = new Questsms\Questsms();
//This are login details 

$ws->url = 'http://account.questdesigners.com/API/?action=balance';
$ws->username = 'username';
/*
Quest sms allows to ways of authentication, you can use either of your password or API Key,
to access your API key loggin to your account in http://account.questdesigners.com to acquire one.
*/
$ws->password = 'yourpassword';

/*$ws->api_key = 'Your Api KEY';*/

//Call this function to get your account balance
$ws->getCredit();

echo $ws->getResponse();
