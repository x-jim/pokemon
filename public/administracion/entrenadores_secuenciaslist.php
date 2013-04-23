<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_secuenciasinfo.php" ?>
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
$entrenadores_secuencias_list = new centrenadores_secuencias_list();
$Page =& $entrenadores_secuencias_list;

// Page init
$entrenadores_secuencias_list->Page_Init();

// Page main
$entrenadores_secuencias_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores_secuencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_secuencias_list = new ew_Page("entrenadores_secuencias_list");

// page properties
entrenadores_secuencias_list.PageID = "list"; // page ID
entrenadores_secuencias_list.FormID = "fentrenadores_secuenciaslist"; // form ID
var EW_PAGE_ID = entrenadores_secuencias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_secuencias_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_secuencias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_secuencias_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($entrenadores_secuencias->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$entrenadores_secuencias_list->lTotalRecs = $entrenadores_secuencias->SelectRecordCount();
	} else {
		if ($rs = $entrenadores_secuencias_list->LoadRecordset())
			$entrenadores_secuencias_list->lTotalRecs = $rs->RecordCount();
	}
	$entrenadores_secuencias_list->lStartRec = 1;
	if ($entrenadores_secuencias_list->lDisplayRecs <= 0 || ($entrenadores_secuencias->Export <> "" && $entrenadores_secuencias->ExportAll)) // Display all records
		$entrenadores_secuencias_list->lDisplayRecs = $entrenadores_secuencias_list->lTotalRecs;
	if (!($entrenadores_secuencias->Export <> "" && $entrenadores_secuencias->ExportAll))
		$entrenadores_secuencias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $entrenadores_secuencias_list->LoadRecordset($entrenadores_secuencias_list->lStartRec-1, $entrenadores_secuencias_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_secuencias->TableCaption() ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_secuencias_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fentrenadores_secuenciaslist" id="fentrenadores_secuenciaslist" class="ewForm" action="" method="post">
<div id="gmp_entrenadores_secuencias" class="ewGridMiddlePanel">
<?php if ($entrenadores_secuencias_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $entrenadores_secuencias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$entrenadores_secuencias_list->RenderListOptions();

// Render list options (header, left)
$entrenadores_secuencias_list->ListOptions->Render("header", "left");
?>
<?php if ($entrenadores_secuencias->id->Visible) { // id ?>
	<?php if ($entrenadores_secuencias->SortUrl($entrenadores_secuencias->id) == "") { ?>
		<td><?php echo $entrenadores_secuencias->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_secuencias->SortUrl($entrenadores_secuencias->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_secuencias->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_secuencias->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_secuencias->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_secuencias->entrenador->Visible) { // entrenador ?>
	<?php if ($entrenadores_secuencias->SortUrl($entrenadores_secuencias->entrenador) == "") { ?>
		<td><?php echo $entrenadores_secuencias->entrenador->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_secuencias->SortUrl($entrenadores_secuencias->entrenador) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_secuencias->entrenador->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_secuencias->entrenador->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_secuencias->entrenador->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_secuencias->secuencia->Visible) { // secuencia ?>
	<?php if ($entrenadores_secuencias->SortUrl($entrenadores_secuencias->secuencia) == "") { ?>
		<td><?php echo $entrenadores_secuencias->secuencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_secuencias->SortUrl($entrenadores_secuencias->secuencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_secuencias->secuencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_secuencias->secuencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_secuencias->secuencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_secuencias->escena->Visible) { // escena ?>
	<?php if ($entrenadores_secuencias->SortUrl($entrenadores_secuencias->escena) == "") { ?>
		<td><?php echo $entrenadores_secuencias->escena->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_secuencias->SortUrl($entrenadores_secuencias->escena) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_secuencias->escena->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_secuencias->escena->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_secuencias->escena->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores_secuencias->fecha->Visible) { // fecha ?>
	<?php if ($entrenadores_secuencias->SortUrl($entrenadores_secuencias->fecha) == "") { ?>
		<td><?php echo $entrenadores_secuencias->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores_secuencias->SortUrl($entrenadores_secuencias->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores_secuencias->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores_secuencias->fecha->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores_secuencias->fecha->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$entrenadores_secuencias_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($entrenadores_secuencias->ExportAll && $entrenadores_secuencias->Export <> "") {
	$entrenadores_secuencias_list->lStopRec = $entrenadores_secuencias_list->lTotalRecs;
} else {
	$entrenadores_secuencias_list->lStopRec = $entrenadores_secuencias_list->lStartRec + $entrenadores_secuencias_list->lDisplayRecs - 1; // Set the last record to display
}
$entrenadores_secuencias_list->lRecCount = $entrenadores_secuencias_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $entrenadores_secuencias_list->lStartRec > 1)
		$rs->Move($entrenadores_secuencias_list->lStartRec - 1);
}

// Initialize aggregate
$entrenadores_secuencias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$entrenadores_secuencias_list->RenderRow();
$entrenadores_secuencias_list->lRowCnt = 0;
while (($entrenadores_secuencias->CurrentAction == "gridadd" || !$rs->EOF) &&
	$entrenadores_secuencias_list->lRecCount < $entrenadores_secuencias_list->lStopRec) {
	$entrenadores_secuencias_list->lRecCount++;
	if (intval($entrenadores_secuencias_list->lRecCount) >= intval($entrenadores_secuencias_list->lStartRec)) {
		$entrenadores_secuencias_list->lRowCnt++;

	// Init row class and style
	$entrenadores_secuencias->CssClass = "";
	$entrenadores_secuencias->CssStyle = "";
	$entrenadores_secuencias->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($entrenadores_secuencias->CurrentAction == "gridadd") {
		$entrenadores_secuencias_list->LoadDefaultValues(); // Load default values
	} else {
		$entrenadores_secuencias_list->LoadRowValues($rs); // Load row values
	}
	$entrenadores_secuencias->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$entrenadores_secuencias_list->RenderRow();

	// Render list options
	$entrenadores_secuencias_list->RenderListOptions();
?>
	<tr<?php echo $entrenadores_secuencias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$entrenadores_secuencias_list->ListOptions->Render("body", "left");
?>
	<?php if ($entrenadores_secuencias->id->Visible) { // id ?>
		<td<?php echo $entrenadores_secuencias->id->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->id->ViewAttributes() ?>><?php echo $entrenadores_secuencias->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_secuencias->entrenador->Visible) { // entrenador ?>
		<td<?php echo $entrenadores_secuencias->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->entrenador->ViewAttributes() ?>><?php echo $entrenadores_secuencias->entrenador->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_secuencias->secuencia->Visible) { // secuencia ?>
		<td<?php echo $entrenadores_secuencias->secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->secuencia->ViewAttributes() ?>><?php echo $entrenadores_secuencias->secuencia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_secuencias->escena->Visible) { // escena ?>
		<td<?php echo $entrenadores_secuencias->escena->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->escena->ViewAttributes() ?>><?php echo $entrenadores_secuencias->escena->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores_secuencias->fecha->Visible) { // fecha ?>
		<td<?php echo $entrenadores_secuencias->fecha->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->fecha->ViewAttributes() ?>><?php echo $entrenadores_secuencias->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$entrenadores_secuencias_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($entrenadores_secuencias->CurrentAction <> "gridadd")
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
<?php if ($entrenadores_secuencias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($entrenadores_secuencias->CurrentAction <> "gridadd" && $entrenadores_secuencias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($entrenadores_secuencias_list->Pager)) $entrenadores_secuencias_list->Pager = new cPrevNextPager($entrenadores_secuencias_list->lStartRec, $entrenadores_secuencias_list->lDisplayRecs, $entrenadores_secuencias_list->lTotalRecs) ?>
<?php if ($entrenadores_secuencias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($entrenadores_secuencias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_secuencias_list->PageUrl() ?>start=<?php echo $entrenadores_secuencias_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($entrenadores_secuencias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_secuencias_list->PageUrl() ?>start=<?php echo $entrenadores_secuencias_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $entrenadores_secuencias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($entrenadores_secuencias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_secuencias_list->PageUrl() ?>start=<?php echo $entrenadores_secuencias_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($entrenadores_secuencias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_secuencias_list->PageUrl() ?>start=<?php echo $entrenadores_secuencias_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $entrenadores_secuencias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $entrenadores_secuencias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $entrenadores_secuencias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $entrenadores_secuencias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($entrenadores_secuencias_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($entrenadores_secuencias_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_secuencias_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($entrenadores_secuencias->Export == "" && $entrenadores_secuencias->CurrentAction == "") { ?>
<?php } ?>
<?php if ($entrenadores_secuencias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_secuencias_list->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_secuencias_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'entrenadores_secuencias';

	// Page object name
	var $PageObjName = 'entrenadores_secuencias_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_secuencias;
		if ($entrenadores_secuencias->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_secuencias->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_secuencias;
		if ($entrenadores_secuencias->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_secuencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_secuencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_secuencias_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_secuencias)
		$GLOBALS["entrenadores_secuencias"] = new centrenadores_secuencias();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["entrenadores_secuencias"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "entrenadores_secuenciasdelete.php";
		$this->MultiUpdateUrl = "entrenadores_secuenciasupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_secuencias', TRUE);

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
		global $entrenadores_secuencias;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$entrenadores_secuencias->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$entrenadores_secuencias->Export = $_POST["exporttype"];
		} else {
			$entrenadores_secuencias->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $entrenadores_secuencias->Export; // Get export parameter, used in header
		$gsExportFile = $entrenadores_secuencias->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $entrenadores_secuencias;

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
		if ($entrenadores_secuencias->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $entrenadores_secuencias->getRecordsPerPage(); // Restore from Session
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
		$entrenadores_secuencias->setSessionWhere($sFilter);
		$entrenadores_secuencias->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $entrenadores_secuencias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$entrenadores_secuencias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$entrenadores_secuencias->CurrentOrderType = @$_GET["ordertype"];
			$entrenadores_secuencias->UpdateSort($entrenadores_secuencias->id); // id
			$entrenadores_secuencias->UpdateSort($entrenadores_secuencias->entrenador); // entrenador
			$entrenadores_secuencias->UpdateSort($entrenadores_secuencias->secuencia); // secuencia
			$entrenadores_secuencias->UpdateSort($entrenadores_secuencias->escena); // escena
			$entrenadores_secuencias->UpdateSort($entrenadores_secuencias->fecha); // fecha
			$entrenadores_secuencias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $entrenadores_secuencias;
		$sOrderBy = $entrenadores_secuencias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($entrenadores_secuencias->SqlOrderBy() <> "") {
				$sOrderBy = $entrenadores_secuencias->SqlOrderBy();
				$entrenadores_secuencias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $entrenadores_secuencias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$entrenadores_secuencias->setSessionOrderBy($sOrderBy);
				$entrenadores_secuencias->id->setSort("");
				$entrenadores_secuencias->entrenador->setSort("");
				$entrenadores_secuencias->secuencia->setSort("");
				$entrenadores_secuencias->escena->setSort("");
				$entrenadores_secuencias->fecha->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $entrenadores_secuencias;

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
		if ($entrenadores_secuencias->Export <> "" ||
			$entrenadores_secuencias->CurrentAction == "gridadd" ||
			$entrenadores_secuencias->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $entrenadores_secuencias;
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
		global $Security, $Language, $entrenadores_secuencias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores_secuencias;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores_secuencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores_secuencias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_secuencias;

		// Call Recordset Selecting event
		$entrenadores_secuencias->Recordset_Selecting($entrenadores_secuencias->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_secuencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_secuencias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_secuencias;
		$sFilter = $entrenadores_secuencias->KeyFilter();

		// Call Row Selecting event
		$entrenadores_secuencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_secuencias->CurrentFilter = $sFilter;
		$sSql = $entrenadores_secuencias->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_secuencias->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_secuencias;
		$entrenadores_secuencias->id->setDbValue($rs->fields('id'));
		$entrenadores_secuencias->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_secuencias->secuencia->setDbValue($rs->fields('secuencia'));
		$entrenadores_secuencias->escena->setDbValue($rs->fields('escena'));
		$entrenadores_secuencias->fecha->setDbValue($rs->fields('fecha'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_secuencias;

		// Initialize URLs
		$this->ViewUrl = $entrenadores_secuencias->ViewUrl();
		$this->EditUrl = $entrenadores_secuencias->EditUrl();
		$this->InlineEditUrl = $entrenadores_secuencias->InlineEditUrl();
		$this->CopyUrl = $entrenadores_secuencias->CopyUrl();
		$this->InlineCopyUrl = $entrenadores_secuencias->InlineCopyUrl();
		$this->DeleteUrl = $entrenadores_secuencias->DeleteUrl();

		// Call Row_Rendering event
		$entrenadores_secuencias->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_secuencias->id->CellCssStyle = ""; $entrenadores_secuencias->id->CellCssClass = "";
		$entrenadores_secuencias->id->CellAttrs = array(); $entrenadores_secuencias->id->ViewAttrs = array(); $entrenadores_secuencias->id->EditAttrs = array();

		// entrenador
		$entrenadores_secuencias->entrenador->CellCssStyle = ""; $entrenadores_secuencias->entrenador->CellCssClass = "";
		$entrenadores_secuencias->entrenador->CellAttrs = array(); $entrenadores_secuencias->entrenador->ViewAttrs = array(); $entrenadores_secuencias->entrenador->EditAttrs = array();

		// secuencia
		$entrenadores_secuencias->secuencia->CellCssStyle = ""; $entrenadores_secuencias->secuencia->CellCssClass = "";
		$entrenadores_secuencias->secuencia->CellAttrs = array(); $entrenadores_secuencias->secuencia->ViewAttrs = array(); $entrenadores_secuencias->secuencia->EditAttrs = array();

		// escena
		$entrenadores_secuencias->escena->CellCssStyle = ""; $entrenadores_secuencias->escena->CellCssClass = "";
		$entrenadores_secuencias->escena->CellAttrs = array(); $entrenadores_secuencias->escena->ViewAttrs = array(); $entrenadores_secuencias->escena->EditAttrs = array();

		// fecha
		$entrenadores_secuencias->fecha->CellCssStyle = ""; $entrenadores_secuencias->fecha->CellCssClass = "";
		$entrenadores_secuencias->fecha->CellAttrs = array(); $entrenadores_secuencias->fecha->ViewAttrs = array(); $entrenadores_secuencias->fecha->EditAttrs = array();
		if ($entrenadores_secuencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_secuencias->id->ViewValue = $entrenadores_secuencias->id->CurrentValue;
			$entrenadores_secuencias->id->CssStyle = "";
			$entrenadores_secuencias->id->CssClass = "";
			$entrenadores_secuencias->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_secuencias->entrenador->ViewValue = $entrenadores_secuencias->entrenador->CurrentValue;
			$entrenadores_secuencias->entrenador->CssStyle = "";
			$entrenadores_secuencias->entrenador->CssClass = "";
			$entrenadores_secuencias->entrenador->ViewCustomAttributes = "";

			// secuencia
			$entrenadores_secuencias->secuencia->ViewValue = $entrenadores_secuencias->secuencia->CurrentValue;
			$entrenadores_secuencias->secuencia->CssStyle = "";
			$entrenadores_secuencias->secuencia->CssClass = "";
			$entrenadores_secuencias->secuencia->ViewCustomAttributes = "";

			// escena
			$entrenadores_secuencias->escena->ViewValue = $entrenadores_secuencias->escena->CurrentValue;
			$entrenadores_secuencias->escena->CssStyle = "";
			$entrenadores_secuencias->escena->CssClass = "";
			$entrenadores_secuencias->escena->ViewCustomAttributes = "";

			// fecha
			$entrenadores_secuencias->fecha->ViewValue = $entrenadores_secuencias->fecha->CurrentValue;
			$entrenadores_secuencias->fecha->ViewValue = ew_FormatDateTime($entrenadores_secuencias->fecha->ViewValue, 7);
			$entrenadores_secuencias->fecha->CssStyle = "";
			$entrenadores_secuencias->fecha->CssClass = "";
			$entrenadores_secuencias->fecha->ViewCustomAttributes = "";

			// id
			$entrenadores_secuencias->id->HrefValue = "";
			$entrenadores_secuencias->id->TooltipValue = "";

			// entrenador
			$entrenadores_secuencias->entrenador->HrefValue = "";
			$entrenadores_secuencias->entrenador->TooltipValue = "";

			// secuencia
			$entrenadores_secuencias->secuencia->HrefValue = "";
			$entrenadores_secuencias->secuencia->TooltipValue = "";

			// escena
			$entrenadores_secuencias->escena->HrefValue = "";
			$entrenadores_secuencias->escena->TooltipValue = "";

			// fecha
			$entrenadores_secuencias->fecha->HrefValue = "";
			$entrenadores_secuencias->fecha->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_secuencias->Row_Rendered();
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
