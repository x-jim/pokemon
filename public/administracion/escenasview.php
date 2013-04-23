<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "escenasinfo.php" ?>
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
$escenas_view = new cescenas_view();
$Page =& $escenas_view;

// Page init
$escenas_view->Page_Init();

// Page main
$escenas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($escenas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var escenas_view = new ew_Page("escenas_view");

// page properties
escenas_view.PageID = "view"; // page ID
escenas_view.FormID = "fescenasview"; // form ID
var EW_PAGE_ID = escenas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
escenas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
escenas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
escenas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $escenas->TableCaption() ?>
<br><br>
<?php if ($escenas->Export == "") { ?>
<a href="<?php echo $escenas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $escenas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $escenas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $escenas_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $escenas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$escenas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($escenas->id->Visible) { // id ?>
	<tr<?php echo $escenas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->id->FldCaption() ?></td>
		<td<?php echo $escenas->id->CellAttributes() ?>>
<div<?php echo $escenas->id->ViewAttributes() ?>><?php echo $escenas->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($escenas->nombre->Visible) { // nombre ?>
	<tr<?php echo $escenas->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->nombre->FldCaption() ?></td>
		<td<?php echo $escenas->nombre->CellAttributes() ?>>
<div<?php echo $escenas->nombre->ViewAttributes() ?>><?php echo $escenas->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($escenas->imagen->Visible) { // imagen ?>
	<tr<?php echo $escenas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->imagen->FldCaption() ?></td>
		<td<?php echo $escenas->imagen->CellAttributes() ?>>
<?php if ($escenas->imagen->HrefValue <> "" || $escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $escenas->imagen->HrefValue ?>"><?php echo $escenas->imagen->ViewValue ?></a>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<?php echo $escenas->imagen->ViewValue ?>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($escenas->texto->Visible) { // texto ?>
	<tr<?php echo $escenas->texto->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->texto->FldCaption() ?></td>
		<td<?php echo $escenas->texto->CellAttributes() ?>>
<div<?php echo $escenas->texto->ViewAttributes() ?>><?php echo $escenas->texto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($escenas->script->Visible) { // script ?>
	<tr<?php echo $escenas->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->script->FldCaption() ?></td>
		<td<?php echo $escenas->script->CellAttributes() ?>>
<div<?php echo $escenas->script->ViewAttributes() ?>><?php echo $escenas->script->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($escenas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$escenas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cescenas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'escenas';

	// Page object name
	var $PageObjName = 'escenas_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $escenas;
		if ($escenas->UseTokenInUrl) $PageUrl .= "t=" . $escenas->TableVar . "&"; // Add page token
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
		global $objForm, $escenas;
		if ($escenas->UseTokenInUrl) {
			if ($objForm)
				return ($escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cescenas_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (escenas)
		$GLOBALS["escenas"] = new cescenas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'escenas', TRUE);

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
		global $escenas;

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
		global $Language, $escenas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$escenas->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $escenas->id->QueryStringValue;
			} else {
				$sReturnUrl = "escenaslist.php"; // Return to list
			}

			// Get action
			$escenas->CurrentAction = "I"; // Display form
			switch ($escenas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "escenaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "escenaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$escenas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $escenas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$escenas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$escenas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $escenas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$escenas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$escenas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$escenas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $escenas;
		$sFilter = $escenas->KeyFilter();

		// Call Row Selecting event
		$escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$escenas->CurrentFilter = $sFilter;
		$sSql = $escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $escenas;
		$escenas->id->setDbValue($rs->fields('id'));
		$escenas->nombre->setDbValue($rs->fields('nombre'));
		$escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$escenas->texto->setDbValue($rs->fields('texto'));
		$escenas->script->setDbValue($rs->fields('script'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $escenas;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($escenas->id->CurrentValue);
		$this->AddUrl = $escenas->AddUrl();
		$this->EditUrl = $escenas->EditUrl();
		$this->CopyUrl = $escenas->CopyUrl();
		$this->DeleteUrl = $escenas->DeleteUrl();
		$this->ListUrl = $escenas->ListUrl();

		// Call Row_Rendering event
		$escenas->Row_Rendering();

		// Common render codes for all row types
		// id

		$escenas->id->CellCssStyle = ""; $escenas->id->CellCssClass = "";
		$escenas->id->CellAttrs = array(); $escenas->id->ViewAttrs = array(); $escenas->id->EditAttrs = array();

		// nombre
		$escenas->nombre->CellCssStyle = ""; $escenas->nombre->CellCssClass = "";
		$escenas->nombre->CellAttrs = array(); $escenas->nombre->ViewAttrs = array(); $escenas->nombre->EditAttrs = array();

		// imagen
		$escenas->imagen->CellCssStyle = ""; $escenas->imagen->CellCssClass = "";
		$escenas->imagen->CellAttrs = array(); $escenas->imagen->ViewAttrs = array(); $escenas->imagen->EditAttrs = array();

		// texto
		$escenas->texto->CellCssStyle = ""; $escenas->texto->CellCssClass = "";
		$escenas->texto->CellAttrs = array(); $escenas->texto->ViewAttrs = array(); $escenas->texto->EditAttrs = array();

		// script
		$escenas->script->CellCssStyle = ""; $escenas->script->CellCssClass = "";
		$escenas->script->CellAttrs = array(); $escenas->script->ViewAttrs = array(); $escenas->script->EditAttrs = array();
		if ($escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$escenas->id->ViewValue = $escenas->id->CurrentValue;
			$escenas->id->CssStyle = "";
			$escenas->id->CssClass = "";
			$escenas->id->ViewCustomAttributes = "";

			// nombre
			$escenas->nombre->ViewValue = $escenas->nombre->CurrentValue;
			$escenas->nombre->CssStyle = "";
			$escenas->nombre->CssClass = "";
			$escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->ViewValue = $escenas->imagen->Upload->DbValue;
			} else {
				$escenas->imagen->ViewValue = "";
			}
			$escenas->imagen->CssStyle = "";
			$escenas->imagen->CssClass = "";
			$escenas->imagen->ViewCustomAttributes = "";

			// texto
			$escenas->texto->ViewValue = $escenas->texto->CurrentValue;
			$escenas->texto->CssStyle = "";
			$escenas->texto->CssClass = "";
			$escenas->texto->ViewCustomAttributes = "";

			// script
			$escenas->script->ViewValue = $escenas->script->CurrentValue;
			$escenas->script->CssStyle = "";
			$escenas->script->CssClass = "";
			$escenas->script->ViewCustomAttributes = "";

			// id
			$escenas->id->HrefValue = "";
			$escenas->id->TooltipValue = "";

			// nombre
			$escenas->nombre->HrefValue = "";
			$escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $escenas->imagen->UploadPath) . ((!empty($escenas->imagen->ViewValue)) ? $escenas->imagen->ViewValue : $escenas->imagen->CurrentValue);
				if ($escenas->Export <> "") $escenas->imagen->HrefValue = ew_ConvertFullUrl($escenas->imagen->HrefValue);
			} else {
				$escenas->imagen->HrefValue = "";
			}
			$escenas->imagen->TooltipValue = "";

			// texto
			$escenas->texto->HrefValue = "";
			$escenas->texto->TooltipValue = "";

			// script
			$escenas->script->HrefValue = "";
			$escenas->script->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$escenas->Row_Rendered();
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
