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
$pokemons_edit = new cpokemons_edit();
$Page =& $pokemons_edit;

// Page init
$pokemons_edit->Page_Init();

// Page main
$pokemons_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_edit = new ew_Page("pokemons_edit");

// page properties
pokemons_edit.PageID = "edit"; // page ID
pokemons_edit.FormID = "fpokemonsedit"; // form ID
var EW_PAGE_ID = pokemons_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
pokemons_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_numero"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pokemons->numero->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_numero"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pokemons->numero->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pokemons->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_icono"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
pokemons_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons->TableCaption() ?><br><br>
<a href="<?php echo $pokemons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_edit->ShowMessage();
?>
<form name="fpokemonsedit" id="fpokemonsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return pokemons_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="pokemons">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pokemons->numero->Visible) { // numero ?>
	<tr<?php echo $pokemons->numero->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->numero->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pokemons->numero->CellAttributes() ?>><span id="el_numero">
<input type="text" name="x_numero" id="x_numero" title="<?php echo $pokemons->numero->FldTitle() ?>" size="30" value="<?php echo $pokemons->numero->EditValue ?>"<?php echo $pokemons->numero->EditAttributes() ?>>
</span><?php echo $pokemons->numero->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons->nombre->Visible) { // nombre ?>
	<tr<?php echo $pokemons->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pokemons->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $pokemons->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $pokemons->nombre->EditValue ?>"<?php echo $pokemons->nombre->EditAttributes() ?>>
</span><?php echo $pokemons->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons->imagen->Visible) { // imagen ?>
	<tr<?php echo $pokemons->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->imagen->FldCaption() ?></td>
		<td<?php echo $pokemons->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($pokemons->imagen->HrefValue <> "" || $pokemons->imagen->TooltipValue <> "") { ?>
<?php if (!empty($pokemons->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $pokemons->imagen->HrefValue ?>"><?php echo $pokemons->imagen->EditValue ?></a>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($pokemons->imagen->Upload->DbValue)) { ?>
<?php echo $pokemons->imagen->EditValue ?>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($pokemons->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $pokemons->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$pokemons->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" title="<?php echo $pokemons->imagen->FldTitle() ?>" size="30"<?php echo $pokemons->imagen->EditAttributes() ?>>
</div>
</span><?php echo $pokemons->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pokemons->icono->Visible) { // icono ?>
	<tr<?php echo $pokemons->icono->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $pokemons->icono->FldCaption() ?></td>
		<td<?php echo $pokemons->icono->CellAttributes() ?>><span id="el_icono">
<div id="old_x_icono">
<?php if ($pokemons->icono->HrefValue <> "" || $pokemons->icono->TooltipValue <> "") { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_icono">
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<label><input type="radio" name="a_icono" id="a_icono" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_icono" id="a_icono" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_icono" id="a_icono" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $pokemons->icono->EditAttrs["onchange"] = "this.form.a_icono[2].checked=true;" . @$pokemons->icono->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_icono" id="a_icono" value="3">
<?php } ?>
<input type="file" name="x_icono" id="x_icono" title="<?php echo $pokemons->icono->FldTitle() ?>" size="30"<?php echo $pokemons->icono->EditAttributes() ?>>
</div>
</span><?php echo $pokemons->icono->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($pokemons->id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$pokemons_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'pokemons';

	// Page object name
	var $PageObjName = 'pokemons_edit';

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
	function cpokemons_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons)
		$GLOBALS["pokemons"] = new cpokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $pokemons;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$pokemons->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$pokemons->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pokemons->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$pokemons->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$pokemons->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($pokemons->id->CurrentValue == "")
			$this->Page_Terminate("pokemonslist.php"); // Invalid key, return to list
		switch ($pokemons->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pokemonslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$pokemons->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $pokemons->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$pokemons->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$pokemons->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pokemons;

		// Get upload data
			if ($pokemons->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $pokemons->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			if ($pokemons->icono->Upload->UploadFile()) {

				// No action required
			} else {
				echo $pokemons->icono->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pokemons;
		$pokemons->numero->setFormValue($objForm->GetValue("x_numero"));
		$pokemons->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$pokemons->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pokemons;
		$pokemons->id->CurrentValue = $pokemons->id->FormValue;
		$this->LoadRow();
		$pokemons->numero->CurrentValue = $pokemons->numero->FormValue;
		$pokemons->nombre->CurrentValue = $pokemons->nombre->FormValue;
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
		$pokemons->imagen->Upload->DbValue = $rs->fields('imagen');
		$pokemons->icono->Upload->DbValue = $rs->fields('icono');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons;

		// Initialize URLs
		// Call Row_Rendering event

		$pokemons->Row_Rendering();

		// Common render codes for all row types
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
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->ViewValue = $pokemons->imagen->Upload->DbValue;
			} else {
				$pokemons->imagen->ViewValue = "";
			}
			$pokemons->imagen->CssStyle = "";
			$pokemons->imagen->CssClass = "";
			$pokemons->imagen->ViewCustomAttributes = "";

			// icono
			if (!ew_Empty($pokemons->icono->Upload->DbValue)) {
				$pokemons->icono->ViewValue = $pokemons->icono->Upload->DbValue;
				$pokemons->icono->ImageWidth = 32;
				$pokemons->icono->ImageHeight = 32;
				$pokemons->icono->ImageAlt = $pokemons->icono->FldAlt();
			} else {
				$pokemons->icono->ViewValue = "";
			}
			$pokemons->icono->CssStyle = "";
			$pokemons->icono->CssClass = "";
			$pokemons->icono->ViewCustomAttributes = "";

			// numero
			$pokemons->numero->HrefValue = "";
			$pokemons->numero->TooltipValue = "";

			// nombre
			$pokemons->nombre->HrefValue = "";
			$pokemons->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->HrefValue = ew_UploadPathEx(FALSE, $pokemons->imagen->UploadPath) . ((!empty($pokemons->imagen->ViewValue)) ? $pokemons->imagen->ViewValue : $pokemons->imagen->CurrentValue);
				if ($pokemons->Export <> "") $pokemons->imagen->HrefValue = ew_ConvertFullUrl($pokemons->imagen->HrefValue);
			} else {
				$pokemons->imagen->HrefValue = "";
			}
			$pokemons->imagen->TooltipValue = "";

			// icono
			$pokemons->icono->HrefValue = "";
			$pokemons->icono->TooltipValue = "";
		} elseif ($pokemons->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// numero
			$pokemons->numero->EditCustomAttributes = "";
			$pokemons->numero->EditValue = ew_HtmlEncode($pokemons->numero->CurrentValue);

			// nombre
			$pokemons->nombre->EditCustomAttributes = "";
			$pokemons->nombre->EditValue = ew_HtmlEncode($pokemons->nombre->CurrentValue);

			// imagen
			$pokemons->imagen->EditCustomAttributes = "";
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->EditValue = $pokemons->imagen->Upload->DbValue;
			} else {
				$pokemons->imagen->EditValue = "";
			}

			// icono
			$pokemons->icono->EditCustomAttributes = "";
			if (!ew_Empty($pokemons->icono->Upload->DbValue)) {
				$pokemons->icono->EditValue = $pokemons->icono->Upload->DbValue;
				$pokemons->icono->ImageWidth = 32;
				$pokemons->icono->ImageHeight = 32;
				$pokemons->icono->ImageAlt = $pokemons->icono->FldAlt();
			} else {
				$pokemons->icono->EditValue = "";
			}

			// Edit refer script
			// numero

			$pokemons->numero->HrefValue = "";

			// nombre
			$pokemons->nombre->HrefValue = "";

			// imagen
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->HrefValue = ew_UploadPathEx(FALSE, $pokemons->imagen->UploadPath) . ((!empty($pokemons->imagen->EditValue)) ? $pokemons->imagen->EditValue : $pokemons->imagen->CurrentValue);
				if ($pokemons->Export <> "") $pokemons->imagen->HrefValue = ew_ConvertFullUrl($pokemons->imagen->HrefValue);
			} else {
				$pokemons->imagen->HrefValue = "";
			}

			// icono
			$pokemons->icono->HrefValue = "";
		}

		// Call Row Rendered event
		if ($pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pokemons;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($pokemons->imagen->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($pokemons->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $pokemons->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (!ew_CheckFileType($pokemons->icono->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($pokemons->icono->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $pokemons->icono->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pokemons->numero->FormValue) && $pokemons->numero->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pokemons->numero->FldCaption();
		}
		if (!ew_CheckInteger($pokemons->numero->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pokemons->numero->FldErrMsg();
		}
		if (!is_null($pokemons->nombre->FormValue) && $pokemons->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pokemons->nombre->FldCaption();
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $pokemons;
		$sFilter = $pokemons->KeyFilter();
		$pokemons->CurrentFilter = $sFilter;
		$sSql = $pokemons->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// numero
			$pokemons->numero->SetDbValueDef($rsnew, $pokemons->numero->CurrentValue, 0, FALSE);

			// nombre
			$pokemons->nombre->SetDbValueDef($rsnew, $pokemons->nombre->CurrentValue, "", FALSE);

			// imagen
			$pokemons->imagen->Upload->SaveToSession(); // Save file value to Session
						if ($pokemons->imagen->Upload->Action == "2" || $pokemons->imagen->Upload->Action == "3") { // Update/Remove
			$pokemons->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($pokemons->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				if ($pokemons->imagen->Upload->FileName == $pokemons->imagen->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['imagen'] = $pokemons->imagen->Upload->FileName;
				} else {
					$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $pokemons->imagen->UploadPath), $pokemons->imagen->Upload->FileName);
				}
			}
			}

			// icono
			$pokemons->icono->Upload->SaveToSession(); // Save file value to Session
						if ($pokemons->icono->Upload->Action == "2" || $pokemons->icono->Upload->Action == "3") { // Update/Remove
			$pokemons->icono->Upload->DbValue = $rs->fields('icono'); // Get original value
			if (is_null($pokemons->icono->Upload->Value)) {
				$rsnew['icono'] = NULL;
			} else {
				if ($pokemons->icono->Upload->FileName == $pokemons->icono->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['icono'] = $pokemons->icono->Upload->FileName;
				} else {
					$rsnew['icono'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $pokemons->icono->UploadPath), $pokemons->icono->Upload->FileName);
				}
			}
			}

			// Call Row Updating event
			$bUpdateRow = $pokemons->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($pokemons->imagen->Upload->Value)) {
				if ($pokemons->imagen->Upload->FileName == $pokemons->imagen->Upload->DbValue) { // Overwrite if same file name
					$pokemons->imagen->Upload->SaveToFile($pokemons->imagen->UploadPath, $rsnew['imagen'], TRUE);
					$pokemons->imagen->Upload->DbValue = ""; // No need to delete any more
				} else {
					$pokemons->imagen->Upload->SaveToFile($pokemons->imagen->UploadPath, $rsnew['imagen'], FALSE);
				}
			}
			if ($pokemons->imagen->Upload->Action == "2" || $pokemons->imagen->Upload->Action == "3") { // Update/Remove
				if ($pokemons->imagen->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $pokemons->imagen->UploadPath) . $pokemons->imagen->Upload->DbValue);
			}
			if (!ew_Empty($pokemons->icono->Upload->Value)) {
				if ($pokemons->icono->Upload->FileName == $pokemons->icono->Upload->DbValue) { // Overwrite if same file name
					$pokemons->icono->Upload->SaveToFile($pokemons->icono->UploadPath, $rsnew['icono'], TRUE);
					$pokemons->icono->Upload->DbValue = ""; // No need to delete any more
				} else {
					$pokemons->icono->Upload->SaveToFile($pokemons->icono->UploadPath, $rsnew['icono'], FALSE);
				}
			}
			if ($pokemons->icono->Upload->Action == "2" || $pokemons->icono->Upload->Action == "3") { // Update/Remove
				if ($pokemons->icono->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($pokemons->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($pokemons->CancelMessage <> "") {
					$this->setMessage($pokemons->CancelMessage);
					$pokemons->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$pokemons->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// imagen
		$pokemons->imagen->Upload->RemoveFromSession(); // Remove file value from Session

		// icono
		$pokemons->icono->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
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
