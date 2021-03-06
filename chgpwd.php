<?php

/*
# File: chgpwd.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

	include_once ("auth.php");
	include_once ("authconfig.php");
	include_once ("check.php");
?>

<head>
	<title>Change Password</title>
</head>
<body bgcolor="#FFFFFF">

<p align="center"><b>Change Password</b></p>
<div align="center">

  <form method="POST" action="chgpwd.php">
  <table border="0" cellpadding="0" cellspacing="0" width="40%">
    <tr>
      <td width="100%" bgcolor="#C0C0C0" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td  bgcolor="#C0C0C0">
          <label>
						 Old Password:
              <input type="password" name="oldpasswd" size="25">
          </label>
				</td>
    </tr>
    <tr>
      <td bgcolor="#C0C0C0">

          <label>
						 New Password:
              <input type="password" name="newpasswd" size="25">
          </label></td>
    </tr>
    <tr>
      <td bgcolor="#C0C0C0">
          <label>
						Confirm:
              <input type="password" name="confirmpasswd" size="25">
          </label>
				</td>
    </tr>
    <tr>
      <td width="100%" colspan="2" bgcolor="#C0C0C0">&nbsp; </td>
    </tr>
    <tr>
      <td width="100%" colspan="2" bgcolor="#C0C0C0">
      <p align="center"><input type="submit" value="Save Changes" name="submit">
      <input type="reset" value="Reset Fields" name="reset"></td>
    </tr>
    <tr>
      <td width="100%" colspan="2" bgcolor="#C0C0C0">&nbsp;
       </td>
    </tr>
  </table>
  </form>

</div>

<?php

	// Get global variable values if there are any
	if (isset($_POST['submit']))
	{
		$USERNAME = $_COOKIE['USERNAME'];
		$PASSWORD = $_COOKIE['PASSWORD'];
		$submit = $_POST['submit'];
		$oldpasswd = $_POST['oldpasswd'];
		$newpasswd = $_POST['newpasswd'];
		$confirmpasswd = $_POST['confirmpasswd'];
    }
	else
	{
		$submit = "";
	}

	$user = new auth();
	$connection = mysqli_connect($dbhost, $dbusername, $dbpass);

	// REVISED CODE
	$SelectedDB = mysqli_select_db($dbname);
	$userdata = mysqli_query("SELECT * FROM authuserWHERE uname='$USERNAME' and passwd='$PASSWORD'");

	if ($submit)
	{
		// Check if Old password is the correct
		if ($oldpasswd != $PASSWORD)
		{
			print "<p align=\"center\">";

			print "		<b>Old password is wrong!</b>";

			print "</p>";
			exit;
		}

		// Check if New password if blank
		if (trim($newpasswd) == "")
		{
			print "<p align=\"center\">";

			print "		<b>New password cannot be blank!</b>";

			print "</p>";
			exit;
		}

		// Check if New password is confirmed
		if ($newpasswd != $confirmpasswd)
		{
			print "<p align=\"center\">";

			print "		<b>New password was not confirmed!</b>";

			print "</p>";
			exit;
		}

		// If everything is ok, use auth class to modify the record
		$update = $user->modify_user($USERNAME, $newpasswd, $check["team"], $check["level"], $check["status"]);
		if ($update) {
			print "<p align=\"center\">";

			print "		<b>Password Changed!</b><br>";
			print "		You will be required to re-login so that your session will recognize the new password. <BR>";
			print "		Click <a href=\"$login\">here</a> to login again.";

			print "</p>";
		}

	}	// end - new password field is not empty // DEBUG Line 132 : $login EXTERNAL_FRAGMENT //

?>

</body>
