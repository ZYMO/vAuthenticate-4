<?php

/*
# File: authgroup.php
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

	if ($check['level'] != 1)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.
		print "<b>Illegal Access</b>";
		print "<br>";
		print "<b>You do not have permission to view this page.</b>";

		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}
	$group = new auth();

	$connection = mysqli_connect($dbhost, $dbusername, $dbpass);
	$SelectedDB = mysqli_select_db($dbname);
	$listusers = mysqli_query("SELECT * from authuser");

// Check if we have instantiated $action and $act variable
// If yes, get the value from previous posting
// If not, set values to null or ""

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	$act = "";
	$teamname = $_POST['teamname'];
	$teamlead = $_POST['teamlead'];
	$status = $_POST['status'];
}
elseif (isset($_GET['act']))
{
	$act = $_GET['act'];
	$action = "";
}
else
{
	$action = "";
	$act = "";
	$teamname = "";
	$teamlead = "";
	$status = "";
}

$message = "";

// ADD GROUP
if ($action == "Add") {
	$situation = $group->add_team($teamname, $teamlead, $status);

	if ($situation == "blank team name") {
		$message = "Team Name field cannot be blank.";
		$action = "";
	}
	elseif ($situation == "group exists") {
		$message = "Team Name already exists in the database. Please enter a new one.";
		$action = "";
	}
	elseif ($situation == 1) {
		$message = "New team added successfully.";
	}
	else {
		$message = "";
	}
}

// DELETE GROUP
if ($action=="Delete") {
	$delete = $group->delete_team($teamname);

	if ($delete) {
		$message = $delete;
		$action = "";
	}
	else {
		$teamname = "";
		$teamlead = "sa";
		$status = "active";
		$message = "The group has been deleted.<br>All users associated with the group are moved to the Ungrouped team";
	}
}

// MODIFY TEAM
if ($action == "Modify") {
	$update = $group->modify_team($teamname, $teamlead, $status);

	if ($update==1) {
		$message = "Team detail updated successfully.";
	}
	elseif ($update == "Admin team cannot be inactivated.") {
		$message = $update;
		$action = "";
	}
	elseif ($update == "Ungrouped team cannot be inactivated.") {
		$message = $update;
		$action = "";
	}
	elseif ($update == "Team Lead field cannot be blank.") {
		$message = $update;
		$action = "";
	}
	else {
		$message = "";
	}
}

// EDIT TEAM (accessed from clicking on username links)
if ($act == "Edit") {
    $teamname = $_GET['teamname'];
    $teamlead = $_GET['teamlead'];
    $status = $_GET['status'];
    $message = "Modify team details.";
}

// CLEAR FIELDS
if ($action == "Add New") {
	$teamname = "";
	$teamlead = "sa";
	$status = "active";
	$message = "New team detail entry.";
}

?>

<html>
<head>
<title>vAuthenticate Administrative Interface</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><b>vAuthenticate Administration
  - Teams</b></p>
<table width="75%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" bgcolor="#0099CC" height="16"><b>Administer</b></td>
    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="index.php">Home</a></div>
    </td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="authuser.php">Users</a></div>
    </td>

    <td width="16%" bgcolor="#FFFFCC" height="16">
      <div align="center"><a href="<?php echo $logout; ?>">Logout</a></div>
    </td>
  </tr>
</table><br>&nbsp;
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr valign="top">
    <td width="50%">

	  <form name="AddTeam" method="Post" action="authgroup.php">
	    <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
          <tr bgcolor="#000000">
            <td colspan="2">
              <div align="center"><b>TEAM
                DETAILS</b></div>
            </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Team
              Name </b></td>
            <td width="73%">&nbsp;
<?php

			  	if (($action == "Modify") || ($action=="Add") || ($act=="Edit")) {
					print "<input type=\"hidden\" name=\"teamname\" value=\"$teamname\">";
					print "$teamname";
				}
				else {
					print "<input type=\"text\" name=\"teamname\" size=\"15\" maxlength=\"15\" value=\"$teamname\">";
				}

?>
              </td>
          </tr>
          <tr valign="middle">
            <td width="27%" bgcolor="#33CCFF"><b>Team
              Lead </b></td>
            <td width="73%">&nbsp;
				<label>
					<select name="teamlead">
						<?php

			  	// DISPLAY MEMBERS
			  	$row = mysqli_fetch_array($listusers);
			  	while ($row) {
					$memberlist = $row["uname"];

					if ($teamlead == $memberlist) {
						print "<option value=\"$memberlist\" SELECTED>" . $row["uname"] . "</option>";
						}
						else {
						print "
						<option value=\"$memberlist\">" . $row["uname"] . "</option>
						";
						}
						$row = mysqli_fetch_array($listusers);
						}

						?>

					</select>
				</label>
				<a href="authuser.php">Add</a></td>
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
          <td colspan="3">
            <div align="center"><b>TEAM
              LIST</b></div>
          </td>
        </tr>
        <tr bgcolor="#CCCCCC">
          <td width="35%">
            <div align="center"><b>Team
              Name </b></div>
          </td>
          <td width="34%">
            <div align="center"><b>Team
              Lead </b></div>
          </td>
          <td width="31%">
            <div align="center"><b>Status</b></div>
          </td>
        </tr>

<?php

	// Fetch rows from AuthUser table and display ALL users
	$qQuery = "SELECT * FROM authteam ORDER BY id";

	// OLD CODE - DO NOT REMOVE
	// $result = mysql_db_query($dbname, $qQuery);

	// REVISED CODE
	$result = mysqli_query($qQuery);

	$row = mysqli_fetch_array($result);
	while ($row) {
		print "<tr>";
        print "  <td width=\"35%\">";
        print "    <div align=\"left\">";
		print "		<a href=\"authgroup.php?act=Edit&teamname=".$row["teamname"]."&teamlead=".$row["teamlead"]."&status=".$row["status"]."\">";
		print 		$row["teamname"];
		print "		</a>";
		print "	   </div>";
        print "  </td>";
        print "  <td width=\"34%\">";
        print "    <div align=\"center\">".$row["teamlead"]."</div>";
        print "  </td>";
        print "  <td width=\"31%\">";
        print "    <div align=\"right\">".($row["status"])."</div>";
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
