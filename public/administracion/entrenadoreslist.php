<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$entrenadores_list = new centrenadores_list();
$Page =& $entrenadores_list;

// Page init
$entrenadores_list->Page_Init();

// Page main
$entrenadores_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_list = new ew_Page("entrenadores_list");

// page properties
entrenadores_list.PageID = "list"; // page ID
entrenadores_list.FormID = "fentrenadoreslist"; // form ID
var EW_PAGE_ID = entrenadores_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($entrenadores->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$entrenadores_list->lTotalRecs = $entrenadores->SelectRecordCount();
	} else {
		if ($rs = $entrenadores_list->LoadRecordset())
			$entrenadores_list->lTotalRecs = $rs->RecordCount();
	}
	$entrenadores_list->lStartRec = 1;
	if ($entrenadores_list->lDisplayRecs <= 0 || ($entrenadores->Export <> "" && $entrenadores->ExportAll)) // Display all records
		$entrenadores_list->lDisplayRecs = $entrenadores_list->lTotalRecs;
	if (!($entrenadores->Export <> "" && $entrenadores->ExportAll))
		$entrenadores_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $entrenadores_list->LoadRecordset($entrenadores_list->lStartRec-1, $entrenadores_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($entrenadores->Export == "" && $entrenadores->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(entrenadores_list);" style="text-decoration: none;"><img id="entrenadores_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="entrenadores_list_SearchPanel">
<form name="fentrenadoreslistsrch" id="fentrenadoreslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="entrenadores">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($entrenadores->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $entrenadores_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($entrenadores->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($entrenadores->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($entrenadores->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fentrenadoreslist" id="fentrenadoreslist" class="ewForm" action="" method="post">
<div id="gmp_entrenadores" class="ewGridMiddlePanel">
<?php if ($entrenadores_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $entrenadores->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$entrenadores_list->RenderListOptions();

// Render list options (header, left)
$entrenadores_list->ListOptions->Render("header", "left");
?>
<?php if ($entrenadores->id->Visible) { // id ?>
	<?php if ($entrenadores->SortUrl($entrenadores->id) == "") { ?>
		<td><?php echo $entrenadores->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->nombre->Visible) { // nombre ?>
	<?php if ($entrenadores->SortUrl($entrenadores->nombre) == "") { ?>
		<td><?php echo $entrenadores->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entrenadores->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->zemail->Visible) { // email ?>
	<?php if ($entrenadores->SortUrl($entrenadores->zemail) == "") { ?>
		<td><?php echo $entrenadores->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entrenadores->zemail->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->zemail->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->passwd->Visible) { // passwd ?>
	<?php if ($entrenadores->SortUrl($entrenadores->passwd) == "") { ?>
		<td><?php echo $entrenadores->passwd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->passwd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->passwd->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($entrenadores->passwd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->passwd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->iniciado->Visible) { // iniciado ?>
	<?php if ($entrenadores->SortUrl($entrenadores->iniciado) == "") { ?>
		<td><?php echo $entrenadores->iniciado->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->iniciado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->iniciado->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->iniciado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->iniciado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->en_secuencia->Visible) { // en_secuencia ?>
	<?php if ($entrenadores->SortUrl($entrenadores->en_secuencia) == "") { ?>
		<td><?php echo $entrenadores->en_secuencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->en_secuencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->en_secuencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->en_secuencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->en_secuencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->map->Visible) { // map ?>
	<?php if ($entrenadores->SortUrl($entrenadores->map) == "") { ?>
		<td><?php echo $entrenadores->map->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->map) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->map->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->map->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->map->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->secuencia->Visible) { // secuencia ?>
	<?php if ($entrenadores->SortUrl($entrenadores->secuencia) == "") { ?>
		<td><?php echo $entrenadores->secuencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->secuencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->secuencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->secuencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->secuencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($entrenadores->escena->Visible) { // escena ?>
	<?php if ($entrenadores->SortUrl($entrenadores->escena) == "") { ?>
		<td><?php echo $entrenadores->escena->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $entrenadores->SortUrl($entrenadores->escena) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $entrenadores->escena->FldCaption() ?></td><td style="width: 10px;"><?php if ($entrenadores->escena->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($entrenadores->escena->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$entrenadores_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($entrenadores->ExportAll && $entrenadores->Export <> "") {
	$entrenadores_list->lStopRec = $entrenadores_list->lTotalRecs;
} else {
	$entrenadores_list->lStopRec = $entrenadores_list->lStartRec + $entrenadores_list->lDisplayRecs - 1; // Set the last record to display
}
$entrenadores_list->lRecCount = $entrenadores_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $entrenadores_list->lStartRec > 1)
		$rs->Move($entrenadores_list->lStartRec - 1);
}

// Initialize aggregate
$entrenadores->RowType = EW_ROWTYPE_AGGREGATEINIT;
$entrenadores_list->RenderRow();
$entrenadores_list->lRowCnt = 0;
while (($entrenadores->CurrentAction == "gridadd" || !$rs->EOF) &&
	$entrenadores_list->lRecCount < $entrenadores_list->lStopRec) {
	$entrenadores_list->lRecCount++;
	if (intval($entrenadores_list->lRecCount) >= intval($entrenadores_list->lStartRec)) {
		$entrenadores_list->lRowCnt++;

	// Init row class and style
	$entrenadores->CssClass = "";
	$entrenadores->CssStyle = "";
	$entrenadores->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($entrenadores->CurrentAction == "gridadd") {
		$entrenadores_list->LoadDefaultValues(); // Load default values
	} else {
		$entrenadores_list->LoadRowValues($rs); // Load row values
	}
	$entrenadores->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$entrenadores_list->RenderRow();

	// Render list options
	$entrenadores_list->RenderListOptions();
?>
	<tr<?php echo $entrenadores->RowAttributes() ?>>
<?php

// Render list options (body, left)
$entrenadores_list->ListOptions->Render("body", "left");
?>
	<?php if ($entrenadores->id->Visible) { // id ?>
		<td<?php echo $entrenadores->id->CellAttributes() ?>>
<div<?php echo $entrenadores->id->ViewAttributes() ?>><?php echo $entrenadores->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->nombre->Visible) { // nombre ?>
		<td<?php echo $entrenadores->nombre->CellAttributes() ?>>
<div<?php echo $entrenadores->nombre->ViewAttributes() ?>><?php echo $entrenadores->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->zemail->Visible) { // email ?>
		<td<?php echo $entrenadores->zemail->CellAttributes() ?>>
<div<?php echo $entrenadores->zemail->ViewAttributes() ?>><?php echo $entrenadores->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->passwd->Visible) { // passwd ?>
		<td<?php echo $entrenadores->passwd->CellAttributes() ?>>
<div<?php echo $entrenadores->passwd->ViewAttributes() ?>><?php echo $entrenadores->passwd->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->iniciado->Visible) { // iniciado ?>
		<td<?php echo $entrenadores->iniciado->CellAttributes() ?>>
<div<?php echo $entrenadores->iniciado->ViewAttributes() ?>><?php echo $entrenadores->iniciado->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->en_secuencia->Visible) { // en_secuencia ?>
		<td<?php echo $entrenadores->en_secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores->en_secuencia->ViewAttributes() ?>><?php echo $entrenadores->en_secuencia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->map->Visible) { // map ?>
		<td<?php echo $entrenadores->map->CellAttributes() ?>>
<div<?php echo $entrenadores->map->ViewAttributes() ?>><?php echo $entrenadores->map->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->secuencia->Visible) { // secuencia ?>
		<td<?php echo $entrenadores->secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores->secuencia->ViewAttributes() ?>><?php echo $entrenadores->secuencia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($entrenadores->escena->Visible) { // escena ?>
		<td<?php echo $entrenadores->escena->CellAttributes() ?>>
<div<?php echo $entrenadores->escena->ViewAttributes() ?>><?php echo $entrenadores->escena->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$entrenadores_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($entrenadores->CurrentAction <> "gridadd")
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
<?php if ($entrenadores->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($entrenadores->CurrentAction <> "gridadd" && $entrenadores->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($entrenadores_list->Pager)) $entrenadores_list->Pager = new cPrevNextPager($entrenadores_list->lStartRec, $entrenadores_list->lDisplayRecs, $entrenadores_list->lTotalRecs) ?>
<?php if ($entrenadores_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($entrenadores_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_list->PageUrl() ?>start=<?php echo $entrenadores_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($entrenadores_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_list->PageUrl() ?>start=<?php echo $entrenadores_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $entrenadores_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($entrenadores_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_list->PageUrl() ?>start=<?php echo $entrenadores_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($entrenadores_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $entrenadores_list->PageUrl() ?>start=<?php echo $entrenadores_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $entrenadores_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $entrenadores_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $entrenadores_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $entrenadores_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($entrenadores_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($entrenadores_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($entrenadores->Export == "" && $entrenadores->CurrentAction == "") { ?>
<?php } ?>
<?php if ($entrenadores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_list->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'entrenadores';

	// Page object name
	var $PageObjName = 'entrenadores_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores;
		if ($entrenadores->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores;
		if ($entrenadores->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores)
		$GLOBALS["entrenadores"] = new centrenadores();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["entrenadores"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "entrenadoresdelete.php";
		$this->MultiUpdateUrl = "entrenadoresupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores', TRUE);

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
		global $entrenadores;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$entrenadores->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$entrenadores->Export = $_POST["exporttype"];
		} else {
			$entrenadores->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $entrenadores->Export; // Get export parameter, used in header
		$gsExportFile = $entrenadores->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $entrenadores;

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
			$entrenadores->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($entrenadores->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $entrenadores->getRecordsPerPage(); // Restore from Session
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
		$entrenadores->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$entrenadores->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$entrenadores->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $entrenadores->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$entrenadores->setSessionWhere($sFilter);
		$entrenadores->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $entrenadores;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $entrenadores->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entrenadores->zemail, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $entrenadores->passwd, $Keyword);
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
		global $Security, $entrenadores;
		$sSearchStr = "";
		$sSearchKeyword = $entrenadores->BasicSearchKeyword;
		$sSearchType = $entrenadores->BasicSearchType;
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
			$entrenadores->setSessionBasicSearchKeyword($sSearchKeyword);
			$entrenadores->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $entrenadores;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$entrenadores->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $entrenadores;
		$entrenadores->setSessionBasicSearchKeyword("");
		$entrenadores->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $entrenadores;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$entrenadores->BasicSearchKeyword = $entrenadores->getSessionBasicSearchKeyword();
			$entrenadores->BasicSearchType = $entrenadores->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $entrenadores;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$entrenadores->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$entrenadores->CurrentOrderType = @$_GET["ordertype"];
			$entrenadores->UpdateSort($entrenadores->id); // id
			$entrenadores->UpdateSort($entrenadores->nombre); // nombre
			$entrenadores->UpdateSort($entrenadores->zemail); // email
			$entrenadores->UpdateSort($entrenadores->passwd); // passwd
			$entrenadores->UpdateSort($entrenadores->iniciado); // iniciado
			$entrenadores->UpdateSort($entrenadores->en_secuencia); // en_secuencia
			$entrenadores->UpdateSort($entrenadores->map); // map
			$entrenadores->UpdateSort($entrenadores->secuencia); // secuencia
			$entrenadores->UpdateSort($entrenadores->escena); // escena
			$entrenadores->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $entrenadores;
		$sOrderBy = $entrenadores->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($entrenadores->SqlOrderBy() <> "") {
				$sOrderBy = $entrenadores->SqlOrderBy();
				$entrenadores->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $entrenadores;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$entrenadores->setSessionOrderBy($sOrderBy);
				$entrenadores->id->setSort("");
				$entrenadores->nombre->setSort("");
				$entrenadores->zemail->setSort("");
				$entrenadores->passwd->setSort("");
				$entrenadores->iniciado->setSort("");
				$entrenadores->en_secuencia->setSort("");
				$entrenadores->map->setSort("");
				$entrenadores->secuencia->setSort("");
				$entrenadores->escena->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$entrenadores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $entrenadores;

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

		// "detail_entrenadores_items"
		$this->ListOptions->Add("detail_entrenadores_items");
		$item =& $this->ListOptions->Items["detail_entrenadores_items"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($entrenadores->Export <> "" ||
			$entrenadores->CurrentAction == "gridadd" ||
			$entrenadores->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $entrenadores;
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

		// "detail_entrenadores_items"
		$oListOpt =& $this->ListOptions->Items["detail_entrenadores_items"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("entrenadores_items", "TblCaption");
			$oListOpt->Body = "<a href=\"entrenadores_itemslist.php?" . EW_TABLE_SHOW_MASTER . "=entrenadores&id=" . urlencode(strval($entrenadores->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $entrenadores;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $entrenadores;
		$entrenadores->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$entrenadores->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores;

		// Call Recordset Selecting event
		$entrenadores->Recordset_Selecting($entrenadores->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores;
		$sFilter = $entrenadores->KeyFilter();

		// Call Row Selecting event
		$entrenadores->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores->CurrentFilter = $sFilter;
		$sSql = $entrenadores->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores;
		$entrenadores->id->setDbValue($rs->fields('id'));
		$entrenadores->nombre->setDbValue($rs->fields('nombre'));
		$entrenadores->zemail->setDbValue($rs->fields('email'));
		$entrenadores->passwd->setDbValue($rs->fields('passwd'));
		$entrenadores->iniciado->setDbValue($rs->fields('iniciado'));
		$entrenadores->en_secuencia->setDbValue($rs->fields('en_secuencia'));
		$entrenadores->map->setDbValue($rs->fields('map'));
		$entrenadores->secuencia->setDbValue($rs->fields('secuencia'));
		$entrenadores->escena->setDbValue($rs->fields('escena'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores;

		// Initialize URLs
		$this->ViewUrl = $entrenadores->ViewUrl();
		$this->EditUrl = $entrenadores->EditUrl();
		$this->InlineEditUrl = $entrenadores->InlineEditUrl();
		$this->CopyUrl = $entrenadores->CopyUrl();
		$this->InlineCopyUrl = $entrenadores->InlineCopyUrl();
		$this->DeleteUrl = $entrenadores->DeleteUrl();

		// Call Row_Rendering event
		$entrenadores->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores->id->CellCssStyle = ""; $entrenadores->id->CellCssClass = "";
		$entrenadores->id->CellAttrs = array(); $entrenadores->id->ViewAttrs = array(); $entrenadores->id->EditAttrs = array();

		// nombre
		$entrenadores->nombre->CellCssStyle = ""; $entrenadores->nombre->CellCssClass = "";
		$entrenadores->nombre->CellAttrs = array(); $entrenadores->nombre->ViewAttrs = array(); $entrenadores->nombre->EditAttrs = array();

		// email
		$entrenadores->zemail->CellCssStyle = ""; $entrenadores->zemail->CellCssClass = "";
		$entrenadores->zemail->CellAttrs = array(); $entrenadores->zemail->ViewAttrs = array(); $entrenadores->zemail->EditAttrs = array();

		// passwd
		$entrenadores->passwd->CellCssStyle = ""; $entrenadores->passwd->CellCssClass = "";
		$entrenadores->passwd->CellAttrs = array(); $entrenadores->passwd->ViewAttrs = array(); $entrenadores->passwd->EditAttrs = array();

		// iniciado
		$entrenadores->iniciado->CellCssStyle = ""; $entrenadores->iniciado->CellCssClass = "";
		$entrenadores->iniciado->CellAttrs = array(); $entrenadores->iniciado->ViewAttrs = array(); $entrenadores->iniciado->EditAttrs = array();

		// en_secuencia
		$entrenadores->en_secuencia->CellCssStyle = ""; $entrenadores->en_secuencia->CellCssClass = "";
		$entrenadores->en_secuencia->CellAttrs = array(); $entrenadores->en_secuencia->ViewAttrs = array(); $entrenadores->en_secuencia->EditAttrs = array();

		// map
		$entrenadores->map->CellCssStyle = ""; $entrenadores->map->CellCssClass = "";
		$entrenadores->map->CellAttrs = array(); $entrenadores->map->ViewAttrs = array(); $entrenadores->map->EditAttrs = array();

		// secuencia
		$entrenadores->secuencia->CellCssStyle = ""; $entrenadores->secuencia->CellCssClass = "";
		$entrenadores->secuencia->CellAttrs = array(); $entrenadores->secuencia->ViewAttrs = array(); $entrenadores->secuencia->EditAttrs = array();

		// escena
		$entrenadores->escena->CellCssStyle = ""; $entrenadores->escena->CellCssClass = "";
		$entrenadores->escena->CellAttrs = array(); $entrenadores->escena->ViewAttrs = array(); $entrenadores->escena->EditAttrs = array();
		if ($entrenadores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores->id->ViewValue = $entrenadores->id->CurrentValue;
			$entrenadores->id->CssStyle = "";
			$entrenadores->id->CssClass = "";
			$entrenadores->id->ViewCustomAttributes = "";

			// nombre
			$entrenadores->nombre->ViewValue = $entrenadores->nombre->CurrentValue;
			$entrenadores->nombre->CssStyle = "";
			$entrenadores->nombre->CssClass = "";
			$entrenadores->nombre->ViewCustomAttributes = "";

			// email
			$entrenadores->zemail->ViewValue = $entrenadores->zemail->CurrentValue;
			$entrenadores->zemail->CssStyle = "";
			$entrenadores->zemail->CssClass = "";
			$entrenadores->zemail->ViewCustomAttributes = "";

			// passwd
			$entrenadores->passwd->ViewValue = $entrenadores->passwd->CurrentValue;
			$entrenadores->passwd->CssStyle = "";
			$entrenadores->passwd->CssClass = "";
			$entrenadores->passwd->ViewCustomAttributes = "";

			// iniciado
			$entrenadores->iniciado->ViewValue = $entrenadores->iniciado->CurrentValue;
			$entrenadores->iniciado->CssStyle = "";
			$entrenadores->iniciado->CssClass = "";
			$entrenadores->iniciado->ViewCustomAttributes = "";

			// en_secuencia
			$entrenadores->en_secuencia->ViewValue = $entrenadores->en_secuencia->CurrentValue;
			$entrenadores->en_secuencia->CssStyle = "";
			$entrenadores->en_secuencia->CssClass = "";
			$entrenadores->en_secuencia->ViewCustomAttributes = "";

			// map
			$entrenadores->map->ViewValue = $entrenadores->map->CurrentValue;
			$entrenadores->map->CssStyle = "";
			$entrenadores->map->CssClass = "";
			$entrenadores->map->ViewCustomAttributes = "";

			// secuencia
			$entrenadores->secuencia->ViewValue = $entrenadores->secuencia->CurrentValue;
			$entrenadores->secuencia->CssStyle = "";
			$entrenadores->secuencia->CssClass = "";
			$entrenadores->secuencia->ViewCustomAttributes = "";

			// escena
			$entrenadores->escena->ViewValue = $entrenadores->escena->CurrentValue;
			$entrenadores->escena->CssStyle = "";
			$entrenadores->escena->CssClass = "";
			$entrenadores->escena->ViewCustomAttributes = "";

			// id
			$entrenadores->id->HrefValue = "";
			$entrenadores->id->TooltipValue = "";

			// nombre
			$entrenadores->nombre->HrefValue = "";
			$entrenadores->nombre->TooltipValue = "";

			// email
			$entrenadores->zemail->HrefValue = "";
			$entrenadores->zemail->TooltipValue = "";

			// passwd
			$entrenadores->passwd->HrefValue = "";
			$entrenadores->passwd->TooltipValue = "";

			// iniciado
			$entrenadores->iniciado->HrefValue = "";
			$entrenadores->iniciado->TooltipValue = "";

			// en_secuencia
			$entrenadores->en_secuencia->HrefValue = "";
			$entrenadores->en_secuencia->TooltipValue = "";

			// map
			$entrenadores->map->HrefValue = "";
			$entrenadores->map->TooltipValue = "";

			// secuencia
			$entrenadores->secuencia->HrefValue = "";
			$entrenadores->secuencia->TooltipValue = "";

			// escena
			$entrenadores->escena->HrefValue = "";
			$entrenadores->escena->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores->Row_Rendered();
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
