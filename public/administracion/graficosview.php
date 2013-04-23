<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "graficosinfo.php" ?>
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
$graficos_view = new cgraficos_view();
$Page =& $graficos_view;

// Page init
$graficos_view->Page_Init();

// Page main
$graficos_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($graficos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var graficos_view = new ew_Page("graficos_view");

// page properties
graficos_view.PageID = "view"; // page ID
graficos_view.FormID = "fgraficosview"; // form ID
var EW_PAGE_ID = graficos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
graficos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
graficos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
graficos_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $graficos->TableCaption() ?>
<br><br>
<?php if ($graficos->Export == "") { ?>
<a href="<?php echo $graficos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $graficos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $graficos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $graficos_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $graficos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$graficos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($graficos->id->Visible) { // id ?>
	<tr<?php echo $graficos->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $graficos->id->FldCaption() ?></td>
		<td<?php echo $graficos->id->CellAttributes() ?>>
<div<?php echo $graficos->id->ViewAttributes() ?>><?php echo $graficos->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($graficos->grafico->Visible) { // grafico ?>
	<tr<?php echo $graficos->grafico->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $graficos->grafico->FldCaption() ?></td>
		<td<?php echo $graficos->grafico->CellAttributes() ?>>
<?php if ($graficos->grafico->HrefValue <> "" || $graficos->grafico->TooltipValue <> "") { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<a href="<?php echo $graficos->grafico->HrefValue ?>"><?php echo $graficos->grafico->ViewValue ?></a>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<?php echo $graficos->grafico->ViewValue ?>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($graficos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$graficos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgraficos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'graficos';

	// Page object name
	var $PageObjName = 'graficos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $graficos;
		if ($graficos->UseTokenInUrl) $PageUrl .= "t=" . $graficos->TableVar . "&"; // Add page token
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
		global $objForm, $graficos;
		if ($graficos->UseTokenInUrl) {
			if ($objForm)
				return ($graficos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($graficos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgraficos_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (graficos)
		$GLOBALS["graficos"] = new cgraficos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'graficos', TRUE);

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
		global $graficos;

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
		global $Language, $graficos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$graficos->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $graficos->id->QueryStringValue;
			} else {
				$sReturnUrl = "graficoslist.php"; // Return to list
			}

			// Get action
			$graficos->CurrentAction = "I"; // Display form
			switch ($graficos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "graficoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "graficoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$graficos->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $graficos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$graficos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$graficos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $graficos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$graficos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$graficos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$graficos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $graficos;
		$sFilter = $graficos->KeyFilter();

		// Call Row Selecting event
		$graficos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$graficos->CurrentFilter = $sFilter;
		$sSql = $graficos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$graficos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $graficos;
		$graficos->id->setDbValue($rs->fields('id'));
		$graficos->grafico->Upload->DbValue = $rs->fields('grafico');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $graficos;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($graficos->id->CurrentValue);
		$this->AddUrl = $graficos->AddUrl();
		$this->EditUrl = $graficos->EditUrl();
		$this->CopyUrl = $graficos->CopyUrl();
		$this->DeleteUrl = $graficos->DeleteUrl();
		$this->ListUrl = $graficos->ListUrl();

		// Call Row_Rendering event
		$graficos->Row_Rendering();

		// Common render codes for all row types
		// id

		$graficos->id->CellCssStyle = ""; $graficos->id->CellCssClass = "";
		$graficos->id->CellAttrs = array(); $graficos->id->ViewAttrs = array(); $graficos->id->EditAttrs = array();

		// grafico
		$graficos->grafico->CellCssStyle = ""; $graficos->grafico->CellCssClass = "";
		$graficos->grafico->CellAttrs = array(); $graficos->grafico->ViewAttrs = array(); $graficos->grafico->EditAttrs = array();
		if ($graficos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$graficos->id->ViewValue = $graficos->id->CurrentValue;
			$graficos->id->CssStyle = "";
			$graficos->id->CssClass = "";
			$graficos->id->ViewCustomAttributes = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->ViewValue = $graficos->grafico->Upload->DbValue;
			} else {
				$graficos->grafico->ViewValue = "";
			}
			$graficos->grafico->CssStyle = "";
			$graficos->grafico->CssClass = "";
			$graficos->grafico->ViewCustomAttributes = "";

			// id
			$graficos->id->HrefValue = "";
			$graficos->id->TooltipValue = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->HrefValue = ew_UploadPathEx(FALSE, $graficos->grafico->UploadPath) . ((!empty($graficos->grafico->ViewValue)) ? $graficos->grafico->ViewValue : $graficos->grafico->CurrentValue);
				if ($graficos->Export <> "") $graficos->grafico->HrefValue = ew_ConvertFullUrl($graficos->grafico->HrefValue);
			} else {
				$graficos->grafico->HrefValue = "";
			}
			$graficos->grafico->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($graficos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$graficos->Row_Rendered();
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
