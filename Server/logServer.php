<?php
session_start();
$file = file_get_contents('data.json');
$colors = array('1' => "null", '2' =>"null", '3' => false);
$log = ($_POST['login']);
$pas = ($_POST['password']);
$my_arr = json_decode($file, true);

for ($i = 0; $i < count($my_arr); $i++)
{
	if($log ==  $my_arr[$i]['login'] && md5($pas . $my_arr[$i]['hesh']) ==  $my_arr[$i]['password'])
	{
		$colors = array('1' => $my_arr[$i]['login'], '2' => $my_arr[$i]['password'], '3' => true, '4' => $my_arr[$i]['hesh']);
		$_SESSION['logged_user'] = $my_arr[$i]['login'];
		$_SESSION['name_user'] = $my_arr[$i]['name'];
	}


}
echo json_encode($colors);

?>