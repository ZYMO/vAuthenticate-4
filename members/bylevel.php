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
    <td colspan="2" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font size="3">vAuthenticate:
      Sample Authentication Page</font></b></font></td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Access
      Restriction:</font></b></td>
    <td width="73%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Per
      Level - Any Group</font></td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Access
      Rights:</font></b></td>
    <td width="73%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Level
      4, Level 5, Level 6</font></td>
  </tr>
  <tr>
    <td width="27%" valign="top"><b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Details:</font></b></td>
    <td width="73%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Only
      members with level between 4, 5, and 6 are allowed to see this page (unless
      you've changed the code). This is an example of a page being secured on
      a per-group basis. </font></td>
  </tr>
  <tr>
    <td width="27%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Code:</b></font></td>
    <td width="73%" valign="top">
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">The following
        code snippet is an example of how to implement this type of access restriction.
        Put this code on top of your pages which will be governed by this type
        of security. Please note that this is only an example and you would need
        to make certain adjustments based on your preferences. Here's the code
        snippet:</font></p>
      <blockquote>
        <p><font color="#000099" face="Courier New, Courier, mono" size="2">&lt;?php</font><font face="Courier New, Courier, mono" size="2"><br>
          &nbsp;&nbsp;include_once</font><font color="#000099" face="Courier New, Courier, mono" size="2">
          (&quot;../auth.php&quot;);<br>
          &nbsp;&nbsp;</font><font face="Courier New, Courier, mono" size="2">include_once</font><font color="#000099" face="Courier New, Courier, mono" size="2">
          (&quot;../authconfig.php&quot;);<br>
          &nbsp;&nbsp;</font><font face="Courier New, Courier, mono" size="2">include_once</font><font color="#000099" face="Courier New, Courier, mono" size="2">
          (&quot;../check.php&quot;); </font></p>
        <p><font color="#000099" face="Courier New, Courier, mono" size="2">&nbsp;&nbsp;</font><font face="Courier New, Courier, mono" size="2">if</font><font color="#000099" face="Courier New, Courier, mono" size="2">
          (($check['level'] &lt; 4) || ($check['level'] &gt; 6))<br>
          &nbsp;&nbsp;{<br>
          &nbsp;&nbsp;&nbsp;&nbsp;</font><font face="Courier New, Courier, mono" size="2">echo</font><font color="#000099" face="Courier New, Courier, mono" size="2">
          'You are not allowed to access this page.';<br>
          &nbsp;&nbsp;&nbsp;&nbsp;</font><font face="Courier New, Courier, mono" size="2">exit()</font><font color="#000099" face="Courier New, Courier, mono" size="2">;<br>
          &nbsp;&nbsp;}</font><font face="Courier New, Courier, mono" size="2"><br>
          <font color="#000099">?&gt;</font></font></p>
      </blockquote>
    </td>
  </tr>
</table>
</body>
</html>
