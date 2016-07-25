<?php

include '../Questsms/Questsms.php';

error_reporting(E_ALL ^ E_NOTICE);

$ws = new Questsms\Questsms();
//This are login details 

$ws->url = 'http://account.questdesigners.com/API/?action=schedule';
$ws->username = 'username';
/*
Quest sms allows to ways of authentication, you can use either of your password or API Key,
to access your API key loggin to your account in http://account.questdesigners.com to acquire one.
*/
$ws->password = 'yourpassword';

/*$ws->api_key = 'Your Api KEY';*/

//Fill in the Sender ID approved by your account manager
$ws->from = 'Quest-web';
$ws->schedule = '2016-07-11 17:18:12';

$phone_numbers = array('+2547********', '+2547********');

$sendto = implode(',', $phone_numbers);

$ws->to = $sendto;
$ws->msg = 'Your Message here';
$ws->sendSms();


echo $ws->getResponse();

