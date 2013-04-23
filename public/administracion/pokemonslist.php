<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "pokemonsinfo.php" ?>
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
$pokemons_list = new cpokemons_list();
$Page =& $pokemons_list;

// Page init
$pokemons_list->Page_Init();

// Page main
$pokemons_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pokemons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_list = new ew_Page("pokemons_list");

// page properties
pokemons_list.PageID = "list"; // page ID
pokemons_list.FormID = "fpokemonslist"; // form ID
var EW_PAGE_ID = pokemons_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($pokemons->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pokemons_list->lTotalRecs = $pokemons->SelectRecordCount();
	} else {
		if ($rs = $pokemons_list->LoadRecordset())
			$pokemons_list->lTotalRecs = $rs->RecordCount();
	}
	$pokemons_list->lStartRec = 1;
	if ($pokemons_list->lDisplayRecs <= 0 || ($pokemons->Export <> "" && $pokemons->ExportAll)) // Display all records
		$pokemons_list->lDisplayRecs = $pokemons_list->lTotalRecs;
	if (!($pokemons->Export <> "" && $pokemons->ExportAll))
		$pokemons_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $pokemons_list->LoadRecordset($pokemons_list->lStartRec-1, $pokemons_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($pokemons->Export == "" && $pokemons->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pokemons_list);" style="text-decoration: none;"><img id="pokemons_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pokemons_list_SearchPanel">
<form name="fpokemonslistsrch" id="fpokemonslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pokemons">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pokemons->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $pokemons_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pokemons->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pokemons->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pokemons->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($pokemons->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($pokemons->CurrentAction <> "gridadd" && $pokemons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($pokemons_list->Pager)) $pokemons_list->Pager = new cPrevNextPager($pokemons_list->lStartRec, $pokemons_list->lDisplayRecs, $pokemons_list->lTotalRecs) ?>
<?php if ($pokemons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($pokemons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_list->PageUrl() ?>start=<?php echo $pokemons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($pokemons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_list->PageUrl() ?>start=<?php echo $pokemons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pokemons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($pokemons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_list->PageUrl() ?>start=<?php echo $pokemons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($pokemons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_list->PageUrl() ?>start=<?php echo $pokemons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pokemons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pokemons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pokemons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pokemons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($pokemons_list->sSrchWhere == "0=101") { ?>
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
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpokemonslist" id="fpokemonslist" class="ewForm" action="" method="post">
<div id="gmp_pokemons" class="ewGridMiddlePanel">
<?php if ($pokemons_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pokemons->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pokemons_list->RenderListOptions();

// Render list options (header, left)
$pokemons_list->ListOptions->Render("header", "left");
?>
<?php if ($pokemons->id->Visible) { // id ?>
	<?php if ($pokemons->SortUrl($pokemons->id) == "") { ?>
		<td><?php echo $pokemons->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons->SortUrl($pokemons->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons->numero->Visible) { // numero ?>
	<?php if ($pokemons->SortUrl($pokemons->numero) == "") { ?>
		<td><?php echo $pokemons->numero->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons->SortUrl($pokemons->numero) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons->numero->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons->numero->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons->numero->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons->nombre->Visible) { // nombre ?>
	<?php if ($pokemons->SortUrl($pokemons->nombre) == "") { ?>
		<td><?php echo $pokemons->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons->SortUrl($pokemons->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pokemons->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons->icono->Visible) { // icono ?>
	<?php if ($pokemons->SortUrl($pokemons->icono) == "") { ?>
		<td><?php echo $pokemons->icono->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons->SortUrl($pokemons->icono) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons->icono->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons->icono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons->icono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pokemons_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pokemons->ExportAll && $pokemons->Export <> "") {
	$pokemons_list->lStopRec = $pokemons_list->lTotalRecs;
} else {
	$pokemons_list->lStopRec = $pokemons_list->lStartRec + $pokemons_list->lDisplayRecs - 1; // Set the last record to display
}
$pokemons_list->lRecCount = $pokemons_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $pokemons_list->lStartRec > 1)
		$rs->Move($pokemons_list->lStartRec - 1);
}

// Initialize aggregate
$pokemons->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pokemons_list->RenderRow();
$pokemons_list->lRowCnt = 0;
while (($pokemons->CurrentAction == "gridadd" || !$rs->EOF) &&
	$pokemons_list->lRecCount < $pokemons_list->lStopRec) {
	$pokemons_list->lRecCount++;
	if (intval($pokemons_list->lRecCount) >= intval($pokemons_list->lStartRec)) {
		$pokemons_list->lRowCnt++;

	// Init row class and style
	$pokemons->CssClass = "";
	$pokemons->CssStyle = "";
	$pokemons->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($pokemons->CurrentAction == "gridadd") {
		$pokemons_list->LoadDefaultValues(); // Load default values
	} else {
		$pokemons_list->LoadRowValues($rs); // Load row values
	}
	$pokemons->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$pokemons_list->RenderRow();

	// Render list options
	$pokemons_list->RenderListOptions();
?>
	<tr<?php echo $pokemons->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pokemons_list->ListOptions->Render("body", "left");
?>
	<?php if ($pokemons->id->Visible) { // id ?>
		<td<?php echo $pokemons->id->CellAttributes() ?>>
<div<?php echo $pokemons->id->ViewAttributes() ?>><?php echo $pokemons->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons->numero->Visible) { // numero ?>
		<td<?php echo $pokemons->numero->CellAttributes() ?>>
<div<?php echo $pokemons->numero->ViewAttributes() ?>><?php echo $pokemons->numero->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons->nombre->Visible) { // nombre ?>
		<td<?php echo $pokemons->nombre->CellAttributes() ?>>
<div<?php echo $pokemons->nombre->ViewAttributes() ?>><?php echo $pokemons->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons->icono->Visible) { // icono ?>
		<td<?php echo $pokemons->icono->CellAttributes() ?>>
<?php if ($pokemons->icono->HrefValue <> "" || $pokemons->icono->TooltipValue <> "") { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pokemons_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pokemons->CurrentAction <> "gridadd")
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
</td></tr></table>
<?php if ($pokemons->Export == "" && $pokemons->CurrentAction == "") { ?>
<?php } ?>
<?php if ($pokemons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$pokemons_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pokemons';

	// Page object name
	var $PageObjName = 'pokemons_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokemons;
		if ($pokemons->UseTokenInUrl) $PageUrl .= "t=" . $pokemons->TableVar . "&"; // Add page token
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
		global $objForm, $pokemons;
		if ($pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokemons_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons)
		$GLOBALS["pokemons"] = new cpokemons();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["pokemons"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pokemonsdelete.php";
		$this->MultiUpdateUrl = "pokemonsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons', TRUE);

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
		global $pokemons;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$pokemons->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$pokemons->Export = $_POST["exporttype"];
		} else {
			$pokemons->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $pokemons->Export; // Get export parameter, used in header
		$gsExportFile = $pokemons->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $pokemons;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$pokemons->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($pokemons->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $pokemons->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$pokemons->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$pokemons->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$pokemons->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $pokemons->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$pokemons->setSessionWhere($sFilter);
		$pokemons->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $pokemons;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pokemons->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pokemons->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pokemons->icono, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $pokemons;
		$sSearchStr = "";
		$sSearchKeyword = $pokemons->BasicSearchKeyword;
		$sSearchType = $pokemons->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$pokemons->setSessionBasicSearchKeyword($sSearchKeyword);
			$pokemons->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pokemons;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$pokemons->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pokemons;
		$pokemons->setSessionBasicSearchKeyword("");
		$pokemons->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pokemons;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pokemons->BasicSearchKeyword = $pokemons->getSessionBasicSearchKeyword();
			$pokemons->BasicSearchType = $pokemons->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pokemons;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pokemons->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pokemons->CurrentOrderType = @$_GET["ordertype"];
			$pokemons->UpdateSort($pokemons->id); // id
			$pokemons->UpdateSort($pokemons->numero); // numero
			$pokemons->UpdateSort($pokemons->nombre); // nombre
			$pokemons->UpdateSort($pokemons->icono); // icono
			$pokemons->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pokemons;
		$sOrderBy = $pokemons->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pokemons->SqlOrderBy() <> "") {
				$sOrderBy = $pokemons->SqlOrderBy();
				$pokemons->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pokemons;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pokemons->setSessionOrderBy($sOrderBy);
				$pokemons->id->setSort("");
				$pokemons->numero->setSort("");
				$pokemons->nombre->setSort("");
				$pokemons->icono->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $pokemons;

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
		if ($pokemons->Export <> "" ||
			$pokemons->CurrentAction == "gridadd" ||
			$pokemons->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pokemons;
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
		global $Security, $Language, $pokemons;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pokemons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$pokemons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$pokemons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $pokemons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pokemons;
		$pokemons->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pokemons->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pokemons;

		// Call Recordset Selecting event
		$pokemons->Recordset_Selecting($pokemons->CurrentFilter);

		// Load List page SQL
		$sSql = $pokemons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pokemons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokemons;
		$sFilter = $pokemons->KeyFilter();

		// Call Row Selecting event
		$pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokemons->CurrentFilter = $sFilter;
		$sSql = $pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pokemons;
		$pokemons->id->setDbValue($rs->fields('id'));
		$pokemons->numero->setDbValue($rs->fields('numero'));
		$pokemons->nombre->setDbValue($rs->fields('nombre'));
		$pokemons->imagen->Upload->DbValue = $rs->fields('imagen');
		$pokemons->icono->Upload->DbValue = $rs->fields('icono');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons;

		// Initialize URLs
		$this->ViewUrl = $pokemons->ViewUrl();
		$this->EditUrl = $pokemons->EditUrl();
		$this->InlineEditUrl = $pokemons->InlineEditUrl();
		$this->CopyUrl = $pokemons->CopyUrl();
		$this->InlineCopyUrl = $pokemons->InlineCopyUrl();
		$this->DeleteUrl = $pokemons->DeleteUrl();

		// Call Row_Rendering event
		$pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$pokemons->id->CellCssStyle = ""; $pokemons->id->CellCssClass = "";
		$pokemons->id->CellAttrs = array(); $pokemons->id->ViewAttrs = array(); $pokemons->id->EditAttrs = array();

		// numero
		$pokemons->numero->CellCssStyle = ""; $pokemons->numero->CellCssClass = "";
		$pokemons->numero->CellAttrs = array(); $pokemons->numero->ViewAttrs = array(); $pokemons->numero->EditAttrs = array();

		// nombre
		$pokemons->nombre->CellCssStyle = ""; $pokemons->nombre->CellCssClass = "";
		$pokemons->nombre->CellAttrs = array(); $pokemons->nombre->ViewAttrs = array(); $pokemons->nombre->EditAttrs = array();

		// icono
		$pokemons->icono->CellCssStyle = ""; $pokemons->icono->CellCssClass = "";
		$pokemons->icono->CellAttrs = array(); $pokemons->icono->ViewAttrs = array(); $pokemons->icono->EditAttrs = array();
		if ($pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pokemons->id->ViewValue = $pokemons->id->CurrentValue;
			$pokemons->id->CssStyle = "";
			$pokemons->id->CssClass = "";
			$pokemons->id->ViewCustomAttributes = "";

			// numero
			$pokemons->numero->ViewValue = $pokemons->numero->CurrentValue;
			$pokemons->numero->CssStyle = "";
			$pokemons->numero->CssClass = "";
			$pokemons->numero->ViewCustomAttributes = "";

			// nombre
			$pokemons->nombre->ViewValue = $pokemons->nombre->CurrentValue;
			$pokemons->nombre->CssStyle = "";
			$pokemons->nombre->CssClass = "";
			$pokemons->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->ViewValue = $pokemons->imagen->Upload->DbValue;
			} else {
				$pokemons->imagen->ViewValue = "";
			}
			$pokemons->imagen->CssStyle = "";
			$pokemons->imagen->CssClass = "";
			$pokemons->imagen->ViewCustomAttributes = "";

			// icono
			if (!ew_Empty($pokemons->icono->Upload->DbValue)) {
				$pokemons->icono->ViewValue = $pokemons->icono->Upload->DbValue;
				$pokemons->icono->ImageWidth = 32;
				$pokemons->icono->ImageHeight = 32;
				$pokemons->icono->ImageAlt = $pokemons->icono->FldAlt();
			} else {
				$pokemons->icono->ViewValue = "";
			}
			$pokemons->icono->CssStyle = "";
			$pokemons->icono->CssClass = "";
			$pokemons->icono->ViewCustomAttributes = "";

			// id
			$pokemons->id->HrefValue = "";
			$pokemons->id->TooltipValue = "";

			// numero
			$pokemons->numero->HrefValue = "";
			$pokemons->numero->TooltipValue = "";

			// nombre
			$pokemons->nombre->HrefValue = "";
			$pokemons->nombre->TooltipValue = "";

			// icono
			$pokemons->icono->HrefValue = "";
			$pokemons->icono->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons->Row_Rendered();
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
