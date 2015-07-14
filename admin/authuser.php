<?php

/*
# File: authuser.php
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

	if ($check["level"] != 1)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.

		print "<b>Illegal Access</b>";
		print "<br>";

		print "<b>You do not have permission to view this page.</b>";

		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}

	$user = new auth();

	$connection = mysqli_connect($dbhost, $dbusername, $dbpass);
	$SelectedDB = mysqli_select_db($dbname);
	$listteams = mysqli_query("SELECT * from authteam");

?>
<?
// Get initial values from superglobal variables
// Let's see if the admin clicked a link to get here
// or was originally here already and just pressed
// a button or clicked on the User List

if (isset($_POST['action']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$team = $_POST['team'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	$action = $_POST['action'];
	$act = "";
}
elseif (isset($_GET['act']))
{
	$act = $_GET['act'];
	$action = "";
}
else
{
	$action = "";
	$username = "";
	$password = "";
	$team = "";
	$level = "";
	$status = "";
	$action = "";
	$act = "";
}

$message = "";

// ADD USER
if ($action == "Add") {
	$situation = $user->add_user($username, $password, $team, $level, $status);

	if ($situation == "blank username") {
		$message = "Username field cannot be blank.";
		$action = "";
	}
	elseif ($situation == "username exists") {
		$message = "Username already exists in the database. Please enter a new one.";
		$action = "";
	}
	elseif ($situation == "blank password") {
		$message = "Password field cannot be blank for new members.";
		$action = "";
	}
	elseif ($situation == "blank level") {
		$message = "Level field cannot be blank.";
		$action = "";
	}
	elseif ($situation == 1) {
		$message = "New user added successfully.";
	}
	else {
		$message = "";
	}
}

// DELETE USER
if ($action=="Delete") {
	// Delete record in authuser table
	$delete = $user->delete_user($username);

	// Delete record in signup table
	$deletesignup =  mysqli_query("DELETE FROM signup WHERE uname='$username'");

	if ($delete && $deletesignup) {
		$message = $delete;
	}
	else {
		$username = "";
		$password = "";
		$team = "Ungrouped";
		$level = "";
		$status = "active";
		$message = "The user has been deleted.";
	}
}

// MODIFY USER
if ($action == "Modify") {
	$update = $user->modify_user($username, $password, $team, $level, $status);

	if ($update==1) {
		$message = "User detail updated successfully.";
	}
	elseif ($update == "blank level") {
		$message = "Level field cannot be blank.";
		$action = "";
	}
	elseif ($update == "sa cannot be inactivated") {
		$message = "This user cannot be inactivated.";
		$action = "";
	}
	elseif ($update == "admin cannot be inactivated") {
		$message = "This user cannot be inactivated";
		$action = "";
	}
	else {
		$message = "";
	}
}

// EDIT USER (accessed from clicking on username links)
if ($act == "Edit")
{
    $username = $_GET['username'];
	$listusers = mysqli_query("SELECT * from authuser where uname='$username'");
	$rows = mysqli_fetch_array($listusers);
	$username = $rows["uname"];
	$password = "";
	$team = $rows["team"];
	$level = $rows["level"];
	$status = $rows["status"];

	$message = "Modify user details.";
}

// CLEAR FIELDS
if ($action == "Add New") {
	$username = "";
	$password = "";
	$team = "Ungrouped";
	$level = "";
	$status = "active";
	$message = "New user detail entry.";
}

?>

<html>
<head>
<title>vAuthenticate Administrative Interface</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><b>vAuthenticate Administration
  - Users</b></p>
<table width="75%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" bgcolor="#0099CC" height="16"><b>Administer</b></td>
    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="index.php">Home</a></div>
    </td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="authgroup.php">Groups</a></div>
    </td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="<? echo $logout; ?>">Logout</a></div>
    </td>
  </tr>
</table><br>&nbsp;
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr valign="top">
    <td width="50%">

	  <form name="AddUser" method="Post" action="authuser.php">
	    <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
          <tr bgcolor="#000000">
            <td colspan="2">
              <div align="center"><b>USER
                DETAILS</b></div>
            </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Username</b></td>
            <td width="73%">&nbsp;

<?php

			  	if (($action == "Modify") || ($action=="Add") || ($act=="Edit")) {
					print "<input type=\"hidden\" name=\"username\" value=\"$username\">";
					print "$username";
				}
				else {
					print "<input type=\"text\" name=\"username\" size=\"15\" maxlength=\"15\" value=\"$username\">";
				}

?>
              </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Password</b></td>
            <td width="73%">&nbsp;
              <? print "<input type=\"password\" name=\"password\" size=\"20\" maxlength=\"15\" value=\"$password\">"; ?>
              </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF">&nbsp;</td>
            <td width="73%">&nbsp;&nbsp;Leave
              the password field blank if you want to retain the old password.
              </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Team</b></td>
            <td width="73%">&nbsp;
				<label>
					<select name="team">

						<?php

			  	// DISPLAY TEAMS
			  	$row = mysqli_fetch_array($listteams);
			  	while ($row) {
					$teamlist = $row["teamname"];

					if ($team == $teamlist) {
						print "<option value=\"$teamlist\" SELECTED>" . $row["teamname"] . "</option>";
						}
						else {
						print "
						<option value=\"$teamlist\">" . $row["teamname"] . "</option>
						";
						}
						$row = mysqli_fetch_array($listteams);
						}

						?>

					</select>
				</label>
				<a href="authgroup.php">Add</a></td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Level</b></td>
            <td width="73%">&nbsp;
              <?php print "<input type=\"text\" name=\"level\" size=\"4\" maxlength=\"4\" value=\"$level\">"; ?>
              </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Status</b></td>
            <td width="73%">&nbsp;
				<label>
					<select name="status">

						<?php

			  	// ACTIVE / INACTIVE
				if ($status == "inactive") {
					print "<option value=\"active\">Active</option>";
						print "
						<option value=\"inactive\" selected>Inactive</option>
						";
						}
						else {
						print "
						<option value=\"active\" selected>Active</option>
						";
						print "
						<option value=\"inactive\">Inactive</option>
						";
						}

						?>
					</select>
				</label>
			</td>
          </tr>
          <tr bgcolor="#CCCCCC" valign="middle">
            <td colspan="2">
              <div align="center">

<?php

				if (($action=="Add") || ($action == "Modify") || ($act=="Edit")) {
					print "<input type=\"submit\" name=\"action\" value=\"Add New\"> ";
					print "<input type=\"submit\" name=\"action\" value=\"Modify\"> ";
					print "<input type=\"submit\" name=\"action\" value=\"Delete\"> ";
				}
				else {
					print "<input type=\"submit\" name=\"action\" value=\"Add\"> ";
                }

?>
                <input type="reset" name="Reset" value="Clear">
                </div>
            </td>
          </tr>
        </table>
	  </form>


      <p>&nbsp;</p>
      <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td bgcolor="#990000"><b>Message:</b></td>
        </tr>
        <tr>
          <td>

<?php

		  	if ($message) {
			 	print $message;
		  	}
			else {
				print "<BR>&nbsp;";
			}

?>
		  </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </td>
    <td width="50%">


	  <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
        <tr bgcolor="#000000">
          <td colspan="5">
            <div align="center"><b>USER
              LIST</b></div>
          </td>
        </tr>
        <tr bgcolor="#CCCCCC">
          <td width="20%">
            <div align="center"><b>Username</b></div>
          </td>
          <td width="25%">
            <div align="center"><b>Group</b></div>
          </td>
          <td width="15%">
            <div align="center"><b>Status</b></div>
          </td>
          <td width="30%">
            <div align="center"><b>Last Login</b></div>
          </td>
          <td width="10%">
            <div align="center"><b>Count</b></div>
          </td>
        </tr>

<?php

	// Fetch rows from AuthUser table and display ALL users
	// OLD CODE - DO NOT REMOVE
	// $result = mysql_db_query($dbname, "SELECT * FROM authuser ORDER BY id");

	// REVISED CODE
	$result = mysqli_query("SELECT * FROM authuser ORDER BY id");

	$row = mysqli_fetch_array($result);
	while ($row) {
		print "<tr>";
        print "  <td width=\"20%\">";
        print "    <div align=\"left\">";
		print "		<a href=\"authuser.php?act=Edit&username=".$row['uname']."\">";
		print 		$row['uname'];
		print "		</a>";
		print "	   </div>";
        print "  </td>";
        print "  <td width=\"25%\">";
        print "    <div align=\"center\">".$row['team']."</div>";
        print "  </td>";
        print "  <td width=\"15%\">";
        print "    <div align=\"center\">".($row['status'])."</div>";
        print "  </td>";
        print "  <td width=\"30%\">";
        print "    <div align=\"center\">".$row['lastlogin']."</div>";
        print "  </td>";
        print "  <td width=\"10%\">";
        print "    <div align=\"right\">".($row['logincount'])."</div>";
        print "  </td>";
        print "</tr>";

		$row = mysqli_fetch_array($result);
	}

?>

	  </table>


    </td>
  </tr>
</table>

</body>
</html>
