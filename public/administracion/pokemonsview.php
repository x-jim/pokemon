<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "pokemonsinfo.php" ?>
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
$pokemons_view = new cpokemons_view();
$Page =& $pokemons_view;

// Page init
$pokemons_view->Page_Init();

// Page main
$pokemons_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pokemons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_view = new ew_Page("pokemons_view");

// page properties
pokemons_view.PageID = "view"; // page ID
pokemons_view.FormID = "fpokemonsview"; // form ID
var EW_PAGE_ID = pokemons_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons->TableCaption() ?>
<br><br>
<?php if ($pokemons->Export == "") { ?>
<a href="<?php echo $pokemons_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pokemons_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pokemons->id->Visible) { // id ?>
	<tr<?php echo $pokemons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->id->FldCaption() ?></td>
		<td<?php echo $pokemons->id->CellAttributes() ?>>
<div<?php echo $pokemons->id->ViewAttributes() ?>><?php echo $pokemons->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons->numero->Visible) { // numero ?>
	<tr<?php echo $pokemons->numero->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->numero->FldCaption() ?></td>
		<td<?php echo $pokemons->numero->CellAttributes() ?>>
<div<?php echo $pokemons->numero->ViewAttributes() ?>><?php echo $pokemons->numero->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons->nombre->Visible) { // nombre ?>
	<tr<?php echo $pokemons->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->nombre->FldCaption() ?></td>
		<td<?php echo $pokemons->nombre->CellAttributes() ?>>
<div<?php echo $pokemons->nombre->ViewAttributes() ?>><?php echo $pokemons->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons->imagen->Visible) { // imagen ?>
	<tr<?php echo $pokemons->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->imagen->FldCaption() ?></td>
		<td<?php echo $pokemons->imagen->CellAttributes() ?>>
<div<?php echo $pokemons->imagen->ViewAttributes() ?>><?php echo $pokemons->imagen->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pokemons->icono->Visible) { // icono ?>
	<tr<?php echo $pokemons->icono->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->icono->FldCaption() ?></td>
		<td<?php echo $pokemons->icono->CellAttributes() ?>>
<div<?php echo $pokemons->icono->ViewAttributes() ?>><?php echo $pokemons->icono->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($pokemons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$pokemons_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'pokemons';

	// Page object name
	var $PageObjName = 'pokemons_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokemons;
		if ($pokemons->UseTokenInUrl) $PageUrl .= "t=" . $pokemons->TableVar . "&"; // Add page token
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
		global $objForm, $pokemons;
		if ($pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokemons_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons)
		$GLOBALS["pokemons"] = new cpokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons', TRUE);

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
		global $pokemons;

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
		global $Language, $pokemons;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$pokemons->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $pokemons->id->QueryStringValue;
			} else {
				$sReturnUrl = "pokemonslist.php"; // Return to list
			}

			// Get action
			$pokemons->CurrentAction = "I"; // Display form
			switch ($pokemons->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "pokemonslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "pokemonslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$pokemons->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pokemons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$pokemons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$pokemons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $pokemons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokemons;
		$sFilter = $pokemons->KeyFilter();

		// Call Row Selecting event
		$pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokemons->CurrentFilter = $sFilter;
		$sSql = $pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pokemons;
		$pokemons->id->setDbValue($rs->fields('id'));
		$pokemons->numero->setDbValue($rs->fields('numero'));
		$pokemons->nombre->setDbValue($rs->fields('nombre'));
		$pokemons->imagen->setDbValue($rs->fields('imagen'));
		$pokemons->icono->setDbValue($rs->fields('icono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($pokemons->id->CurrentValue);
		$this->AddUrl = $pokemons->AddUrl();
		$this->EditUrl = $pokemons->EditUrl();
		$this->CopyUrl = $pokemons->CopyUrl();
		$this->DeleteUrl = $pokemons->DeleteUrl();
		$this->ListUrl = $pokemons->ListUrl();

		// Call Row_Rendering event
		$pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$pokemons->id->CellCssStyle = ""; $pokemons->id->CellCssClass = "";
		$pokemons->id->CellAttrs = array(); $pokemons->id->ViewAttrs = array(); $pokemons->id->EditAttrs = array();

		// numero
		$pokemons->numero->CellCssStyle = ""; $pokemons->numero->CellCssClass = "";
		$pokemons->numero->CellAttrs = array(); $pokemons->numero->ViewAttrs = array(); $pokemons->numero->EditAttrs = array();

		// nombre
		$pokemons->nombre->CellCssStyle = ""; $pokemons->nombre->CellCssClass = "";
		$pokemons->nombre->CellAttrs = array(); $pokemons->nombre->ViewAttrs = array(); $pokemons->nombre->EditAttrs = array();

		// imagen
		$pokemons->imagen->CellCssStyle = ""; $pokemons->imagen->CellCssClass = "";
		$pokemons->imagen->CellAttrs = array(); $pokemons->imagen->ViewAttrs = array(); $pokemons->imagen->EditAttrs = array();

		// icono
		$pokemons->icono->CellCssStyle = ""; $pokemons->icono->CellCssClass = "";
		$pokemons->icono->CellAttrs = array(); $pokemons->icono->ViewAttrs = array(); $pokemons->icono->EditAttrs = array();
		if ($pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pokemons->id->ViewValue = $pokemons->id->CurrentValue;
			$pokemons->id->CssStyle = "";
			$pokemons->id->CssClass = "";
			$pokemons->id->ViewCustomAttributes = "";

			// numero
			$pokemons->numero->ViewValue = $pokemons->numero->CurrentValue;
			$pokemons->numero->CssStyle = "";
			$pokemons->numero->CssClass = "";
			$pokemons->numero->ViewCustomAttributes = "";

			// nombre
			$pokemons->nombre->ViewValue = $pokemons->nombre->CurrentValue;
			$pokemons->nombre->CssStyle = "";
			$pokemons->nombre->CssClass = "";
			$pokemons->nombre->ViewCustomAttributes = "";

			// imagen
			$pokemons->imagen->ViewValue = $pokemons->imagen->CurrentValue;
			$pokemons->imagen->CssStyle = "";
			$pokemons->imagen->CssClass = "";
			$pokemons->imagen->ViewCustomAttributes = "";

			// icono
			$pokemons->icono->ViewValue = $pokemons->icono->CurrentValue;
			$pokemons->icono->CssStyle = "";
			$pokemons->icono->CssClass = "";
			$pokemons->icono->ViewCustomAttributes = "";

			// id
			$pokemons->id->HrefValue = "";
			$pokemons->id->TooltipValue = "";

			// numero
			$pokemons->numero->HrefValue = "";
			$pokemons->numero->TooltipValue = "";

			// nombre
			$pokemons->nombre->HrefValue = "";
			$pokemons->nombre->TooltipValue = "";

			// imagen
			$pokemons->imagen->HrefValue = "";
			$pokemons->imagen->TooltipValue = "";

			// icono
			$pokemons->icono->HrefValue = "";
			$pokemons->icono->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons->Row_Rendered();
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
