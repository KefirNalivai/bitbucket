<?php


 session_start();

if(!isset($_SESSION['logged_user']))
{ 
	header("Location: main.php");
 	exit; 
}
?> 
<html> 
<head>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body> Привет <?php echo $_SESSION['name_user']; ?> !
	<button onclick="ex();">Выйти</button>
	<script type="text/javascript">
		function ex()
		{
			 jQuery.ajax({
      dataType: "json",
      method: "POST",
      url: "Server/exitAccountServer.php",
      data: { flag: "hi"}
    }).done(function( msg ) {
    	if(msg['1'] == true)
    	{
    			eraseCookie("log");
    			eraseCookie("sol");
         window.location.replace("main.php"); 
 			
    	}

    });
  		};

  		function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};
		
	</script>
 </body>
 
</html>
