<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_pokemonsinfo.php" ?>
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
$entrenadores_pokemons_view = new centrenadores_pokemons_view();
$Page =& $entrenadores_pokemons_view;

// Page init
$entrenadores_pokemons_view->Page_Init();

// Page main
$entrenadores_pokemons_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_pokemons_view = new ew_Page("entrenadores_pokemons_view");

// page properties
entrenadores_pokemons_view.PageID = "view"; // page ID
entrenadores_pokemons_view.FormID = "fentrenadores_pokemonsview"; // form ID
var EW_PAGE_ID = entrenadores_pokemons_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_pokemons_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_pokemons_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_pokemons_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_pokemons->TableCaption() ?>
<br><br>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<a href="<?php echo $entrenadores_pokemons_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_pokemons_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_pokemons_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_pokemons_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_pokemons_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_pokemons_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores_pokemons->id->Visible) { // id ?>
	<tr<?php echo $entrenadores_pokemons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->id->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->id->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->id->ViewAttributes() ?>><?php echo $entrenadores_pokemons->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->entrenador->Visible) { // entrenador ?>
	<tr<?php echo $entrenadores_pokemons->entrenador->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->entrenador->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->entrenador->ViewAttributes() ?>><?php echo $entrenadores_pokemons->entrenador->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->pokemon->Visible) { // pokemon ?>
	<tr<?php echo $entrenadores_pokemons->pokemon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->pokemon->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->pokemon->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->pokemon->ViewAttributes() ?>><?php echo $entrenadores_pokemons->pokemon->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->nivel->Visible) { // nivel ?>
	<tr<?php echo $entrenadores_pokemons->nivel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->nivel->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->nivel->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->nivel->ViewAttributes() ?>><?php echo $entrenadores_pokemons->nivel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->experiencia->Visible) { // experiencia ?>
	<tr<?php echo $entrenadores_pokemons->experiencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->experiencia->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->experiencia->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->experiencia->ViewAttributes() ?>><?php echo $entrenadores_pokemons->experiencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($entrenadores_pokemons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_pokemons_view->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_pokemons_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'entrenadores_pokemons';

	// Page object name
	var $PageObjName = 'entrenadores_pokemons_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_pokemons->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_pokemons_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_pokemons)
		$GLOBALS["entrenadores_pokemons"] = new centrenadores_pokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_pokemons', TRUE);

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
		global $entrenadores_pokemons;

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
		global $Language, $entrenadores_pokemons;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$entrenadores_pokemons->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $entrenadores_pokemons->id->QueryStringValue;
			} else {
				$sReturnUrl = "entrenadores_pokemonslist.php"; // Return to list
			}

			// Get action
			$entrenadores_pokemons->CurrentAction = "I"; // Display form
			switch ($entrenadores_pokemons->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "entrenadores_pokemonslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "entrenadores_pokemonslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$entrenadores_pokemons->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores_pokemons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores_pokemons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores_pokemons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_pokemons;
		$sFilter = $entrenadores_pokemons->KeyFilter();

		// Call Row Selecting event
		$entrenadores_pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_pokemons->CurrentFilter = $sFilter;
		$sSql = $entrenadores_pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_pokemons;
		$entrenadores_pokemons->id->setDbValue($rs->fields('id'));
		$entrenadores_pokemons->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_pokemons->pokemon->setDbValue($rs->fields('pokemon'));
		$entrenadores_pokemons->nivel->setDbValue($rs->fields('nivel'));
		$entrenadores_pokemons->experiencia->setDbValue($rs->fields('experiencia'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_pokemons;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($entrenadores_pokemons->id->CurrentValue);
		$this->AddUrl = $entrenadores_pokemons->AddUrl();
		$this->EditUrl = $entrenadores_pokemons->EditUrl();
		$this->CopyUrl = $entrenadores_pokemons->CopyUrl();
		$this->DeleteUrl = $entrenadores_pokemons->DeleteUrl();
		$this->ListUrl = $entrenadores_pokemons->ListUrl();

		// Call Row_Rendering event
		$entrenadores_pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_pokemons->id->CellCssStyle = ""; $entrenadores_pokemons->id->CellCssClass = "";
		$entrenadores_pokemons->id->CellAttrs = array(); $entrenadores_pokemons->id->ViewAttrs = array(); $entrenadores_pokemons->id->EditAttrs = array();

		// entrenador
		$entrenadores_pokemons->entrenador->CellCssStyle = ""; $entrenadores_pokemons->entrenador->CellCssClass = "";
		$entrenadores_pokemons->entrenador->CellAttrs = array(); $entrenadores_pokemons->entrenador->ViewAttrs = array(); $entrenadores_pokemons->entrenador->EditAttrs = array();

		// pokemon
		$entrenadores_pokemons->pokemon->CellCssStyle = ""; $entrenadores_pokemons->pokemon->CellCssClass = "";
		$entrenadores_pokemons->pokemon->CellAttrs = array(); $entrenadores_pokemons->pokemon->ViewAttrs = array(); $entrenadores_pokemons->pokemon->EditAttrs = array();

		// nivel
		$entrenadores_pokemons->nivel->CellCssStyle = ""; $entrenadores_pokemons->nivel->CellCssClass = "";
		$entrenadores_pokemons->nivel->CellAttrs = array(); $entrenadores_pokemons->nivel->ViewAttrs = array(); $entrenadores_pokemons->nivel->EditAttrs = array();

		// experiencia
		$entrenadores_pokemons->experiencia->CellCssStyle = ""; $entrenadores_pokemons->experiencia->CellCssClass = "";
		$entrenadores_pokemons->experiencia->CellAttrs = array(); $entrenadores_pokemons->experiencia->ViewAttrs = array(); $entrenadores_pokemons->experiencia->EditAttrs = array();
		if ($entrenadores_pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_pokemons->id->ViewValue = $entrenadores_pokemons->id->CurrentValue;
			$entrenadores_pokemons->id->CssStyle = "";
			$entrenadores_pokemons->id->CssClass = "";
			$entrenadores_pokemons->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_pokemons->entrenador->ViewValue = $entrenadores_pokemons->entrenador->CurrentValue;
			$entrenadores_pokemons->entrenador->CssStyle = "";
			$entrenadores_pokemons->entrenador->CssClass = "";
			$entrenadores_pokemons->entrenador->ViewCustomAttributes = "";

			// pokemon
			$entrenadores_pokemons->pokemon->ViewValue = $entrenadores_pokemons->pokemon->CurrentValue;
			$entrenadores_pokemons->pokemon->CssStyle = "";
			$entrenadores_pokemons->pokemon->CssClass = "";
			$entrenadores_pokemons->pokemon->ViewCustomAttributes = "";

			// nivel
			$entrenadores_pokemons->nivel->ViewValue = $entrenadores_pokemons->nivel->CurrentValue;
			$entrenadores_pokemons->nivel->CssStyle = "";
			$entrenadores_pokemons->nivel->CssClass = "";
			$entrenadores_pokemons->nivel->ViewCustomAttributes = "";

			// experiencia
			$entrenadores_pokemons->experiencia->ViewValue = $entrenadores_pokemons->experiencia->CurrentValue;
			$entrenadores_pokemons->experiencia->CssStyle = "";
			$entrenadores_pokemons->experiencia->CssClass = "";
			$entrenadores_pokemons->experiencia->ViewCustomAttributes = "";

			// id
			$entrenadores_pokemons->id->HrefValue = "";
			$entrenadores_pokemons->id->TooltipValue = "";

			// entrenador
			$entrenadores_pokemons->entrenador->HrefValue = "";
			$entrenadores_pokemons->entrenador->TooltipValue = "";

			// pokemon
			$entrenadores_pokemons->pokemon->HrefValue = "";
			$entrenadores_pokemons->pokemon->TooltipValue = "";

			// nivel
			$entrenadores_pokemons->nivel->HrefValue = "";
			$entrenadores_pokemons->nivel->TooltipValue = "";

			// experiencia
			$entrenadores_pokemons->experiencia->HrefValue = "";
			$entrenadores_pokemons->experiencia->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_pokemons->Row_Rendered();
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
