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
$entrenadores_secuencias_view = new centrenadores_secuencias_view();
$Page =& $entrenadores_secuencias_view;

// Page init
$entrenadores_secuencias_view->Page_Init();

// Page main
$entrenadores_secuencias_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores_secuencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_secuencias_view = new ew_Page("entrenadores_secuencias_view");

// page properties
entrenadores_secuencias_view.PageID = "view"; // page ID
entrenadores_secuencias_view.FormID = "fentrenadores_secuenciasview"; // form ID
var EW_PAGE_ID = entrenadores_secuencias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_secuencias_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_secuencias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_secuencias_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_secuencias->TableCaption() ?>
<br><br>
<?php if ($entrenadores_secuencias->Export == "") { ?>
<a href="<?php echo $entrenadores_secuencias_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_secuencias_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_secuencias_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_secuencias_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_secuencias_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_secuencias_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores_secuencias->id->Visible) { // id ?>
	<tr<?php echo $entrenadores_secuencias->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->id->FldCaption() ?></td>
		<td<?php echo $entrenadores_secuencias->id->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->id->ViewAttributes() ?>><?php echo $entrenadores_secuencias->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->entrenador->Visible) { // entrenador ?>
	<tr<?php echo $entrenadores_secuencias->entrenador->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->entrenador->FldCaption() ?></td>
		<td<?php echo $entrenadores_secuencias->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->entrenador->ViewAttributes() ?>><?php echo $entrenadores_secuencias->entrenador->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $entrenadores_secuencias->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->secuencia->FldCaption() ?></td>
		<td<?php echo $entrenadores_secuencias->secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->secuencia->ViewAttributes() ?>><?php echo $entrenadores_secuencias->secuencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->escena->Visible) { // escena ?>
	<tr<?php echo $entrenadores_secuencias->escena->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->escena->FldCaption() ?></td>
		<td<?php echo $entrenadores_secuencias->escena->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->escena->ViewAttributes() ?>><?php echo $entrenadores_secuencias->escena->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->fecha->Visible) { // fecha ?>
	<tr<?php echo $entrenadores_secuencias->fecha->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->fecha->FldCaption() ?></td>
		<td<?php echo $entrenadores_secuencias->fecha->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->fecha->ViewAttributes() ?>><?php echo $entrenadores_secuencias->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$entrenadores_secuencias_view->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_secuencias_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'entrenadores_secuencias';

	// Page object name
	var $PageObjName = 'entrenadores_secuencias_view';

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
	function centrenadores_secuencias_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_secuencias)
		$GLOBALS["entrenadores_secuencias"] = new centrenadores_secuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_secuencias', TRUE);

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
		global $entrenadores_secuencias;

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
		global $Language, $entrenadores_secuencias;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$entrenadores_secuencias->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $entrenadores_secuencias->id->QueryStringValue;
			} else {
				$sReturnUrl = "entrenadores_secuenciaslist.php"; // Return to list
			}

			// Get action
			$entrenadores_secuencias->CurrentAction = "I"; // Display form
			switch ($entrenadores_secuencias->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "entrenadores_secuenciaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "entrenadores_secuenciaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$entrenadores_secuencias->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($entrenadores_secuencias->id->CurrentValue);
		$this->AddUrl = $entrenadores_secuencias->AddUrl();
		$this->EditUrl = $entrenadores_secuencias->EditUrl();
		$this->CopyUrl = $entrenadores_secuencias->CopyUrl();
		$this->DeleteUrl = $entrenadores_secuencias->DeleteUrl();
		$this->ListUrl = $entrenadores_secuencias->ListUrl();

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
}
?>
