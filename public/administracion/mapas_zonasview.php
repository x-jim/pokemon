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
$mapas_zonas_view = new cmapas_zonas_view();
$Page =& $mapas_zonas_view;

// Page init
$mapas_zonas_view->Page_Init();

// Page main
$mapas_zonas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mapas_zonas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_zonas_view = new ew_Page("mapas_zonas_view");

// page properties
mapas_zonas_view.PageID = "view"; // page ID
mapas_zonas_view.FormID = "fmapas_zonasview"; // form ID
var EW_PAGE_ID = mapas_zonas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_zonas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_zonas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_zonas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas_zonas->TableCaption() ?>
<br><br>
<?php if ($mapas_zonas->Export == "") { ?>
<a href="<?php echo $mapas_zonas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_zonas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_zonas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_zonas_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_zonas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_zonas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mapas_zonas->id->Visible) { // id ?>
	<tr<?php echo $mapas_zonas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->id->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->id->CellAttributes() ?>>
<div<?php echo $mapas_zonas->id->ViewAttributes() ?>><?php echo $mapas_zonas->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->mapa->Visible) { // mapa ?>
	<tr<?php echo $mapas_zonas->mapa->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->mapa->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->mapa->CellAttributes() ?>>
<div<?php echo $mapas_zonas->mapa->ViewAttributes() ?>><?php echo $mapas_zonas->mapa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->pos_x->Visible) { // pos_x ?>
	<tr<?php echo $mapas_zonas->pos_x->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->pos_x->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->pos_x->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_x->ViewAttributes() ?>><?php echo $mapas_zonas->pos_x->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->pos_y->Visible) { // pos_y ?>
	<tr<?php echo $mapas_zonas->pos_y->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->pos_y->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->pos_y->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_y->ViewAttributes() ?>><?php echo $mapas_zonas->pos_y->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $mapas_zonas->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->secuencia->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->secuencia->CellAttributes() ?>>
<div<?php echo $mapas_zonas->secuencia->ViewAttributes() ?>><?php echo $mapas_zonas->secuencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->width->Visible) { // width ?>
	<tr<?php echo $mapas_zonas->width->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->width->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->width->CellAttributes() ?>>
<div<?php echo $mapas_zonas->width->ViewAttributes() ?>><?php echo $mapas_zonas->width->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->height->Visible) { // height ?>
	<tr<?php echo $mapas_zonas->height->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->height->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->height->CellAttributes() ?>>
<div<?php echo $mapas_zonas->height->ViewAttributes() ?>><?php echo $mapas_zonas->height->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->titulo->Visible) { // titulo ?>
	<tr<?php echo $mapas_zonas->titulo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->titulo->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->titulo->CellAttributes() ?>>
<div<?php echo $mapas_zonas->titulo->ViewAttributes() ?>><?php echo $mapas_zonas->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$mapas_zonas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_zonas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'mapas_zonas';

	// Page object name
	var $PageObjName = 'mapas_zonas_view';

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
	function cmapas_zonas_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas_zonas)
		$GLOBALS["mapas_zonas"] = new cmapas_zonas();

		// Table object (mapas)
		$GLOBALS['mapas'] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas_zonas', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $mapas_zonas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$mapas_zonas->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $mapas_zonas->id->QueryStringValue;
			} else {
				$sReturnUrl = "mapas_zonaslist.php"; // Return to list
			}

			// Get action
			$mapas_zonas->CurrentAction = "I"; // Display form
			switch ($mapas_zonas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "mapas_zonaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mapas_zonaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mapas_zonas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($mapas_zonas->id->CurrentValue);
		$this->AddUrl = $mapas_zonas->AddUrl();
		$this->EditUrl = $mapas_zonas->EditUrl();
		$this->CopyUrl = $mapas_zonas->CopyUrl();
		$this->DeleteUrl = $mapas_zonas->DeleteUrl();
		$this->ListUrl = $mapas_zonas->ListUrl();

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
}
?>
