<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$secuencias_view = new csecuencias_view();
$Page =& $secuencias_view;

// Page init
$secuencias_view->Page_Init();

// Page main
$secuencias_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($secuencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_view = new ew_Page("secuencias_view");

// page properties
secuencias_view.PageID = "view"; // page ID
secuencias_view.FormID = "fsecuenciasview"; // form ID
var EW_PAGE_ID = secuencias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias->TableCaption() ?>
<br><br>
<?php if ($secuencias->Export == "") { ?>
<a href="<?php echo $secuencias_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secuencias_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="secuencias_escenaslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=secuencias&id=<?php echo urlencode(strval($secuencias->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("secuencias_escenas", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secuencias->id->Visible) { // id ?>
	<tr<?php echo $secuencias->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias->id->FldCaption() ?></td>
		<td<?php echo $secuencias->id->CellAttributes() ?>>
<div<?php echo $secuencias->id->ViewAttributes() ?>><?php echo $secuencias->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secuencias->nombre->Visible) { // nombre ?>
	<tr<?php echo $secuencias->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias->nombre->FldCaption() ?></td>
		<td<?php echo $secuencias->nombre->CellAttributes() ?>>
<div<?php echo $secuencias->nombre->ViewAttributes() ?>><?php echo $secuencias->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($secuencias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$secuencias_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'secuencias';

	// Page object name
	var $PageObjName = 'secuencias_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secuencias;
		if ($secuencias->UseTokenInUrl) $PageUrl .= "t=" . $secuencias->TableVar . "&"; // Add page token
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
		global $objForm, $secuencias;
		if ($secuencias->UseTokenInUrl) {
			if ($objForm)
				return ($secuencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secuencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecuencias_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias)
		$GLOBALS["secuencias"] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias', TRUE);

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
		global $secuencias;

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
		global $Language, $secuencias;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$secuencias->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $secuencias->id->QueryStringValue;
			} else {
				$sReturnUrl = "secuenciaslist.php"; // Return to list
			}

			// Get action
			$secuencias->CurrentAction = "I"; // Display form
			switch ($secuencias->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "secuenciaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "secuenciaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$secuencias->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $secuencias;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$secuencias->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$secuencias->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $secuencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$secuencias->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$secuencias->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secuencias;
		$sFilter = $secuencias->KeyFilter();

		// Call Row Selecting event
		$secuencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secuencias->CurrentFilter = $sFilter;
		$sSql = $secuencias->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$secuencias->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $secuencias;
		$secuencias->id->setDbValue($rs->fields('id'));
		$secuencias->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secuencias;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($secuencias->id->CurrentValue);
		$this->AddUrl = $secuencias->AddUrl();
		$this->EditUrl = $secuencias->EditUrl();
		$this->CopyUrl = $secuencias->CopyUrl();
		$this->DeleteUrl = $secuencias->DeleteUrl();
		$this->ListUrl = $secuencias->ListUrl();

		// Call Row_Rendering event
		$secuencias->Row_Rendering();

		// Common render codes for all row types
		// id

		$secuencias->id->CellCssStyle = ""; $secuencias->id->CellCssClass = "";
		$secuencias->id->CellAttrs = array(); $secuencias->id->ViewAttrs = array(); $secuencias->id->EditAttrs = array();

		// nombre
		$secuencias->nombre->CellCssStyle = ""; $secuencias->nombre->CellCssClass = "";
		$secuencias->nombre->CellAttrs = array(); $secuencias->nombre->ViewAttrs = array(); $secuencias->nombre->EditAttrs = array();
		if ($secuencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$secuencias->id->ViewValue = $secuencias->id->CurrentValue;
			$secuencias->id->CssStyle = "";
			$secuencias->id->CssClass = "";
			$secuencias->id->ViewCustomAttributes = "";

			// nombre
			$secuencias->nombre->ViewValue = $secuencias->nombre->CurrentValue;
			$secuencias->nombre->CssStyle = "";
			$secuencias->nombre->CssClass = "";
			$secuencias->nombre->ViewCustomAttributes = "";

			// id
			$secuencias->id->HrefValue = "";
			$secuencias->id->TooltipValue = "";

			// nombre
			$secuencias->nombre->HrefValue = "";
			$secuencias->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias->Row_Rendered();
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
