<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_pokemonsinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$entrenadores_pokemons_list = new centrenadores_pokemons_list();
$Page =& $entrenadores_pokemons_list;

// Page init
$entrenadores_pokemons_list->Page_Init();

// Page main
$entrenadores_pokemons_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_pokemons_list = new ew_Page("entrenadores_pokemons_list");

// page properties
entrenadores_pokemons_list.PageID = "list"; // page ID
entrenadores_pokemons_list.FormID = "fentrenadores_pokemonslist"; // form ID
var EW_PAGE_ID = entrenadores_pokemons_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_pokemons_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_pokemons_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_pokemons_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$entrenadores_pokemons_list->lTotalRecs = $entrenadores_pokemons->SelectRecordCount();
	} else {
		if ($rs = $entrenadores_pokemons_list->LoadRecordset())
			$entrenadores_pokemons_list->lTotalRecs = $rs->RecordCount();
	}
	$entrenadores_pokemons_list->lStartRec = 1;
	if ($entrenadores_pokemons_list->lDisplayRecs <= 0 || ($entrenadores_pokemons->Export <> "" && $entrenadores_pokemons->ExportAll)) // Display all records
		$entrenadores_pokemons_list->lDisplayRecs = $entrenadores_pokemons_list->lTotalRecs;
	if (!($entrenadores_pokemons->Export <> "" && $entrenadores_pokemons->ExportAll))
		$entrenadores_pokemons_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $entrenadores_pokemons_list->LoadRecordset($entrenadores_pokemons_list->lStartRec-1, $entrenadores_pokemons_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_pokemons->TableCaption() ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_pokemons_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fentrenadores_pokemonslist" id="fentrenadores_pokemonslist" class="ewForm" action="" method="post">
<div id="gmp_entrenadores_pokemons" class="ewGridMiddlePanel">
<?php if ($entrenadores_pokemons_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $entrenadores_pokemons->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$entrenadores_pokemons_list->RenderListOptions();

// Render list options (header, left)
$entrenadores_pokemons_list->ListOptions->Render("header", "left");
?>
<?php if ($entrenadores_pokemons->id->Visible) { // id ?>
	<?php if ($entrenadores_pokemons->SortUrl($entrenadores_pokemons->id) == "") { ?>
		<td><?php echo $entrenadores_pokemons->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_pokemons->SortUrl($entrenadores_pokemons->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_pokemons->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_pokemons->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_pokemons->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_pokemons->entrenador->Visible) { // entrenador ?>
	<?php if ($entrenadores_pokemons->SortUrl($entrenadores_pokemons->entrenador) == "") { ?>
		<td><?php echo $entrenadores_pokemons->entrenador->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_pokemons->SortUrl($entrenadores_pokemons->entrenador) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_pokemons->entrenador->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_pokemons->entrenador->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_pokemons->entrenador->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_pokemons->pokemon->Visible) { // pokemon ?>
	<?php if ($entrenadores_pokemons->SortUrl($entrenadores_pokemons->pokemon) == "") { ?>
		<td><?php echo $entrenadores_pokemons->pokemon->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_pokemons->SortUrl($entrenadores_pokemons->pokemon) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_pokemons->pokemon->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_pokemons->pokemon->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_pokemons->pokemon->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_pokemons->nivel->Visible) { // nivel ?>
	<?php if ($entrenadores_pokemons->SortUrl($entrenadores_pokemons->nivel) == "") { ?>
		<td><?php echo $entrenadores_pokemons->nivel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_pokemons->SortUrl($entrenadores_pokemons->nivel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_pokemons->nivel->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_pokemons->nivel->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_pokemons->nivel->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_pokemons->experiencia->Visible) { // experiencia ?>
	<?php if ($entrenadores_pokemons->SortUrl($entrenadores_pokemons->experiencia) == "") { ?>
		<td><?php echo $entrenadores_pokemons->experiencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_pokemons->SortUrl($entrenadores_pokemons->experiencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_pokemons->experiencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_pokemons->experiencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_pokemons->experiencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$entrenadores_pokemons_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($entrenadores_pokemons->ExportAll && $entrenadores_pokemons->Export <> "") {
	$entrenadores_pokemons_list->lStopRec = $entrenadores_pokemons_list->lTotalRecs;
} else {
	$entrenadores_pokemons_list->lStopRec = $entrenadores_pokemons_list->lStartRec + $entrenadores_pokemons_list->lDisplayRecs - 1; // Set the last record to display
}
$entrenadores_pokemons_list->lRecCount = $entrenadores_pokemons_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $entrenadores_pokemons_list->lStartRec > 1)
		$rs->Move($entrenadores_pokemons_list->lStartRec - 1);
}

// Initialize aggregate
$entrenadores_pokemons->RowType = EW_ROWTYPE_AGGREGATEINIT;
$entrenadores_pokemons_list->RenderRow();
$entrenadores_pokemons_list->lRowCnt = 0;
while (($entrenadores_pokemons->CurrentAction == "gridadd" || !$rs->EOF) &&
	$entrenadores_pokemons_list->lRecCount < $entrenadores_pokemons_list->lStopRec) {
	$entrenadores_pokemons_list->lRecCount++;
	if (intval($entrenadores_pokemons_list->lRecCount) >= intval($entrenadores_pokemons_list->lStartRec)) {
		$entrenadores_pokemons_list->lRowCnt++;

	// Init row class and style
	$entrenadores_pokemons->CssClass = "";
	$entrenadores_pokemons->CssStyle = "";
	$entrenadores_pokemons->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($entrenadores_pokemons->CurrentAction == "gridadd") {
		$entrenadores_pokemons_list->LoadDefaultValues(); // Load default values
	} else {
		$entrenadores_pokemons_list->LoadRowValues($rs); // Load row values
	}
	$entrenadores_pokemons->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$entrenadores_pokemons_list->RenderRow();

	// Render list options
	$entrenadores_pokemons_list->RenderListOptions();
?>
	<tr<?php echo $entrenadores_pokemons->RowAttributes() ?>>
<?php

// Render list options (body, left)
$entrenadores_pokemons_list->ListOptions->Render("body", "left");
?>
	<?php if ($entrenadores_pokemons->id->Visible) { // id ?>
		<td<?php echo $entrenadores_pokemons->id->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->id->ViewAttributes() ?>><?php echo $entrenadores_pokemons->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_pokemons->entrenador->Visible) { // entrenador ?>
		<td<?php echo $entrenadores_pokemons->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->entrenador->ViewAttributes() ?>><?php echo $entrenadores_pokemons->entrenador->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_pokemons->pokemon->Visible) { // pokemon ?>
		<td<?php echo $entrenadores_pokemons->pokemon->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->pokemon->ViewAttributes() ?>><?php echo $entrenadores_pokemons->pokemon->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_pokemons->nivel->Visible) { // nivel ?>
		<td<?php echo $entrenadores_pokemons->nivel->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->nivel->ViewAttributes() ?>><?php echo $entrenadores_pokemons->nivel->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_pokemons->experiencia->Visible) { // experiencia ?>
		<td<?php echo $entrenadores_pokemons->experiencia->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->experiencia->ViewAttributes() ?>><?php echo $entrenadores_pokemons->experiencia->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$entrenadores_pokemons_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($entrenadores_pokemons->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($entrenadores_pokemons->CurrentAction <> "gridadd" && $entrenadores_pokemons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($entrenadores_pokemons_list->Pager)) $entrenadores_pokemons_list->Pager = new cPrevNextPager($entrenadores_pokemons_list->lStartRec, $entrenadores_pokemons_list->lDisplayRecs, $entrenadores_pokemons_list->lTotalRecs) ?>
<?php if ($entrenadores_pokemons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($entrenadores_pokemons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_pokemons_list->PageUrl() ?>start=<?php echo $entrenadores_pokemons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($entrenadores_pokemons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_pokemons_list->PageUrl() ?>start=<?php echo $entrenadores_pokemons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $entrenadores_pokemons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($entrenadores_pokemons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_pokemons_list->PageUrl() ?>start=<?php echo $entrenadores_pokemons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($entrenadores_pokemons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_pokemons_list->PageUrl() ?>start=<?php echo $entrenadores_pokemons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $entrenadores_pokemons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $entrenadores_pokemons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $entrenadores_pokemons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $entrenadores_pokemons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($entrenadores_pokemons_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($entrenadores_pokemons_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_pokemons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($entrenadores_pokemons->Export == "" && $entrenadores_pokemons->CurrentAction == "") { ?>
<?php } ?>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_pokemons_list->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_pokemons_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'entrenadores_pokemons';

	// Page object name
	var $PageObjName = 'entrenadores_pokemons_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_pokemons->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_pokemons_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_pokemons)
		$GLOBALS["entrenadores_pokemons"] = new centrenadores_pokemons();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["entrenadores_pokemons"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "entrenadores_pokemonsdelete.php";
		$this->MultiUpdateUrl = "entrenadores_pokemonsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_pokemons', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $entrenadores_pokemons;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$entrenadores_pokemons->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$entrenadores_pokemons->Export = $_POST["exporttype"];
		} else {
			$entrenadores_pokemons->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $entrenadores_pokemons->Export; // Get export parameter, used in header
		$gsExportFile = $entrenadores_pokemons->TableVar; // Get export file, used in header

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $entrenadores_pokemons;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($entrenadores_pokemons->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $entrenadores_pokemons->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$entrenadores_pokemons->setSessionWhere($sFilter);
		$entrenadores_pokemons->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $entrenadores_pokemons;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$entrenadores_pokemons->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$entrenadores_pokemons->CurrentOrderType = @$_GET["ordertype"];
			$entrenadores_pokemons->UpdateSort($entrenadores_pokemons->id); // id
			$entrenadores_pokemons->UpdateSort($entrenadores_pokemons->entrenador); // entrenador
			$entrenadores_pokemons->UpdateSort($entrenadores_pokemons->pokemon); // pokemon
			$entrenadores_pokemons->UpdateSort($entrenadores_pokemons->nivel); // nivel
			$entrenadores_pokemons->UpdateSort($entrenadores_pokemons->experiencia); // experiencia
			$entrenadores_pokemons->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $entrenadores_pokemons;
		$sOrderBy = $entrenadores_pokemons->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($entrenadores_pokemons->SqlOrderBy() <> "") {
				$sOrderBy = $entrenadores_pokemons->SqlOrderBy();
				$entrenadores_pokemons->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $entrenadores_pokemons;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$entrenadores_pokemons->setSessionOrderBy($sOrderBy);
				$entrenadores_pokemons->id->setSort("");
				$entrenadores_pokemons->entrenador->setSort("");
				$entrenadores_pokemons->pokemon->setSort("");
				$entrenadores_pokemons->nivel->setSort("");
				$entrenadores_pokemons->experiencia->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $entrenadores_pokemons;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($entrenadores_pokemons->Export <> "" ||
			$entrenadores_pokemons->CurrentAction == "gridadd" ||
			$entrenadores_pokemons->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $entrenadores_pokemons;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"images/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $entrenadores_pokemons;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores_pokemons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores_pokemons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_pokemons;

		// Call Recordset Selecting event
		$entrenadores_pokemons->Recordset_Selecting($entrenadores_pokemons->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_pokemons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_pokemons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_pokemons;
		$sFilter = $entrenadores_pokemons->KeyFilter();

		// Call Row Selecting event
		$entrenadores_pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_pokemons->CurrentFilter = $sFilter;
		$sSql = $entrenadores_pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_pokemons;
		$entrenadores_pokemons->id->setDbValue($rs->fields('id'));
		$entrenadores_pokemons->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_pokemons->pokemon->setDbValue($rs->fields('pokemon'));
		$entrenadores_pokemons->nivel->setDbValue($rs->fields('nivel'));
		$entrenadores_pokemons->experiencia->setDbValue($rs->fields('experiencia'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_pokemons;

		// Initialize URLs
		$this->ViewUrl = $entrenadores_pokemons->ViewUrl();
		$this->EditUrl = $entrenadores_pokemons->EditUrl();
		$this->InlineEditUrl = $entrenadores_pokemons->InlineEditUrl();
		$this->CopyUrl = $entrenadores_pokemons->CopyUrl();
		$this->InlineCopyUrl = $entrenadores_pokemons->InlineCopyUrl();
		$this->DeleteUrl = $entrenadores_pokemons->DeleteUrl();

		// Call Row_Rendering event
		$entrenadores_pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_pokemons->id->CellCssStyle = ""; $entrenadores_pokemons->id->CellCssClass = "";
		$entrenadores_pokemons->id->CellAttrs = array(); $entrenadores_pokemons->id->ViewAttrs = array(); $entrenadores_pokemons->id->EditAttrs = array();

		// entrenador
		$entrenadores_pokemons->entrenador->CellCssStyle = ""; $entrenadores_pokemons->entrenador->CellCssClass = "";
		$entrenadores_pokemons->entrenador->CellAttrs = array(); $entrenadores_pokemons->entrenador->ViewAttrs = array(); $entrenadores_pokemons->entrenador->EditAttrs = array();

		// pokemon
		$entrenadores_pokemons->pokemon->CellCssStyle = ""; $entrenadores_pokemons->pokemon->CellCssClass = "";
		$entrenadores_pokemons->pokemon->CellAttrs = array(); $entrenadores_pokemons->pokemon->ViewAttrs = array(); $entrenadores_pokemons->pokemon->EditAttrs = array();

		// nivel
		$entrenadores_pokemons->nivel->CellCssStyle = ""; $entrenadores_pokemons->nivel->CellCssClass = "";
		$entrenadores_pokemons->nivel->CellAttrs = array(); $entrenadores_pokemons->nivel->ViewAttrs = array(); $entrenadores_pokemons->nivel->EditAttrs = array();

		// experiencia
		$entrenadores_pokemons->experiencia->CellCssStyle = ""; $entrenadores_pokemons->experiencia->CellCssClass = "";
		$entrenadores_pokemons->experiencia->CellAttrs = array(); $entrenadores_pokemons->experiencia->ViewAttrs = array(); $entrenadores_pokemons->experiencia->EditAttrs = array();
		if ($entrenadores_pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_pokemons->id->ViewValue = $entrenadores_pokemons->id->CurrentValue;
			$entrenadores_pokemons->id->CssStyle = "";
			$entrenadores_pokemons->id->CssClass = "";
			$entrenadores_pokemons->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_pokemons->entrenador->ViewValue = $entrenadores_pokemons->entrenador->CurrentValue;
			$entrenadores_pokemons->entrenador->CssStyle = "";
			$entrenadores_pokemons->entrenador->CssClass = "";
			$entrenadores_pokemons->entrenador->ViewCustomAttributes = "";

			// pokemon
			$entrenadores_pokemons->pokemon->ViewValue = $entrenadores_pokemons->pokemon->CurrentValue;
			$entrenadores_pokemons->pokemon->CssStyle = "";
			$entrenadores_pokemons->pokemon->CssClass = "";
			$entrenadores_pokemons->pokemon->ViewCustomAttributes = "";

			// nivel
			$entrenadores_pokemons->nivel->ViewValue = $entrenadores_pokemons->nivel->CurrentValue;
			$entrenadores_pokemons->nivel->CssStyle = "";
			$entrenadores_pokemons->nivel->CssClass = "";
			$entrenadores_pokemons->nivel->ViewCustomAttributes = "";

			// experiencia
			$entrenadores_pokemons->experiencia->ViewValue = $entrenadores_pokemons->experiencia->CurrentValue;
			$entrenadores_pokemons->experiencia->CssStyle = "";
			$entrenadores_pokemons->experiencia->CssClass = "";
			$entrenadores_pokemons->experiencia->ViewCustomAttributes = "";

			// id
			$entrenadores_pokemons->id->HrefValue = "";
			$entrenadores_pokemons->id->TooltipValue = "";

			// entrenador
			$entrenadores_pokemons->entrenador->HrefValue = "";
			$entrenadores_pokemons->entrenador->TooltipValue = "";

			// pokemon
			$entrenadores_pokemons->pokemon->HrefValue = "";
			$entrenadores_pokemons->pokemon->TooltipValue = "";

			// nivel
			$entrenadores_pokemons->nivel->HrefValue = "";
			$entrenadores_pokemons->nivel->TooltipValue = "";

			// experiencia
			$entrenadores_pokemons->experiencia->HrefValue = "";
			$entrenadores_pokemons->experiencia->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_pokemons->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
