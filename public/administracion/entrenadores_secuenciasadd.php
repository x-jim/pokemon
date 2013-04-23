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
$entrenadores_secuencias_add = new centrenadores_secuencias_add();
$Page =& $entrenadores_secuencias_add;

// Page init
$entrenadores_secuencias_add->Page_Init();

// Page main
$entrenadores_secuencias_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_secuencias_add = new ew_Page("entrenadores_secuencias_add");

// page properties
entrenadores_secuencias_add.PageID = "add"; // page ID
entrenadores_secuencias_add.FormID = "fentrenadores_secuenciasadd"; // form ID
var EW_PAGE_ID = entrenadores_secuencias_add.PageID; // for backward compatibility

// extend page with ValidateForm function
entrenadores_secuencias_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_entrenador"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_secuencias->entrenador->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_entrenador"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_secuencias->entrenador->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_secuencia"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_secuencias->secuencia->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_secuencia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_secuencias->secuencia->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_escena"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_secuencias->escena->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_escena"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_secuencias->escena->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_secuencias->fecha->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_secuencias->fecha->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
entrenadores_secuencias_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_secuencias_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_secuencias_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_secuencias->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_secuencias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_secuencias_add->ShowMessage();
?>
<form name="fentrenadores_secuenciasadd" id="fentrenadores_secuenciasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return entrenadores_secuencias_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="entrenadores_secuencias">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores_secuencias->entrenador->Visible) { // entrenador ?>
	<tr<?php echo $entrenadores_secuencias->entrenador->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->entrenador->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_secuencias->entrenador->CellAttributes() ?>><span id="el_entrenador">
