# Questsms Bulk SMS API PHP 
Quest sms API is a free bulk sms gateway to send bulk sms through the internet

Quest website developers Ltd Official project website:

   https://questdesigners.com/bulk-sms-messages
#Installation
<ul>
<li>Upload all the files in your server, you can also use local server like WAMP and XAMPP</li>
<li>Acquire an account from Quest sms portal at http://account.questdesigners.com.</li>
</ul>
#Examples
When you acquire an account you receive an API KEY. To access to API KEY, navigate to Excel / HTTP API
You can either use your API KEY or your password to use the API, but cannot use both.

#Sending a Simple SMS
A sending script is in examples directory

<pre>
$ws = new Questsms\Questsms();
//This are login details 

$ws->url = 'http://account.questdesigners.com/API/?action=compose';
$ws->username = 'username';
/*
Quest sms allows to ways of authentication, you can use either of your password or API Key,
to access your API key loggin to your account in http://account.questdesigners.com to acquire one.
*/
$ws->password = 'yourpassword';

/*$ws->api_key = 'Your Api KEY';*/

//Fill in the Sender ID approved by your account manager
$ws->from = 'Quest-web';

$phone_numbers = array('+254701234567', '+254701234567');

$sendto = implode(',', $phone_numbers);

$ws->to = $sendto;
$ws->msg = 'Your Message here';
$ws->sendSms();
</pre>

#How to get SMS Balance
<pre>
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
</pre>
