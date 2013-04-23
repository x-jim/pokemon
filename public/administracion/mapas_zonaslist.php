<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "mapas_zonasinfo.php" ?>
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
$mapas_zonas_list = new cmapas_zonas_list();
$Page =& $mapas_zonas_list;

// Page init
$mapas_zonas_list->Page_Init();

// Page main
$mapas_zonas_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mapas_zonas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_zonas_list = new ew_Page("mapas_zonas_list");

// page properties
mapas_zonas_list.PageID = "list"; // page ID
mapas_zonas_list.FormID = "fmapas_zonaslist"; // form ID
var EW_PAGE_ID = mapas_zonas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_zonas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_zonas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_zonas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mapas_zonas->Export == "") { ?>
<?php
$gsMasterReturnUrl = "mapaslist.php";
if ($mapas_zonas_list->sDbMasterFilter <> "" && $mapas_zonas->getCurrentMasterTable() == "mapas") {
	if ($mapas_zonas_list->bMasterRecordExists) {
		if ($mapas_zonas->getCurrentMasterTable() == $mapas_zonas->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "mapasmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$mapas_zonas_list->lTotalRecs = $mapas_zonas->SelectRecordCount();
	} else {
		if ($rs = $mapas_zonas_list->LoadRecordset())
			$mapas_zonas_list->lTotalRecs = $rs->RecordCount();
	}
	$mapas_zonas_list->lStartRec = 1;
	if ($mapas_zonas_list->lDisplayRecs <= 0 || ($mapas_zonas->Export <> "" && $mapas_zonas->ExportAll)) // Display all records
		$mapas_zonas_list->lDisplayRecs = $mapas_zonas_list->lTotalRecs;
	if (!($mapas_zonas->Export <> "" && $mapas_zonas->ExportAll))
		$mapas_zonas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mapas_zonas_list->LoadRecordset($mapas_zonas_list->lStartRec-1, $mapas_zonas_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas_zonas->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($mapas_zonas->Export == "" && $mapas_zonas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mapas_zonas_list);" style="text-decoration: none;"><img id="mapas_zonas_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="mapas_zonas_list_SearchPanel">
<form name="fmapas_zonaslistsrch" id="fmapas_zonaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="mapas_zonas">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($mapas_zonas->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $mapas_zonas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($mapas_zonas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($mapas_zonas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($mapas_zonas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_zonas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmapas_zonaslist" id="fmapas_zonaslist" class="ewForm" action="" method="post">
<div id="gmp_mapas_zonas" class="ewGridMiddlePanel">
<?php if ($mapas_zonas_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $mapas_zonas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$mapas_zonas_list->RenderListOptions();

// Render list options (header, left)
$mapas_zonas_list->ListOptions->Render("header", "left");
?>
<?php if ($mapas_zonas->id->Visible) { // id ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->id) == "") { ?>
		<td><?php echo $mapas_zonas->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->mapa->Visible) { // mapa ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->mapa) == "") { ?>
		<td><?php echo $mapas_zonas->mapa->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->mapa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->mapa->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->mapa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->mapa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->pos_x->Visible) { // pos_x ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->pos_x) == "") { ?>
		<td><?php echo $mapas_zonas->pos_x->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->pos_x) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->pos_x->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->pos_x->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->pos_x->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->pos_y->Visible) { // pos_y ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->pos_y) == "") { ?>
		<td><?php echo $mapas_zonas->pos_y->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->pos_y) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->pos_y->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->pos_y->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->pos_y->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->secuencia->Visible) { // secuencia ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->secuencia) == "") { ?>
		<td><?php echo $mapas_zonas->secuencia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->secuencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->secuencia->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->secuencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->secuencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->width->Visible) { // width ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->width) == "") { ?>
		<td><?php echo $mapas_zonas->width->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->width) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->width->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->width->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->width->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->height->Visible) { // height ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->height) == "") { ?>
		<td><?php echo $mapas_zonas->height->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->height) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->height->FldCaption() ?></td><td style="width: 10px;"><?php if ($mapas_zonas->height->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->height->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($mapas_zonas->titulo->Visible) { // titulo ?>
	<?php if ($mapas_zonas->SortUrl($mapas_zonas->titulo) == "") { ?>
		<td><?php echo $mapas_zonas->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mapas_zonas->SortUrl($mapas_zonas->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $mapas_zonas->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($mapas_zonas->titulo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mapas_zonas->titulo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$mapas_zonas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($mapas_zonas->ExportAll && $mapas_zonas->Export <> "") {
	$mapas_zonas_list->lStopRec = $mapas_zonas_list->lTotalRecs;
} else {
	$mapas_zonas_list->lStopRec = $mapas_zonas_list->lStartRec + $mapas_zonas_list->lDisplayRecs - 1; // Set the last record to display
}
$mapas_zonas_list->lRecCount = $mapas_zonas_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $mapas_zonas_list->lStartRec > 1)
		$rs->Move($mapas_zonas_list->lStartRec - 1);
}

// Initialize aggregate
$mapas_zonas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$mapas_zonas_list->RenderRow();
$mapas_zonas_list->lRowCnt = 0;
while (($mapas_zonas->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mapas_zonas_list->lRecCount < $mapas_zonas_list->lStopRec) {
	$mapas_zonas_list->lRecCount++;
	if (intval($mapas_zonas_list->lRecCount) >= intval($mapas_zonas_list->lStartRec)) {
		$mapas_zonas_list->lRowCnt++;

	// Init row class and style
	$mapas_zonas->CssClass = "";
	$mapas_zonas->CssStyle = "";
	$mapas_zonas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($mapas_zonas->CurrentAction == "gridadd") {
		$mapas_zonas_list->LoadDefaultValues(); // Load default values
	} else {
		$mapas_zonas_list->LoadRowValues($rs); // Load row values
	}
	$mapas_zonas->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mapas_zonas_list->RenderRow();

	// Render list options
	$mapas_zonas_list->RenderListOptions();
?>
	<tr<?php echo $mapas_zonas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$mapas_zonas_list->ListOptions->Render("body", "left");
?>
	<?php if ($mapas_zonas->id->Visible) { // id ?>
		<td<?php echo $mapas_zonas->id->CellAttributes() ?>>
<div<?php echo $mapas_zonas->id->ViewAttributes() ?>><?php echo $mapas_zonas->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->mapa->Visible) { // mapa ?>
		<td<?php echo $mapas_zonas->mapa->CellAttributes() ?>>
<div<?php echo $mapas_zonas->mapa->ViewAttributes() ?>><?php echo $mapas_zonas->mapa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->pos_x->Visible) { // pos_x ?>
		<td<?php echo $mapas_zonas->pos_x->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_x->ViewAttributes() ?>><?php echo $mapas_zonas->pos_x->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->pos_y->Visible) { // pos_y ?>
		<td<?php echo $mapas_zonas->pos_y->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_y->ViewAttributes() ?>><?php echo $mapas_zonas->pos_y->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->secuencia->Visible) { // secuencia ?>
		<td<?php echo $mapas_zonas->secuencia->CellAttributes() ?>>
<div<?php echo $mapas_zonas->secuencia->ViewAttributes() ?>><?php echo $mapas_zonas->secuencia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->width->Visible) { // width ?>
		<td<?php echo $mapas_zonas->width->CellAttributes() ?>>
<div<?php echo $mapas_zonas->width->ViewAttributes() ?>><?php echo $mapas_zonas->width->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->height->Visible) { // height ?>
		<td<?php echo $mapas_zonas->height->CellAttributes() ?>>
<div<?php echo $mapas_zonas->height->ViewAttributes() ?>><?php echo $mapas_zonas->height->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mapas_zonas->titulo->Visible) { // titulo ?>
		<td<?php echo $mapas_zonas->titulo->CellAttributes() ?>>
<div<?php echo $mapas_zonas->titulo->ViewAttributes() ?>><?php echo $mapas_zonas->titulo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mapas_zonas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($mapas_zonas->CurrentAction <> "gridadd")
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
<?php if ($mapas_zonas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($mapas_zonas->CurrentAction <> "gridadd" && $mapas_zonas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mapas_zonas_list->Pager)) $mapas_zonas_list->Pager = new cPrevNextPager($mapas_zonas_list->lStartRec, $mapas_zonas_list->lDisplayRecs, $mapas_zonas_list->lTotalRecs) ?>
<?php if ($mapas_zonas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($mapas_zonas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_zonas_list->PageUrl() ?>start=<?php echo $mapas_zonas_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mapas_zonas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_zonas_list->PageUrl() ?>start=<?php echo $mapas_zonas_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mapas_zonas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mapas_zonas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_zonas_list->PageUrl() ?>start=<?php echo $mapas_zonas_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mapas_zonas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mapas_zonas_list->PageUrl() ?>start=<?php echo $mapas_zonas_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $mapas_zonas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mapas_zonas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mapas_zonas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mapas_zonas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mapas_zonas_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($mapas_zonas_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_zonas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($mapas_zonas->Export == "" && $mapas_zonas->CurrentAction == "") { ?>
<?php } ?>
<?php if ($mapas_zonas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mapas_zonas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_zonas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'mapas_zonas';

	// Page object name
	var $PageObjName = 'mapas_zonas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mapas_zonas;
		if ($mapas_zonas->UseTokenInUrl) $PageUrl .= "t=" . $mapas_zonas->TableVar . "&"; // Add page token
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
		global $objForm, $mapas_zonas;
		if ($mapas_zonas->UseTokenInUrl) {
			if ($objForm)
				return ($mapas_zonas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mapas_zonas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmapas_zonas_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas_zonas)
		$GLOBALS["mapas_zonas"] = new cmapas_zonas();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["mapas_zonas"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "mapas_zonasdelete.php";
		$this->MultiUpdateUrl = "mapas_zonasupdate.php";

		// Table object (mapas)
		$GLOBALS['mapas'] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas_zonas', TRUE);

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
		global $mapas_zonas;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$mapas_zonas->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$mapas_zonas->Export = $_POST["exporttype"];
		} else {
			$mapas_zonas->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $mapas_zonas->Export; // Get export parameter, used in header
		$gsExportFile = $mapas_zonas->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $mapas_zonas;

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
			$mapas_zonas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($mapas_zonas->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mapas_zonas->getRecordsPerPage(); // Restore from Session
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
		$mapas_zonas->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$mapas_zonas->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$mapas_zonas->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $mapas_zonas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $mapas_zonas->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $mapas_zonas->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($mapas_zonas->getMasterFilter() <> "" && $mapas_zonas->getCurrentMasterTable() == "mapas") {
			global $mapas;
			$rsmaster = $mapas->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$mapas_zonas->setMasterFilter(""); // Clear master filter
				$mapas_zonas->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($mapas_zonas->getReturnUrl()); // Return to caller
			} else {
				$mapas->LoadListRowValues($rsmaster);
				$mapas->RowType = EW_ROWTYPE_MASTER; // Master row
				$mapas->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$mapas_zonas->setSessionWhere($sFilter);
		$mapas_zonas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $mapas_zonas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $mapas_zonas->titulo, $Keyword);
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
		global $Security, $mapas_zonas;
		$sSearchStr = "";
		$sSearchKeyword = $mapas_zonas->BasicSearchKeyword;
		$sSearchType = $mapas_zonas->BasicSearchType;
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
			$mapas_zonas->setSessionBasicSearchKeyword($sSearchKeyword);
			$mapas_zonas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $mapas_zonas;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$mapas_zonas->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $mapas_zonas;
		$mapas_zonas->setSessionBasicSearchKeyword("");
		$mapas_zonas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $mapas_zonas;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$mapas_zonas->BasicSearchKeyword = $mapas_zonas->getSessionBasicSearchKeyword();
			$mapas_zonas->BasicSearchType = $mapas_zonas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $mapas_zonas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$mapas_zonas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mapas_zonas->CurrentOrderType = @$_GET["ordertype"];
			$mapas_zonas->UpdateSort($mapas_zonas->id); // id
			$mapas_zonas->UpdateSort($mapas_zonas->mapa); // mapa
			$mapas_zonas->UpdateSort($mapas_zonas->pos_x); // pos_x
			$mapas_zonas->UpdateSort($mapas_zonas->pos_y); // pos_y
			$mapas_zonas->UpdateSort($mapas_zonas->secuencia); // secuencia
			$mapas_zonas->UpdateSort($mapas_zonas->width); // width
			$mapas_zonas->UpdateSort($mapas_zonas->height); // height
			$mapas_zonas->UpdateSort($mapas_zonas->titulo); // titulo
			$mapas_zonas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $mapas_zonas;
		$sOrderBy = $mapas_zonas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($mapas_zonas->SqlOrderBy() <> "") {
				$sOrderBy = $mapas_zonas->SqlOrderBy();
				$mapas_zonas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $mapas_zonas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$mapas_zonas->getCurrentMasterTable = ""; // Clear master table
				$mapas_zonas->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$mapas_zonas->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$mapas_zonas->mapa->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mapas_zonas->setSessionOrderBy($sOrderBy);
				$mapas_zonas->id->setSort("");
				$mapas_zonas->mapa->setSort("");
				$mapas_zonas->pos_x->setSort("");
				$mapas_zonas->pos_y->setSort("");
				$mapas_zonas->secuencia->setSort("");
				$mapas_zonas->width->setSort("");
				$mapas_zonas->height->setSort("");
				$mapas_zonas->titulo->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $mapas_zonas;

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
		if ($mapas_zonas->Export <> "" ||
			$mapas_zonas->CurrentAction == "gridadd" ||
			$mapas_zonas->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $mapas_zonas;
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
		global $Security, $Language, $mapas_zonas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $mapas_zonas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mapas_zonas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mapas_zonas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mapas_zonas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $mapas_zonas;
		$mapas_zonas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$mapas_zonas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mapas_zonas;

		// Call Recordset Selecting event
		$mapas_zonas->Recordset_Selecting($mapas_zonas->CurrentFilter);

		// Load List page SQL
		$sSql = $mapas_zonas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$mapas_zonas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mapas_zonas;
		$sFilter = $mapas_zonas->KeyFilter();

		// Call Row Selecting event
		$mapas_zonas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$mapas_zonas->CurrentFilter = $sFilter;
		$sSql = $mapas_zonas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$mapas_zonas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $mapas_zonas;
		$mapas_zonas->id->setDbValue($rs->fields('id'));
		$mapas_zonas->mapa->setDbValue($rs->fields('mapa'));
		$mapas_zonas->pos_x->setDbValue($rs->fields('pos_x'));
		$mapas_zonas->pos_y->setDbValue($rs->fields('pos_y'));
		$mapas_zonas->secuencia->setDbValue($rs->fields('secuencia'));
		$mapas_zonas->width->setDbValue($rs->fields('width'));
		$mapas_zonas->height->setDbValue($rs->fields('height'));
		$mapas_zonas->titulo->setDbValue($rs->fields('titulo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $mapas_zonas;

		// Initialize URLs
		$this->ViewUrl = $mapas_zonas->ViewUrl();
		$this->EditUrl = $mapas_zonas->EditUrl();
		$this->InlineEditUrl = $mapas_zonas->InlineEditUrl();
		$this->CopyUrl = $mapas_zonas->CopyUrl();
		$this->InlineCopyUrl = $mapas_zonas->InlineCopyUrl();
		$this->DeleteUrl = $mapas_zonas->DeleteUrl();

		// Call Row_Rendering event
		$mapas_zonas->Row_Rendering();

		// Common render codes for all row types
		// id

		$mapas_zonas->id->CellCssStyle = ""; $mapas_zonas->id->CellCssClass = "";
		$mapas_zonas->id->CellAttrs = array(); $mapas_zonas->id->ViewAttrs = array(); $mapas_zonas->id->EditAttrs = array();

		// mapa
		$mapas_zonas->mapa->CellCssStyle = ""; $mapas_zonas->mapa->CellCssClass = "";
		$mapas_zonas->mapa->CellAttrs = array(); $mapas_zonas->mapa->ViewAttrs = array(); $mapas_zonas->mapa->EditAttrs = array();

		// pos_x
		$mapas_zonas->pos_x->CellCssStyle = ""; $mapas_zonas->pos_x->CellCssClass = "";
		$mapas_zonas->pos_x->CellAttrs = array(); $mapas_zonas->pos_x->ViewAttrs = array(); $mapas_zonas->pos_x->EditAttrs = array();

		// pos_y
		$mapas_zonas->pos_y->CellCssStyle = ""; $mapas_zonas->pos_y->CellCssClass = "";
		$mapas_zonas->pos_y->CellAttrs = array(); $mapas_zonas->pos_y->ViewAttrs = array(); $mapas_zonas->pos_y->EditAttrs = array();

		// secuencia
		$mapas_zonas->secuencia->CellCssStyle = ""; $mapas_zonas->secuencia->CellCssClass = "";
		$mapas_zonas->secuencia->CellAttrs = array(); $mapas_zonas->secuencia->ViewAttrs = array(); $mapas_zonas->secuencia->EditAttrs = array();

		// width
		$mapas_zonas->width->CellCssStyle = ""; $mapas_zonas->width->CellCssClass = "";
		$mapas_zonas->width->CellAttrs = array(); $mapas_zonas->width->ViewAttrs = array(); $mapas_zonas->width->EditAttrs = array();

		// height
		$mapas_zonas->height->CellCssStyle = ""; $mapas_zonas->height->CellCssClass = "";
		$mapas_zonas->height->CellAttrs = array(); $mapas_zonas->height->ViewAttrs = array(); $mapas_zonas->height->EditAttrs = array();

		// titulo
		$mapas_zonas->titulo->CellCssStyle = ""; $mapas_zonas->titulo->CellCssClass = "";
		$mapas_zonas->titulo->CellAttrs = array(); $mapas_zonas->titulo->ViewAttrs = array(); $mapas_zonas->titulo->EditAttrs = array();
		if ($mapas_zonas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mapas_zonas->id->ViewValue = $mapas_zonas->id->CurrentValue;
			$mapas_zonas->id->CssStyle = "";
			$mapas_zonas->id->CssClass = "";
			$mapas_zonas->id->ViewCustomAttributes = "";

			// mapa
			$mapas_zonas->mapa->ViewValue = $mapas_zonas->mapa->CurrentValue;
			$mapas_zonas->mapa->CssStyle = "";
			$mapas_zonas->mapa->CssClass = "";
			$mapas_zonas->mapa->ViewCustomAttributes = "";

			// pos_x
			$mapas_zonas->pos_x->ViewValue = $mapas_zonas->pos_x->CurrentValue;
			$mapas_zonas->pos_x->CssStyle = "";
			$mapas_zonas->pos_x->CssClass = "";
			$mapas_zonas->pos_x->ViewCustomAttributes = "";

			// pos_y
			$mapas_zonas->pos_y->ViewValue = $mapas_zonas->pos_y->CurrentValue;
			$mapas_zonas->pos_y->CssStyle = "";
			$mapas_zonas->pos_y->CssClass = "";
			$mapas_zonas->pos_y->ViewCustomAttributes = "";

			// secuencia
			if (strval($mapas_zonas->secuencia->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas_zonas->secuencia->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas_zonas->secuencia->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$mapas_zonas->secuencia->ViewValue = $mapas_zonas->secuencia->CurrentValue;
				}
			} else {
				$mapas_zonas->secuencia->ViewValue = NULL;
			}
			$mapas_zonas->secuencia->CssStyle = "";
			$mapas_zonas->secuencia->CssClass = "";
			$mapas_zonas->secuencia->ViewCustomAttributes = "";

			// width
			$mapas_zonas->width->ViewValue = $mapas_zonas->width->CurrentValue;
			$mapas_zonas->width->CssStyle = "";
			$mapas_zonas->width->CssClass = "";
			$mapas_zonas->width->ViewCustomAttributes = "";

			// height
			$mapas_zonas->height->ViewValue = $mapas_zonas->height->CurrentValue;
			$mapas_zonas->height->CssStyle = "";
			$mapas_zonas->height->CssClass = "";
			$mapas_zonas->height->ViewCustomAttributes = "";

			// titulo
			$mapas_zonas->titulo->ViewValue = $mapas_zonas->titulo->CurrentValue;
			$mapas_zonas->titulo->CssStyle = "";
			$mapas_zonas->titulo->CssClass = "";
			$mapas_zonas->titulo->ViewCustomAttributes = "";

			// id
			$mapas_zonas->id->HrefValue = "";
			$mapas_zonas->id->TooltipValue = "";

			// mapa
			$mapas_zonas->mapa->HrefValue = "";
			$mapas_zonas->mapa->TooltipValue = "";

			// pos_x
			$mapas_zonas->pos_x->HrefValue = "";
			$mapas_zonas->pos_x->TooltipValue = "";

			// pos_y
			$mapas_zonas->pos_y->HrefValue = "";
			$mapas_zonas->pos_y->TooltipValue = "";

			// secuencia
			$mapas_zonas->secuencia->HrefValue = "";
			$mapas_zonas->secuencia->TooltipValue = "";

			// width
			$mapas_zonas->width->HrefValue = "";
			$mapas_zonas->width->TooltipValue = "";

			// height
			$mapas_zonas->height->HrefValue = "";
			$mapas_zonas->height->TooltipValue = "";

			// titulo
			$mapas_zonas->titulo->HrefValue = "";
			$mapas_zonas->titulo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($mapas_zonas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas_zonas->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $mapas_zonas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "mapas") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $mapas_zonas->SqlMasterFilter_mapas();
				$this->sDbDetailFilter = $mapas_zonas->SqlDetailFilter_mapas();
				if (@$_GET["id"] <> "") {
					$GLOBALS["mapas"]->id->setQueryStringValue($_GET["id"]);
					$mapas_zonas->mapa->setQueryStringValue($GLOBALS["mapas"]->id->QueryStringValue);
					$mapas_zonas->mapa->setSessionValue($mapas_zonas->mapa->QueryStringValue);
					if (!is_numeric($GLOBALS["mapas"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["mapas"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@mapa@", ew_AdjustSql($GLOBALS["mapas"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$mapas_zonas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
			$mapas_zonas->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$mapas_zonas->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "mapas") {
				if ($mapas_zonas->mapa->QueryStringValue == "") $mapas_zonas->mapa->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $mapas_zonas->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $mapas_zonas->getDetailFilter(); // Restore detail filter
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