<input type="text" name="x_entrenador" id="x_entrenador" title="<?php echo $entrenadores_secuencias->entrenador->FldTitle() ?>" size="30" value="<?php echo $entrenadores_secuencias->entrenador->EditValue ?>"<?php echo $entrenadores_secuencias->entrenador->EditAttributes() ?>>
</span><?php echo $entrenadores_secuencias->entrenador->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $entrenadores_secuencias->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->secuencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_secuencias->secuencia->CellAttributes() ?>><span id="el_secuencia">
<input type="text" name="x_secuencia" id="x_secuencia" title="<?php echo $entrenadores_secuencias->secuencia->FldTitle() ?>" size="30" value="<?php echo $entrenadores_secuencias->secuencia->EditValue ?>"<?php echo $entrenadores_secuencias->secuencia->EditAttributes() ?>>
</span><?php echo $entrenadores_secuencias->secuencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->escena->Visible) { // escena ?>
	<tr<?php echo $entrenadores_secuencias->escena->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->escena->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_secuencias->escena->CellAttributes() ?>><span id="el_escena">
<input type="text" name="x_escena" id="x_escena" title="<?php echo $entrenadores_secuencias->escena->FldTitle() ?>" size="30" value="<?php echo $entrenadores_secuencias->escena->EditValue ?>"<?php echo $entrenadores_secuencias->escena->EditAttributes() ?>>
</span><?php echo $entrenadores_secuencias->escena->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_secuencias->fecha->Visible) { // fecha ?>
	<tr<?php echo $entrenadores_secuencias->fecha->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_secuencias->fecha->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_secuencias->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" title="<?php echo $entrenadores_secuencias->fecha->FldTitle() ?>" value="<?php echo $entrenadores_secuencias->fecha->EditValue ?>"<?php echo $entrenadores_secuencias->fecha->EditAttributes() ?>>
</span><?php echo $entrenadores_secuencias->fecha->CustomMsg ?></td>
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
$entrenadores_secuencias_add->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_secuencias_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'entrenadores_secuencias';

	// Page object name
	var $PageObjName = 'entrenadores_secuencias_add';

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
	function centrenadores_secuencias_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_secuencias)
		$GLOBALS["entrenadores_secuencias"] = new centrenadores_secuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $Language, $gsFormError, $entrenadores_secuencias;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $entrenadores_secuencias->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $entrenadores_secuencias->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$entrenadores_secuencias->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $entrenadores_secuencias->CurrentAction = "C"; // Copy record
		  } else {
		    $entrenadores_secuencias->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($entrenadores_secuencias->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("entrenadores_secuenciaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$entrenadores_secuencias->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $entrenadores_secuencias->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$entrenadores_secuencias->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $entrenadores_secuencias;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $entrenadores_secuencias;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $entrenadores_secuencias;
		$entrenadores_secuencias->entrenador->setFormValue($objForm->GetValue("x_entrenador"));
		$entrenadores_secuencias->secuencia->setFormValue($objForm->GetValue("x_secuencia"));
		$entrenadores_secuencias->escena->setFormValue($objForm->GetValue("x_escena"));
		$entrenadores_secuencias->fecha->setFormValue($objForm->GetValue("x_fecha"));
		$entrenadores_secuencias->fecha->CurrentValue = ew_UnFormatDateTime($entrenadores_secuencias->fecha->CurrentValue, 7);
		$entrenadores_secuencias->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $entrenadores_secuencias;
		$entrenadores_secuencias->id->CurrentValue = $entrenadores_secuencias->id->FormValue;
		$entrenadores_secuencias->entrenador->CurrentValue = $entrenadores_secuencias->entrenador->FormValue;
		$entrenadores_secuencias->secuencia->CurrentValue = $entrenadores_secuencias->secuencia->FormValue;
		$entrenadores_secuencias->escena->CurrentValue = $entrenadores_secuencias->escena->FormValue;
		$entrenadores_secuencias->fecha->CurrentValue = $entrenadores_secuencias->fecha->FormValue;
		$entrenadores_secuencias->fecha->CurrentValue = ew_UnFormatDateTime($entrenadores_secuencias->fecha->CurrentValue, 7);
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
		// Call Row_Rendering event

		$entrenadores_secuencias->Row_Rendering();

		// Common render codes for all row types
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
		} elseif ($entrenadores_secuencias->RowType == EW_ROWTYPE_ADD) { // Add row

			// entrenador
			$entrenadores_secuencias->entrenador->EditCustomAttributes = "";
			$entrenadores_secuencias->entrenador->EditValue = ew_HtmlEncode($entrenadores_secuencias->entrenador->CurrentValue);

			// secuencia
			$entrenadores_secuencias->secuencia->EditCustomAttributes = "";
			$entrenadores_secuencias->secuencia->EditValue = ew_HtmlEncode($entrenadores_secuencias->secuencia->CurrentValue);

			// escena
			$entrenadores_secuencias->escena->EditCustomAttributes = "";
			$entrenadores_secuencias->escena->EditValue = ew_HtmlEncode($entrenadores_secuencias->escena->CurrentValue);

			// fecha
			$entrenadores_secuencias->fecha->EditCustomAttributes = "";
			$entrenadores_secuencias->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($entrenadores_secuencias->fecha->CurrentValue, 7));
		}

		// Call Row Rendered event
		if ($entrenadores_secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_secuencias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $entrenadores_secuencias;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($entrenadores_secuencias->entrenador->FormValue) && $entrenadores_secuencias->entrenador->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_secuencias->entrenador->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_secuencias->entrenador->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_secuencias->entrenador->FldErrMsg();
		}
		if (!is_null($entrenadores_secuencias->secuencia->FormValue) && $entrenadores_secuencias->secuencia->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_secuencias->secuencia->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_secuencias->secuencia->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_secuencias->secuencia->FldErrMsg();
		}
		if (!is_null($entrenadores_secuencias->escena->FormValue) && $entrenadores_secuencias->escena->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_secuencias->escena->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_secuencias->escena->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_secuencias->escena->FldErrMsg();
		}
		if (!is_null($entrenadores_secuencias->fecha->FormValue) && $entrenadores_secuencias->fecha->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_secuencias->fecha->FldCaption();
		}
		if (!ew_CheckEuroDate($entrenadores_secuencias->fecha->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_secuencias->fecha->FldErrMsg();
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
		global $conn, $Language, $Security, $entrenadores_secuencias;
		$rsnew = array();

		// entrenador
		$entrenadores_secuencias->entrenador->SetDbValueDef($rsnew, $entrenadores_secuencias->entrenador->CurrentValue, 0, FALSE);

		// secuencia
		$entrenadores_secuencias->secuencia->SetDbValueDef($rsnew, $entrenadores_secuencias->secuencia->CurrentValue, 0, FALSE);

		// escena
		$entrenadores_secuencias->escena->SetDbValueDef($rsnew, $entrenadores_secuencias->escena->CurrentValue, 0, FALSE);

		// fecha
		$entrenadores_secuencias->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($entrenadores_secuencias->fecha->CurrentValue, 7, FALSE), ew_CurrentDate());

		// Call Row Inserting event
		$bInsertRow = $entrenadores_secuencias->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($entrenadores_secuencias->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($entrenadores_secuencias->CancelMessage <> "") {
				$this->setMessage($entrenadores_secuencias->CancelMessage);
				$entrenadores_secuencias->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$entrenadores_secuencias->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $entrenadores_secuencias->id->DbValue;

			// Call Row Inserted event
			$entrenadores_secuencias->Row_Inserted($rsnew);
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
