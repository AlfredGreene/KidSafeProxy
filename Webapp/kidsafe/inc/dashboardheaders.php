<?php
/*** creates html headers and menu structure ***/
// for the dashboard pages

/** Copyright Information (GPL 3)
Copyright Stewart Watkiss 2013

This file is part of kidsafe.

This is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this software.  If not, see <http://www.gnu.org/licenses/>.
**/




/* This should be called just prior to outputting html text to the user 

First issue:
include("inc/dashboardheaders.php");

The following variables are made available to display - normally called in this order

$header - first entry (includes doctype to <body>)
$login_banner
$main_banner
$main_menu
$footer - last entry (includes </body> and </html>) 



These are done as individual entries in case we need something specific
eg. $main_menu is not used on the login screen

Content can be changed using the following variables
$username (normally set by login code)
$title (to override default dashboard title)
*/


// some menu items available to everyone - others only if $user->isAdmin() or $user->isSupervisor()

$html_menu = "<ul id=\"menu-home\"><li><a href=\"dashboard.php\">Home</a></li></ul>\n";

if (isset ($user) && ($user->isAdmin() || $user->isSupervisor()))
{
	// Manually list menu items - perhaps in future move this into an array to make it easier to read
	$html_menu .= "<ul id=\"menu-rules\"><li><a href=\"dashboardlistrules.php\">Rules</a>	<ul><li><a class=\"submenu\" href=\"dashboardlistrules.php\">List rules</a></li><li><a href=\"dashboardaddrule.php\">Add rule</a></li></ul></li></ul>\n";
	$html_menu .= "<ul id=\"menu-users\"><li><a href=\"dashboardlistusers.php\">Users</a><ul><li><a href=\"dashboardlistusers.php\">List users</a></li><li><a href=\"dashboardadduser.php\">Add user</a></li></ul></li></ul>\n";
	$html_menu .= "<ul id=\"menu-log\"><li><a href=\"dashboardviewlog.php\">Log viewer</a></li></ul>\n";
}


//$html_menu .= "</div>\n";


if (!isset ($username) || $username == '')
{
	$statusline = "<a href=\"dashboardlogin.php\">Login</a>";
}
else
{
	$statusline = "Welcome: $username - <a href=\"dashboardpassword.php\">Manage account</a> - <a href=\"dashboardlogout.php\">Logout</a>";
}


$login_banner = <<< EOT
<div id="login-status">
	$statusline
</div>
EOT;

$main_banner = <<< EOT2
<div id="logo">
	<img style="float:left" src="kidsafe-logo.png" alt="kidsafe child friendly Internet proxy">
	<p style="padding-top:20px;"><strong>Internet protection for the family</strong><br>Management dashboard created by <a style="text-decoration:none" href="http://www.penguintutor.com">PenguinTutor</a></p>
</div>
EOT2;


$main_menu = <<< EOT3
<div id="mainmenu">
	$html_menu
</div>
EOT3;


if (!isset ($title) || $title == '')
{
	$title = "Kidsafe dashboard";
}

$header = <<< EOT4
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>$title</title>
<link href="kidsafe.css" rel="stylesheet" type="text/css">
</head>
<body>

EOT4;

$footer = <<< EOT5
</body>
</html>
EOT5;



?>
