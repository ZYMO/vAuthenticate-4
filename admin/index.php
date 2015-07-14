<?php

/*
# File: admin/index.php

# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

    require_once ('../auth.php');
    require_once ('../authconfig.php');
    require_once ('../check.php');

	if ($check["level"] != 1)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.

		print "<b>Illegal Access</b>";
		print "<br>";
		print "<b>You do not have permission to view this page.</b>";

		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}

?>

<html>
<head>
  <title>vAuthenticate Administrative Interface</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><b>vAuthenticate Administration</b></p>
<table width="75%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" bgcolor="#0099CC" height="16"><b>Administer</b></td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="authuser.php">Users</a></div>
    </td>
    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="authgroup.php">Groups</a></div>
    </td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="<? echo $logout; ?>">Logout</a></div>
    </td>
  </tr>
</table>
<table width="75%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle">
      <p>&nbsp;</p>
    </td>
  </tr>
  <tr>
    <td valign="middle">Welcome
      to the administration panel of vAuthenticate! Please click on any of the
      five (5) administrative functions above. Below is a description of each
      function:

<p>
<b>Settings</b> - Control site-wide signup and security settings.</p>

<p>
<b>Users</b> - Add, modify, activate/inactivate, delete, and group users.</p>

<p>
<b>Groups</b> - Create, modify, activate/inactivate, and delete groups.</p>

<p>
<b>Emailer</b> - Customize profiles for the types of email to be sent for notification.</p>

<p>
<b>Logout</b> - End the current session.</p>


    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
