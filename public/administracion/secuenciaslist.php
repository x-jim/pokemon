<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "secuenciasinfo.php" ?>
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
$secuencias_list = new csecuencias_list();
$Page =& $secuencias_list;

// Page init
$secuencias_list->Page_Init();

// Page main
$secuencias_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($secuencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_list = new ew_Page("secuencias_list");

// page properties
secuencias_list.PageID = "list"; // page ID
secuencias_list.FormID = "fsecuenciaslist"; // form ID
var EW_PAGE_ID = secuencias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($secuencias->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$secuencias_list->lTotalRecs = $secuencias->SelectRecordCount();
	} else {
		if ($rs = $secuencias_list->LoadRecordset())
			$secuencias_list->lTotalRecs = $rs->RecordCount();
	}
	$secuencias_list->lStartRec = 1;
	if ($secuencias_list->lDisplayRecs <= 0 || ($secuencias->Export <> "" && $secuencias->ExportAll)) // Display all records
		$secuencias_list->lDisplayRecs = $secuencias_list->lTotalRecs;
	if (!($secuencias->Export <> "" && $secuencias->ExportAll))
		$secuencias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $secuencias_list->LoadRecordset($secuencias_list->lStartRec-1, $secuencias_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($secuencias->Export == "" && $secuencias->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(secuencias_list);" style="text-decoration: none;"><img id="secuencias_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="secuencias_list_SearchPanel">
<form name="fsecuenciaslistsrch" id="fsecuenciaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="secuencias">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($secuencias->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $secuencias_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($secuencias->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($secuencias->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($secuencias->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsecuenciaslist" id="fsecuenciaslist" class="ewForm" action="" method="post">
<div id="gmp_secuencias" class="ewGridMiddlePanel">
<?php if ($secuencias_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $secuencias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$secuencias_list->RenderListOptions();

// Render list options (header, left)
$secuencias_list->ListOptions->Render("header", "left");
?>
<?php if ($secuencias->id->Visible) { // id ?>
	<?php if ($secuencias->SortUrl($secuencias->id) == "") { ?>
		<td><?php echo $secuencias->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias->SortUrl($secuencias->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($secuencias->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secuencias->nombre->Visible) { // nombre ?>
	<?php if ($secuencias->SortUrl($secuencias->nombre) == "") { ?>
		<td><?php echo $secuencias->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias->SortUrl($secuencias->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($secuencias->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$secuencias_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($secuencias->ExportAll && $secuencias->Export <> "") {
	$secuencias_list->lStopRec = $secuencias_list->lTotalRecs;
} else {
	$secuencias_list->lStopRec = $secuencias_list->lStartRec + $secuencias_list->lDisplayRecs - 1; // Set the last record to display
}
$secuencias_list->lRecCount = $secuencias_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $secuencias_list->lStartRec > 1)
		$rs->Move($secuencias_list->lStartRec - 1);
}

// Initialize aggregate
$secuencias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$secuencias_list->RenderRow();
$secuencias_list->lRowCnt = 0;
while (($secuencias->CurrentAction == "gridadd" || !$rs->EOF) &&
	$secuencias_list->lRecCount < $secuencias_list->lStopRec) {
	$secuencias_list->lRecCount++;
	if (intval($secuencias_list->lRecCount) >= intval($secuencias_list->lStartRec)) {
		$secuencias_list->lRowCnt++;

	// Init row class and style
	$secuencias->CssClass = "";
	$secuencias->CssStyle = "";
	$secuencias->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($secuencias->CurrentAction == "gridadd") {
		$secuencias_list->LoadDefaultValues(); // Load default values
	} else {
		$secuencias_list->LoadRowValues($rs); // Load row values
	}
	$secuencias->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$secuencias_list->RenderRow();

	// Render list options
	$secuencias_list->RenderListOptions();
?>
	<tr<?php echo $secuencias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$secuencias_list->ListOptions->Render("body", "left");
?>
	<?php if ($secuencias->id->Visible) { // id ?>
		<td<?php echo $secuencias->id->CellAttributes() ?>>
<div<?php echo $secuencias->id->ViewAttributes() ?>><?php echo $secuencias->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secuencias->nombre->Visible) { // nombre ?>
		<td<?php echo $secuencias->nombre->CellAttributes() ?>>
<div<?php echo $secuencias->nombre->ViewAttributes() ?>><?php echo $secuencias->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$secuencias_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($secuencias->CurrentAction <> "gridadd")
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
<?php if ($secuencias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($secuencias->CurrentAction <> "gridadd" && $secuencias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($secuencias_list->Pager)) $secuencias_list->Pager = new cPrevNextPager($secuencias_list->lStartRec, $secuencias_list->lDisplayRecs, $secuencias_list->lTotalRecs) ?>
<?php if ($secuencias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($secuencias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_list->PageUrl() ?>start=<?php echo $secuencias_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($secuencias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_list->PageUrl() ?>start=<?php echo $secuencias_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $secuencias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($secuencias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_list->PageUrl() ?>start=<?php echo $secuencias_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($secuencias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_list->PageUrl() ?>start=<?php echo $secuencias_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $secuencias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $secuencias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $secuencias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $secuencias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($secuencias_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($secuencias_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($secuencias->Export == "" && $secuencias->CurrentAction == "") { ?>
<?php } ?>
<?php if ($secuencias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$secuencias_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'secuencias';

	// Page object name
	var $PageObjName = 'secuencias_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secuencias;
		if ($secuencias->UseTokenInUrl) $PageUrl .= "t=" . $secuencias->TableVar . "&"; // Add page token
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
		global $objForm, $secuencias;
		if ($secuencias->UseTokenInUrl) {
			if ($objForm)
				return ($secuencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secuencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecuencias_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias)
		$GLOBALS["secuencias"] = new csecuencias();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["secuencias"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "secuenciasdelete.php";
		$this->MultiUpdateUrl = "secuenciasupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias', TRUE);

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
		global $secuencias;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$secuencias->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$secuencias->Export = $_POST["exporttype"];
		} else {
			$secuencias->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $secuencias->Export; // Get export parameter, used in header
		$gsExportFile = $secuencias->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $secuencias;

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
			$secuencias->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($secuencias->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $secuencias->getRecordsPerPage(); // Restore from Session
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
		$secuencias->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$secuencias->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$secuencias->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $secuencias->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$secuencias->setSessionWhere($sFilter);
		$secuencias->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $secuencias;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $secuencias->nombre, $Keyword);
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
		global $Security, $secuencias;
		$sSearchStr = "";
		$sSearchKeyword = $secuencias->BasicSearchKeyword;
		$sSearchType = $secuencias->BasicSearchType;
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
			$secuencias->setSessionBasicSearchKeyword($sSearchKeyword);
			$secuencias->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $secuencias;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$secuencias->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $secuencias;
		$secuencias->setSessionBasicSearchKeyword("");
		$secuencias->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $secuencias;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$secuencias->BasicSearchKeyword = $secuencias->getSessionBasicSearchKeyword();
			$secuencias->BasicSearchType = $secuencias->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $secuencias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$secuencias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$secuencias->CurrentOrderType = @$_GET["ordertype"];
			$secuencias->UpdateSort($secuencias->id); // id
			$secuencias->UpdateSort($secuencias->nombre); // nombre
			$secuencias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $secuencias;
		$sOrderBy = $secuencias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($secuencias->SqlOrderBy() <> "") {
				$sOrderBy = $secuencias->SqlOrderBy();
				$secuencias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $secuencias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$secuencias->setSessionOrderBy($sOrderBy);
				$secuencias->id->setSort("");
				$secuencias->nombre->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$secuencias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $secuencias;

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

		// "detail_secuencias_escenas"
		$this->ListOptions->Add("detail_secuencias_escenas");
		$item =& $this->ListOptions->Items["detail_secuencias_escenas"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($secuencias->Export <> "" ||
			$secuencias->CurrentAction == "gridadd" ||
			$secuencias->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $secuencias;
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

		// "detail_secuencias_escenas"
		$oListOpt =& $this->ListOptions->Items["detail_secuencias_escenas"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("secuencias_escenas", "TblCaption");
			$oListOpt->Body = "<a href=\"secuencias_escenaslist.php?" . EW_TABLE_SHOW_MASTER . "=secuencias&id=" . urlencode(strval($secuencias->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $secuencias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $secuencias;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$secuencias->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$secuencias->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $secuencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$secuencias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $secuencias;
		$secuencias->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$secuencias->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secuencias;

		// Call Recordset Selecting event
		$secuencias->Recordset_Selecting($secuencias->CurrentFilter);

		// Load List page SQL
		$sSql = $secuencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secuencias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secuencias;
		$sFilter = $secuencias->KeyFilter();

		// Call Row Selecting event
		$secuencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secuencias->CurrentFilter = $sFilter;
		$sSql = $secuencias->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$secuencias->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $secuencias;
		$secuencias->id->setDbValue($rs->fields('id'));
		$secuencias->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secuencias;

		// Initialize URLs
		$this->ViewUrl = $secuencias->ViewUrl();
		$this->EditUrl = $secuencias->EditUrl();
		$this->InlineEditUrl = $secuencias->InlineEditUrl();
		$this->CopyUrl = $secuencias->CopyUrl();
		$this->InlineCopyUrl = $secuencias->InlineCopyUrl();
		$this->DeleteUrl = $secuencias->DeleteUrl();

		// Call Row_Rendering event
		$secuencias->Row_Rendering();

		// Common render codes for all row types
		// id

		$secuencias->id->CellCssStyle = ""; $secuencias->id->CellCssClass = "";
		$secuencias->id->CellAttrs = array(); $secuencias->id->ViewAttrs = array(); $secuencias->id->EditAttrs = array();

		// nombre
		$secuencias->nombre->CellCssStyle = ""; $secuencias->nombre->CellCssClass = "";
		$secuencias->nombre->CellAttrs = array(); $secuencias->nombre->ViewAttrs = array(); $secuencias->nombre->EditAttrs = array();
		if ($secuencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$secuencias->id->ViewValue = $secuencias->id->CurrentValue;
			$secuencias->id->CssStyle = "";
			$secuencias->id->CssClass = "";
			$secuencias->id->ViewCustomAttributes = "";

			// nombre
			$secuencias->nombre->ViewValue = $secuencias->nombre->CurrentValue;
			$secuencias->nombre->CssStyle = "";
			$secuencias->nombre->CssClass = "";
			$secuencias->nombre->ViewCustomAttributes = "";

			// id
			$secuencias->id->HrefValue = "";
			$secuencias->id->TooltipValue = "";

			// nombre
			$secuencias->nombre->HrefValue = "";
			$secuencias->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias->Row_Rendered();
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
