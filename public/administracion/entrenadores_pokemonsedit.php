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
$entrenadores_pokemons_edit = new centrenadores_pokemons_edit();
$Page =& $entrenadores_pokemons_edit;

// Page init
$entrenadores_pokemons_edit->Page_Init();

// Page main
$entrenadores_pokemons_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_pokemons_edit = new ew_Page("entrenadores_pokemons_edit");

// page properties
entrenadores_pokemons_edit.PageID = "edit"; // page ID
entrenadores_pokemons_edit.FormID = "fentrenadores_pokemonsedit"; // form ID
var EW_PAGE_ID = entrenadores_pokemons_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
entrenadores_pokemons_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_pokemons->entrenador->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_entrenador"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_pokemons->entrenador->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pokemon"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_pokemons->pokemon->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pokemon"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_pokemons->pokemon->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_nivel"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_pokemons->nivel->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_experiencia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_pokemons->experiencia->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
entrenadores_pokemons_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_pokemons_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_pokemons_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_pokemons->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_pokemons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_pokemons_edit->ShowMessage();
?>
<form name="fentrenadores_pokemonsedit" id="fentrenadores_pokemonsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return entrenadores_pokemons_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="entrenadores_pokemons">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores_pokemons->id->Visible) { // id ?>
	<tr<?php echo $entrenadores_pokemons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->id->FldCaption() ?></td>
		<td<?php echo $entrenadores_pokemons->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $entrenadores_pokemons->id->ViewAttributes() ?>><?php echo $entrenadores_pokemons->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($entrenadores_pokemons->id->CurrentValue) ?>">
