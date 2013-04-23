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
$pokemons_evoluciones_view = new cpokemons_evoluciones_view();
$Page =& $pokemons_evoluciones_view;

// Page init
$pokemons_evoluciones_view->Page_Init();

// Page main
$pokemons_evoluciones_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pokemons_evoluciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_evoluciones_view = new ew_Page("pokemons_evoluciones_view");

// page properties
pokemons_evoluciones_view.PageID = "view"; // page ID
pokemons_evoluciones_view.FormID = "fpokemons_evolucionesview"; // form ID
var EW_PAGE_ID = pokemons_evoluciones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_evoluciones_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_evoluciones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_evoluciones_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons_evoluciones->TableCaption() ?>
<br><br>
<?php if ($pokemons_evoluciones->Export == "") { ?>
<a href="<?php echo $pokemons_evoluciones_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_evoluciones_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_evoluciones_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_evoluciones_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_evoluciones_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_evoluciones_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pokemons_evoluciones->de->Visible) { // de ?>
	<tr<?php echo $pokemons_evoluciones->de->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->de->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->de->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->de->ViewAttributes() ?>><?php echo $pokemons_evoluciones->de->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->a->Visible) { // a ?>
	<tr<?php echo $pokemons_evoluciones->a->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->a->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->a->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->a->ViewAttributes() ?>><?php echo $pokemons_evoluciones->a->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->nivel->Visible) { // nivel ?>
	<tr<?php echo $pokemons_evoluciones->nivel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->nivel->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->nivel->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->nivel->ViewAttributes() ?>><?php echo $pokemons_evoluciones->nivel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->item->Visible) { // item ?>
	<tr<?php echo $pokemons_evoluciones->item->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->item->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->item->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->item->ViewAttributes() ?>><?php echo $pokemons_evoluciones->item->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$pokemons_evoluciones_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_evoluciones_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'pokemons_evoluciones';

	// Page object name
	var $PageObjName = 'pokemons_evoluciones_view';

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
	function cpokemons_evoluciones_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons_evoluciones)
		$GLOBALS["pokemons_evoluciones"] = new cpokemons_evoluciones();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons_evoluciones', TRUE);

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
		global $pokemons_evoluciones;

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
		global $Language, $pokemons_evoluciones;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["de"] <> "") {
				$pokemons_evoluciones->de->setQueryStringValue($_GET["de"]);
				$this->arRecKey["de"] = $pokemons_evoluciones->de->QueryStringValue;
			} else {
				$sReturnUrl = "pokemons_evolucioneslist.php"; // Return to list
			}
			if (@$_GET["a"] <> "") {
				$pokemons_evoluciones->a->setQueryStringValue($_GET["a"]);
				$this->arRecKey["a"] = $pokemons_evoluciones->a->QueryStringValue;
			} else {
				$sReturnUrl = "pokemons_evolucioneslist.php"; // Return to list
			}

			// Get action
			$pokemons_evoluciones->CurrentAction = "I"; // Display form
			switch ($pokemons_evoluciones->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "pokemons_evolucioneslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "pokemons_evolucioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$pokemons_evoluciones->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "de=" . urlencode($pokemons_evoluciones->de->CurrentValue) . "&a=" . urlencode($pokemons_evoluciones->a->CurrentValue);
		$this->AddUrl = $pokemons_evoluciones->AddUrl();
		$this->EditUrl = $pokemons_evoluciones->EditUrl();
		$this->CopyUrl = $pokemons_evoluciones->CopyUrl();
		$this->DeleteUrl = $pokemons_evoluciones->DeleteUrl();
		$this->ListUrl = $pokemons_evoluciones->ListUrl();

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
}
?>
