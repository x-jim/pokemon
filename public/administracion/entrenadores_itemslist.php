<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_itemsinfo.php" ?>
<?php include "entrenadoresinfo.php" ?>
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
$entrenadores_items_list = new centrenadores_items_list();
$Page =& $entrenadores_items_list;

// Page init
$entrenadores_items_list->Page_Init();

// Page main
$entrenadores_items_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores_items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_items_list = new ew_Page("entrenadores_items_list");

// page properties
entrenadores_items_list.PageID = "list"; // page ID
entrenadores_items_list.FormID = "fentrenadores_itemslist"; // form ID
var EW_PAGE_ID = entrenadores_items_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_items_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_items_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_items_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($entrenadores_items->Export == "") { ?>
<?php
$gsMasterReturnUrl = "entrenadoreslist.php";
if ($entrenadores_items_list->sDbMasterFilter <> "" && $entrenadores_items->getCurrentMasterTable() == "entrenadores") {
	if ($entrenadores_items_list->bMasterRecordExists) {
		if ($entrenadores_items->getCurrentMasterTable() == $entrenadores_items->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "entrenadoresmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$entrenadores_items_list->lTotalRecs = $entrenadores_items->SelectRecordCount();
	} else {
		if ($rs = $entrenadores_items_list->LoadRecordset())
			$entrenadores_items_list->lTotalRecs = $rs->RecordCount();
	}
	$entrenadores_items_list->lStartRec = 1;
	if ($entrenadores_items_list->lDisplayRecs <= 0 || ($entrenadores_items->Export <> "" && $entrenadores_items->ExportAll)) // Display all records
		$entrenadores_items_list->lDisplayRecs = $entrenadores_items_list->lTotalRecs;
	if (!($entrenadores_items->Export <> "" && $entrenadores_items->ExportAll))
		$entrenadores_items_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $entrenadores_items_list->LoadRecordset($entrenadores_items_list->lStartRec-1, $entrenadores_items_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_items->TableCaption() ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_items_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fentrenadores_itemslist" id="fentrenadores_itemslist" class="ewForm" action="" method="post">
<div id="gmp_entrenadores_items" class="ewGridMiddlePanel">
<?php if ($entrenadores_items_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $entrenadores_items->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$entrenadores_items_list->RenderListOptions();

// Render list options (header, left)
$entrenadores_items_list->ListOptions->Render("header", "left");
?>
<?php if ($entrenadores_items->id->Visible) { // id ?>
	<?php if ($entrenadores_items->SortUrl($entrenadores_items->id) == "") { ?>
		<td><?php echo $entrenadores_items->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_items->SortUrl($entrenadores_items->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_items->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_items->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_items->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_items->item->Visible) { // item ?>
	<?php if ($entrenadores_items->SortUrl($entrenadores_items->item) == "") { ?>
		<td><?php echo $entrenadores_items->item->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_items->SortUrl($entrenadores_items->item) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_items->item->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_items->item->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_items->item->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_items->entrenador->Visible) { // entrenador ?>
	<?php if ($entrenadores_items->SortUrl($entrenadores_items->entrenador) == "") { ?>
		<td><?php echo $entrenadores_items->entrenador->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_items->SortUrl($entrenadores_items->entrenador) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_items->entrenador->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_items->entrenador->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_items->entrenador->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_items->cantidad->Visible) { // cantidad ?>
	<?php if ($entrenadores_items->SortUrl($entrenadores_items->cantidad) == "") { ?>
		<td><?php echo $entrenadores_items->cantidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_items->SortUrl($entrenadores_items->cantidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_items->cantidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_items->cantidad->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_items->cantidad->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$entrenadores_items_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($entrenadores_items->ExportAll && $entrenadores_items->Export <> "") {
	$entrenadores_items_list->lStopRec = $entrenadores_items_list->lTotalRecs;
} else {
	$entrenadores_items_list->lStopRec = $entrenadores_items_list->lStartRec + $entrenadores_items_list->lDisplayRecs - 1; // Set the last record to display
}
$entrenadores_items_list->lRecCount = $entrenadores_items_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $entrenadores_items_list->lStartRec > 1)
		$rs->Move($entrenadores_items_list->lStartRec - 1);
}

// Initialize aggregate
$entrenadores_items->RowType = EW_ROWTYPE_AGGREGATEINIT;
$entrenadores_items_list->RenderRow();
$entrenadores_items_list->lRowCnt = 0;
while (($entrenadores_items->CurrentAction == "gridadd" || !$rs->EOF) &&
	$entrenadores_items_list->lRecCount < $entrenadores_items_list->lStopRec) {
	$entrenadores_items_list->lRecCount++;
	if (intval($entrenadores_items_list->lRecCount) >= intval($entrenadores_items_list->lStartRec)) {
		$entrenadores_items_list->lRowCnt++;

	// Init row class and style
	$entrenadores_items->CssClass = "";
	$entrenadores_items->CssStyle = "";
	$entrenadores_items->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($entrenadores_items->CurrentAction == "gridadd") {
		$entrenadores_items_list->LoadDefaultValues(); // Load default values
	} else {
		$entrenadores_items_list->LoadRowValues($rs); // Load row values
	}
	$entrenadores_items->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$entrenadores_items_list->RenderRow();

	// Render list options
	$entrenadores_items_list->RenderListOptions();
?>
	<tr<?php echo $entrenadores_items->RowAttributes() ?>>
<?php

// Render list options (body, left)
$entrenadores_items_list->ListOptions->Render("body", "left");
?>
	<?php if ($entrenadores_items->id->Visible) { // id ?>
		<td<?php echo $entrenadores_items->id->CellAttributes() ?>>
<div<?php echo $entrenadores_items->id->ViewAttributes() ?>><?php echo $entrenadores_items->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_items->item->Visible) { // item ?>
		<td<?php echo $entrenadores_items->item->CellAttributes() ?>>
<div<?php echo $entrenadores_items->item->ViewAttributes() ?>><?php echo $entrenadores_items->item->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_items->entrenador->Visible) { // entrenador ?>
		<td<?php echo $entrenadores_items->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_items->entrenador->ViewAttributes() ?>><?php echo $entrenadores_items->entrenador->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_items->cantidad->Visible) { // cantidad ?>
		<td<?php echo $entrenadores_items->cantidad->CellAttributes() ?>>
<div<?php echo $entrenadores_items->cantidad->ViewAttributes() ?>><?php echo $entrenadores_items->cantidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$entrenadores_items_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($entrenadores_items->CurrentAction <> "gridadd")
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
<?php if ($entrenadores_items->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($entrenadores_items->CurrentAction <> "gridadd" && $entrenadores_items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($entrenadores_items_list->Pager)) $entrenadores_items_list->Pager = new cPrevNextPager($entrenadores_items_list->lStartRec, $entrenadores_items_list->lDisplayRecs, $entrenadores_items_list->lTotalRecs) ?>
<?php if ($entrenadores_items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($entrenadores_items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_items_list->PageUrl() ?>start=<?php echo $entrenadores_items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($entrenadores_items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_items_list->PageUrl() ?>start=<?php echo $entrenadores_items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $entrenadores_items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($entrenadores_items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_items_list->PageUrl() ?>start=<?php echo $entrenadores_items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($entrenadores_items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_items_list->PageUrl() ?>start=<?php echo $entrenadores_items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $entrenadores_items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $entrenadores_items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $entrenadores_items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $entrenadores_items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($entrenadores_items_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($entrenadores_items_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($entrenadores_items->Export == "" && $entrenadores_items->CurrentAction == "") { ?>
<?php } ?>
<?php if ($entrenadores_items->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_items_list->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_items_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'entrenadores_items';

	// Page object name
	var $PageObjName = 'entrenadores_items_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_items;
		if ($entrenadores_items->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_items->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_items;
		if ($entrenadores_items->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_items_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_items)
		$GLOBALS["entrenadores_items"] = new centrenadores_items();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["entrenadores_items"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "entrenadores_itemsdelete.php";
		$this->MultiUpdateUrl = "entrenadores_itemsupdate.php";

		// Table object (entrenadores)
		$GLOBALS['entrenadores'] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_items', TRUE);

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
		global $entrenadores_items;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$entrenadores_items->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$entrenadores_items->Export = $_POST["exporttype"];
		} else {
			$entrenadores_items->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $entrenadores_items->Export; // Get export parameter, used in header
		$gsExportFile = $entrenadores_items->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $entrenadores_items;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Set up list options
			$this->SetupListOptions();

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($entrenadores_items->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $entrenadores_items->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $entrenadores_items->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $entrenadores_items->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($entrenadores_items->getMasterFilter() <> "" && $entrenadores_items->getCurrentMasterTable() == "entrenadores") {
			global $entrenadores;
			$rsmaster = $entrenadores->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$entrenadores_items->setMasterFilter(""); // Clear master filter
				$entrenadores_items->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($entrenadores_items->getReturnUrl()); // Return to caller
			} else {
				$entrenadores->LoadListRowValues($rsmaster);
				$entrenadores->RowType = EW_ROWTYPE_MASTER; // Master row
				$entrenadores->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$entrenadores_items->setSessionWhere($sFilter);
		$entrenadores_items->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $entrenadores_items;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$entrenadores_items->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$entrenadores_items->CurrentOrderType = @$_GET["ordertype"];
			$entrenadores_items->UpdateSort($entrenadores_items->id); // id
			$entrenadores_items->UpdateSort($entrenadores_items->item); // item
			$entrenadores_items->UpdateSort($entrenadores_items->entrenador); // entrenador
			$entrenadores_items->UpdateSort($entrenadores_items->cantidad); // cantidad
			$entrenadores_items->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $entrenadores_items;
		$sOrderBy = $entrenadores_items->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($entrenadores_items->SqlOrderBy() <> "") {
				$sOrderBy = $entrenadores_items->SqlOrderBy();
				$entrenadores_items->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $entrenadores_items;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$entrenadores_items->getCurrentMasterTable = ""; // Clear master table
				$entrenadores_items->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$entrenadores_items->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$entrenadores_items->entrenador->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$entrenadores_items->setSessionOrderBy($sOrderBy);
				$entrenadores_items->id->setSort("");
				$entrenadores_items->item->setSort("");
				$entrenadores_items->entrenador->setSort("");
				$entrenadores_items->cantidad->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $entrenadores_items;

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
		if ($entrenadores_items->Export <> "" ||
			$entrenadores_items->CurrentAction == "gridadd" ||
			$entrenadores_items->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $entrenadores_items;
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
		global $Security, $Language, $entrenadores_items;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores_items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores_items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores_items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores_items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_items;

		// Call Recordset Selecting event
		$entrenadores_items->Recordset_Selecting($entrenadores_items->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_items;
		$sFilter = $entrenadores_items->KeyFilter();

		// Call Row Selecting event
		$entrenadores_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_items->CurrentFilter = $sFilter;
		$sSql = $entrenadores_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_items;
		$entrenadores_items->id->setDbValue($rs->fields('id'));
		$entrenadores_items->item->setDbValue($rs->fields('item'));
		$entrenadores_items->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_items->cantidad->setDbValue($rs->fields('cantidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_items;

		// Initialize URLs
		$this->ViewUrl = $entrenadores_items->ViewUrl();
		$this->EditUrl = $entrenadores_items->EditUrl();
		$this->InlineEditUrl = $entrenadores_items->InlineEditUrl();
		$this->CopyUrl = $entrenadores_items->CopyUrl();
		$this->InlineCopyUrl = $entrenadores_items->InlineCopyUrl();
		$this->DeleteUrl = $entrenadores_items->DeleteUrl();

		// Call Row_Rendering event
		$entrenadores_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_items->id->CellCssStyle = ""; $entrenadores_items->id->CellCssClass = "";
		$entrenadores_items->id->CellAttrs = array(); $entrenadores_items->id->ViewAttrs = array(); $entrenadores_items->id->EditAttrs = array();

		// item
		$entrenadores_items->item->CellCssStyle = ""; $entrenadores_items->item->CellCssClass = "";
		$entrenadores_items->item->CellAttrs = array(); $entrenadores_items->item->ViewAttrs = array(); $entrenadores_items->item->EditAttrs = array();

		// entrenador
		$entrenadores_items->entrenador->CellCssStyle = ""; $entrenadores_items->entrenador->CellCssClass = "";
		$entrenadores_items->entrenador->CellAttrs = array(); $entrenadores_items->entrenador->ViewAttrs = array(); $entrenadores_items->entrenador->EditAttrs = array();

		// cantidad
		$entrenadores_items->cantidad->CellCssStyle = ""; $entrenadores_items->cantidad->CellCssClass = "";
		$entrenadores_items->cantidad->CellAttrs = array(); $entrenadores_items->cantidad->ViewAttrs = array(); $entrenadores_items->cantidad->EditAttrs = array();
		if ($entrenadores_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_items->id->ViewValue = $entrenadores_items->id->CurrentValue;
			$entrenadores_items->id->CssStyle = "";
			$entrenadores_items->id->CssClass = "";
			$entrenadores_items->id->ViewCustomAttributes = "";

			// item
			if (strval($entrenadores_items->item->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($entrenadores_items->item->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `items`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$entrenadores_items->item->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$entrenadores_items->item->ViewValue = $entrenadores_items->item->CurrentValue;
				}
			} else {
				$entrenadores_items->item->ViewValue = NULL;
			}
			$entrenadores_items->item->CssStyle = "";
			$entrenadores_items->item->CssClass = "";
			$entrenadores_items->item->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_items->entrenador->ViewValue = $entrenadores_items->entrenador->CurrentValue;
			$entrenadores_items->entrenador->CssStyle = "";
			$entrenadores_items->entrenador->CssClass = "";
			$entrenadores_items->entrenador->ViewCustomAttributes = "";

			// cantidad
			$entrenadores_items->cantidad->ViewValue = $entrenadores_items->cantidad->CurrentValue;
			$entrenadores_items->cantidad->CssStyle = "";
			$entrenadores_items->cantidad->CssClass = "";
			$entrenadores_items->cantidad->ViewCustomAttributes = "";

			// id
			$entrenadores_items->id->HrefValue = "";
			$entrenadores_items->id->TooltipValue = "";

			// item
			$entrenadores_items->item->HrefValue = "";
			$entrenadores_items->item->TooltipValue = "";

			// entrenador
			$entrenadores_items->entrenador->HrefValue = "";
			$entrenadores_items->entrenador->TooltipValue = "";

			// cantidad
			$entrenadores_items->cantidad->HrefValue = "";
			$entrenadores_items->cantidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_items->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $entrenadores_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "entrenadores") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $entrenadores_items->SqlMasterFilter_entrenadores();
				$this->sDbDetailFilter = $entrenadores_items->SqlDetailFilter_entrenadores();
				if (@$_GET["id"] <> "") {
					$GLOBALS["entrenadores"]->id->setQueryStringValue($_GET["id"]);
					$entrenadores_items->entrenador->setQueryStringValue($GLOBALS["entrenadores"]->id->QueryStringValue);
					$entrenadores_items->entrenador->setSessionValue($entrenadores_items->entrenador->QueryStringValue);
					if (!is_numeric($GLOBALS["entrenadores"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["entrenadores"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@entrenador@", ew_AdjustSql($GLOBALS["entrenadores"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$entrenadores_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
			$entrenadores_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$entrenadores_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "entrenadores") {
				if ($entrenadores_items->entrenador->QueryStringValue == "") $entrenadores_items->entrenador->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $entrenadores_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $entrenadores_items->getDetailFilter(); // Restore detail filter
		}
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
