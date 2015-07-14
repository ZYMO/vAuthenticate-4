<?php

/*
# File: members/index.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");

?>

<html>
<head>
<title>vAuthenticate Sample User Login Results</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><b>vAuthenticate Sample
  User Login Results</b></p>
<table width="60%" border="1" cellpadding="0" cellspacing="0">
  <tr bgcolor="#000066">
    <td colspan="2">
      <div align="center"><b>Sample Results </b></div>
    </td>
  </tr>
  <tr>
    <td width="16%" bgcolor="#0099CC"><b>ID</b></td>
    <td width="84%">&nbsp; <? echo $check["id"] ?></td>
  </tr>
  <tr>
    <td width="16%" bgcolor="#0099CC"><b>Username</b></td>
    <td width="84%">&nbsp; <? echo $check["uname"] ?></td>
  </tr>

  <tr>
    <td width="16%" bgcolor="#0099CC"><b>Password</b></td>
    <td width="84%">&nbsp; <? echo $_COOKIE['PASSWORD'] ?> &nbsp;&nbsp;<a href="<? echo $changepassword; ?>">Change</a></td>
  </tr>

  <tr>
    <td width="16%" bgcolor="#0099CC"><b>Team</b></td>
    <td width="84%">&nbsp; <? echo $check["team"] ?></td>
  </tr>
  <tr>
    <td width="16%" bgcolor="#0099CC"><b>Level</b></td>
    <td width="84%">&nbsp; <? echo $check["level"] ?> </td>
  </tr>
  <tr>
    <td width="16%" bgcolor="#0099CC"><b>Status</b></td>
    <td width="84%">&nbsp; <? echo $check["status"] ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="60%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td height="22" colspan="2" bgcolor="#CCCC00">
      <div align="center"><b>Sample
        Authentication</b></div>
    </td>
  </tr>
  <tr valign="top">
    <td colspan="2">Due
      to the number of people asking for an example on how to implement authentication
      on secured pages. I made 2 sample pages whose authentication is based on
      a per-group or per-level basis. You can extend the functionality of the
      authentication code snippet to match your needs.</td>
  </tr>
  <tr valign="top">
    <td width="16%" bgcolor="#CCCCCC"><b>By
      <a href="bygroup.php">Group</a></b></td>
    <td width="84%">This
      is a sample page wherein only members of Group 1 and Group 3 would be allowed
      to view the contents of the page. All other groups including the Admin group
      would not be able to see the contents.</td>
  </tr>
  <tr valign="top">
    <td width="16%" bgcolor="#CCCCCC"><b>By
      <a href="bylevel.php">Level</a></b></td>
    <td width="84%">This
      is a sample page wherein only members with level of 4, 5, and 6 would be
      allowed to view the contents of the page. Members with a different level
      other than the one mentioned above are not allowed to view the contents.
      This rule holds true even for level 1's.</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="60%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC">
    <td colspan="2">
      <div align="center"><b>Field
        Description</b></div>
    </td>
  </tr>
  <tr valign="top">
    <td width="16%"><b>ID</b></td>
    <td width="84%">Unique
      identifier. This is not editable even by the administrator</td>
  </tr>
  <tr valign="top">
    <td width="16%"><b>Username</b></td>
    <td width="84%">A
      unique identifier chosen by the user during signup process OR a unique identifier
      given by the administrator to the user. The administrator has the power
      to change this when needed.</td>
  </tr>
  <tr valign="top">
    <td width="16%"><b>Password</b></td>
    <td width="84%">A
      security requirement whose value depends on either the user OR the administrator.
      The administrator has the power to change this when needed.</td>
  </tr>
  <tr valign="top">
    <td width="16%"><b>Team</b></td>
    <td width="84%">A
      group to which the specified user is a part of. This is used to simplify
      mass status modification. A user cannot be a member of 2 or more teams.</td>
  </tr>
  <tr valign="top">
    <td width="16%"><b>Level</b></td>
    <td width="84%">This
      is the level of power that a user posses. The administrator has the option
      to set the number of levels available. 1 is the highest, which usually pertains
      to system administrators and sometimes, web masters.</td>
  </tr>
  <tr>
    <td width="16%"><b>Status</b></td>
    <td width="84%">This
      can either be ACTIVE or INACTIVE. Inactive accounts cannot log into the
      system. An inactive account can be activated by the administrator or someone
      with administrative privileges.</td>
  </tr>
</table>
<p>Click <a href="<? echo $logout; ?>">here<a> to logout.</p>
