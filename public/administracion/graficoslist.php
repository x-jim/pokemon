<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "graficosinfo.php" ?>
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
$graficos_list = new cgraficos_list();
$Page =& $graficos_list;

// Page init
$graficos_list->Page_Init();

// Page main
$graficos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($graficos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var graficos_list = new ew_Page("graficos_list");

// page properties
graficos_list.PageID = "list"; // page ID
graficos_list.FormID = "fgraficoslist"; // form ID
var EW_PAGE_ID = graficos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
graficos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
graficos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
graficos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($graficos->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$graficos_list->lTotalRecs = $graficos->SelectRecordCount();
	} else {
		if ($rs = $graficos_list->LoadRecordset())
			$graficos_list->lTotalRecs = $rs->RecordCount();
	}
	$graficos_list->lStartRec = 1;
	if ($graficos_list->lDisplayRecs <= 0 || ($graficos->Export <> "" && $graficos->ExportAll)) // Display all records
		$graficos_list->lDisplayRecs = $graficos_list->lTotalRecs;
	if (!($graficos->Export <> "" && $graficos->ExportAll))
		$graficos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $graficos_list->LoadRecordset($graficos_list->lStartRec-1, $graficos_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $graficos->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($graficos->Export == "" && $graficos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(graficos_list);" style="text-decoration: none;"><img id="graficos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="graficos_list_SearchPanel">
<form name="fgraficoslistsrch" id="fgraficoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="graficos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($graficos->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $graficos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($graficos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($graficos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($graficos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$graficos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgraficoslist" id="fgraficoslist" class="ewForm" action="" method="post">
<div id="gmp_graficos" class="ewGridMiddlePanel">
<?php if ($graficos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $graficos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$graficos_list->RenderListOptions();

// Render list options (header, left)
$graficos_list->ListOptions->Render("header", "left");
?>
<?php if ($graficos->id->Visible) { // id ?>
	<?php if ($graficos->SortUrl($graficos->id) == "") { ?>
		<td><?php echo $graficos->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $graficos->SortUrl($graficos->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $graficos->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($graficos->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($graficos->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($graficos->grafico->Visible) { // grafico ?>
	<?php if ($graficos->SortUrl($graficos->grafico) == "") { ?>
		<td><?php echo $graficos->grafico->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $graficos->SortUrl($graficos->grafico) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $graficos->grafico->FldCaption() ?></td><td style="width: 10px;"><?php if ($graficos->grafico->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($graficos->grafico->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$graficos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($graficos->ExportAll && $graficos->Export <> "") {
	$graficos_list->lStopRec = $graficos_list->lTotalRecs;
} else {
	$graficos_list->lStopRec = $graficos_list->lStartRec + $graficos_list->lDisplayRecs - 1; // Set the last record to display
}
$graficos_list->lRecCount = $graficos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $graficos_list->lStartRec > 1)
		$rs->Move($graficos_list->lStartRec - 1);
}

// Initialize aggregate
$graficos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$graficos_list->RenderRow();
$graficos_list->lRowCnt = 0;
while (($graficos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$graficos_list->lRecCount < $graficos_list->lStopRec) {
	$graficos_list->lRecCount++;
	if (intval($graficos_list->lRecCount) >= intval($graficos_list->lStartRec)) {
		$graficos_list->lRowCnt++;

	// Init row class and style
	$graficos->CssClass = "";
	$graficos->CssStyle = "";
	$graficos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($graficos->CurrentAction == "gridadd") {
		$graficos_list->LoadDefaultValues(); // Load default values
	} else {
		$graficos_list->LoadRowValues($rs); // Load row values
	}
	$graficos->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$graficos_list->RenderRow();

	// Render list options
	$graficos_list->RenderListOptions();
?>
	<tr<?php echo $graficos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$graficos_list->ListOptions->Render("body", "left");
?>
	<?php if ($graficos->id->Visible) { // id ?>
		<td<?php echo $graficos->id->CellAttributes() ?>>
<div<?php echo $graficos->id->ViewAttributes() ?>><?php echo $graficos->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($graficos->grafico->Visible) { // grafico ?>
		<td<?php echo $graficos->grafico->CellAttributes() ?>>
<?php if ($graficos->grafico->HrefValue <> "" || $graficos->grafico->TooltipValue <> "") { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<a href="<?php echo $graficos->grafico->HrefValue ?>"><?php echo $graficos->grafico->ListViewValue() ?></a>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<?php echo $graficos->grafico->ListViewValue() ?>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$graficos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($graficos->CurrentAction <> "gridadd")
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
<?php if ($graficos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($graficos->CurrentAction <> "gridadd" && $graficos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($graficos_list->Pager)) $graficos_list->Pager = new cPrevNextPager($graficos_list->lStartRec, $graficos_list->lDisplayRecs, $graficos_list->lTotalRecs) ?>
<?php if ($graficos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($graficos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $graficos_list->PageUrl() ?>start=<?php echo $graficos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($graficos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $graficos_list->PageUrl() ?>start=<?php echo $graficos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $graficos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($graficos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $graficos_list->PageUrl() ?>start=<?php echo $graficos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($graficos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $graficos_list->PageUrl() ?>start=<?php echo $graficos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $graficos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $graficos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $graficos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $graficos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($graficos_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($graficos_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $graficos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($graficos->Export == "" && $graficos->CurrentAction == "") { ?>
<?php } ?>
<?php if ($graficos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$graficos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgraficos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'graficos';

	// Page object name
	var $PageObjName = 'graficos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $graficos;
		if ($graficos->UseTokenInUrl) $PageUrl .= "t=" . $graficos->TableVar . "&"; // Add page token
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
		global $objForm, $graficos;
		if ($graficos->UseTokenInUrl) {
			if ($objForm)
				return ($graficos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($graficos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgraficos_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (graficos)
		$GLOBALS["graficos"] = new cgraficos();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["graficos"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "graficosdelete.php";
		$this->MultiUpdateUrl = "graficosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'graficos', TRUE);

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
		global $graficos;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$graficos->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$graficos->Export = $_POST["exporttype"];
		} else {
			$graficos->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $graficos->Export; // Get export parameter, used in header
		$gsExportFile = $graficos->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $graficos;

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
			$graficos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($graficos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $graficos->getRecordsPerPage(); // Restore from Session
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
		$graficos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$graficos->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$graficos->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $graficos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$graficos->setSessionWhere($sFilter);
		$graficos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $graficos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $graficos->grafico, $Keyword);
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
		global $Security, $graficos;
		$sSearchStr = "";
		$sSearchKeyword = $graficos->BasicSearchKeyword;
		$sSearchType = $graficos->BasicSearchType;
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
			$graficos->setSessionBasicSearchKeyword($sSearchKeyword);
			$graficos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $graficos;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$graficos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $graficos;
		$graficos->setSessionBasicSearchKeyword("");
		$graficos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $graficos;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$graficos->BasicSearchKeyword = $graficos->getSessionBasicSearchKeyword();
			$graficos->BasicSearchType = $graficos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $graficos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$graficos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$graficos->CurrentOrderType = @$_GET["ordertype"];
			$graficos->UpdateSort($graficos->id); // id
			$graficos->UpdateSort($graficos->grafico); // grafico
			$graficos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $graficos;
		$sOrderBy = $graficos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($graficos->SqlOrderBy() <> "") {
				$sOrderBy = $graficos->SqlOrderBy();
				$graficos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $graficos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$graficos->setSessionOrderBy($sOrderBy);
				$graficos->id->setSort("");
				$graficos->grafico->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$graficos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $graficos;

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
		if ($graficos->Export <> "" ||
			$graficos->CurrentAction == "gridadd" ||
			$graficos->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $graficos;
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
		global $Security, $Language, $graficos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $graficos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$graficos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$graficos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $graficos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$graficos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$graficos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$graficos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $graficos;
		$graficos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$graficos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $graficos;

		// Call Recordset Selecting event
		$graficos->Recordset_Selecting($graficos->CurrentFilter);

		// Load List page SQL
		$sSql = $graficos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$graficos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $graficos;
		$sFilter = $graficos->KeyFilter();

		// Call Row Selecting event
		$graficos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$graficos->CurrentFilter = $sFilter;
		$sSql = $graficos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$graficos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $graficos;
		$graficos->id->setDbValue($rs->fields('id'));
		$graficos->grafico->Upload->DbValue = $rs->fields('grafico');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $graficos;

		// Initialize URLs
		$this->ViewUrl = $graficos->ViewUrl();
		$this->EditUrl = $graficos->EditUrl();
		$this->InlineEditUrl = $graficos->InlineEditUrl();
		$this->CopyUrl = $graficos->CopyUrl();
		$this->InlineCopyUrl = $graficos->InlineCopyUrl();
		$this->DeleteUrl = $graficos->DeleteUrl();

		// Call Row_Rendering event
		$graficos->Row_Rendering();

		// Common render codes for all row types
		// id

		$graficos->id->CellCssStyle = ""; $graficos->id->CellCssClass = "";
		$graficos->id->CellAttrs = array(); $graficos->id->ViewAttrs = array(); $graficos->id->EditAttrs = array();

		// grafico
		$graficos->grafico->CellCssStyle = ""; $graficos->grafico->CellCssClass = "";
		$graficos->grafico->CellAttrs = array(); $graficos->grafico->ViewAttrs = array(); $graficos->grafico->EditAttrs = array();
		if ($graficos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$graficos->id->ViewValue = $graficos->id->CurrentValue;
			$graficos->id->CssStyle = "";
			$graficos->id->CssClass = "";
			$graficos->id->ViewCustomAttributes = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->ViewValue = $graficos->grafico->Upload->DbValue;
			} else {
				$graficos->grafico->ViewValue = "";
			}
			$graficos->grafico->CssStyle = "";
			$graficos->grafico->CssClass = "";
			$graficos->grafico->ViewCustomAttributes = "";

			// id
			$graficos->id->HrefValue = "";
			$graficos->id->TooltipValue = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->HrefValue = ew_UploadPathEx(FALSE, $graficos->grafico->UploadPath) . ((!empty($graficos->grafico->ViewValue)) ? $graficos->grafico->ViewValue : $graficos->grafico->CurrentValue);
				if ($graficos->Export <> "") $graficos->grafico->HrefValue = ew_ConvertFullUrl($graficos->grafico->HrefValue);
			} else {
				$graficos->grafico->HrefValue = "";
			}
			$graficos->grafico->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($graficos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$graficos->Row_Rendered();
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
