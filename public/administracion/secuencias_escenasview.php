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
$secuencias_escenas_view = new csecuencias_escenas_view();
$Page =& $secuencias_escenas_view;

// Page init
$secuencias_escenas_view->Page_Init();

// Page main
$secuencias_escenas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($secuencias_escenas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_escenas_view = new ew_Page("secuencias_escenas_view");

// page properties
secuencias_escenas_view.PageID = "view"; // page ID
secuencias_escenas_view.FormID = "fsecuencias_escenasview"; // form ID
var EW_PAGE_ID = secuencias_escenas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_escenas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_escenas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_escenas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias_escenas->TableCaption() ?>
<br><br>
<?php if ($secuencias_escenas->Export == "") { ?>
<a href="<?php echo $secuencias_escenas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_escenas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_escenas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_escenas_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_escenas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_escenas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secuencias_escenas->id->Visible) { // id ?>
	<tr<?php echo $secuencias_escenas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->id->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->id->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->id->ViewAttributes() ?>><?php echo $secuencias_escenas->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $secuencias_escenas->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->secuencia->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->secuencia->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->secuencia->ViewAttributes() ?>><?php echo $secuencias_escenas->secuencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->nombre->Visible) { // nombre ?>
	<tr<?php echo $secuencias_escenas->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->nombre->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->nombre->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->nombre->ViewAttributes() ?>><?php echo $secuencias_escenas->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->imagen->Visible) { // imagen ?>
	<tr<?php echo $secuencias_escenas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->imagen->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->imagen->CellAttributes() ?>>
<?php if ($secuencias_escenas->imagen->HrefValue <> "" || $secuencias_escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $secuencias_escenas->imagen->HrefValue ?>"><?php echo $secuencias_escenas->imagen->ViewValue ?></a>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<?php echo $secuencias_escenas->imagen->ViewValue ?>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->texto->Visible) { // texto ?>
	<tr<?php echo $secuencias_escenas->texto->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->texto->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->texto->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->texto->ViewAttributes() ?>><?php echo $secuencias_escenas->texto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->script->Visible) { // script ?>
	<tr<?php echo $secuencias_escenas->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->script->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->script->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->script->ViewAttributes() ?>><?php echo $secuencias_escenas->script->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->orden->Visible) { // orden ?>
	<tr<?php echo $secuencias_escenas->orden->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->orden->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->orden->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->orden->ViewAttributes() ?>><?php echo $secuencias_escenas->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$secuencias_escenas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_escenas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'secuencias_escenas';

	// Page object name
	var $PageObjName = 'secuencias_escenas_view';

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
	function csecuencias_escenas_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias_escenas)
		$GLOBALS["secuencias_escenas"] = new csecuencias_escenas();

		// Table object (secuencias)
		$GLOBALS['secuencias'] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias_escenas', TRUE);

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
		global $secuencias_escenas;

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
		global $Language, $secuencias_escenas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$secuencias_escenas->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $secuencias_escenas->id->QueryStringValue;
			} else {
				$sReturnUrl = "secuencias_escenaslist.php"; // Return to list
			}

			// Get action
			$secuencias_escenas->CurrentAction = "I"; // Display form
			switch ($secuencias_escenas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "secuencias_escenaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "secuencias_escenaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$secuencias_escenas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($secuencias_escenas->id->CurrentValue);
		$this->AddUrl = $secuencias_escenas->AddUrl();
		$this->EditUrl = $secuencias_escenas->EditUrl();
		$this->CopyUrl = $secuencias_escenas->CopyUrl();
		$this->DeleteUrl = $secuencias_escenas->DeleteUrl();
		$this->ListUrl = $secuencias_escenas->ListUrl();

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

		// texto
		$secuencias_escenas->texto->CellCssStyle = ""; $secuencias_escenas->texto->CellCssClass = "";
		$secuencias_escenas->texto->CellAttrs = array(); $secuencias_escenas->texto->ViewAttrs = array(); $secuencias_escenas->texto->EditAttrs = array();

		// script
		$secuencias_escenas->script->CellCssStyle = ""; $secuencias_escenas->script->CellCssClass = "";
		$secuencias_escenas->script->CellAttrs = array(); $secuencias_escenas->script->ViewAttrs = array(); $secuencias_escenas->script->EditAttrs = array();

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

			// texto
			$secuencias_escenas->texto->ViewValue = $secuencias_escenas->texto->CurrentValue;
			$secuencias_escenas->texto->CssStyle = "";
			$secuencias_escenas->texto->CssClass = "";
			$secuencias_escenas->texto->ViewCustomAttributes = "";

			// script
			$secuencias_escenas->script->ViewValue = $secuencias_escenas->script->CurrentValue;
			$secuencias_escenas->script->CssStyle = "";
			$secuencias_escenas->script->CssClass = "";
			$secuencias_escenas->script->ViewCustomAttributes = "";

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

			// texto
			$secuencias_escenas->texto->HrefValue = "";
			$secuencias_escenas->texto->TooltipValue = "";

			// script
			$secuencias_escenas->script->HrefValue = "";
			$secuencias_escenas->script->TooltipValue = "";

			// orden
			$secuencias_escenas->orden->HrefValue = "";
			$secuencias_escenas->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias_escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias_escenas->Row_Rendered();
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
