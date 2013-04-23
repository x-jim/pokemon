<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadoresinfo.php" ?>
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
$entrenadores_view = new centrenadores_view();
$Page =& $entrenadores_view;

// Page init
$entrenadores_view->Page_Init();

// Page main
$entrenadores_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($entrenadores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_view = new ew_Page("entrenadores_view");

// page properties
entrenadores_view.PageID = "view"; // page ID
entrenadores_view.FormID = "fentrenadoresview"; // form ID
var EW_PAGE_ID = entrenadores_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores->TableCaption() ?>
<br><br>
<?php if ($entrenadores->Export == "") { ?>
<a href="<?php echo $entrenadores_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $entrenadores_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores->id->Visible) { // id ?>
	<tr<?php echo $entrenadores->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->id->FldCaption() ?></td>
		<td<?php echo $entrenadores->id->CellAttributes() ?>>
<div<?php echo $entrenadores->id->ViewAttributes() ?>><?php echo $entrenadores->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->nombre->Visible) { // nombre ?>
	<tr<?php echo $entrenadores->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->nombre->FldCaption() ?></td>
		<td<?php echo $entrenadores->nombre->CellAttributes() ?>>
<div<?php echo $entrenadores->nombre->ViewAttributes() ?>><?php echo $entrenadores->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->zemail->Visible) { // email ?>
	<tr<?php echo $entrenadores->zemail->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->zemail->FldCaption() ?></td>
		<td<?php echo $entrenadores->zemail->CellAttributes() ?>>
<div<?php echo $entrenadores->zemail->ViewAttributes() ?>><?php echo $entrenadores->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->passwd->Visible) { // passwd ?>
	<tr<?php echo $entrenadores->passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->passwd->FldCaption() ?></td>
		<td<?php echo $entrenadores->passwd->CellAttributes() ?>>
<div<?php echo $entrenadores->passwd->ViewAttributes() ?>><?php echo $entrenadores->passwd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->iniciado->Visible) { // iniciado ?>
	<tr<?php echo $entrenadores->iniciado->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->iniciado->FldCaption() ?></td>
		<td<?php echo $entrenadores->iniciado->CellAttributes() ?>>
<div<?php echo $entrenadores->iniciado->ViewAttributes() ?>><?php echo $entrenadores->iniciado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->en_secuencia->Visible) { // en_secuencia ?>
	<tr<?php echo $entrenadores->en_secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->en_secuencia->FldCaption() ?></td>
		<td<?php echo $entrenadores->en_secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores->en_secuencia->ViewAttributes() ?>><?php echo $entrenadores->en_secuencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->map->Visible) { // map ?>
	<tr<?php echo $entrenadores->map->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->map->FldCaption() ?></td>
		<td<?php echo $entrenadores->map->CellAttributes() ?>>
<div<?php echo $entrenadores->map->ViewAttributes() ?>><?php echo $entrenadores->map->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($entrenadores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$entrenadores_view->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'entrenadores';

	// Page object name
	var $PageObjName = 'entrenadores_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores;
		if ($entrenadores->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores;
		if ($entrenadores->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores)
		$GLOBALS["entrenadores"] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores', TRUE);

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
		global $entrenadores;

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
		global $Language, $entrenadores;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$entrenadores->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $entrenadores->id->QueryStringValue;
			} else {
				$sReturnUrl = "entrenadoreslist.php"; // Return to list
			}

			// Get action
			$entrenadores->CurrentAction = "I"; // Display form
			switch ($entrenadores->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "entrenadoreslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "entrenadoreslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$entrenadores->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $entrenadores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$entrenadores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$entrenadores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $entrenadores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$entrenadores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$entrenadores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$entrenadores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores;
		$sFilter = $entrenadores->KeyFilter();

		// Call Row Selecting event
		$entrenadores->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores->CurrentFilter = $sFilter;
		$sSql = $entrenadores->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores;
		$entrenadores->id->setDbValue($rs->fields('id'));
		$entrenadores->nombre->setDbValue($rs->fields('nombre'));
		$entrenadores->zemail->setDbValue($rs->fields('email'));
		$entrenadores->passwd->setDbValue($rs->fields('passwd'));
		$entrenadores->iniciado->setDbValue($rs->fields('iniciado'));
		$entrenadores->en_secuencia->setDbValue($rs->fields('en_secuencia'));
		$entrenadores->map->setDbValue($rs->fields('map'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($entrenadores->id->CurrentValue);
		$this->AddUrl = $entrenadores->AddUrl();
		$this->EditUrl = $entrenadores->EditUrl();
		$this->CopyUrl = $entrenadores->CopyUrl();
		$this->DeleteUrl = $entrenadores->DeleteUrl();
		$this->ListUrl = $entrenadores->ListUrl();

		// Call Row_Rendering event
		$entrenadores->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores->id->CellCssStyle = ""; $entrenadores->id->CellCssClass = "";
		$entrenadores->id->CellAttrs = array(); $entrenadores->id->ViewAttrs = array(); $entrenadores->id->EditAttrs = array();

		// nombre
		$entrenadores->nombre->CellCssStyle = ""; $entrenadores->nombre->CellCssClass = "";
		$entrenadores->nombre->CellAttrs = array(); $entrenadores->nombre->ViewAttrs = array(); $entrenadores->nombre->EditAttrs = array();

		// email
		$entrenadores->zemail->CellCssStyle = ""; $entrenadores->zemail->CellCssClass = "";
		$entrenadores->zemail->CellAttrs = array(); $entrenadores->zemail->ViewAttrs = array(); $entrenadores->zemail->EditAttrs = array();

		// passwd
		$entrenadores->passwd->CellCssStyle = ""; $entrenadores->passwd->CellCssClass = "";
		$entrenadores->passwd->CellAttrs = array(); $entrenadores->passwd->ViewAttrs = array(); $entrenadores->passwd->EditAttrs = array();

		// iniciado
		$entrenadores->iniciado->CellCssStyle = ""; $entrenadores->iniciado->CellCssClass = "";
		$entrenadores->iniciado->CellAttrs = array(); $entrenadores->iniciado->ViewAttrs = array(); $entrenadores->iniciado->EditAttrs = array();

		// en_secuencia
		$entrenadores->en_secuencia->CellCssStyle = ""; $entrenadores->en_secuencia->CellCssClass = "";
		$entrenadores->en_secuencia->CellAttrs = array(); $entrenadores->en_secuencia->ViewAttrs = array(); $entrenadores->en_secuencia->EditAttrs = array();

		// map
		$entrenadores->map->CellCssStyle = ""; $entrenadores->map->CellCssClass = "";
		$entrenadores->map->CellAttrs = array(); $entrenadores->map->ViewAttrs = array(); $entrenadores->map->EditAttrs = array();
		if ($entrenadores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores->id->ViewValue = $entrenadores->id->CurrentValue;
			$entrenadores->id->CssStyle = "";
			$entrenadores->id->CssClass = "";
			$entrenadores->id->ViewCustomAttributes = "";

			// nombre
			$entrenadores->nombre->ViewValue = $entrenadores->nombre->CurrentValue;
			$entrenadores->nombre->CssStyle = "";
			$entrenadores->nombre->CssClass = "";
			$entrenadores->nombre->ViewCustomAttributes = "";

			// email
			$entrenadores->zemail->ViewValue = $entrenadores->zemail->CurrentValue;
			$entrenadores->zemail->CssStyle = "";
			$entrenadores->zemail->CssClass = "";
			$entrenadores->zemail->ViewCustomAttributes = "";

			// passwd
			$entrenadores->passwd->ViewValue = $entrenadores->passwd->CurrentValue;
			$entrenadores->passwd->CssStyle = "";
			$entrenadores->passwd->CssClass = "";
			$entrenadores->passwd->ViewCustomAttributes = "";

			// iniciado
			$entrenadores->iniciado->ViewValue = $entrenadores->iniciado->CurrentValue;
			$entrenadores->iniciado->CssStyle = "";
			$entrenadores->iniciado->CssClass = "";
			$entrenadores->iniciado->ViewCustomAttributes = "";

			// en_secuencia
			$entrenadores->en_secuencia->ViewValue = $entrenadores->en_secuencia->CurrentValue;
			$entrenadores->en_secuencia->CssStyle = "";
			$entrenadores->en_secuencia->CssClass = "";
			$entrenadores->en_secuencia->ViewCustomAttributes = "";

			// map
			$entrenadores->map->ViewValue = $entrenadores->map->CurrentValue;
			$entrenadores->map->CssStyle = "";
			$entrenadores->map->CssClass = "";
			$entrenadores->map->ViewCustomAttributes = "";

			// id
			$entrenadores->id->HrefValue = "";
			$entrenadores->id->TooltipValue = "";

			// nombre
			$entrenadores->nombre->HrefValue = "";
			$entrenadores->nombre->TooltipValue = "";

			// email
			$entrenadores->zemail->HrefValue = "";
			$entrenadores->zemail->TooltipValue = "";

			// passwd
			$entrenadores->passwd->HrefValue = "";
			$entrenadores->passwd->TooltipValue = "";

			// iniciado
			$entrenadores->iniciado->HrefValue = "";
			$entrenadores->iniciado->TooltipValue = "";

			// en_secuencia
			$entrenadores->en_secuencia->HrefValue = "";
			$entrenadores->en_secuencia->TooltipValue = "";

			// map
			$entrenadores->map->HrefValue = "";
			$entrenadores->map->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores->Row_Rendered();
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
