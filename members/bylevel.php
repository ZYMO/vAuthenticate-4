<?php

/*
# File: members/bylevel.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

?>

<html>
<head>
<?php 

	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");

    if (($check['level'] < 4) || ($check['level'] > 6))
    {
        echo 'You are not allowed to access this page.';
		exit();
	}

?>

<title>vAuthenticate Sample Member Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="84%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" valign="top"><b>vAuthenticate: Sample Authentication Page</b></td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b>Access Restriction:</b></td>
    <td width="73%" valign="top">Per Level - Any Group</td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b>Access Rights:</b></td>
    <td width="73%" valign="top">Level 4, Level 5, Level 6</td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b>Details:</b></td>
    <td width="73%" valign="top">Only
      members with level between 4, 5, and 6 are allowed to see this page (unless
      you've changed the code). This is an example of a page being secured on
      a per-group basis. </td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b>Code:</b></td>
    <td width="73%" valign="top">
      <p>The following
        code snippet is an example of how to implement this type of access restriction.
        Put this code on top of your pages which will be governed by this type
        of security. Please note that this is only an example and you would need
        to make certain adjustments based on your preferences. Here's the code
        snippet:</p>
      <blockquote>
        <p>&lt;?php<br>
          &nbsp;&nbsp;include_once
          (&quot;../auth.php&quot;);<br>
          &nbsp;&nbsp;include_once
          (&quot;../authconfig.php&quot;);<br>
          &nbsp;&nbsp;include_once
          (&quot;../check.php&quot;); </p>
        <p>&nbsp;&nbsp;if
          (($check['level'] &lt; 4) || ($check['level'] &gt; 6))<br>
          &nbsp;&nbsp;{<br>
          &nbsp;&nbsp;&nbsp;&nbsp;echo
          'You are not allowed to access this page.';<br>
          &nbsp;&nbsp;&nbsp;&nbsp;exit();<br>
          &nbsp;&nbsp;}<br>
          ?&gt;</p>
      </blockquote>
    </td>
  </tr>
</table>
</body>
</html>
