<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "pokemons_evolucionesinfo.php" ?>
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
$pokemons_evoluciones_list = new cpokemons_evoluciones_list();
$Page =& $pokemons_evoluciones_list;

// Page init
$pokemons_evoluciones_list->Page_Init();

// Page main
$pokemons_evoluciones_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pokemons_evoluciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_evoluciones_list = new ew_Page("pokemons_evoluciones_list");

// page properties
pokemons_evoluciones_list.PageID = "list"; // page ID
pokemons_evoluciones_list.FormID = "fpokemons_evolucioneslist"; // form ID
var EW_PAGE_ID = pokemons_evoluciones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_evoluciones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_evoluciones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_evoluciones_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($pokemons_evoluciones->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pokemons_evoluciones_list->lTotalRecs = $pokemons_evoluciones->SelectRecordCount();
	} else {
		if ($rs = $pokemons_evoluciones_list->LoadRecordset())
			$pokemons_evoluciones_list->lTotalRecs = $rs->RecordCount();
	}
	$pokemons_evoluciones_list->lStartRec = 1;
	if ($pokemons_evoluciones_list->lDisplayRecs <= 0 || ($pokemons_evoluciones->Export <> "" && $pokemons_evoluciones->ExportAll)) // Display all records
		$pokemons_evoluciones_list->lDisplayRecs = $pokemons_evoluciones_list->lTotalRecs;
	if (!($pokemons_evoluciones->Export <> "" && $pokemons_evoluciones->ExportAll))
		$pokemons_evoluciones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $pokemons_evoluciones_list->LoadRecordset($pokemons_evoluciones_list->lStartRec-1, $pokemons_evoluciones_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons_evoluciones->TableCaption() ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_evoluciones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpokemons_evolucioneslist" id="fpokemons_evolucioneslist" class="ewForm" action="" method="post">
<div id="gmp_pokemons_evoluciones" class="ewGridMiddlePanel">
<?php if ($pokemons_evoluciones_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pokemons_evoluciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pokemons_evoluciones_list->RenderListOptions();

// Render list options (header, left)
$pokemons_evoluciones_list->ListOptions->Render("header", "left");
?>
<?php if ($pokemons_evoluciones->de->Visible) { // de ?>
	<?php if ($pokemons_evoluciones->SortUrl($pokemons_evoluciones->de) == "") { ?>
		<td><?php echo $pokemons_evoluciones->de->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons_evoluciones->SortUrl($pokemons_evoluciones->de) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons_evoluciones->de->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons_evoluciones->de->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons_evoluciones->de->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons_evoluciones->a->Visible) { // a ?>
	<?php if ($pokemons_evoluciones->SortUrl($pokemons_evoluciones->a) == "") { ?>
		<td><?php echo $pokemons_evoluciones->a->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons_evoluciones->SortUrl($pokemons_evoluciones->a) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons_evoluciones->a->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons_evoluciones->a->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons_evoluciones->a->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons_evoluciones->nivel->Visible) { // nivel ?>
	<?php if ($pokemons_evoluciones->SortUrl($pokemons_evoluciones->nivel) == "") { ?>
		<td><?php echo $pokemons_evoluciones->nivel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons_evoluciones->SortUrl($pokemons_evoluciones->nivel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons_evoluciones->nivel->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons_evoluciones->nivel->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons_evoluciones->nivel->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pokemons_evoluciones->item->Visible) { // item ?>
	<?php if ($pokemons_evoluciones->SortUrl($pokemons_evoluciones->item) == "") { ?>
		<td><?php echo $pokemons_evoluciones->item->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pokemons_evoluciones->SortUrl($pokemons_evoluciones->item) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pokemons_evoluciones->item->FldCaption() ?></td><td style="width: 10px;"><?php if ($pokemons_evoluciones->item->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pokemons_evoluciones->item->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pokemons_evoluciones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pokemons_evoluciones->ExportAll && $pokemons_evoluciones->Export <> "") {
	$pokemons_evoluciones_list->lStopRec = $pokemons_evoluciones_list->lTotalRecs;
} else {
	$pokemons_evoluciones_list->lStopRec = $pokemons_evoluciones_list->lStartRec + $pokemons_evoluciones_list->lDisplayRecs - 1; // Set the last record to display
}
$pokemons_evoluciones_list->lRecCount = $pokemons_evoluciones_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $pokemons_evoluciones_list->lStartRec > 1)
		$rs->Move($pokemons_evoluciones_list->lStartRec - 1);
}

// Initialize aggregate
$pokemons_evoluciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pokemons_evoluciones_list->RenderRow();
$pokemons_evoluciones_list->lRowCnt = 0;
while (($pokemons_evoluciones->CurrentAction == "gridadd" || !$rs->EOF) &&
	$pokemons_evoluciones_list->lRecCount < $pokemons_evoluciones_list->lStopRec) {
	$pokemons_evoluciones_list->lRecCount++;
	if (intval($pokemons_evoluciones_list->lRecCount) >= intval($pokemons_evoluciones_list->lStartRec)) {
		$pokemons_evoluciones_list->lRowCnt++;

	// Init row class and style
	$pokemons_evoluciones->CssClass = "";
	$pokemons_evoluciones->CssStyle = "";
	$pokemons_evoluciones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($pokemons_evoluciones->CurrentAction == "gridadd") {
		$pokemons_evoluciones_list->LoadDefaultValues(); // Load default values
	} else {
		$pokemons_evoluciones_list->LoadRowValues($rs); // Load row values
	}
	$pokemons_evoluciones->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$pokemons_evoluciones_list->RenderRow();

	// Render list options
	$pokemons_evoluciones_list->RenderListOptions();
?>
	<tr<?php echo $pokemons_evoluciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pokemons_evoluciones_list->ListOptions->Render("body", "left");
?>
	<?php if ($pokemons_evoluciones->de->Visible) { // de ?>
		<td<?php echo $pokemons_evoluciones->de->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->de->ViewAttributes() ?>><?php echo $pokemons_evoluciones->de->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons_evoluciones->a->Visible) { // a ?>
		<td<?php echo $pokemons_evoluciones->a->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->a->ViewAttributes() ?>><?php echo $pokemons_evoluciones->a->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons_evoluciones->nivel->Visible) { // nivel ?>
		<td<?php echo $pokemons_evoluciones->nivel->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->nivel->ViewAttributes() ?>><?php echo $pokemons_evoluciones->nivel->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pokemons_evoluciones->item->Visible) { // item ?>
		<td<?php echo $pokemons_evoluciones->item->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->item->ViewAttributes() ?>><?php echo $pokemons_evoluciones->item->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pokemons_evoluciones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pokemons_evoluciones->CurrentAction <> "gridadd")
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
<?php if ($pokemons_evoluciones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($pokemons_evoluciones->CurrentAction <> "gridadd" && $pokemons_evoluciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($pokemons_evoluciones_list->Pager)) $pokemons_evoluciones_list->Pager = new cPrevNextPager($pokemons_evoluciones_list->lStartRec, $pokemons_evoluciones_list->lDisplayRecs, $pokemons_evoluciones_list->lTotalRecs) ?>
<?php if ($pokemons_evoluciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($pokemons_evoluciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_evoluciones_list->PageUrl() ?>start=<?php echo $pokemons_evoluciones_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($pokemons_evoluciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_evoluciones_list->PageUrl() ?>start=<?php echo $pokemons_evoluciones_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pokemons_evoluciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($pokemons_evoluciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_evoluciones_list->PageUrl() ?>start=<?php echo $pokemons_evoluciones_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($pokemons_evoluciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $pokemons_evoluciones_list->PageUrl() ?>start=<?php echo $pokemons_evoluciones_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pokemons_evoluciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pokemons_evoluciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pokemons_evoluciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pokemons_evoluciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($pokemons_evoluciones_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($pokemons_evoluciones_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_evoluciones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($pokemons_evoluciones->Export == "" && $pokemons_evoluciones->CurrentAction == "") { ?>
<?php } ?>
<?php if ($pokemons_evoluciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$pokemons_evoluciones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_evoluciones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pokemons_evoluciones';

	// Page object name
	var $PageObjName = 'pokemons_evoluciones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokemons_evoluciones;
		if ($pokemons_evoluciones->UseTokenInUrl) $PageUrl .= "t=" . $pokemons_evoluciones->TableVar . "&"; // Add page token
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
		global $objForm, $pokemons_evoluciones;
		if ($pokemons_evoluciones->UseTokenInUrl) {
			if ($objForm)
				return ($pokemons_evoluciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokemons_evoluciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokemons_evoluciones_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons_evoluciones)
		$GLOBALS["pokemons_evoluciones"] = new cpokemons_evoluciones();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["pokemons_evoluciones"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pokemons_evolucionesdelete.php";
		$this->MultiUpdateUrl = "pokemons_evolucionesupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons_evoluciones', TRUE);

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
		global $pokemons_evoluciones;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$pokemons_evoluciones->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$pokemons_evoluciones->Export = $_POST["exporttype"];
		} else {
			$pokemons_evoluciones->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $pokemons_evoluciones->Export; // Get export parameter, used in header
		$gsExportFile = $pokemons_evoluciones->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $pokemons_evoluciones;

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
		if ($pokemons_evoluciones->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $pokemons_evoluciones->getRecordsPerPage(); // Restore from Session
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
		$pokemons_evoluciones->setSessionWhere($sFilter);
		$pokemons_evoluciones->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pokemons_evoluciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pokemons_evoluciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pokemons_evoluciones->CurrentOrderType = @$_GET["ordertype"];
			$pokemons_evoluciones->UpdateSort($pokemons_evoluciones->de); // de
			$pokemons_evoluciones->UpdateSort($pokemons_evoluciones->a); // a
			$pokemons_evoluciones->UpdateSort($pokemons_evoluciones->nivel); // nivel
			$pokemons_evoluciones->UpdateSort($pokemons_evoluciones->item); // item
			$pokemons_evoluciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pokemons_evoluciones;
		$sOrderBy = $pokemons_evoluciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pokemons_evoluciones->SqlOrderBy() <> "") {
				$sOrderBy = $pokemons_evoluciones->SqlOrderBy();
				$pokemons_evoluciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pokemons_evoluciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pokemons_evoluciones->setSessionOrderBy($sOrderBy);
				$pokemons_evoluciones->de->setSort("");
				$pokemons_evoluciones->a->setSort("");
				$pokemons_evoluciones->nivel->setSort("");
				$pokemons_evoluciones->item->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $pokemons_evoluciones;

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
		if ($pokemons_evoluciones->Export <> "" ||
			$pokemons_evoluciones->CurrentAction == "gridadd" ||
			$pokemons_evoluciones->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pokemons_evoluciones;
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
		global $Security, $Language, $pokemons_evoluciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pokemons_evoluciones;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $pokemons_evoluciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$pokemons_evoluciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pokemons_evoluciones;

		// Call Recordset Selecting event
		$pokemons_evoluciones->Recordset_Selecting($pokemons_evoluciones->CurrentFilter);

		// Load List page SQL
		$sSql = $pokemons_evoluciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pokemons_evoluciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokemons_evoluciones;
		$sFilter = $pokemons_evoluciones->KeyFilter();

		// Call Row Selecting event
		$pokemons_evoluciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokemons_evoluciones->CurrentFilter = $sFilter;
		$sSql = $pokemons_evoluciones->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pokemons_evoluciones->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pokemons_evoluciones;
		$pokemons_evoluciones->de->setDbValue($rs->fields('de'));
		$pokemons_evoluciones->a->setDbValue($rs->fields('a'));
		$pokemons_evoluciones->nivel->setDbValue($rs->fields('nivel'));
		$pokemons_evoluciones->item->setDbValue($rs->fields('item'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons_evoluciones;

		// Initialize URLs
		$this->ViewUrl = $pokemons_evoluciones->ViewUrl();
		$this->EditUrl = $pokemons_evoluciones->EditUrl();
		$this->InlineEditUrl = $pokemons_evoluciones->InlineEditUrl();
		$this->CopyUrl = $pokemons_evoluciones->CopyUrl();
		$this->InlineCopyUrl = $pokemons_evoluciones->InlineCopyUrl();
		$this->DeleteUrl = $pokemons_evoluciones->DeleteUrl();

		// Call Row_Rendering event
		$pokemons_evoluciones->Row_Rendering();

		// Common render codes for all row types
		// de

		$pokemons_evoluciones->de->CellCssStyle = ""; $pokemons_evoluciones->de->CellCssClass = "";
		$pokemons_evoluciones->de->CellAttrs = array(); $pokemons_evoluciones->de->ViewAttrs = array(); $pokemons_evoluciones->de->EditAttrs = array();

		// a
		$pokemons_evoluciones->a->CellCssStyle = ""; $pokemons_evoluciones->a->CellCssClass = "";
		$pokemons_evoluciones->a->CellAttrs = array(); $pokemons_evoluciones->a->ViewAttrs = array(); $pokemons_evoluciones->a->EditAttrs = array();

		// nivel
		$pokemons_evoluciones->nivel->CellCssStyle = ""; $pokemons_evoluciones->nivel->CellCssClass = "";
		$pokemons_evoluciones->nivel->CellAttrs = array(); $pokemons_evoluciones->nivel->ViewAttrs = array(); $pokemons_evoluciones->nivel->EditAttrs = array();

		// item
		$pokemons_evoluciones->item->CellCssStyle = ""; $pokemons_evoluciones->item->CellCssClass = "";
		$pokemons_evoluciones->item->CellAttrs = array(); $pokemons_evoluciones->item->ViewAttrs = array(); $pokemons_evoluciones->item->EditAttrs = array();
		if ($pokemons_evoluciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// de
			$pokemons_evoluciones->de->ViewValue = $pokemons_evoluciones->de->CurrentValue;
			$pokemons_evoluciones->de->CssStyle = "";
			$pokemons_evoluciones->de->CssClass = "";
			$pokemons_evoluciones->de->ViewCustomAttributes = "";

			// a
			$pokemons_evoluciones->a->ViewValue = $pokemons_evoluciones->a->CurrentValue;
			$pokemons_evoluciones->a->CssStyle = "";
			$pokemons_evoluciones->a->CssClass = "";
			$pokemons_evoluciones->a->ViewCustomAttributes = "";

			// nivel
			$pokemons_evoluciones->nivel->ViewValue = $pokemons_evoluciones->nivel->CurrentValue;
			$pokemons_evoluciones->nivel->CssStyle = "";
			$pokemons_evoluciones->nivel->CssClass = "";
			$pokemons_evoluciones->nivel->ViewCustomAttributes = "";

			// item
			$pokemons_evoluciones->item->ViewValue = $pokemons_evoluciones->item->CurrentValue;
			$pokemons_evoluciones->item->CssStyle = "";
			$pokemons_evoluciones->item->CssClass = "";
			$pokemons_evoluciones->item->ViewCustomAttributes = "";

			// de
			$pokemons_evoluciones->de->HrefValue = "";
			$pokemons_evoluciones->de->TooltipValue = "";

			// a
			$pokemons_evoluciones->a->HrefValue = "";
			$pokemons_evoluciones->a->TooltipValue = "";

			// nivel
			$pokemons_evoluciones->nivel->HrefValue = "";
			$pokemons_evoluciones->nivel->TooltipValue = "";

			// item
			$pokemons_evoluciones->item->HrefValue = "";
			$pokemons_evoluciones->item->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokemons_evoluciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons_evoluciones->Row_Rendered();
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