</span><?php echo $entrenadores_pokemons->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->entrenador->Visible) { // entrenador ?>
	<tr<?php echo $entrenadores_pokemons->entrenador->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->entrenador->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_pokemons->entrenador->CellAttributes() ?>><span id="el_entrenador">
<input type="text" name="x_entrenador" id="x_entrenador" title="<?php echo $entrenadores_pokemons->entrenador->FldTitle() ?>" size="30" value="<?php echo $entrenadores_pokemons->entrenador->EditValue ?>"<?php echo $entrenadores_pokemons->entrenador->EditAttributes() ?>>
</span><?php echo $entrenadores_pokemons->entrenador->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->pokemon->Visible) { // pokemon ?>
	<tr<?php echo $entrenadores_pokemons->pokemon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->pokemon->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_pokemons->pokemon->CellAttributes() ?>><span id="el_pokemon">
<input type="text" name="x_pokemon" id="x_pokemon" title="<?php echo $entrenadores_pokemons->pokemon->FldTitle() ?>" size="30" value="<?php echo $entrenadores_pokemons->pokemon->EditValue ?>"<?php echo $entrenadores_pokemons->pokemon->EditAttributes() ?>>
</span><?php echo $entrenadores_pokemons->pokemon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->nivel->Visible) { // nivel ?>
	<tr<?php echo $entrenadores_pokemons->nivel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->nivel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_pokemons->nivel->CellAttributes() ?>><span id="el_nivel">
<input type="text" name="x_nivel" id="x_nivel" title="<?php echo $entrenadores_pokemons->nivel->FldTitle() ?>" size="30" value="<?php echo $entrenadores_pokemons->nivel->EditValue ?>"<?php echo $entrenadores_pokemons->nivel->EditAttributes() ?>>
</span><?php echo $entrenadores_pokemons->nivel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_pokemons->experiencia->Visible) { // experiencia ?>
	<tr<?php echo $entrenadores_pokemons->experiencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_pokemons->experiencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_pokemons->experiencia->CellAttributes() ?>><span id="el_experiencia">
<input type="text" name="x_experiencia" id="x_experiencia" title="<?php echo $entrenadores_pokemons->experiencia->FldTitle() ?>" size="30" value="<?php echo $entrenadores_pokemons->experiencia->EditValue ?>"<?php echo $entrenadores_pokemons->experiencia->EditAttributes() ?>>
</span><?php echo $entrenadores_pokemons->experiencia->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
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
$entrenadores_pokemons_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_pokemons_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'entrenadores_pokemons';

	// Page object name
	var $PageObjName = 'entrenadores_pokemons_edit';

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
	function centrenadores_pokemons_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_pokemons)
		$GLOBALS["entrenadores_pokemons"] = new centrenadores_pokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $entrenadores_pokemons;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$entrenadores_pokemons->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$entrenadores_pokemons->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$entrenadores_pokemons->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$entrenadores_pokemons->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$entrenadores_pokemons->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($entrenadores_pokemons->id->CurrentValue == "")
			$this->Page_Terminate("entrenadores_pokemonslist.php"); // Invalid key, return to list
		switch ($entrenadores_pokemons->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("entrenadores_pokemonslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$entrenadores_pokemons->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $entrenadores_pokemons->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$entrenadores_pokemons->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$entrenadores_pokemons->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $entrenadores_pokemons;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $entrenadores_pokemons;
		$entrenadores_pokemons->id->setFormValue($objForm->GetValue("x_id"));
		$entrenadores_pokemons->entrenador->setFormValue($objForm->GetValue("x_entrenador"));
		$entrenadores_pokemons->pokemon->setFormValue($objForm->GetValue("x_pokemon"));
		$entrenadores_pokemons->nivel->setFormValue($objForm->GetValue("x_nivel"));
		$entrenadores_pokemons->experiencia->setFormValue($objForm->GetValue("x_experiencia"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $entrenadores_pokemons;
		$this->LoadRow();
		$entrenadores_pokemons->id->CurrentValue = $entrenadores_pokemons->id->FormValue;
		$entrenadores_pokemons->entrenador->CurrentValue = $entrenadores_pokemons->entrenador->FormValue;
		$entrenadores_pokemons->pokemon->CurrentValue = $entrenadores_pokemons->pokemon->FormValue;
		$entrenadores_pokemons->nivel->CurrentValue = $entrenadores_pokemons->nivel->FormValue;
		$entrenadores_pokemons->experiencia->CurrentValue = $entrenadores_pokemons->experiencia->FormValue;
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
		} elseif ($entrenadores_pokemons->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$entrenadores_pokemons->id->EditCustomAttributes = "";
			$entrenadores_pokemons->id->EditValue = $entrenadores_pokemons->id->CurrentValue;
			$entrenadores_pokemons->id->CssStyle = "";
			$entrenadores_pokemons->id->CssClass = "";
			$entrenadores_pokemons->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_pokemons->entrenador->EditCustomAttributes = "";
			$entrenadores_pokemons->entrenador->EditValue = ew_HtmlEncode($entrenadores_pokemons->entrenador->CurrentValue);

			// pokemon
			$entrenadores_pokemons->pokemon->EditCustomAttributes = "";
			$entrenadores_pokemons->pokemon->EditValue = ew_HtmlEncode($entrenadores_pokemons->pokemon->CurrentValue);

			// nivel
			$entrenadores_pokemons->nivel->EditCustomAttributes = "";
			$entrenadores_pokemons->nivel->EditValue = ew_HtmlEncode($entrenadores_pokemons->nivel->CurrentValue);

			// experiencia
			$entrenadores_pokemons->experiencia->EditCustomAttributes = "";
			$entrenadores_pokemons->experiencia->EditValue = ew_HtmlEncode($entrenadores_pokemons->experiencia->CurrentValue);

			// Edit refer script
			// id

			$entrenadores_pokemons->id->HrefValue = "";

			// entrenador
			$entrenadores_pokemons->entrenador->HrefValue = "";

			// pokemon
			$entrenadores_pokemons->pokemon->HrefValue = "";

			// nivel
			$entrenadores_pokemons->nivel->HrefValue = "";

			// experiencia
			$entrenadores_pokemons->experiencia->HrefValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_pokemons->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $entrenadores_pokemons;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($entrenadores_pokemons->entrenador->FormValue) && $entrenadores_pokemons->entrenador->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_pokemons->entrenador->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_pokemons->entrenador->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_pokemons->entrenador->FldErrMsg();
		}
		if (!is_null($entrenadores_pokemons->pokemon->FormValue) && $entrenadores_pokemons->pokemon->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_pokemons->pokemon->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_pokemons->pokemon->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_pokemons->pokemon->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores_pokemons->nivel->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_pokemons->nivel->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores_pokemons->experiencia->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_pokemons->experiencia->FldErrMsg();
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
		global $conn, $Security, $Language, $entrenadores_pokemons;
		$sFilter = $entrenadores_pokemons->KeyFilter();
		$entrenadores_pokemons->CurrentFilter = $sFilter;
		$sSql = $entrenadores_pokemons->SQL();
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

			// entrenador
			$entrenadores_pokemons->entrenador->SetDbValueDef($rsnew, $entrenadores_pokemons->entrenador->CurrentValue, 0, FALSE);

			// pokemon
			$entrenadores_pokemons->pokemon->SetDbValueDef($rsnew, $entrenadores_pokemons->pokemon->CurrentValue, 0, FALSE);

			// nivel
			$entrenadores_pokemons->nivel->SetDbValueDef($rsnew, $entrenadores_pokemons->nivel->CurrentValue, 0, FALSE);

			// experiencia
			$entrenadores_pokemons->experiencia->SetDbValueDef($rsnew, $entrenadores_pokemons->experiencia->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $entrenadores_pokemons->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($entrenadores_pokemons->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($entrenadores_pokemons->CancelMessage <> "") {
					$this->setMessage($entrenadores_pokemons->CancelMessage);
					$entrenadores_pokemons->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$entrenadores_pokemons->Row_Updated($rsold, $rsnew);
		$rs->Close();
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
