<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "iconosinfo.php" ?>
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
$iconos_list = new ciconos_list();
$Page =& $iconos_list;

// Page init
$iconos_list->Page_Init();

// Page main
$iconos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($iconos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var iconos_list = new ew_Page("iconos_list");

// page properties
iconos_list.PageID = "list"; // page ID
iconos_list.FormID = "ficonoslist"; // form ID
var EW_PAGE_ID = iconos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
iconos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
iconos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
iconos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($iconos->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$iconos_list->lTotalRecs = $iconos->SelectRecordCount();
	} else {
		if ($rs = $iconos_list->LoadRecordset())
			$iconos_list->lTotalRecs = $rs->RecordCount();
	}
	$iconos_list->lStartRec = 1;
	if ($iconos_list->lDisplayRecs <= 0 || ($iconos->Export <> "" && $iconos->ExportAll)) // Display all records
		$iconos_list->lDisplayRecs = $iconos_list->lTotalRecs;
	if (!($iconos->Export <> "" && $iconos->ExportAll))
		$iconos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $iconos_list->LoadRecordset($iconos_list->lStartRec-1, $iconos_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $iconos->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($iconos->Export == "" && $iconos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(iconos_list);" style="text-decoration: none;"><img id="iconos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="iconos_list_SearchPanel">
<form name="ficonoslistsrch" id="ficonoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="iconos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($iconos->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $iconos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($iconos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($iconos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($iconos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$iconos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="ficonoslist" id="ficonoslist" class="ewForm" action="" method="post">
<div id="gmp_iconos" class="ewGridMiddlePanel">
<?php if ($iconos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $iconos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$iconos_list->RenderListOptions();

// Render list options (header, left)
$iconos_list->ListOptions->Render("header", "left");
?>
<?php if ($iconos->id->Visible) { // id ?>
	<?php if ($iconos->SortUrl($iconos->id) == "") { ?>
		<td><?php echo $iconos->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $iconos->SortUrl($iconos->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $iconos->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($iconos->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($iconos->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($iconos->nombre->Visible) { // nombre ?>
	<?php if ($iconos->SortUrl($iconos->nombre) == "") { ?>
		<td><?php echo $iconos->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $iconos->SortUrl($iconos->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $iconos->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($iconos->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($iconos->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($iconos->x->Visible) { // x ?>
	<?php if ($iconos->SortUrl($iconos->x) == "") { ?>
		<td><?php echo $iconos->x->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $iconos->SortUrl($iconos->x) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $iconos->x->FldCaption() ?></td><td style="width: 10px;"><?php if ($iconos->x->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($iconos->x->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($iconos->y->Visible) { // y ?>
	<?php if ($iconos->SortUrl($iconos->y) == "") { ?>
		<td><?php echo $iconos->y->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $iconos->SortUrl($iconos->y) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $iconos->y->FldCaption() ?></td><td style="width: 10px;"><?php if ($iconos->y->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($iconos->y->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$iconos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($iconos->ExportAll && $iconos->Export <> "") {
	$iconos_list->lStopRec = $iconos_list->lTotalRecs;
} else {
	$iconos_list->lStopRec = $iconos_list->lStartRec + $iconos_list->lDisplayRecs - 1; // Set the last record to display
}
$iconos_list->lRecCount = $iconos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $iconos_list->lStartRec > 1)
		$rs->Move($iconos_list->lStartRec - 1);
}

// Initialize aggregate
$iconos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$iconos_list->RenderRow();
$iconos_list->lRowCnt = 0;
while (($iconos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$iconos_list->lRecCount < $iconos_list->lStopRec) {
	$iconos_list->lRecCount++;
	if (intval($iconos_list->lRecCount) >= intval($iconos_list->lStartRec)) {
		$iconos_list->lRowCnt++;

	// Init row class and style
	$iconos->CssClass = "";
	$iconos->CssStyle = "";
	$iconos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($iconos->CurrentAction == "gridadd") {
		$iconos_list->LoadDefaultValues(); // Load default values
	} else {
		$iconos_list->LoadRowValues($rs); // Load row values
	}
	$iconos->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$iconos_list->RenderRow();

	// Render list options
	$iconos_list->RenderListOptions();
?>
	<tr<?php echo $iconos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$iconos_list->ListOptions->Render("body", "left");
?>
	<?php if ($iconos->id->Visible) { // id ?>
		<td<?php echo $iconos->id->CellAttributes() ?>>
<div<?php echo $iconos->id->ViewAttributes() ?>><?php echo $iconos->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($iconos->nombre->Visible) { // nombre ?>
		<td<?php echo $iconos->nombre->CellAttributes() ?>>
<div<?php echo $iconos->nombre->ViewAttributes() ?>><?php echo $iconos->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($iconos->x->Visible) { // x ?>
		<td<?php echo $iconos->x->CellAttributes() ?>>
<div<?php echo $iconos->x->ViewAttributes() ?>><?php echo $iconos->x->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($iconos->y->Visible) { // y ?>
		<td<?php echo $iconos->y->CellAttributes() ?>>
<div<?php echo $iconos->y->ViewAttributes() ?>><?php echo $iconos->y->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$iconos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($iconos->CurrentAction <> "gridadd")
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
<?php if ($iconos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($iconos->CurrentAction <> "gridadd" && $iconos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($iconos_list->Pager)) $iconos_list->Pager = new cPrevNextPager($iconos_list->lStartRec, $iconos_list->lDisplayRecs, $iconos_list->lTotalRecs) ?>
<?php if ($iconos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($iconos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $iconos_list->PageUrl() ?>start=<?php echo $iconos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($iconos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $iconos_list->PageUrl() ?>start=<?php echo $iconos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $iconos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($iconos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $iconos_list->PageUrl() ?>start=<?php echo $iconos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($iconos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $iconos_list->PageUrl() ?>start=<?php echo $iconos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $iconos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $iconos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $iconos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $iconos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($iconos_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($iconos_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $iconos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($iconos->Export == "" && $iconos->CurrentAction == "") { ?>
<?php } ?>
<?php if ($iconos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$iconos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ciconos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'iconos';

	// Page object name
	var $PageObjName = 'iconos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $iconos;
		if ($iconos->UseTokenInUrl) $PageUrl .= "t=" . $iconos->TableVar . "&"; // Add page token
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
		global $objForm, $iconos;
		if ($iconos->UseTokenInUrl) {
			if ($objForm)
				return ($iconos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($iconos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ciconos_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (iconos)
		$GLOBALS["iconos"] = new ciconos();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["iconos"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "iconosdelete.php";
		$this->MultiUpdateUrl = "iconosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'iconos', TRUE);

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
		global $iconos;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$iconos->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$iconos->Export = $_POST["exporttype"];
		} else {
			$iconos->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $iconos->Export; // Get export parameter, used in header
		$gsExportFile = $iconos->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $iconos;

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
			$iconos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($iconos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $iconos->getRecordsPerPage(); // Restore from Session
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
		$iconos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$iconos->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$iconos->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $iconos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$iconos->setSessionWhere($sFilter);
		$iconos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $iconos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $iconos->nombre, $Keyword);
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
		global $Security, $iconos;
		$sSearchStr = "";
		$sSearchKeyword = $iconos->BasicSearchKeyword;
		$sSearchType = $iconos->BasicSearchType;
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
			$iconos->setSessionBasicSearchKeyword($sSearchKeyword);
			$iconos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $iconos;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$iconos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $iconos;
		$iconos->setSessionBasicSearchKeyword("");
		$iconos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $iconos;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$iconos->BasicSearchKeyword = $iconos->getSessionBasicSearchKeyword();
			$iconos->BasicSearchType = $iconos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $iconos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$iconos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$iconos->CurrentOrderType = @$_GET["ordertype"];
			$iconos->UpdateSort($iconos->id); // id
			$iconos->UpdateSort($iconos->nombre); // nombre
			$iconos->UpdateSort($iconos->x); // x
			$iconos->UpdateSort($iconos->y); // y
			$iconos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $iconos;
		$sOrderBy = $iconos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($iconos->SqlOrderBy() <> "") {
				$sOrderBy = $iconos->SqlOrderBy();
				$iconos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $iconos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$iconos->setSessionOrderBy($sOrderBy);
				$iconos->id->setSort("");
				$iconos->nombre->setSort("");
				$iconos->x->setSort("");
				$iconos->y->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$iconos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $iconos;

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
		if ($iconos->Export <> "" ||
			$iconos->CurrentAction == "gridadd" ||
			$iconos->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $iconos;
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
		global $Security, $Language, $iconos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $iconos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$iconos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$iconos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $iconos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$iconos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$iconos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$iconos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $iconos;
		$iconos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$iconos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $iconos;

		// Call Recordset Selecting event
		$iconos->Recordset_Selecting($iconos->CurrentFilter);

		// Load List page SQL
		$sSql = $iconos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$iconos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $iconos;
		$sFilter = $iconos->KeyFilter();

		// Call Row Selecting event
		$iconos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$iconos->CurrentFilter = $sFilter;
		$sSql = $iconos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$iconos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $iconos;
		$iconos->id->setDbValue($rs->fields('id'));
		$iconos->nombre->setDbValue($rs->fields('nombre'));
		$iconos->x->setDbValue($rs->fields('x'));
		$iconos->y->setDbValue($rs->fields('y'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $iconos;

		// Initialize URLs
		$this->ViewUrl = $iconos->ViewUrl();
		$this->EditUrl = $iconos->EditUrl();
		$this->InlineEditUrl = $iconos->InlineEditUrl();
		$this->CopyUrl = $iconos->CopyUrl();
		$this->InlineCopyUrl = $iconos->InlineCopyUrl();
		$this->DeleteUrl = $iconos->DeleteUrl();

		// Call Row_Rendering event
		$iconos->Row_Rendering();

		// Common render codes for all row types
		// id

		$iconos->id->CellCssStyle = ""; $iconos->id->CellCssClass = "";
		$iconos->id->CellAttrs = array(); $iconos->id->ViewAttrs = array(); $iconos->id->EditAttrs = array();

		// nombre
		$iconos->nombre->CellCssStyle = ""; $iconos->nombre->CellCssClass = "";
		$iconos->nombre->CellAttrs = array(); $iconos->nombre->ViewAttrs = array(); $iconos->nombre->EditAttrs = array();

		// x
		$iconos->x->CellCssStyle = ""; $iconos->x->CellCssClass = "";
		$iconos->x->CellAttrs = array(); $iconos->x->ViewAttrs = array(); $iconos->x->EditAttrs = array();

		// y
		$iconos->y->CellCssStyle = ""; $iconos->y->CellCssClass = "";
		$iconos->y->CellAttrs = array(); $iconos->y->ViewAttrs = array(); $iconos->y->EditAttrs = array();
		if ($iconos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$iconos->id->ViewValue = $iconos->id->CurrentValue;
			$iconos->id->CssStyle = "";
			$iconos->id->CssClass = "";
			$iconos->id->ViewCustomAttributes = "";

			// nombre
			$iconos->nombre->ViewValue = $iconos->nombre->CurrentValue;
			$iconos->nombre->CssStyle = "";
			$iconos->nombre->CssClass = "";
			$iconos->nombre->ViewCustomAttributes = "";

			// x
			$iconos->x->ViewValue = $iconos->x->CurrentValue;
			$iconos->x->CssStyle = "";
			$iconos->x->CssClass = "";
			$iconos->x->ViewCustomAttributes = "";

			// y
			$iconos->y->ViewValue = $iconos->y->CurrentValue;
			$iconos->y->CssStyle = "";
			$iconos->y->CssClass = "";
			$iconos->y->ViewCustomAttributes = "";

			// id
			$iconos->id->HrefValue = "";
			$iconos->id->TooltipValue = "";

			// nombre
			$iconos->nombre->HrefValue = "";
			$iconos->nombre->TooltipValue = "";

			// x
			$iconos->x->HrefValue = "";
			$iconos->x->TooltipValue = "";

			// y
			$iconos->y->HrefValue = "";
			$iconos->y->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($iconos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$iconos->Row_Rendered();
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
