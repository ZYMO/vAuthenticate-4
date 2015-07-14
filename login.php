<?php

/*
# File: login.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

    include_once ("authconfig.php");

?>
<html>
<head>
    <title>User Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<p><b>Login</b></p>

<form name="Sample" method="post" action="<?php print $resultpage ?>">
  <table width="40%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" bgcolor="#FFFFCC" valign="middle">
        <div align="center">vAuthenticate</div>
      </td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" valign="middle">
        <label>
            Username
            <input type="text" name="username" size="15" maxlength="15">
        </label>
      </td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" valign="middle">
        <label>
            Password
            <input type="password" name="password" size="15" maxlength="15">
        </label>
      </td>
  </tr>
    <tr valign="middle" bgcolor="#CCCCCC">
      <td colspan="2">
        <div align="center">
          <input type="submit" name="Login" value="Login">
          <input type="reset" name="Clear" value="Clear">
        </div>
      </td>
  </tr>
</table>
</form>

<p>&nbsp;</p>

</body>
</html>
