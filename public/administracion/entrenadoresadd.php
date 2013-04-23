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
$entrenadores_add = new centrenadores_add();
$Page =& $entrenadores_add;

// Page init
$entrenadores_add->Page_Init();

// Page main
$entrenadores_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_add = new ew_Page("entrenadores_add");

// page properties
entrenadores_add.PageID = "add"; // page ID
entrenadores_add.FormID = "fentrenadoresadd"; // form ID
var EW_PAGE_ID = entrenadores_add.PageID; // for backward compatibility

// extend page with ValidateForm function
entrenadores_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_passwd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores->passwd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_iniciado"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores->iniciado->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_en_secuencia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores->en_secuencia->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_map"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores->map->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_secuencia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores->secuencia->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_escena"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores->escena->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
entrenadores_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_add->ShowMessage();
?>
<form name="fentrenadoresadd" id="fentrenadoresadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return entrenadores_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="entrenadores">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores->nombre->Visible) { // nombre ?>
	<tr<?php echo $entrenadores->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $entrenadores->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $entrenadores->nombre->EditValue ?>"<?php echo $entrenadores->nombre->EditAttributes() ?>>
</span><?php echo $entrenadores->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->zemail->Visible) { // email ?>
	<tr<?php echo $entrenadores->zemail->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" title="<?php echo $entrenadores->zemail->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $entrenadores->zemail->EditValue ?>"<?php echo $entrenadores->zemail->EditAttributes() ?>>
</span><?php echo $entrenadores->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->passwd->Visible) { // passwd ?>
	<tr<?php echo $entrenadores->passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->passwd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->passwd->CellAttributes() ?>><span id="el_passwd">
<input type="text" name="x_passwd" id="x_passwd" title="<?php echo $entrenadores->passwd->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $entrenadores->passwd->EditValue ?>"<?php echo $entrenadores->passwd->EditAttributes() ?>>
</span><?php echo $entrenadores->passwd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->iniciado->Visible) { // iniciado ?>
	<tr<?php echo $entrenadores->iniciado->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->iniciado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->iniciado->CellAttributes() ?>><span id="el_iniciado">
<input type="text" name="x_iniciado" id="x_iniciado" title="<?php echo $entrenadores->iniciado->FldTitle() ?>" size="30" value="<?php echo $entrenadores->iniciado->EditValue ?>"<?php echo $entrenadores->iniciado->EditAttributes() ?>>
</span><?php echo $entrenadores->iniciado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->en_secuencia->Visible) { // en_secuencia ?>
	<tr<?php echo $entrenadores->en_secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->en_secuencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->en_secuencia->CellAttributes() ?>><span id="el_en_secuencia">
<input type="text" name="x_en_secuencia" id="x_en_secuencia" title="<?php echo $entrenadores->en_secuencia->FldTitle() ?>" size="30" value="<?php echo $entrenadores->en_secuencia->EditValue ?>"<?php echo $entrenadores->en_secuencia->EditAttributes() ?>>
</span><?php echo $entrenadores->en_secuencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->map->Visible) { // map ?>
	<tr<?php echo $entrenadores->map->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->map->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores->map->CellAttributes() ?>><span id="el_map">
<input type="text" name="x_map" id="x_map" title="<?php echo $entrenadores->map->FldTitle() ?>" size="30" value="<?php echo $entrenadores->map->EditValue ?>"<?php echo $entrenadores->map->EditAttributes() ?>>
</span><?php echo $entrenadores->map->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $entrenadores->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->secuencia->FldCaption() ?></td>
		<td<?php echo $entrenadores->secuencia->CellAttributes() ?>><span id="el_secuencia">
<input type="text" name="x_secuencia" id="x_secuencia" title="<?php echo $entrenadores->secuencia->FldTitle() ?>" size="30" value="<?php echo $entrenadores->secuencia->EditValue ?>"<?php echo $entrenadores->secuencia->EditAttributes() ?>>
</span><?php echo $entrenadores->secuencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores->escena->Visible) { // escena ?>
	<tr<?php echo $entrenadores->escena->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores->escena->FldCaption() ?></td>
		<td<?php echo $entrenadores->escena->CellAttributes() ?>><span id="el_escena">
<input type="text" name="x_escena" id="x_escena" title="<?php echo $entrenadores->escena->FldTitle() ?>" size="30" value="<?php echo $entrenadores->escena->EditValue ?>"<?php echo $entrenadores->escena->EditAttributes() ?>>
</span><?php echo $entrenadores->escena->CustomMsg ?></td>
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
$entrenadores_add->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'entrenadores';

	// Page object name
	var $PageObjName = 'entrenadores_add';

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
	function centrenadores_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores)
		$GLOBALS["entrenadores"] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $Language, $gsFormError, $entrenadores;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $entrenadores->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $entrenadores->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$entrenadores->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $entrenadores->CurrentAction = "C"; // Copy record
		  } else {
		    $entrenadores->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($entrenadores->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("entrenadoreslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$entrenadores->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $entrenadores->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$entrenadores->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $entrenadores;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $entrenadores;
		$entrenadores->iniciado->CurrentValue = 0;
		$entrenadores->en_secuencia->CurrentValue = 1;
		$entrenadores->map->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $entrenadores;
		$entrenadores->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$entrenadores->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$entrenadores->passwd->setFormValue($objForm->GetValue("x_passwd"));
		$entrenadores->iniciado->setFormValue($objForm->GetValue("x_iniciado"));
		$entrenadores->en_secuencia->setFormValue($objForm->GetValue("x_en_secuencia"));
		$entrenadores->map->setFormValue($objForm->GetValue("x_map"));
		$entrenadores->secuencia->setFormValue($objForm->GetValue("x_secuencia"));
		$entrenadores->escena->setFormValue($objForm->GetValue("x_escena"));
		$entrenadores->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $entrenadores;
		$entrenadores->id->CurrentValue = $entrenadores->id->FormValue;
		$entrenadores->nombre->CurrentValue = $entrenadores->nombre->FormValue;
		$entrenadores->zemail->CurrentValue = $entrenadores->zemail->FormValue;
		$entrenadores->passwd->CurrentValue = $entrenadores->passwd->FormValue;
		$entrenadores->iniciado->CurrentValue = $entrenadores->iniciado->FormValue;
		$entrenadores->en_secuencia->CurrentValue = $entrenadores->en_secuencia->FormValue;
		$entrenadores->map->CurrentValue = $entrenadores->map->FormValue;
		$entrenadores->secuencia->CurrentValue = $entrenadores->secuencia->FormValue;
		$entrenadores->escena->CurrentValue = $entrenadores->escena->FormValue;
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
		$entrenadores->secuencia->setDbValue($rs->fields('secuencia'));
		$entrenadores->escena->setDbValue($rs->fields('escena'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores;

		// Initialize URLs
		// Call Row_Rendering event

		$entrenadores->Row_Rendering();

		// Common render codes for all row types
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

		// secuencia
		$entrenadores->secuencia->CellCssStyle = ""; $entrenadores->secuencia->CellCssClass = "";
		$entrenadores->secuencia->CellAttrs = array(); $entrenadores->secuencia->ViewAttrs = array(); $entrenadores->secuencia->EditAttrs = array();

		// escena
		$entrenadores->escena->CellCssStyle = ""; $entrenadores->escena->CellCssClass = "";
		$entrenadores->escena->CellAttrs = array(); $entrenadores->escena->ViewAttrs = array(); $entrenadores->escena->EditAttrs = array();
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

			// secuencia
			$entrenadores->secuencia->ViewValue = $entrenadores->secuencia->CurrentValue;
			$entrenadores->secuencia->CssStyle = "";
			$entrenadores->secuencia->CssClass = "";
			$entrenadores->secuencia->ViewCustomAttributes = "";

			// escena
			$entrenadores->escena->ViewValue = $entrenadores->escena->CurrentValue;
			$entrenadores->escena->CssStyle = "";
			$entrenadores->escena->CssClass = "";
			$entrenadores->escena->ViewCustomAttributes = "";

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

			// secuencia
			$entrenadores->secuencia->HrefValue = "";
			$entrenadores->secuencia->TooltipValue = "";

			// escena
			$entrenadores->escena->HrefValue = "";
			$entrenadores->escena->TooltipValue = "";
		} elseif ($entrenadores->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$entrenadores->nombre->EditCustomAttributes = "";
			$entrenadores->nombre->EditValue = ew_HtmlEncode($entrenadores->nombre->CurrentValue);

			// email
			$entrenadores->zemail->EditCustomAttributes = "";
			$entrenadores->zemail->EditValue = ew_HtmlEncode($entrenadores->zemail->CurrentValue);

			// passwd
			$entrenadores->passwd->EditCustomAttributes = "";
			$entrenadores->passwd->EditValue = ew_HtmlEncode($entrenadores->passwd->CurrentValue);

			// iniciado
			$entrenadores->iniciado->EditCustomAttributes = "";
			$entrenadores->iniciado->EditValue = ew_HtmlEncode($entrenadores->iniciado->CurrentValue);

			// en_secuencia
			$entrenadores->en_secuencia->EditCustomAttributes = "";
			$entrenadores->en_secuencia->EditValue = ew_HtmlEncode($entrenadores->en_secuencia->CurrentValue);

			// map
			$entrenadores->map->EditCustomAttributes = "";
			$entrenadores->map->EditValue = ew_HtmlEncode($entrenadores->map->CurrentValue);

			// secuencia
			$entrenadores->secuencia->EditCustomAttributes = "";
			$entrenadores->secuencia->EditValue = ew_HtmlEncode($entrenadores->secuencia->CurrentValue);

			// escena
			$entrenadores->escena->EditCustomAttributes = "";
			$entrenadores->escena->EditValue = ew_HtmlEncode($entrenadores->escena->CurrentValue);
		}

		// Call Row Rendered event
		if ($entrenadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $entrenadores;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($entrenadores->nombre->FormValue) && $entrenadores->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores->nombre->FldCaption();
		}
		if (!is_null($entrenadores->zemail->FormValue) && $entrenadores->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores->zemail->FldCaption();
		}
		if (!is_null($entrenadores->passwd->FormValue) && $entrenadores->passwd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores->passwd->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores->iniciado->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores->iniciado->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores->en_secuencia->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores->en_secuencia->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores->map->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores->map->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores->secuencia->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores->secuencia->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores->escena->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores->escena->FldErrMsg();
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
		global $conn, $Language, $Security, $entrenadores;
		$rsnew = array();

		// nombre
		$entrenadores->nombre->SetDbValueDef($rsnew, $entrenadores->nombre->CurrentValue, "", FALSE);

		// email
		$entrenadores->zemail->SetDbValueDef($rsnew, $entrenadores->zemail->CurrentValue, "", FALSE);

		// passwd
		$entrenadores->passwd->SetDbValueDef($rsnew, $entrenadores->passwd->CurrentValue, "", FALSE);

		// iniciado
		$entrenadores->iniciado->SetDbValueDef($rsnew, $entrenadores->iniciado->CurrentValue, 0, TRUE);

		// en_secuencia
		$entrenadores->en_secuencia->SetDbValueDef($rsnew, $entrenadores->en_secuencia->CurrentValue, 0, TRUE);

		// map
		$entrenadores->map->SetDbValueDef($rsnew, $entrenadores->map->CurrentValue, 0, TRUE);

		// secuencia
		$entrenadores->secuencia->SetDbValueDef($rsnew, $entrenadores->secuencia->CurrentValue, NULL, FALSE);

		// escena
		$entrenadores->escena->SetDbValueDef($rsnew, $entrenadores->escena->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $entrenadores->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($entrenadores->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($entrenadores->CancelMessage <> "") {
				$this->setMessage($entrenadores->CancelMessage);
				$entrenadores->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$entrenadores->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $entrenadores->id->DbValue;

			// Call Row Inserted event
			$entrenadores->Row_Inserted($rsnew);
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
