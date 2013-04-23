<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "secuencias_escenasinfo.php" ?>
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
$secuencias_escenas_list = new csecuencias_escenas_list();
$Page =& $secuencias_escenas_list;

// Page init
$secuencias_escenas_list->Page_Init();

// Page main
$secuencias_escenas_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($secuencias_escenas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_escenas_list = new ew_Page("secuencias_escenas_list");

// page properties
secuencias_escenas_list.PageID = "list"; // page ID
secuencias_escenas_list.FormID = "fsecuencias_escenaslist"; // form ID
var EW_PAGE_ID = secuencias_escenas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_escenas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_escenas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_escenas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($secuencias_escenas->Export == "") { ?>
<?php
$gsMasterReturnUrl = "secuenciaslist.php";
if ($secuencias_escenas_list->sDbMasterFilter <> "" && $secuencias_escenas->getCurrentMasterTable() == "secuencias") {
	if ($secuencias_escenas_list->bMasterRecordExists) {
		if ($secuencias_escenas->getCurrentMasterTable() == $secuencias_escenas->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "secuenciasmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$secuencias_escenas_list->lTotalRecs = $secuencias_escenas->SelectRecordCount();
	} else {
		if ($rs = $secuencias_escenas_list->LoadRecordset())
			$secuencias_escenas_list->lTotalRecs = $rs->RecordCount();
	}
	$secuencias_escenas_list->lStartRec = 1;
	if ($secuencias_escenas_list->lDisplayRecs <= 0 || ($secuencias_escenas->Export <> "" && $secuencias_escenas->ExportAll)) // Display all records
		$secuencias_escenas_list->lDisplayRecs = $secuencias_escenas_list->lTotalRecs;
	if (!($secuencias_escenas->Export <> "" && $secuencias_escenas->ExportAll))
		$secuencias_escenas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $secuencias_escenas_list->LoadRecordset($secuencias_escenas_list->lStartRec-1, $secuencias_escenas_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias_escenas->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($secuencias_escenas->Export == "" && $secuencias_escenas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(secuencias_escenas_list);" style="text-decoration: none;"><img id="secuencias_escenas_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="secuencias_escenas_list_SearchPanel">
<form name="fsecuencias_escenaslistsrch" id="fsecuencias_escenaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="secuencias_escenas">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($secuencias_escenas->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $secuencias_escenas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($secuencias_escenas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($secuencias_escenas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($secuencias_escenas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_escenas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsecuencias_escenaslist" id="fsecuencias_escenaslist" class="ewForm" action="" method="post">
<div id="gmp_secuencias_escenas" class="ewGridMiddlePanel">
<?php if ($secuencias_escenas_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $secuencias_escenas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$secuencias_escenas_list->RenderListOptions();

// Render list options (header, left)
$secuencias_escenas_list->ListOptions->Render("header", "left");
?>
<?php if ($secuencias_escenas->id->Visible) { // id ?>
	<?php if ($secuencias_escenas->SortUrl($secuencias_escenas->id) == "") { ?>
		<td><?php echo $secuencias_escenas->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias_escenas->SortUrl($secuencias_escenas->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias_escenas->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($secuencias_escenas->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias_escenas->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secuencias_escenas->secuencia->Visible) { // secuencia ?>
	<?php if ($secuencias_escenas->SortUrl($secuencias_escenas->secuencia) == "") { ?>
		<td><?php echo $secuencias_escenas->secuencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias_escenas->SortUrl($secuencias_escenas->secuencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias_escenas->secuencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($secuencias_escenas->secuencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias_escenas->secuencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secuencias_escenas->nombre->Visible) { // nombre ?>
	<?php if ($secuencias_escenas->SortUrl($secuencias_escenas->nombre) == "") { ?>
		<td><?php echo $secuencias_escenas->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias_escenas->SortUrl($secuencias_escenas->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias_escenas->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($secuencias_escenas->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias_escenas->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secuencias_escenas->imagen->Visible) { // imagen ?>
	<?php if ($secuencias_escenas->SortUrl($secuencias_escenas->imagen) == "") { ?>
		<td><?php echo $secuencias_escenas->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias_escenas->SortUrl($secuencias_escenas->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias_escenas->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($secuencias_escenas->imagen->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias_escenas->imagen->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secuencias_escenas->orden->Visible) { // orden ?>
	<?php if ($secuencias_escenas->SortUrl($secuencias_escenas->orden) == "") { ?>
		<td><?php echo $secuencias_escenas->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secuencias_escenas->SortUrl($secuencias_escenas->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secuencias_escenas->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($secuencias_escenas->orden->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secuencias_escenas->orden->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$secuencias_escenas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($secuencias_escenas->ExportAll && $secuencias_escenas->Export <> "") {
	$secuencias_escenas_list->lStopRec = $secuencias_escenas_list->lTotalRecs;
} else {
	$secuencias_escenas_list->lStopRec = $secuencias_escenas_list->lStartRec + $secuencias_escenas_list->lDisplayRecs - 1; // Set the last record to display
}
$secuencias_escenas_list->lRecCount = $secuencias_escenas_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $secuencias_escenas_list->lStartRec > 1)
		$rs->Move($secuencias_escenas_list->lStartRec - 1);
}

// Initialize aggregate
$secuencias_escenas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$secuencias_escenas_list->RenderRow();
$secuencias_escenas_list->lRowCnt = 0;
while (($secuencias_escenas->CurrentAction == "gridadd" || !$rs->EOF) &&
	$secuencias_escenas_list->lRecCount < $secuencias_escenas_list->lStopRec) {
	$secuencias_escenas_list->lRecCount++;
	if (intval($secuencias_escenas_list->lRecCount) >= intval($secuencias_escenas_list->lStartRec)) {
		$secuencias_escenas_list->lRowCnt++;

	// Init row class and style
	$secuencias_escenas->CssClass = "";
	$secuencias_escenas->CssStyle = "";
	$secuencias_escenas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($secuencias_escenas->CurrentAction == "gridadd") {
		$secuencias_escenas_list->LoadDefaultValues(); // Load default values
	} else {
		$secuencias_escenas_list->LoadRowValues($rs); // Load row values
	}
	$secuencias_escenas->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$secuencias_escenas_list->RenderRow();

	// Render list options
	$secuencias_escenas_list->RenderListOptions();
?>
	<tr<?php echo $secuencias_escenas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$secuencias_escenas_list->ListOptions->Render("body", "left");
?>
	<?php if ($secuencias_escenas->id->Visible) { // id ?>
		<td<?php echo $secuencias_escenas->id->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->id->ViewAttributes() ?>><?php echo $secuencias_escenas->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secuencias_escenas->secuencia->Visible) { // secuencia ?>
		<td<?php echo $secuencias_escenas->secuencia->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->secuencia->ViewAttributes() ?>><?php echo $secuencias_escenas->secuencia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secuencias_escenas->nombre->Visible) { // nombre ?>
		<td<?php echo $secuencias_escenas->nombre->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->nombre->ViewAttributes() ?>><?php echo $secuencias_escenas->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secuencias_escenas->imagen->Visible) { // imagen ?>
		<td<?php echo $secuencias_escenas->imagen->CellAttributes() ?>>
<?php if ($secuencias_escenas->imagen->HrefValue <> "" || $secuencias_escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $secuencias_escenas->imagen->HrefValue ?>"><?php echo $secuencias_escenas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<?php echo $secuencias_escenas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($secuencias_escenas->orden->Visible) { // orden ?>
		<td<?php echo $secuencias_escenas->orden->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->orden->ViewAttributes() ?>><?php echo $secuencias_escenas->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$secuencias_escenas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($secuencias_escenas->CurrentAction <> "gridadd")
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
<?php if ($secuencias_escenas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($secuencias_escenas->CurrentAction <> "gridadd" && $secuencias_escenas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($secuencias_escenas_list->Pager)) $secuencias_escenas_list->Pager = new cPrevNextPager($secuencias_escenas_list->lStartRec, $secuencias_escenas_list->lDisplayRecs, $secuencias_escenas_list->lTotalRecs) ?>
<?php if ($secuencias_escenas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($secuencias_escenas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_escenas_list->PageUrl() ?>start=<?php echo $secuencias_escenas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($secuencias_escenas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_escenas_list->PageUrl() ?>start=<?php echo $secuencias_escenas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $secuencias_escenas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($secuencias_escenas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_escenas_list->PageUrl() ?>start=<?php echo $secuencias_escenas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($secuencias_escenas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $secuencias_escenas_list->PageUrl() ?>start=<?php echo $secuencias_escenas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $secuencias_escenas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $secuencias_escenas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $secuencias_escenas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $secuencias_escenas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($secuencias_escenas_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($secuencias_escenas_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_escenas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($secuencias_escenas->Export == "" && $secuencias_escenas->CurrentAction == "") { ?>
<?php } ?>
<?php if ($secuencias_escenas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$secuencias_escenas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_escenas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'secuencias_escenas';

	// Page object name
	var $PageObjName = 'secuencias_escenas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secuencias_escenas;
		if ($secuencias_escenas->UseTokenInUrl) $PageUrl .= "t=" . $secuencias_escenas->TableVar . "&"; // Add page token
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
		global $objForm, $secuencias_escenas;
		if ($secuencias_escenas->UseTokenInUrl) {
			if ($objForm)
				return ($secuencias_escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secuencias_escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecuencias_escenas_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias_escenas)
		$GLOBALS["secuencias_escenas"] = new csecuencias_escenas();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["secuencias_escenas"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "secuencias_escenasdelete.php";
		$this->MultiUpdateUrl = "secuencias_escenasupdate.php";

		// Table object (secuencias)
		$GLOBALS['secuencias'] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias_escenas', TRUE);

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
		global $secuencias_escenas;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$secuencias_escenas->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$secuencias_escenas->Export = $_POST["exporttype"];
		} else {
			$secuencias_escenas->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $secuencias_escenas->Export; // Get export parameter, used in header
		$gsExportFile = $secuencias_escenas->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $secuencias_escenas;

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

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$secuencias_escenas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($secuencias_escenas->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $secuencias_escenas->getRecordsPerPage(); // Restore from Session
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
		$secuencias_escenas->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$secuencias_escenas->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$secuencias_escenas->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $secuencias_escenas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $secuencias_escenas->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $secuencias_escenas->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($secuencias_escenas->getMasterFilter() <> "" && $secuencias_escenas->getCurrentMasterTable() == "secuencias") {
			global $secuencias;
			$rsmaster = $secuencias->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$secuencias_escenas->setMasterFilter(""); // Clear master filter
				$secuencias_escenas->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($secuencias_escenas->getReturnUrl()); // Return to caller
			} else {
				$secuencias->LoadListRowValues($rsmaster);
				$secuencias->RowType = EW_ROWTYPE_MASTER; // Master row
				$secuencias->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$secuencias_escenas->setSessionWhere($sFilter);
		$secuencias_escenas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $secuencias_escenas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $secuencias_escenas->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secuencias_escenas->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secuencias_escenas->texto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secuencias_escenas->script, $Keyword);
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
		global $Security, $secuencias_escenas;
		$sSearchStr = "";
		$sSearchKeyword = $secuencias_escenas->BasicSearchKeyword;
		$sSearchType = $secuencias_escenas->BasicSearchType;
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
			$secuencias_escenas->setSessionBasicSearchKeyword($sSearchKeyword);
			$secuencias_escenas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $secuencias_escenas;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$secuencias_escenas->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $secuencias_escenas;
		$secuencias_escenas->setSessionBasicSearchKeyword("");
		$secuencias_escenas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $secuencias_escenas;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$secuencias_escenas->BasicSearchKeyword = $secuencias_escenas->getSessionBasicSearchKeyword();
			$secuencias_escenas->BasicSearchType = $secuencias_escenas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $secuencias_escenas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$secuencias_escenas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$secuencias_escenas->CurrentOrderType = @$_GET["ordertype"];
			$secuencias_escenas->UpdateSort($secuencias_escenas->id); // id
			$secuencias_escenas->UpdateSort($secuencias_escenas->secuencia); // secuencia
			$secuencias_escenas->UpdateSort($secuencias_escenas->nombre); // nombre
			$secuencias_escenas->UpdateSort($secuencias_escenas->imagen); // imagen
			$secuencias_escenas->UpdateSort($secuencias_escenas->orden); // orden
			$secuencias_escenas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $secuencias_escenas;
		$sOrderBy = $secuencias_escenas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($secuencias_escenas->SqlOrderBy() <> "") {
				$sOrderBy = $secuencias_escenas->SqlOrderBy();
				$secuencias_escenas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $secuencias_escenas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$secuencias_escenas->getCurrentMasterTable = ""; // Clear master table
				$secuencias_escenas->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$secuencias_escenas->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$secuencias_escenas->secuencia->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$secuencias_escenas->setSessionOrderBy($sOrderBy);
				$secuencias_escenas->id->setSort("");
				$secuencias_escenas->secuencia->setSort("");
				$secuencias_escenas->nombre->setSort("");
				$secuencias_escenas->imagen->setSort("");
				$secuencias_escenas->orden->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $secuencias_escenas;

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
		if ($secuencias_escenas->Export <> "" ||
			$secuencias_escenas->CurrentAction == "gridadd" ||
			$secuencias_escenas->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $secuencias_escenas;
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
		global $Security, $Language, $secuencias_escenas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $secuencias_escenas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$secuencias_escenas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$secuencias_escenas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $secuencias_escenas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $secuencias_escenas;
		$secuencias_escenas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$secuencias_escenas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secuencias_escenas;

		// Call Recordset Selecting event
		$secuencias_escenas->Recordset_Selecting($secuencias_escenas->CurrentFilter);

		// Load List page SQL
		$sSql = $secuencias_escenas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secuencias_escenas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secuencias_escenas;
		$sFilter = $secuencias_escenas->KeyFilter();

		// Call Row Selecting event
		$secuencias_escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secuencias_escenas->CurrentFilter = $sFilter;
		$sSql = $secuencias_escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$secuencias_escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $secuencias_escenas;
		$secuencias_escenas->id->setDbValue($rs->fields('id'));
		$secuencias_escenas->secuencia->setDbValue($rs->fields('secuencia'));
		$secuencias_escenas->nombre->setDbValue($rs->fields('nombre'));
		$secuencias_escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$secuencias_escenas->texto->setDbValue($rs->fields('texto'));
		$secuencias_escenas->script->setDbValue($rs->fields('script'));
		$secuencias_escenas->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secuencias_escenas;

		// Initialize URLs
		$this->ViewUrl = $secuencias_escenas->ViewUrl();
		$this->EditUrl = $secuencias_escenas->EditUrl();
		$this->InlineEditUrl = $secuencias_escenas->InlineEditUrl();
		$this->CopyUrl = $secuencias_escenas->CopyUrl();
		$this->InlineCopyUrl = $secuencias_escenas->InlineCopyUrl();
		$this->DeleteUrl = $secuencias_escenas->DeleteUrl();

		// Call Row_Rendering event
		$secuencias_escenas->Row_Rendering();

		// Common render codes for all row types
		// id

		$secuencias_escenas->id->CellCssStyle = ""; $secuencias_escenas->id->CellCssClass = "";
		$secuencias_escenas->id->CellAttrs = array(); $secuencias_escenas->id->ViewAttrs = array(); $secuencias_escenas->id->EditAttrs = array();

		// secuencia
		$secuencias_escenas->secuencia->CellCssStyle = ""; $secuencias_escenas->secuencia->CellCssClass = "";
		$secuencias_escenas->secuencia->CellAttrs = array(); $secuencias_escenas->secuencia->ViewAttrs = array(); $secuencias_escenas->secuencia->EditAttrs = array();

		// nombre
		$secuencias_escenas->nombre->CellCssStyle = ""; $secuencias_escenas->nombre->CellCssClass = "";
		$secuencias_escenas->nombre->CellAttrs = array(); $secuencias_escenas->nombre->ViewAttrs = array(); $secuencias_escenas->nombre->EditAttrs = array();

		// imagen
		$secuencias_escenas->imagen->CellCssStyle = ""; $secuencias_escenas->imagen->CellCssClass = "";
		$secuencias_escenas->imagen->CellAttrs = array(); $secuencias_escenas->imagen->ViewAttrs = array(); $secuencias_escenas->imagen->EditAttrs = array();

		// orden
		$secuencias_escenas->orden->CellCssStyle = ""; $secuencias_escenas->orden->CellCssClass = "";
		$secuencias_escenas->orden->CellAttrs = array(); $secuencias_escenas->orden->ViewAttrs = array(); $secuencias_escenas->orden->EditAttrs = array();
		if ($secuencias_escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$secuencias_escenas->id->ViewValue = $secuencias_escenas->id->CurrentValue;
			$secuencias_escenas->id->CssStyle = "";
			$secuencias_escenas->id->CssClass = "";
			$secuencias_escenas->id->ViewCustomAttributes = "";

			// secuencia
			if (strval($secuencias_escenas->secuencia->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($secuencias_escenas->secuencia->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$secuencias_escenas->secuencia->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$secuencias_escenas->secuencia->ViewValue = $secuencias_escenas->secuencia->CurrentValue;
				}
			} else {
				$secuencias_escenas->secuencia->ViewValue = NULL;
			}
			$secuencias_escenas->secuencia->CssStyle = "";
			$secuencias_escenas->secuencia->CssClass = "";
			$secuencias_escenas->secuencia->ViewCustomAttributes = "";

			// nombre
			$secuencias_escenas->nombre->ViewValue = $secuencias_escenas->nombre->CurrentValue;
			$secuencias_escenas->nombre->CssStyle = "";
			$secuencias_escenas->nombre->CssClass = "";
			$secuencias_escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($secuencias_escenas->imagen->Upload->DbValue)) {
				$secuencias_escenas->imagen->ViewValue = $secuencias_escenas->imagen->Upload->DbValue;
			} else {
				$secuencias_escenas->imagen->ViewValue = "";
			}
			$secuencias_escenas->imagen->CssStyle = "";
			$secuencias_escenas->imagen->CssClass = "";
			$secuencias_escenas->imagen->ViewCustomAttributes = "";

			// orden
			$secuencias_escenas->orden->ViewValue = $secuencias_escenas->orden->CurrentValue;
			$secuencias_escenas->orden->CssStyle = "";
			$secuencias_escenas->orden->CssClass = "";
			$secuencias_escenas->orden->ViewCustomAttributes = "";

			// id
			$secuencias_escenas->id->HrefValue = "";
			$secuencias_escenas->id->TooltipValue = "";

			// secuencia
			$secuencias_escenas->secuencia->HrefValue = "";
			$secuencias_escenas->secuencia->TooltipValue = "";

			// nombre
			$secuencias_escenas->nombre->HrefValue = "";
			$secuencias_escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($secuencias_escenas->imagen->Upload->DbValue)) {
				$secuencias_escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $secuencias_escenas->imagen->UploadPath) . ((!empty($secuencias_escenas->imagen->ViewValue)) ? $secuencias_escenas->imagen->ViewValue : $secuencias_escenas->imagen->CurrentValue);
				if ($secuencias_escenas->Export <> "") $secuencias_escenas->imagen->HrefValue = ew_ConvertFullUrl($secuencias_escenas->imagen->HrefValue);
			} else {
				$secuencias_escenas->imagen->HrefValue = "";
			}
			$secuencias_escenas->imagen->TooltipValue = "";

			// orden
			$secuencias_escenas->orden->HrefValue = "";
			$secuencias_escenas->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias_escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias_escenas->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $secuencias_escenas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "secuencias") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $secuencias_escenas->SqlMasterFilter_secuencias();
				$this->sDbDetailFilter = $secuencias_escenas->SqlDetailFilter_secuencias();
				if (@$_GET["id"] <> "") {
					$GLOBALS["secuencias"]->id->setQueryStringValue($_GET["id"]);
					$secuencias_escenas->secuencia->setQueryStringValue($GLOBALS["secuencias"]->id->QueryStringValue);
					$secuencias_escenas->secuencia->setSessionValue($secuencias_escenas->secuencia->QueryStringValue);
					if (!is_numeric($GLOBALS["secuencias"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["secuencias"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@secuencia@", ew_AdjustSql($GLOBALS["secuencias"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$secuencias_escenas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
			$secuencias_escenas->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$secuencias_escenas->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "secuencias") {
				if ($secuencias_escenas->secuencia->QueryStringValue == "") $secuencias_escenas->secuencia->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $secuencias_escenas->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $secuencias_escenas->getDetailFilter(); // Restore detail filter
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
