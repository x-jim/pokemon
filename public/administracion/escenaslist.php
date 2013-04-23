<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "escenasinfo.php" ?>
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
$escenas_list = new cescenas_list();
$Page =& $escenas_list;

// Page init
$escenas_list->Page_Init();

// Page main
$escenas_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($escenas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var escenas_list = new ew_Page("escenas_list");

// page properties
escenas_list.PageID = "list"; // page ID
escenas_list.FormID = "fescenaslist"; // form ID
var EW_PAGE_ID = escenas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
escenas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
escenas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
escenas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($escenas->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$escenas_list->lTotalRecs = $escenas->SelectRecordCount();
	} else {
		if ($rs = $escenas_list->LoadRecordset())
			$escenas_list->lTotalRecs = $rs->RecordCount();
	}
	$escenas_list->lStartRec = 1;
	if ($escenas_list->lDisplayRecs <= 0 || ($escenas->Export <> "" && $escenas->ExportAll)) // Display all records
		$escenas_list->lDisplayRecs = $escenas_list->lTotalRecs;
	if (!($escenas->Export <> "" && $escenas->ExportAll))
		$escenas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $escenas_list->LoadRecordset($escenas_list->lStartRec-1, $escenas_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $escenas->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($escenas->Export == "" && $escenas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(escenas_list);" style="text-decoration: none;"><img id="escenas_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="escenas_list_SearchPanel">
<form name="fescenaslistsrch" id="fescenaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="escenas">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($escenas->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $escenas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($escenas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($escenas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($escenas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$escenas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fescenaslist" id="fescenaslist" class="ewForm" action="" method="post">
<div id="gmp_escenas" class="ewGridMiddlePanel">
<?php if ($escenas_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $escenas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$escenas_list->RenderListOptions();

// Render list options (header, left)
$escenas_list->ListOptions->Render("header", "left");
?>
<?php if ($escenas->id->Visible) { // id ?>
	<?php if ($escenas->SortUrl($escenas->id) == "") { ?>
		<td><?php echo $escenas->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $escenas->SortUrl($escenas->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $escenas->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($escenas->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($escenas->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($escenas->nombre->Visible) { // nombre ?>
	<?php if ($escenas->SortUrl($escenas->nombre) == "") { ?>
		<td><?php echo $escenas->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $escenas->SortUrl($escenas->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $escenas->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($escenas->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($escenas->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($escenas->imagen->Visible) { // imagen ?>
	<?php if ($escenas->SortUrl($escenas->imagen) == "") { ?>
		<td><?php echo $escenas->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $escenas->SortUrl($escenas->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $escenas->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($escenas->imagen->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($escenas->imagen->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$escenas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($escenas->ExportAll && $escenas->Export <> "") {
	$escenas_list->lStopRec = $escenas_list->lTotalRecs;
} else {
	$escenas_list->lStopRec = $escenas_list->lStartRec + $escenas_list->lDisplayRecs - 1; // Set the last record to display
}
$escenas_list->lRecCount = $escenas_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $escenas_list->lStartRec > 1)
		$rs->Move($escenas_list->lStartRec - 1);
}

// Initialize aggregate
$escenas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$escenas_list->RenderRow();
$escenas_list->lRowCnt = 0;
while (($escenas->CurrentAction == "gridadd" || !$rs->EOF) &&
	$escenas_list->lRecCount < $escenas_list->lStopRec) {
	$escenas_list->lRecCount++;
	if (intval($escenas_list->lRecCount) >= intval($escenas_list->lStartRec)) {
		$escenas_list->lRowCnt++;

	// Init row class and style
	$escenas->CssClass = "";
	$escenas->CssStyle = "";
	$escenas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($escenas->CurrentAction == "gridadd") {
		$escenas_list->LoadDefaultValues(); // Load default values
	} else {
		$escenas_list->LoadRowValues($rs); // Load row values
	}
	$escenas->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$escenas_list->RenderRow();

	// Render list options
	$escenas_list->RenderListOptions();
?>
	<tr<?php echo $escenas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$escenas_list->ListOptions->Render("body", "left");
?>
	<?php if ($escenas->id->Visible) { // id ?>
		<td<?php echo $escenas->id->CellAttributes() ?>>
<div<?php echo $escenas->id->ViewAttributes() ?>><?php echo $escenas->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($escenas->nombre->Visible) { // nombre ?>
		<td<?php echo $escenas->nombre->CellAttributes() ?>>
<div<?php echo $escenas->nombre->ViewAttributes() ?>><?php echo $escenas->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($escenas->imagen->Visible) { // imagen ?>
		<td<?php echo $escenas->imagen->CellAttributes() ?>>
<?php if ($escenas->imagen->HrefValue <> "" || $escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $escenas->imagen->HrefValue ?>"><?php echo $escenas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<?php echo $escenas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$escenas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($escenas->CurrentAction <> "gridadd")
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
<?php if ($escenas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($escenas->CurrentAction <> "gridadd" && $escenas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($escenas_list->Pager)) $escenas_list->Pager = new cPrevNextPager($escenas_list->lStartRec, $escenas_list->lDisplayRecs, $escenas_list->lTotalRecs) ?>
<?php if ($escenas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($escenas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $escenas_list->PageUrl() ?>start=<?php echo $escenas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($escenas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $escenas_list->PageUrl() ?>start=<?php echo $escenas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $escenas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($escenas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $escenas_list->PageUrl() ?>start=<?php echo $escenas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($escenas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $escenas_list->PageUrl() ?>start=<?php echo $escenas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $escenas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $escenas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $escenas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $escenas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($escenas_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($escenas_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $escenas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($escenas->Export == "" && $escenas->CurrentAction == "") { ?>
<?php } ?>
<?php if ($escenas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$escenas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cescenas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'escenas';

	// Page object name
	var $PageObjName = 'escenas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $escenas;
		if ($escenas->UseTokenInUrl) $PageUrl .= "t=" . $escenas->TableVar . "&"; // Add page token
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
		global $objForm, $escenas;
		if ($escenas->UseTokenInUrl) {
			if ($objForm)
				return ($escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cescenas_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (escenas)
		$GLOBALS["escenas"] = new cescenas();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["escenas"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "escenasdelete.php";
		$this->MultiUpdateUrl = "escenasupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'escenas', TRUE);

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
		global $escenas;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$escenas->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$escenas->Export = $_POST["exporttype"];
		} else {
			$escenas->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $escenas->Export; // Get export parameter, used in header
		$gsExportFile = $escenas->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $escenas;

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
			$escenas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($escenas->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $escenas->getRecordsPerPage(); // Restore from Session
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
		$escenas->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$escenas->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$escenas->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $escenas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$escenas->setSessionWhere($sFilter);
		$escenas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $escenas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $escenas->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $escenas->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $escenas->texto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $escenas->script, $Keyword);
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
		global $Security, $escenas;
		$sSearchStr = "";
		$sSearchKeyword = $escenas->BasicSearchKeyword;
		$sSearchType = $escenas->BasicSearchType;
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
			$escenas->setSessionBasicSearchKeyword($sSearchKeyword);
			$escenas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $escenas;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$escenas->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $escenas;
		$escenas->setSessionBasicSearchKeyword("");
		$escenas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $escenas;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$escenas->BasicSearchKeyword = $escenas->getSessionBasicSearchKeyword();
			$escenas->BasicSearchType = $escenas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $escenas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$escenas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$escenas->CurrentOrderType = @$_GET["ordertype"];
			$escenas->UpdateSort($escenas->id); // id
			$escenas->UpdateSort($escenas->nombre); // nombre
			$escenas->UpdateSort($escenas->imagen); // imagen
			$escenas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $escenas;
		$sOrderBy = $escenas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($escenas->SqlOrderBy() <> "") {
				$sOrderBy = $escenas->SqlOrderBy();
				$escenas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $escenas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$escenas->setSessionOrderBy($sOrderBy);
				$escenas->id->setSort("");
				$escenas->nombre->setSort("");
				$escenas->imagen->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$escenas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $escenas;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
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
		if ($escenas->Export <> "" ||
			$escenas->CurrentAction == "gridadd" ||
			$escenas->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $escenas;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . "<img src=\"images/copy.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
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
		global $Security, $Language, $escenas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $escenas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$escenas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$escenas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $escenas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$escenas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$escenas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$escenas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $escenas;
		$escenas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$escenas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $escenas;

		// Call Recordset Selecting event
		$escenas->Recordset_Selecting($escenas->CurrentFilter);

		// Load List page SQL
		$sSql = $escenas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$escenas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $escenas;
		$sFilter = $escenas->KeyFilter();

		// Call Row Selecting event
		$escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$escenas->CurrentFilter = $sFilter;
		$sSql = $escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $escenas;
		$escenas->id->setDbValue($rs->fields('id'));
		$escenas->nombre->setDbValue($rs->fields('nombre'));
		$escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$escenas->texto->setDbValue($rs->fields('texto'));
		$escenas->script->setDbValue($rs->fields('script'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $escenas;

		// Initialize URLs
		$this->ViewUrl = $escenas->ViewUrl();
		$this->EditUrl = $escenas->EditUrl();
		$this->InlineEditUrl = $escenas->InlineEditUrl();
		$this->CopyUrl = $escenas->CopyUrl();
		$this->InlineCopyUrl = $escenas->InlineCopyUrl();
		$this->DeleteUrl = $escenas->DeleteUrl();

		// Call Row_Rendering event
		$escenas->Row_Rendering();

		// Common render codes for all row types
		// id

		$escenas->id->CellCssStyle = ""; $escenas->id->CellCssClass = "";
		$escenas->id->CellAttrs = array(); $escenas->id->ViewAttrs = array(); $escenas->id->EditAttrs = array();

		// nombre
		$escenas->nombre->CellCssStyle = ""; $escenas->nombre->CellCssClass = "";
		$escenas->nombre->CellAttrs = array(); $escenas->nombre->ViewAttrs = array(); $escenas->nombre->EditAttrs = array();

		// imagen
		$escenas->imagen->CellCssStyle = ""; $escenas->imagen->CellCssClass = "";
		$escenas->imagen->CellAttrs = array(); $escenas->imagen->ViewAttrs = array(); $escenas->imagen->EditAttrs = array();
		if ($escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$escenas->id->ViewValue = $escenas->id->CurrentValue;
			$escenas->id->CssStyle = "";
			$escenas->id->CssClass = "";
			$escenas->id->ViewCustomAttributes = "";

			// nombre
			$escenas->nombre->ViewValue = $escenas->nombre->CurrentValue;
			$escenas->nombre->CssStyle = "";
			$escenas->nombre->CssClass = "";
			$escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->ViewValue = $escenas->imagen->Upload->DbValue;
			} else {
				$escenas->imagen->ViewValue = "";
			}
			$escenas->imagen->CssStyle = "";
			$escenas->imagen->CssClass = "";
			$escenas->imagen->ViewCustomAttributes = "";

			// id
			$escenas->id->HrefValue = "";
			$escenas->id->TooltipValue = "";

			// nombre
			$escenas->nombre->HrefValue = "";
			$escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $escenas->imagen->UploadPath) . ((!empty($escenas->imagen->ViewValue)) ? $escenas->imagen->ViewValue : $escenas->imagen->CurrentValue);
				if ($escenas->Export <> "") $escenas->imagen->HrefValue = ew_ConvertFullUrl($escenas->imagen->HrefValue);
			} else {
				$escenas->imagen->HrefValue = "";
			}
			$escenas->imagen->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$escenas->Row_Rendered();
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
