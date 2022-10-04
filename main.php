

<?php
session_start();
include('Server/functions.php');
if (isset($_COOKIE['log']) and isset($_COOKIE['sol'] ) )
(
  checkcookie($_COOKIE['log'], $_COOKIE['sol'])
);

 
 if(isset($_SESSION['logged_user'])){
   header("Location: logged.php");
 }
 ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form id = "registrationForm" >
<div>
<label for="regLog">Login:  </label><br>
<input id="regLog"><label style="color: red" id = "regLogE"></label><br>
<label for="regPass">Password:  </label><br>
<input type="password" id="regPass"><label style="color: red" id = "regPassE"></label><br>
<label for="regRetryPass">Confirm Password:  </label><br>
<input type="password" id="regRetryPass"><label style="color: red" id = "regRetryPassE"></label><br>
<label for="regMail">Email:  </label><br>
<input id="regMail"><label style="color: red" id = "regMailE"></label><br>
<label for="regName">Real Name:  </label><br>
<input id="regName"><label style="color: red" id = "regNameE"></label><br><br>
<script type="text/javascript">
document.write('<input type="submit" id = "regBut" value="Register" onclick="Register(); return false;">');
</script>
<noscript>
 <input type="button" id = "regBut" value="Register" onclick="return false;">
</noscript>
<script type="text/javascript">
document.write('<input type="submit" value="Go to log" onclick="ChangeForm(); return false;">');
</script>
<noscript>
<input type="button" id = "regBut" value="Go to log" onclick="return false;">
  </noscript>
</div>
</form>
<form id = "loginForm" style="display: none;">
<div>
<label for="Log">Login:  </label><br>
<input id="Log"><label style="color: red" id = "regLogE"></label><br>
<label for="Pass">Password:  </label><br>
<input type="password" id="Pass"><label style="color: red" id = "regPassE"></label><br>

<input type="submit" value="Login" onclick="logg(); return false;">
<input type="submit" value="Go to registration" onclick="ChangeForm(); return false;">

</div>
</form>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
  function Register()
  {
          jQuery('#regLogE').text("");
          jQuery('#regPassE').text("");
          jQuery('#regMailE').text("");
          jQuery('#regNameE').text("");
    jQuery.ajax({
      dataType: "json",
      method: "POST",
      url: "Server/regServer.php",
      data: { regLog: jQuery('#regLog').val(), regPass: jQuery('#regPass').val(), regRetryPass: jQuery('#regRetryPass').val(), regMail: jQuery('#regMail').val(), regName: jQuery('#regName').val()}
    }).done(function( msg ) {
      if(msg["oper"] === true)
      {
          alert("You been registered! Please, log in you account");
          jQuery('#Log').val(jQuery('#regLog').val());
          ChangeForm();          
      }
        else
        {
          jQuery('#regLogE').text(msg["login"]);
          jQuery('#regPassE').text(msg["password"]);
          jQuery('#regMailE').text(msg["mail"]);
          jQuery('#regNameE').text(msg["name"]);
        }
    });
  }
  
</script>


<script>
	function logg()
  {
    jQuery.ajax({
      dataType: "json",
      method: "POST",
      url: "Server/logServer.php",
      data: { login: jQuery('#Log').val(), password: jQuery('#Pass').val()}
    }).done(function( msg ) {
    	if(msg["3"] == true)
      {
        var now = new Date();
        var time = now.getTime();
        var expireTime = time + 3600 * 10;
        now.setTime(expireTime);
        document.cookie = "log="+msg["1"]+";expires="+ now.toUTCString();
        document.cookie = "sol="+ msg["4"]+";expires="+ now.toUTCString();
      	window.location.replace("logged.php");
      }
      	else
      		alert("User not be finded");
    });
  }
</script>


<script>
  function ChangeForm()
  {
    if($("#loginForm").is(':visible'))
    {
        $("#loginForm").css({"display":"none"});
        $("#registrationForm").css({"display":"block"});
    }
    else
    {
        $("#loginForm").css({"display":"block"});
        $("#registrationForm").css({"display":"none"});
    }

  };

  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
};
</script>
</body>
</html>