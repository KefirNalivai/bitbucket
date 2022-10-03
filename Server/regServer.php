<?php
include('functions.php');
include('CRUD.php');
$regLog = ($_POST['regLog']);
$regPass = ($_POST['regPass']);
$regRetryPass = ($_POST['regRetryPass']);
$regMail = ($_POST['regMail']);
$regName = ($_POST['regName']);

$filename = 'data.json';
if (file_exists($filename)) {
    $file = file_get_contents('data.json');
} else {
    $file = fopen("data.json", "a+");
}
	
$crudd = new crud($regLog, $regPass, $regMail, $regName, saltHesh(), file_get_contents($filename));
$my_arr = $crudd->readData();
[$regCondition, $regLogE, $regPassE, $regRetryPassE, $regMailE, $regNameE] = checkErrors($regLog, $regPass, $regRetryPass, $regMail, $regName, $my_arr);

if($regCondition)
{
$crudd->inputData();
$array = array(
	'oper' => true, 
);
echo json_encode($array);
}
else
{
	$array = array(
		'login' => $regLogE, 
		'password' => $regPassE, 
		'mail' => $regMailE, 
		'name' => $regNameE,
		'oper' => false,
	);
	echo json_encode($array);	
}
?>