<?php

/*
# File: check.php
# Script Name: vAuthenticate 4.0
# Author: ZYMO
#
# Description:
#
# Hardened version of vAuthenticate 3.0.1 to address exploits
# and update deprecated database functions on PHP v5.5 servers.
#
*/

    // Check if the cookies are set
    // This removes some notices (undefined index)
    if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD']))
    {
        // Get values from superglobal variables
        $USERNAME = $_COOKIE['USERNAME'];
        $PASSWORD = $_COOKIE['PASSWORD'];

        $CheckSecurity = new auth();
        $check = $CheckSecurity->page_check($USERNAME, $PASSWORD);
    }
    else
    {
        $check = false;
    }

	if ($check == false)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.

		print "<b>Illegal Access</b>";
		print "<br>";
		print "<b>You do not have permission to view this page.</b>";

		// REDIRECT BACK TO LOGIN PAGE
        // REMOVE BLOCK IF NOT BEING USED
		   print "<br>";
		   print "You will be redirected back to the login page in a short while.";

?>
              <HEAD>
			           <SCRIPT language="JavaScript1.1">
			           <!--
				           location.replace("<?php echo $login; ?>");
                       //-->
                       </SCRIPT>
              </HEAD>

<?php

		// END OF REDIRECTION BLOCK
		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}

?>
