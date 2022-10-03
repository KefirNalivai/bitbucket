<?php
function checkErrors($regLog, $regPass, $regRetryPass, $regMail, $regName, $my_arr) {
	$regLogE = "";
$regPassE = "";
$regRetryPassE = "";
$regMailE = "";
$regNameE = "";
$regCondition = true;
if($my_arr !== null)
{
for ($i = 0; $i < count($my_arr); $i++)
{
	if($regLog ==  $my_arr[$i]['login'])
	{
		$regLogE = "This login already registered";
		$regCondition = false;
	}

	if($regMail ==  $my_arr[$i]['mail'])
	{
		$regMailE = "This mail already registered";
		$regCondition = false;
	}
}
}

if(strlen($regLog) < 6)
{
	$regLogE = "Count of login character should more or equal at 6";
	$regCondition = false;
}

if(strlen($regLog) == 0)
{
	$regLogE = "Please, enter login";
	$regCondition = false;
}

if($regPass != $regRetryPass)
{
	$regPassE = "Retry password does not match the password";
	$regCondition = false;
}

if($regPass != $regRetryPass)
{
	$regPassE = "Retry password does not match the password";
	$regCondition = false;
}

if(strlen($regName) < 2)
{
	$regNameE = "Count of name character should more or equal at 2";
	$regCondition = false;
}

if(strlen($regName) == 0)
{
	$regNameE = "Please, enter you name";
	$regCondition = false;
}

if (preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z0-9]+/", $regPass) || preg_match_all("/[0-9]/", $regPass) <= 0 || preg_match_all("/[А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z]/", $regPass) <= 0) {
 	$regPassE = "Password does include letters and digits.";
	$regCondition = false;
}

if(strlen($regPass) < 6)
{
	$regPassE = "Count of password character should more or equal at 6";
	$regCondition = false;
}

if(strlen($regPass) == 0)
{
	$regPassE = "Please, enter password";
	$regCondition = false;
}

if (preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z\-_]+/", $regName)) {
 	$regNameE = "Founded incorrect value. Only latters.";
	$regCondition = false;
}

if (!filter_var($regMail, FILTER_VALIDATE_EMAIL)) {
$regMailE = "Invalid Email";
$regCondition = false;
}

if(strlen($regMail) == 0)
{
	$regMailE = "Please, enter E-mail";
	$regCondition = false;
}

   return [ $regCondition, $regLogE, $regPassE, $regRetryPassE, $regMailE, $regNameE];
};

function saltHesh($cost = 13) {
	if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
        throw new Exception("cost parameter must be between 4 and 31");
    }
    $rand = array();
    for ($i = 0; $i < 8; $i += 1) {
        $rand[] = pack('S', mt_rand(0, 0xffff));
    }
    $rand[] = substr(microtime(), 2, 6);
    $rand = sha1(implode('', $rand), true);
    $salt = '$2a$' . sprintf('%02d', $cost) . '$';
    $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
    return $salt;
};
?>

<?php 
function checkcookie($inName, $inHesh)
 {
session_start();
$file = file_get_contents('Server/data.json');
$my_arr = json_decode($file, true);

for ($i = 0; $i < count($my_arr); $i++)
{
	if($inName ==  $my_arr[$i]['login'] && $inHesh ==  $my_arr[$i]['hesh'])
	{
		$_SESSION['logged_user'] = $my_arr[$i]['login'];
		$_SESSION['name_user'] = $my_arr[$i]['name'];
		break;
	}
}

 }
 ?>