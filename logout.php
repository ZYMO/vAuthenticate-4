<?php

/*
# File: logout.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

	// Destroy Sessions
	setcookie ("USERNAME", "");
	setcookie ("PASSWORD", "");

	include_once ("authconfig.php");

?>

<html>
<head>
	<title>Member's Area</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><b>You have successfully logged off.</b></p>
<p><b>Click <a href="<?php echo $login; ?>">here</a> to re-login.</b></p>
