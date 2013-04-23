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
$mapas_view = new cmapas_view();
$Page =& $mapas_view;

// Page init
$mapas_view->Page_Init();

// Page main
$mapas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mapas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_view = new ew_Page("mapas_view");

// page properties
mapas_view.PageID = "view"; // page ID
mapas_view.FormID = "fmapasview"; // form ID
var EW_PAGE_ID = mapas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas->TableCaption() ?>
<br><br>
<?php if ($mapas->Export == "") { ?>
<a href="<?php echo $mapas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $mapas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="mapas_zonaslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=mapas&id=<?php echo urlencode(strval($mapas->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("mapas_zonas", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mapas->id->Visible) { // id ?>
	<tr<?php echo $mapas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->id->FldCaption() ?></td>
		<td<?php echo $mapas->id->CellAttributes() ?>>
<div<?php echo $mapas->id->ViewAttributes() ?>><?php echo $mapas->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas->imagen->Visible) { // imagen ?>
	<tr<?php echo $mapas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->imagen->FldCaption() ?></td>
		<td<?php echo $mapas->imagen->CellAttributes() ?>>
<?php if ($mapas->imagen->HrefValue <> "" || $mapas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $mapas->imagen->HrefValue ?>"><?php echo $mapas->imagen->ViewValue ?></a>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<?php echo $mapas->imagen->ViewValue ?>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_norte->Visible) { // mapa_norte ?>
	<tr<?php echo $mapas->mapa_norte->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_norte->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_norte->CellAttributes() ?>>
<div<?php echo $mapas->mapa_norte->ViewAttributes() ?>><?php echo $mapas->mapa_norte->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_este->Visible) { // mapa_este ?>
	<tr<?php echo $mapas->mapa_este->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_este->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_este->CellAttributes() ?>>
<div<?php echo $mapas->mapa_este->ViewAttributes() ?>><?php echo $mapas->mapa_este->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_sur->Visible) { // mapa_sur ?>
	<tr<?php echo $mapas->mapa_sur->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_sur->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_sur->CellAttributes() ?>>
<div<?php echo $mapas->mapa_sur->ViewAttributes() ?>><?php echo $mapas->mapa_sur->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_oeste->Visible) { // mapa_oeste ?>
	<tr<?php echo $mapas->mapa_oeste->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_oeste->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_oeste->CellAttributes() ?>>
<div<?php echo $mapas->mapa_oeste->ViewAttributes() ?>><?php echo $mapas->mapa_oeste->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$mapas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'mapas';

	// Page object name
	var $PageObjName = 'mapas_view';

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
	function cmapas_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas)
		$GLOBALS["mapas"] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas', TRUE);

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
		global $mapas;

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
		global $Language, $mapas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$mapas->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $mapas->id->QueryStringValue;
			} else {
				$sReturnUrl = "mapaslist.php"; // Return to list
			}

			// Get action
			$mapas->CurrentAction = "I"; // Display form
			switch ($mapas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "mapaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mapaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mapas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($mapas->id->CurrentValue);
		$this->AddUrl = $mapas->AddUrl();
		$this->EditUrl = $mapas->EditUrl();
		$this->CopyUrl = $mapas->CopyUrl();
		$this->DeleteUrl = $mapas->DeleteUrl();
		$this->ListUrl = $mapas->ListUrl();

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
}
?>
