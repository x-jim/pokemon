<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "MenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "MenuBarItemSubmenu", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "iconoslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(16, $Language->MenuPhrase("16", "MenuText"), "itemslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "entrenadoreslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "pokemonslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "secuenciaslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--

// init the menu
var RootMenu = new Spry.Widget.MenuBar("RootMenu", {imgDown:"images/SpryMenuBarDownHover.gif", imgRight:"images/SpryMenuBarRightHover.gif"});

//-->
</script>
