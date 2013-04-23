<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "itemsinfo.php" ?>
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
$items_list = new citems_list();
$Page =& $items_list;

// Page init
$items_list->Page_Init();

// Page main
$items_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var items_list = new ew_Page("items_list");

// page properties
items_list.PageID = "list"; // page ID
items_list.FormID = "fitemslist"; // form ID
var EW_PAGE_ID = items_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
items_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
items_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
items_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($items->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$items_list->lTotalRecs = $items->SelectRecordCount();
	} else {
		if ($rs = $items_list->LoadRecordset())
			$items_list->lTotalRecs = $rs->RecordCount();
	}
	$items_list->lStartRec = 1;
	if ($items_list->lDisplayRecs <= 0 || ($items->Export <> "" && $items->ExportAll)) // Display all records
		$items_list->lDisplayRecs = $items_list->lTotalRecs;
	if (!($items->Export <> "" && $items->ExportAll))
		$items_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $items_list->LoadRecordset($items_list->lStartRec-1, $items_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $items->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($items->Export == "" && $items->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(items_list);" style="text-decoration: none;"><img id="items_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="items_list_SearchPanel">
<form name="fitemslistsrch" id="fitemslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="items">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($items->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $items_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($items->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($items->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($items->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$items_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fitemslist" id="fitemslist" class="ewForm" action="" method="post">
<div id="gmp_items" class="ewGridMiddlePanel">
<?php if ($items_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $items->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$items_list->RenderListOptions();

// Render list options (header, left)
$items_list->ListOptions->Render("header", "left");
?>
<?php if ($items->id->Visible) { // id ?>
	<?php if ($items->SortUrl($items->id) == "") { ?>
		<td><?php echo $items->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $items->SortUrl($items->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $items->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($items->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($items->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($items->nombre->Visible) { // nombre ?>
	<?php if ($items->SortUrl($items->nombre) == "") { ?>
		<td><?php echo $items->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $items->SortUrl($items->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $items->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($items->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($items->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($items->icono->Visible) { // icono ?>
	<?php if ($items->SortUrl($items->icono) == "") { ?>
		<td><?php echo $items->icono->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $items->SortUrl($items->icono) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $items->icono->FldCaption() ?></td><td style="width: 10px;"><?php if ($items->icono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($items->icono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$items_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($items->ExportAll && $items->Export <> "") {
	$items_list->lStopRec = $items_list->lTotalRecs;
} else {
	$items_list->lStopRec = $items_list->lStartRec + $items_list->lDisplayRecs - 1; // Set the last record to display
}
$items_list->lRecCount = $items_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $items_list->lStartRec > 1)
		$rs->Move($items_list->lStartRec - 1);
}

// Initialize aggregate
$items->RowType = EW_ROWTYPE_AGGREGATEINIT;
$items_list->RenderRow();
$items_list->lRowCnt = 0;
while (($items->CurrentAction == "gridadd" || !$rs->EOF) &&
	$items_list->lRecCount < $items_list->lStopRec) {
	$items_list->lRecCount++;
	if (intval($items_list->lRecCount) >= intval($items_list->lStartRec)) {
		$items_list->lRowCnt++;

	// Init row class and style
	$items->CssClass = "";
	$items->CssStyle = "";
	$items->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($items->CurrentAction == "gridadd") {
		$items_list->LoadDefaultValues(); // Load default values
	} else {
		$items_list->LoadRowValues($rs); // Load row values
	}
	$items->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$items_list->RenderRow();

	// Render list options
	$items_list->RenderListOptions();
?>
	<tr<?php echo $items->RowAttributes() ?>>
<?php

// Render list options (body, left)
$items_list->ListOptions->Render("body", "left");
?>
	<?php if ($items->id->Visible) { // id ?>
		<td<?php echo $items->id->CellAttributes() ?>>
<div<?php echo $items->id->ViewAttributes() ?>><?php echo $items->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($items->nombre->Visible) { // nombre ?>
		<td<?php echo $items->nombre->CellAttributes() ?>>
<div<?php echo $items->nombre->ViewAttributes() ?>><?php echo $items->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($items->icono->Visible) { // icono ?>
		<td<?php echo $items->icono->CellAttributes() ?>>
<div<?php echo $items->icono->ViewAttributes() ?>><?php echo $items->icono->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$items_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($items->CurrentAction <> "gridadd")
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
<?php if ($items->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($items->CurrentAction <> "gridadd" && $items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($items_list->Pager)) $items_list->Pager = new cPrevNextPager($items_list->lStartRec, $items_list->lDisplayRecs, $items_list->lTotalRecs) ?>
<?php if ($items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $items_list->PageUrl() ?>start=<?php echo $items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $items_list->PageUrl() ?>start=<?php echo $items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $items_list->PageUrl() ?>start=<?php echo $items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $items_list->PageUrl() ?>start=<?php echo $items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($items_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($items_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($items->Export == "" && $items->CurrentAction == "") { ?>
<?php } ?>
<?php if ($items->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$items_list->Page_Terminate();
?>
<?php

//
// Page class
//
class citems_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'items';

	// Page object name
	var $PageObjName = 'items_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $items;
		if ($items->UseTokenInUrl) $PageUrl .= "t=" . $items->TableVar . "&"; // Add page token
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
		global $objForm, $items;
		if ($items->UseTokenInUrl) {
			if ($objForm)
				return ($items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function citems_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (items)
		$GLOBALS["items"] = new citems();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["items"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "itemsdelete.php";
		$this->MultiUpdateUrl = "itemsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'items', TRUE);

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
		global $items;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$items->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$items->Export = $_POST["exporttype"];
		} else {
			$items->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $items->Export; // Get export parameter, used in header
		$gsExportFile = $items->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $items;

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
			$items->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($items->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $items->getRecordsPerPage(); // Restore from Session
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
		$items->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$items->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$items->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $items->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$items->setSessionWhere($sFilter);
		$items->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $items;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $items->nombre, $Keyword);
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
		global $Security, $items;
		$sSearchStr = "";
		$sSearchKeyword = $items->BasicSearchKeyword;
		$sSearchType = $items->BasicSearchType;
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
			$items->setSessionBasicSearchKeyword($sSearchKeyword);
			$items->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $items;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$items->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $items;
		$items->setSessionBasicSearchKeyword("");
		$items->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $items;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$items->BasicSearchKeyword = $items->getSessionBasicSearchKeyword();
			$items->BasicSearchType = $items->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $items;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$items->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$items->CurrentOrderType = @$_GET["ordertype"];
			$items->UpdateSort($items->id); // id
			$items->UpdateSort($items->nombre); // nombre
			$items->UpdateSort($items->icono); // icono
			$items->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $items;
		$sOrderBy = $items->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($items->SqlOrderBy() <> "") {
				$sOrderBy = $items->SqlOrderBy();
				$items->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $items;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$items->setSessionOrderBy($sOrderBy);
				$items->id->setSort("");
				$items->nombre->setSort("");
				$items->icono->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $items;

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
		if ($items->Export <> "" ||
			$items->CurrentAction == "gridadd" ||
			$items->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $items;
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
		global $Security, $Language, $items;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $items;
		$items->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$items->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $items;

		// Call Recordset Selecting event
		$items->Recordset_Selecting($items->CurrentFilter);

		// Load List page SQL
		$sSql = $items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $items;
		$sFilter = $items->KeyFilter();

		// Call Row Selecting event
		$items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$items->CurrentFilter = $sFilter;
		$sSql = $items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $items;
		$items->id->setDbValue($rs->fields('id'));
		$items->nombre->setDbValue($rs->fields('nombre'));
		$items->icono->setDbValue($rs->fields('icono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $items;

		// Initialize URLs
		$this->ViewUrl = $items->ViewUrl();
		$this->EditUrl = $items->EditUrl();
		$this->InlineEditUrl = $items->InlineEditUrl();
		$this->CopyUrl = $items->CopyUrl();
		$this->InlineCopyUrl = $items->InlineCopyUrl();
		$this->DeleteUrl = $items->DeleteUrl();

		// Call Row_Rendering event
		$items->Row_Rendering();

		// Common render codes for all row types
		// id

		$items->id->CellCssStyle = ""; $items->id->CellCssClass = "";
		$items->id->CellAttrs = array(); $items->id->ViewAttrs = array(); $items->id->EditAttrs = array();

		// nombre
		$items->nombre->CellCssStyle = ""; $items->nombre->CellCssClass = "";
		$items->nombre->CellAttrs = array(); $items->nombre->ViewAttrs = array(); $items->nombre->EditAttrs = array();

		// icono
		$items->icono->CellCssStyle = ""; $items->icono->CellCssClass = "";
		$items->icono->CellAttrs = array(); $items->icono->ViewAttrs = array(); $items->icono->EditAttrs = array();
		if ($items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$items->id->ViewValue = $items->id->CurrentValue;
			$items->id->CssStyle = "";
			$items->id->CssClass = "";
			$items->id->ViewCustomAttributes = "";

			// nombre
			$items->nombre->ViewValue = $items->nombre->CurrentValue;
			$items->nombre->CssStyle = "";
			$items->nombre->CssClass = "";
			$items->nombre->ViewCustomAttributes = "";

			// icono
			if (strval($items->icono->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($items->icono->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `iconos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$items->icono->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$items->icono->ViewValue = $items->icono->CurrentValue;
				}
			} else {
				$items->icono->ViewValue = NULL;
			}
			$items->icono->CssStyle = "";
			$items->icono->CssClass = "";
			$items->icono->ViewCustomAttributes = "";

			// id
			$items->id->HrefValue = "";
			$items->id->TooltipValue = "";

			// nombre
			$items->nombre->HrefValue = "";
			$items->nombre->TooltipValue = "";

			// icono
			$items->icono->HrefValue = "";
			$items->icono->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$items->Row_Rendered();
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
