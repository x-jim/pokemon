<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "mapasinfo.php" ?>
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
$mapas_list = new cmapas_list();
$Page =& $mapas_list;

// Page init
$mapas_list->Page_Init();

// Page main
$mapas_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mapas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_list = new ew_Page("mapas_list");

// page properties
mapas_list.PageID = "list"; // page ID
mapas_list.FormID = "fmapaslist"; // form ID
var EW_PAGE_ID = mapas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mapas->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$mapas_list->lTotalRecs = $mapas->SelectRecordCount();
	} else {
		if ($rs = $mapas_list->LoadRecordset())
			$mapas_list->lTotalRecs = $rs->RecordCount();
	}
	$mapas_list->lStartRec = 1;
	if ($mapas_list->lDisplayRecs <= 0 || ($mapas->Export <> "" && $mapas->ExportAll)) // Display all records
		$mapas_list->lDisplayRecs = $mapas_list->lTotalRecs;
	if (!($mapas->Export <> "" && $mapas->ExportAll))
		$mapas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mapas_list->LoadRecordset($mapas_list->lStartRec-1, $mapas_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($mapas->Export == "" && $mapas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mapas_list);" style="text-decoration: none;"><img id="mapas_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="mapas_list_SearchPanel">
<form name="fmapaslistsrch" id="fmapaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="mapas">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($mapas->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $mapas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($mapas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($mapas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($mapas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmapaslist" id="fmapaslist" class="ewForm" action="" method="post">
<div id="gmp_mapas" class="ewGridMiddlePanel">
<?php if ($mapas_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $mapas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$mapas_list->RenderListOptions();

// Render list options (header, left)
$mapas_list->ListOptions->Render("header", "left");
?>
<?php if ($mapas->id->Visible) { // id ?>
	<?php if ($mapas->SortUrl($mapas->id) == "") { ?>
		<td><?php echo $mapas->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas->imagen->Visible) { // imagen ?>
	<?php if ($mapas->SortUrl($mapas->imagen) == "") { ?>
		<td><?php echo $mapas->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->imagen->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->imagen->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas->mapa_norte->Visible) { // mapa_norte ?>
	<?php if ($mapas->SortUrl($mapas->mapa_norte) == "") { ?>
		<td><?php echo $mapas->mapa_norte->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->mapa_norte) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->mapa_norte->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->mapa_norte->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->mapa_norte->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas->mapa_este->Visible) { // mapa_este ?>
	<?php if ($mapas->SortUrl($mapas->mapa_este) == "") { ?>
		<td><?php echo $mapas->mapa_este->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->mapa_este) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->mapa_este->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->mapa_este->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->mapa_este->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas->mapa_sur->Visible) { // mapa_sur ?>
	<?php if ($mapas->SortUrl($mapas->mapa_sur) == "") { ?>
		<td><?php echo $mapas->mapa_sur->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->mapa_sur) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->mapa_sur->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->mapa_sur->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->mapa_sur->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas->mapa_oeste->Visible) { // mapa_oeste ?>
	<?php if ($mapas->SortUrl($mapas->mapa_oeste) == "") { ?>
		<td><?php echo $mapas->mapa_oeste->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas->SortUrl($mapas->mapa_oeste) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas->mapa_oeste->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas->mapa_oeste->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas->mapa_oeste->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$mapas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($mapas->ExportAll && $mapas->Export <> "") {
	$mapas_list->lStopRec = $mapas_list->lTotalRecs;
} else {
	$mapas_list->lStopRec = $mapas_list->lStartRec + $mapas_list->lDisplayRecs - 1; // Set the last record to display
}
$mapas_list->lRecCount = $mapas_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $mapas_list->lStartRec > 1)
		$rs->Move($mapas_list->lStartRec - 1);
}

// Initialize aggregate
$mapas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$mapas_list->RenderRow();
$mapas_list->lRowCnt = 0;
while (($mapas->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mapas_list->lRecCount < $mapas_list->lStopRec) {
	$mapas_list->lRecCount++;
	if (intval($mapas_list->lRecCount) >= intval($mapas_list->lStartRec)) {
		$mapas_list->lRowCnt++;

	// Init row class and style
	$mapas->CssClass = "";
	$mapas->CssStyle = "";
	$mapas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($mapas->CurrentAction == "gridadd") {
		$mapas_list->LoadDefaultValues(); // Load default values
	} else {
		$mapas_list->LoadRowValues($rs); // Load row values
	}
	$mapas->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mapas_list->RenderRow();

	// Render list options
	$mapas_list->RenderListOptions();
?>
	<tr<?php echo $mapas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$mapas_list->ListOptions->Render("body", "left");
?>
	<?php if ($mapas->id->Visible) { // id ?>
		<td<?php echo $mapas->id->CellAttributes() ?>>
<div<?php echo $mapas->id->ViewAttributes() ?>><?php echo $mapas->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas->imagen->Visible) { // imagen ?>
		<td<?php echo $mapas->imagen->CellAttributes() ?>>
<?php if ($mapas->imagen->HrefValue <> "" || $mapas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $mapas->imagen->HrefValue ?>"><?php echo $mapas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<?php echo $mapas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mapas->mapa_norte->Visible) { // mapa_norte ?>
		<td<?php echo $mapas->mapa_norte->CellAttributes() ?>>
<div<?php echo $mapas->mapa_norte->ViewAttributes() ?>><?php echo $mapas->mapa_norte->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas->mapa_este->Visible) { // mapa_este ?>
		<td<?php echo $mapas->mapa_este->CellAttributes() ?>>
<div<?php echo $mapas->mapa_este->ViewAttributes() ?>><?php echo $mapas->mapa_este->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas->mapa_sur->Visible) { // mapa_sur ?>
		<td<?php echo $mapas->mapa_sur->CellAttributes() ?>>
<div<?php echo $mapas->mapa_sur->ViewAttributes() ?>><?php echo $mapas->mapa_sur->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas->mapa_oeste->Visible) { // mapa_oeste ?>
		<td<?php echo $mapas->mapa_oeste->CellAttributes() ?>>
<div<?php echo $mapas->mapa_oeste->ViewAttributes() ?>><?php echo $mapas->mapa_oeste->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mapas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($mapas->CurrentAction <> "gridadd")
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
<?php if ($mapas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($mapas->CurrentAction <> "gridadd" && $mapas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mapas_list->Pager)) $mapas_list->Pager = new cPrevNextPager($mapas_list->lStartRec, $mapas_list->lDisplayRecs, $mapas_list->lTotalRecs) ?>
<?php if ($mapas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($mapas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_list->PageUrl() ?>start=<?php echo $mapas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mapas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_list->PageUrl() ?>start=<?php echo $mapas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mapas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mapas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_list->PageUrl() ?>start=<?php echo $mapas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mapas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_list->PageUrl() ?>start=<?php echo $mapas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $mapas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mapas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mapas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mapas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mapas_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($mapas_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($mapas->Export == "" && $mapas->CurrentAction == "") { ?>
<?php } ?>
<?php if ($mapas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mapas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'mapas';

	// Page object name
	var $PageObjName = 'mapas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mapas;
		if ($mapas->UseTokenInUrl) $PageUrl .= "t=" . $mapas->TableVar . "&"; // Add page token
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
		global $objForm, $mapas;
		if ($mapas->UseTokenInUrl) {
			if ($objForm)
				return ($mapas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mapas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmapas_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas)
		$GLOBALS["mapas"] = new cmapas();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["mapas"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "mapasdelete.php";
		$this->MultiUpdateUrl = "mapasupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas', TRUE);

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
		global $mapas;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$mapas->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$mapas->Export = $_POST["exporttype"];
		} else {
			$mapas->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $mapas->Export; // Get export parameter, used in header
		$gsExportFile = $mapas->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $mapas;

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
			$mapas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($mapas->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mapas->getRecordsPerPage(); // Restore from Session
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
		$mapas->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$mapas->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$mapas->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $mapas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$mapas->setSessionWhere($sFilter);
		$mapas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $mapas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $mapas->imagen, $Keyword);
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
		global $Security, $mapas;
		$sSearchStr = "";
		$sSearchKeyword = $mapas->BasicSearchKeyword;
		$sSearchType = $mapas->BasicSearchType;
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
			$mapas->setSessionBasicSearchKeyword($sSearchKeyword);
			$mapas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $mapas;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$mapas->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $mapas;
		$mapas->setSessionBasicSearchKeyword("");
		$mapas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $mapas;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$mapas->BasicSearchKeyword = $mapas->getSessionBasicSearchKeyword();
			$mapas->BasicSearchType = $mapas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $mapas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$mapas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mapas->CurrentOrderType = @$_GET["ordertype"];
			$mapas->UpdateSort($mapas->id); // id
			$mapas->UpdateSort($mapas->imagen); // imagen
			$mapas->UpdateSort($mapas->mapa_norte); // mapa_norte
			$mapas->UpdateSort($mapas->mapa_este); // mapa_este
			$mapas->UpdateSort($mapas->mapa_sur); // mapa_sur
			$mapas->UpdateSort($mapas->mapa_oeste); // mapa_oeste
			$mapas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $mapas;
		$sOrderBy = $mapas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($mapas->SqlOrderBy() <> "") {
				$sOrderBy = $mapas->SqlOrderBy();
				$mapas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $mapas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mapas->setSessionOrderBy($sOrderBy);
				$mapas->id->setSort("");
				$mapas->imagen->setSort("");
				$mapas->mapa_norte->setSort("");
				$mapas->mapa_este->setSort("");
				$mapas->mapa_sur->setSort("");
				$mapas->mapa_oeste->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mapas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $mapas;

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

		// "detail_mapas_zonas"
		$this->ListOptions->Add("detail_mapas_zonas");
		$item =& $this->ListOptions->Items["detail_mapas_zonas"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($mapas->Export <> "" ||
			$mapas->CurrentAction == "gridadd" ||
			$mapas->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $mapas;
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

		// "detail_mapas_zonas"
		$oListOpt =& $this->ListOptions->Items["detail_mapas_zonas"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("mapas_zonas", "TblCaption");
			$oListOpt->Body = "<a href=\"mapas_zonaslist.php?" . EW_TABLE_SHOW_MASTER . "=mapas&id=" . urlencode(strval($mapas->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $mapas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $mapas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mapas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mapas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mapas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mapas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mapas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mapas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $mapas;
		$mapas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$mapas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mapas;

		// Call Recordset Selecting event
		$mapas->Recordset_Selecting($mapas->CurrentFilter);

		// Load List page SQL
		$sSql = $mapas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$mapas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mapas;
		$sFilter = $mapas->KeyFilter();

		// Call Row Selecting event
		$mapas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$mapas->CurrentFilter = $sFilter;
		$sSql = $mapas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$mapas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $mapas;
		$mapas->id->setDbValue($rs->fields('id'));
		$mapas->imagen->Upload->DbValue = $rs->fields('imagen');
		$mapas->mapa_norte->setDbValue($rs->fields('mapa_norte'));
		$mapas->mapa_este->setDbValue($rs->fields('mapa_este'));
		$mapas->mapa_sur->setDbValue($rs->fields('mapa_sur'));
		$mapas->mapa_oeste->setDbValue($rs->fields('mapa_oeste'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $mapas;

		// Initialize URLs
		$this->ViewUrl = $mapas->ViewUrl();
		$this->EditUrl = $mapas->EditUrl();
		$this->InlineEditUrl = $mapas->InlineEditUrl();
		$this->CopyUrl = $mapas->CopyUrl();
		$this->InlineCopyUrl = $mapas->InlineCopyUrl();
		$this->DeleteUrl = $mapas->DeleteUrl();

		// Call Row_Rendering event
		$mapas->Row_Rendering();

		// Common render codes for all row types
		// id

		$mapas->id->CellCssStyle = ""; $mapas->id->CellCssClass = "";
		$mapas->id->CellAttrs = array(); $mapas->id->ViewAttrs = array(); $mapas->id->EditAttrs = array();

		// imagen
		$mapas->imagen->CellCssStyle = ""; $mapas->imagen->CellCssClass = "";
		$mapas->imagen->CellAttrs = array(); $mapas->imagen->ViewAttrs = array(); $mapas->imagen->EditAttrs = array();

		// mapa_norte
		$mapas->mapa_norte->CellCssStyle = ""; $mapas->mapa_norte->CellCssClass = "";
		$mapas->mapa_norte->CellAttrs = array(); $mapas->mapa_norte->ViewAttrs = array(); $mapas->mapa_norte->EditAttrs = array();

		// mapa_este
		$mapas->mapa_este->CellCssStyle = ""; $mapas->mapa_este->CellCssClass = "";
		$mapas->mapa_este->CellAttrs = array(); $mapas->mapa_este->ViewAttrs = array(); $mapas->mapa_este->EditAttrs = array();

		// mapa_sur
		$mapas->mapa_sur->CellCssStyle = ""; $mapas->mapa_sur->CellCssClass = "";
		$mapas->mapa_sur->CellAttrs = array(); $mapas->mapa_sur->ViewAttrs = array(); $mapas->mapa_sur->EditAttrs = array();

		// mapa_oeste
		$mapas->mapa_oeste->CellCssStyle = ""; $mapas->mapa_oeste->CellCssClass = "";
		$mapas->mapa_oeste->CellAttrs = array(); $mapas->mapa_oeste->ViewAttrs = array(); $mapas->mapa_oeste->EditAttrs = array();
		if ($mapas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mapas->id->ViewValue = $mapas->id->CurrentValue;
			$mapas->id->CssStyle = "";
			$mapas->id->CssClass = "";
			$mapas->id->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->ViewValue = $mapas->imagen->Upload->DbValue;
			} else {
				$mapas->imagen->ViewValue = "";
			}
			$mapas->imagen->CssStyle = "";
			$mapas->imagen->CssClass = "";
			$mapas->imagen->ViewCustomAttributes = "";

			// mapa_norte
			if (strval($mapas->mapa_norte->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_norte->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_norte->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_norte->ViewValue = $mapas->mapa_norte->CurrentValue;
				}
			} else {
				$mapas->mapa_norte->ViewValue = NULL;
			}
			$mapas->mapa_norte->CssStyle = "";
			$mapas->mapa_norte->CssClass = "";
			$mapas->mapa_norte->ViewCustomAttributes = "";

			// mapa_este
			if (strval($mapas->mapa_este->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_este->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_este->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_este->ViewValue = $mapas->mapa_este->CurrentValue;
				}
			} else {
				$mapas->mapa_este->ViewValue = NULL;
			}
			$mapas->mapa_este->CssStyle = "";
			$mapas->mapa_este->CssClass = "";
			$mapas->mapa_este->ViewCustomAttributes = "";

			// mapa_sur
			if (strval($mapas->mapa_sur->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_sur->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_sur->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_sur->ViewValue = $mapas->mapa_sur->CurrentValue;
				}
			} else {
				$mapas->mapa_sur->ViewValue = NULL;
			}
			$mapas->mapa_sur->CssStyle = "";
			$mapas->mapa_sur->CssClass = "";
			$mapas->mapa_sur->ViewCustomAttributes = "";

			// mapa_oeste
			if (strval($mapas->mapa_oeste->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_oeste->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_oeste->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_oeste->ViewValue = $mapas->mapa_oeste->CurrentValue;
				}
			} else {
				$mapas->mapa_oeste->ViewValue = NULL;
			}
			$mapas->mapa_oeste->CssStyle = "";
			$mapas->mapa_oeste->CssClass = "";
			$mapas->mapa_oeste->ViewCustomAttributes = "";

			// id
			$mapas->id->HrefValue = "";
			$mapas->id->TooltipValue = "";

			// imagen
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->HrefValue = ew_UploadPathEx(FALSE, $mapas->imagen->UploadPath) . ((!empty($mapas->imagen->ViewValue)) ? $mapas->imagen->ViewValue : $mapas->imagen->CurrentValue);
				if ($mapas->Export <> "") $mapas->imagen->HrefValue = ew_ConvertFullUrl($mapas->imagen->HrefValue);
			} else {
				$mapas->imagen->HrefValue = "";
			}
			$mapas->imagen->TooltipValue = "";

			// mapa_norte
			$mapas->mapa_norte->HrefValue = "";
			$mapas->mapa_norte->TooltipValue = "";

			// mapa_este
			$mapas->mapa_este->HrefValue = "";
			$mapas->mapa_este->TooltipValue = "";

			// mapa_sur
			$mapas->mapa_sur->HrefValue = "";
			$mapas->mapa_sur->TooltipValue = "";

			// mapa_oeste
			$mapas->mapa_oeste->HrefValue = "";
			$mapas->mapa_oeste->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($mapas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas->Row_Rendered();
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
