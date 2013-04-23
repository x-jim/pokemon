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
$pokemons_evoluciones_add = new cpokemons_evoluciones_add();
$Page =& $pokemons_evoluciones_add;

// Page init
$pokemons_evoluciones_add->Page_Init();

// Page main
$pokemons_evoluciones_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_evoluciones_add = new ew_Page("pokemons_evoluciones_add");

// page properties
pokemons_evoluciones_add.PageID = "add"; // page ID
pokemons_evoluciones_add.FormID = "fpokemons_evolucionesadd"; // form ID
var EW_PAGE_ID = pokemons_evoluciones_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pokemons_evoluciones_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_de"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pokemons_evoluciones->de->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_de"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pokemons_evoluciones->de->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_a"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pokemons_evoluciones->a->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_a"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pokemons_evoluciones->a->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_nivel"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pokemons_evoluciones->nivel->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_item"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pokemons_evoluciones->item->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
pokemons_evoluciones_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_evoluciones_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_evoluciones_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons_evoluciones->TableCaption() ?><br><br>
<a href="<?php echo $pokemons_evoluciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_evoluciones_add->ShowMessage();
?>
<form name="fpokemons_evolucionesadd" id="fpokemons_evolucionesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pokemons_evoluciones_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pokemons_evoluciones">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pokemons_evoluciones->de->Visible) { // de ?>
	<tr<?php echo $pokemons_evoluciones->de->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->de->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pokemons_evoluciones->de->CellAttributes() ?>><span id="el_de">
<input type="text" name="x_de" id="x_de" title="<?php echo $pokemons_evoluciones->de->FldTitle() ?>" size="30" value="<?php echo $pokemons_evoluciones->de->EditValue ?>"<?php echo $pokemons_evoluciones->de->EditAttributes() ?>>
</span><?php echo $pokemons_evoluciones->de->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->a->Visible) { // a ?>
	<tr<?php echo $pokemons_evoluciones->a->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->a->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pokemons_evoluciones->a->CellAttributes() ?>><span id="el_a">
<input type="text" name="x_a" id="x_a" title="<?php echo $pokemons_evoluciones->a->FldTitle() ?>" size="30" value="<?php echo $pokemons_evoluciones->a->EditValue ?>"<?php echo $pokemons_evoluciones->a->EditAttributes() ?>>
</span><?php echo $pokemons_evoluciones->a->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->nivel->Visible) { // nivel ?>
	<tr<?php echo $pokemons_evoluciones->nivel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->nivel->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->nivel->CellAttributes() ?>><span id="el_nivel">
<input type="text" name="x_nivel" id="x_nivel" title="<?php echo $pokemons_evoluciones->nivel->FldTitle() ?>" size="30" value="<?php echo $pokemons_evoluciones->nivel->EditValue ?>"<?php echo $pokemons_evoluciones->nivel->EditAttributes() ?>>
</span><?php echo $pokemons_evoluciones->nivel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons_evoluciones->item->Visible) { // item ?>
	<tr<?php echo $pokemons_evoluciones->item->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons_evoluciones->item->FldCaption() ?></td>
		<td<?php echo $pokemons_evoluciones->item->CellAttributes() ?>><span id="el_item">
<input type="text" name="x_item" id="x_item" title="<?php echo $pokemons_evoluciones->item->FldTitle() ?>" size="30" value="<?php echo $pokemons_evoluciones->item->EditValue ?>"<?php echo $pokemons_evoluciones->item->EditAttributes() ?>>
</span><?php echo $pokemons_evoluciones->item->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$pokemons_evoluciones_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_evoluciones_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pokemons_evoluciones';

	// Page object name
	var $PageObjName = 'pokemons_evoluciones_add';

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
	function cpokemons_evoluciones_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons_evoluciones)
		$GLOBALS["pokemons_evoluciones"] = new cpokemons_evoluciones();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $pokemons_evoluciones;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["de"] != "") {
		  $pokemons_evoluciones->de->setQueryStringValue($_GET["de"]);
		} else {
		  $bCopy = FALSE;
		}
		if (@$_GET["a"] != "") {
		  $pokemons_evoluciones->a->setQueryStringValue($_GET["a"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $pokemons_evoluciones->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pokemons_evoluciones->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $pokemons_evoluciones->CurrentAction = "C"; // Copy record
		  } else {
		    $pokemons_evoluciones->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($pokemons_evoluciones->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("pokemons_evolucioneslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$pokemons_evoluciones->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pokemons_evoluciones->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$pokemons_evoluciones->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pokemons_evoluciones;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $pokemons_evoluciones;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pokemons_evoluciones;
		$pokemons_evoluciones->de->setFormValue($objForm->GetValue("x_de"));
		$pokemons_evoluciones->a->setFormValue($objForm->GetValue("x_a"));
		$pokemons_evoluciones->nivel->setFormValue($objForm->GetValue("x_nivel"));
		$pokemons_evoluciones->item->setFormValue($objForm->GetValue("x_item"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pokemons_evoluciones;
		$pokemons_evoluciones->de->CurrentValue = $pokemons_evoluciones->de->FormValue;
		$pokemons_evoluciones->a->CurrentValue = $pokemons_evoluciones->a->FormValue;
		$pokemons_evoluciones->nivel->CurrentValue = $pokemons_evoluciones->nivel->FormValue;
		$pokemons_evoluciones->item->CurrentValue = $pokemons_evoluciones->item->FormValue;
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
		} elseif ($pokemons_evoluciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// de
			$pokemons_evoluciones->de->EditCustomAttributes = "";
			$pokemons_evoluciones->de->EditValue = ew_HtmlEncode($pokemons_evoluciones->de->CurrentValue);

			// a
			$pokemons_evoluciones->a->EditCustomAttributes = "";
			$pokemons_evoluciones->a->EditValue = ew_HtmlEncode($pokemons_evoluciones->a->CurrentValue);

			// nivel
			$pokemons_evoluciones->nivel->EditCustomAttributes = "";
			$pokemons_evoluciones->nivel->EditValue = ew_HtmlEncode($pokemons_evoluciones->nivel->CurrentValue);

			// item
			$pokemons_evoluciones->item->EditCustomAttributes = "";
			$pokemons_evoluciones->item->EditValue = ew_HtmlEncode($pokemons_evoluciones->item->CurrentValue);
		}

		// Call Row Rendered event
		if ($pokemons_evoluciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons_evoluciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pokemons_evoluciones;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pokemons_evoluciones->de->FormValue) && $pokemons_evoluciones->de->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pokemons_evoluciones->de->FldCaption();
		}
		if (!ew_CheckInteger($pokemons_evoluciones->de->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pokemons_evoluciones->de->FldErrMsg();
		}
		if (!is_null($pokemons_evoluciones->a->FormValue) && $pokemons_evoluciones->a->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pokemons_evoluciones->a->FldCaption();
		}
		if (!ew_CheckInteger($pokemons_evoluciones->a->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pokemons_evoluciones->a->FldErrMsg();
		}
		if (!ew_CheckInteger($pokemons_evoluciones->nivel->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pokemons_evoluciones->nivel->FldErrMsg();
		}
		if (!ew_CheckInteger($pokemons_evoluciones->item->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pokemons_evoluciones->item->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $pokemons_evoluciones;

		// Check if key value entered
		if ($pokemons_evoluciones->de->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($pokemons_evoluciones->a->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $pokemons_evoluciones->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $pokemons_evoluciones->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// de
		$pokemons_evoluciones->de->SetDbValueDef($rsnew, $pokemons_evoluciones->de->CurrentValue, 0, FALSE);

		// a
		$pokemons_evoluciones->a->SetDbValueDef($rsnew, $pokemons_evoluciones->a->CurrentValue, 0, FALSE);

		// nivel
		$pokemons_evoluciones->nivel->SetDbValueDef($rsnew, $pokemons_evoluciones->nivel->CurrentValue, NULL, FALSE);

		// item
		$pokemons_evoluciones->item->SetDbValueDef($rsnew, $pokemons_evoluciones->item->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $pokemons_evoluciones->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pokemons_evoluciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pokemons_evoluciones->CancelMessage <> "") {
				$this->setMessage($pokemons_evoluciones->CancelMessage);
				$pokemons_evoluciones->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$pokemons_evoluciones->Row_Inserted($rsnew);
		}
		return $AddRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
