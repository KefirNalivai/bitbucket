<?php
session_start();
$regLog = ($_POST['flag']);
$exitFlag = array('1' => true);
session_destroy();
echo json_encode($exitFlag);

?>