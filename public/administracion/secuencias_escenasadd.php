<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "secuencias_escenasinfo.php" ?>
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
$secuencias_escenas_add = new csecuencias_escenas_add();
$Page =& $secuencias_escenas_add;

// Page init
$secuencias_escenas_add->Page_Init();

// Page main
$secuencias_escenas_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_escenas_add = new ew_Page("secuencias_escenas_add");

// page properties
secuencias_escenas_add.PageID = "add"; // page ID
secuencias_escenas_add.FormID = "fsecuencias_escenasadd"; // form ID
var EW_PAGE_ID = secuencias_escenas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
secuencias_escenas_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_secuencia"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($secuencias_escenas->secuencia->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($secuencias_escenas->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($secuencias_escenas->orden->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
secuencias_escenas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_escenas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_escenas_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias_escenas->TableCaption() ?><br><br>
<a href="<?php echo $secuencias_escenas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_escenas_add->ShowMessage();
?>
<form name="fsecuencias_escenasadd" id="fsecuencias_escenasadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return secuencias_escenas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="secuencias_escenas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secuencias_escenas->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $secuencias_escenas->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->secuencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $secuencias_escenas->secuencia->CellAttributes() ?>><span id="el_secuencia">
<?php if ($secuencias_escenas->secuencia->getSessionValue() <> "") { ?>
<div<?php echo $secuencias_escenas->secuencia->ViewAttributes() ?>><?php echo $secuencias_escenas->secuencia->ViewValue ?></div>
<input type="hidden" id="x_secuencia" name="x_secuencia" value="<?php echo ew_HtmlEncode($secuencias_escenas->secuencia->CurrentValue) ?>">
<?php } else { ?>
<select id="x_secuencia" name="x_secuencia" title="<?php echo $secuencias_escenas->secuencia->FldTitle() ?>"<?php echo $secuencias_escenas->secuencia->EditAttributes() ?>>
<?php
if (is_array($secuencias_escenas->secuencia->EditValue)) {
	$arwrk = $secuencias_escenas->secuencia->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($secuencias_escenas->secuencia->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $secuencias_escenas->secuencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->nombre->Visible) { // nombre ?>
	<tr<?php echo $secuencias_escenas->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $secuencias_escenas->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $secuencias_escenas->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $secuencias_escenas->nombre->EditValue ?>"<?php echo $secuencias_escenas->nombre->EditAttributes() ?>>
</span><?php echo $secuencias_escenas->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->imagen->Visible) { // imagen ?>
	<tr<?php echo $secuencias_escenas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->imagen->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->imagen->CellAttributes() ?>><span id="el_imagen">
<input type="file" name="x_imagen" id="x_imagen" title="<?php echo $secuencias_escenas->imagen->FldTitle() ?>" size="30"<?php echo $secuencias_escenas->imagen->EditAttributes() ?>>
</div>
</span><?php echo $secuencias_escenas->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->texto->Visible) { // texto ?>
	<tr<?php echo $secuencias_escenas->texto->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->texto->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->texto->CellAttributes() ?>><span id="el_texto">
<textarea name="x_texto" id="x_texto" title="<?php echo $secuencias_escenas->texto->FldTitle() ?>" cols="35" rows="4"<?php echo $secuencias_escenas->texto->EditAttributes() ?>><?php echo $secuencias_escenas->texto->EditValue ?></textarea>
</span><?php echo $secuencias_escenas->texto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->script->Visible) { // script ?>
	<tr<?php echo $secuencias_escenas->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->script->FldCaption() ?></td>
		<td<?php echo $secuencias_escenas->script->CellAttributes() ?>><span id="el_script">
<textarea name="x_script" id="x_script" title="<?php echo $secuencias_escenas->script->FldTitle() ?>" cols="35" rows="8"<?php echo $secuencias_escenas->script->EditAttributes() ?>><?php echo $secuencias_escenas->script->EditValue ?></textarea>
</span><?php echo $secuencias_escenas->script->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secuencias_escenas->orden->Visible) { // orden ?>
	<tr<?php echo $secuencias_escenas->orden->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias_escenas->orden->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $secuencias_escenas->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" title="<?php echo $secuencias_escenas->orden->FldTitle() ?>" size="30" value="<?php echo $secuencias_escenas->orden->EditValue ?>"<?php echo $secuencias_escenas->orden->EditAttributes() ?>>
</span><?php echo $secuencias_escenas->orden->CustomMsg ?></td>
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
$secuencias_escenas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_escenas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'secuencias_escenas';

	// Page object name
	var $PageObjName = 'secuencias_escenas_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secuencias_escenas;
		if ($secuencias_escenas->UseTokenInUrl) $PageUrl .= "t=" . $secuencias_escenas->TableVar . "&"; // Add page token
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
		global $objForm, $secuencias_escenas;
		if ($secuencias_escenas->UseTokenInUrl) {
			if ($objForm)
				return ($secuencias_escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secuencias_escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecuencias_escenas_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias_escenas)
		$GLOBALS["secuencias_escenas"] = new csecuencias_escenas();

		// Table object (secuencias)
		$GLOBALS['secuencias'] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias_escenas', TRUE);

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
		global $secuencias_escenas;

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
		global $objForm, $Language, $gsFormError, $secuencias_escenas;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $secuencias_escenas->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $secuencias_escenas->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$secuencias_escenas->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $secuencias_escenas->CurrentAction = "C"; // Copy record
		  } else {
		    $secuencias_escenas->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($secuencias_escenas->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("secuencias_escenaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$secuencias_escenas->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $secuencias_escenas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$secuencias_escenas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $secuencias_escenas;

		// Get upload data
			if ($secuencias_escenas->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $secuencias_escenas->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $secuencias_escenas;
		$secuencias_escenas->imagen->CurrentValue = NULL; // Clear file related field
		$secuencias_escenas->orden->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $secuencias_escenas;
		$secuencias_escenas->secuencia->setFormValue($objForm->GetValue("x_secuencia"));
		$secuencias_escenas->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$secuencias_escenas->texto->setFormValue($objForm->GetValue("x_texto"));
		$secuencias_escenas->script->setFormValue($objForm->GetValue("x_script"));
		$secuencias_escenas->orden->setFormValue($objForm->GetValue("x_orden"));
		$secuencias_escenas->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $secuencias_escenas;
		$secuencias_escenas->id->CurrentValue = $secuencias_escenas->id->FormValue;
		$secuencias_escenas->secuencia->CurrentValue = $secuencias_escenas->secuencia->FormValue;
		$secuencias_escenas->nombre->CurrentValue = $secuencias_escenas->nombre->FormValue;
		$secuencias_escenas->texto->CurrentValue = $secuencias_escenas->texto->FormValue;
		$secuencias_escenas->script->CurrentValue = $secuencias_escenas->script->FormValue;
		$secuencias_escenas->orden->CurrentValue = $secuencias_escenas->orden->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secuencias_escenas;
		$sFilter = $secuencias_escenas->KeyFilter();

		// Call Row Selecting event
		$secuencias_escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secuencias_escenas->CurrentFilter = $sFilter;
		$sSql = $secuencias_escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$secuencias_escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $secuencias_escenas;
		$secuencias_escenas->id->setDbValue($rs->fields('id'));
		$secuencias_escenas->secuencia->setDbValue($rs->fields('secuencia'));
		$secuencias_escenas->nombre->setDbValue($rs->fields('nombre'));
		$secuencias_escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$secuencias_escenas->texto->setDbValue($rs->fields('texto'));
		$secuencias_escenas->script->setDbValue($rs->fields('script'));
		$secuencias_escenas->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secuencias_escenas;

		// Initialize URLs
		// Call Row_Rendering event

		$secuencias_escenas->Row_Rendering();

		// Common render codes for all row types
		// secuencia

		$secuencias_escenas->secuencia->CellCssStyle = ""; $secuencias_escenas->secuencia->CellCssClass = "";
		$secuencias_escenas->secuencia->CellAttrs = array(); $secuencias_escenas->secuencia->ViewAttrs = array(); $secuencias_escenas->secuencia->EditAttrs = array();

		// nombre
		$secuencias_escenas->nombre->CellCssStyle = ""; $secuencias_escenas->nombre->CellCssClass = "";
		$secuencias_escenas->nombre->CellAttrs = array(); $secuencias_escenas->nombre->ViewAttrs = array(); $secuencias_escenas->nombre->EditAttrs = array();

		// imagen
		$secuencias_escenas->imagen->CellCssStyle = ""; $secuencias_escenas->imagen->CellCssClass = "";
		$secuencias_escenas->imagen->CellAttrs = array(); $secuencias_escenas->imagen->ViewAttrs = array(); $secuencias_escenas->imagen->EditAttrs = array();

		// texto
		$secuencias_escenas->texto->CellCssStyle = ""; $secuencias_escenas->texto->CellCssClass = "";
		$secuencias_escenas->texto->CellAttrs = array(); $secuencias_escenas->texto->ViewAttrs = array(); $secuencias_escenas->texto->EditAttrs = array();

		// script
		$secuencias_escenas->script->CellCssStyle = ""; $secuencias_escenas->script->CellCssClass = "";
		$secuencias_escenas->script->CellAttrs = array(); $secuencias_escenas->script->ViewAttrs = array(); $secuencias_escenas->script->EditAttrs = array();

		// orden
		$secuencias_escenas->orden->CellCssStyle = ""; $secuencias_escenas->orden->CellCssClass = "";
		$secuencias_escenas->orden->CellAttrs = array(); $secuencias_escenas->orden->ViewAttrs = array(); $secuencias_escenas->orden->EditAttrs = array();
		if ($secuencias_escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$secuencias_escenas->id->ViewValue = $secuencias_escenas->id->CurrentValue;
			$secuencias_escenas->id->CssStyle = "";
			$secuencias_escenas->id->CssClass = "";
			$secuencias_escenas->id->ViewCustomAttributes = "";

			// secuencia
			if (strval($secuencias_escenas->secuencia->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($secuencias_escenas->secuencia->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$secuencias_escenas->secuencia->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$secuencias_escenas->secuencia->ViewValue = $secuencias_escenas->secuencia->CurrentValue;
				}
			} else {
				$secuencias_escenas->secuencia->ViewValue = NULL;
			}
			$secuencias_escenas->secuencia->CssStyle = "";
			$secuencias_escenas->secuencia->CssClass = "";
			$secuencias_escenas->secuencia->ViewCustomAttributes = "";

			// nombre
			$secuencias_escenas->nombre->ViewValue = $secuencias_escenas->nombre->CurrentValue;
			$secuencias_escenas->nombre->CssStyle = "";
			$secuencias_escenas->nombre->CssClass = "";
			$secuencias_escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($secuencias_escenas->imagen->Upload->DbValue)) {
				$secuencias_escenas->imagen->ViewValue = $secuencias_escenas->imagen->Upload->DbValue;
			} else {
				$secuencias_escenas->imagen->ViewValue = "";
			}
			$secuencias_escenas->imagen->CssStyle = "";
			$secuencias_escenas->imagen->CssClass = "";
			$secuencias_escenas->imagen->ViewCustomAttributes = "";

			// texto
			$secuencias_escenas->texto->ViewValue = $secuencias_escenas->texto->CurrentValue;
			$secuencias_escenas->texto->CssStyle = "";
			$secuencias_escenas->texto->CssClass = "";
			$secuencias_escenas->texto->ViewCustomAttributes = "";

			// script
			$secuencias_escenas->script->ViewValue = $secuencias_escenas->script->CurrentValue;
			$secuencias_escenas->script->CssStyle = "";
			$secuencias_escenas->script->CssClass = "";
			$secuencias_escenas->script->ViewCustomAttributes = "";

			// orden
			$secuencias_escenas->orden->ViewValue = $secuencias_escenas->orden->CurrentValue;
			$secuencias_escenas->orden->CssStyle = "";
			$secuencias_escenas->orden->CssClass = "";
			$secuencias_escenas->orden->ViewCustomAttributes = "";

			// secuencia
			$secuencias_escenas->secuencia->HrefValue = "";
			$secuencias_escenas->secuencia->TooltipValue = "";

			// nombre
			$secuencias_escenas->nombre->HrefValue = "";
			$secuencias_escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($secuencias_escenas->imagen->Upload->DbValue)) {
				$secuencias_escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $secuencias_escenas->imagen->UploadPath) . ((!empty($secuencias_escenas->imagen->ViewValue)) ? $secuencias_escenas->imagen->ViewValue : $secuencias_escenas->imagen->CurrentValue);
				if ($secuencias_escenas->Export <> "") $secuencias_escenas->imagen->HrefValue = ew_ConvertFullUrl($secuencias_escenas->imagen->HrefValue);
			} else {
				$secuencias_escenas->imagen->HrefValue = "";
			}
			$secuencias_escenas->imagen->TooltipValue = "";

			// texto
			$secuencias_escenas->texto->HrefValue = "";
			$secuencias_escenas->texto->TooltipValue = "";

			// script
			$secuencias_escenas->script->HrefValue = "";
			$secuencias_escenas->script->TooltipValue = "";

			// orden
			$secuencias_escenas->orden->HrefValue = "";
			$secuencias_escenas->orden->TooltipValue = "";
		} elseif ($secuencias_escenas->RowType == EW_ROWTYPE_ADD) { // Add row

			// secuencia
			$secuencias_escenas->secuencia->EditCustomAttributes = "";
			if ($secuencias_escenas->secuencia->getSessionValue() <> "") {
				$secuencias_escenas->secuencia->CurrentValue = $secuencias_escenas->secuencia->getSessionValue();
			if (strval($secuencias_escenas->secuencia->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($secuencias_escenas->secuencia->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$secuencias_escenas->secuencia->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$secuencias_escenas->secuencia->ViewValue = $secuencias_escenas->secuencia->CurrentValue;
				}
			} else {
				$secuencias_escenas->secuencia->ViewValue = NULL;
			}
			$secuencias_escenas->secuencia->CssStyle = "";
			$secuencias_escenas->secuencia->CssClass = "";
			$secuencias_escenas->secuencia->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$secuencias_escenas->secuencia->EditValue = $arwrk;
			}

			// nombre
			$secuencias_escenas->nombre->EditCustomAttributes = "";
			$secuencias_escenas->nombre->EditValue = ew_HtmlEncode($secuencias_escenas->nombre->CurrentValue);

			// imagen
			$secuencias_escenas->imagen->EditCustomAttributes = "";
			if (!ew_Empty($secuencias_escenas->imagen->Upload->DbValue)) {
				$secuencias_escenas->imagen->EditValue = $secuencias_escenas->imagen->Upload->DbValue;
			} else {
				$secuencias_escenas->imagen->EditValue = "";
			}

			// texto
			$secuencias_escenas->texto->EditCustomAttributes = "";
			$secuencias_escenas->texto->EditValue = ew_HtmlEncode($secuencias_escenas->texto->CurrentValue);

			// script
			$secuencias_escenas->script->EditCustomAttributes = "";
			$secuencias_escenas->script->EditValue = ew_HtmlEncode($secuencias_escenas->script->CurrentValue);

			// orden
			$secuencias_escenas->orden->EditCustomAttributes = "";
			$secuencias_escenas->orden->EditValue = ew_HtmlEncode($secuencias_escenas->orden->CurrentValue);
		}

		// Call Row Rendered event
		if ($secuencias_escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias_escenas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $secuencias_escenas;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($secuencias_escenas->imagen->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($secuencias_escenas->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $secuencias_escenas->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($secuencias_escenas->secuencia->FormValue) && $secuencias_escenas->secuencia->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $secuencias_escenas->secuencia->FldCaption();
		}
		if (!is_null($secuencias_escenas->nombre->FormValue) && $secuencias_escenas->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $secuencias_escenas->nombre->FldCaption();
		}
		if (!ew_CheckInteger($secuencias_escenas->orden->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $secuencias_escenas->orden->FldErrMsg();
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
		global $conn, $Language, $Security, $secuencias_escenas;
		$rsnew = array();

		// secuencia
		$secuencias_escenas->secuencia->SetDbValueDef($rsnew, $secuencias_escenas->secuencia->CurrentValue, 0, FALSE);

		// nombre
		$secuencias_escenas->nombre->SetDbValueDef($rsnew, $secuencias_escenas->nombre->CurrentValue, "", FALSE);

		// imagen
		$secuencias_escenas->imagen->Upload->SaveToSession(); // Save file value to Session
		if (is_null($secuencias_escenas->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $secuencias_escenas->imagen->UploadPath), $secuencias_escenas->imagen->Upload->FileName);
		}

		// texto
		$secuencias_escenas->texto->SetDbValueDef($rsnew, $secuencias_escenas->texto->CurrentValue, NULL, FALSE);

		// script
		$secuencias_escenas->script->SetDbValueDef($rsnew, $secuencias_escenas->script->CurrentValue, NULL, FALSE);

		// orden
		$secuencias_escenas->orden->SetDbValueDef($rsnew, $secuencias_escenas->orden->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $secuencias_escenas->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($secuencias_escenas->imagen->Upload->Value)) {
				if ($secuencias_escenas->imagen->Upload->FileName == $secuencias_escenas->imagen->Upload->DbValue) { // Overwrite if same file name
					$secuencias_escenas->imagen->Upload->SaveToFile($secuencias_escenas->imagen->UploadPath, $rsnew['imagen'], TRUE);
					$secuencias_escenas->imagen->Upload->DbValue = ""; // No need to delete any more
				} else {
					$secuencias_escenas->imagen->Upload->SaveToFile($secuencias_escenas->imagen->UploadPath, $rsnew['imagen'], FALSE);
				}
			}
			if ($secuencias_escenas->imagen->Upload->Action == "2" || $secuencias_escenas->imagen->Upload->Action == "3") { // Update/Remove
				if ($secuencias_escenas->imagen->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $secuencias_escenas->imagen->UploadPath) . $secuencias_escenas->imagen->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($secuencias_escenas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($secuencias_escenas->CancelMessage <> "") {
				$this->setMessage($secuencias_escenas->CancelMessage);
				$secuencias_escenas->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$secuencias_escenas->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $secuencias_escenas->id->DbValue;

			// Call Row Inserted event
			$secuencias_escenas->Row_Inserted($rsnew);
		}

		// imagen
		$secuencias_escenas->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $secuencias_escenas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "secuencias") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $secuencias_escenas->SqlMasterFilter_secuencias();
				$this->sDbDetailFilter = $secuencias_escenas->SqlDetailFilter_secuencias();
				if (@$_GET["id"] <> "") {
					$GLOBALS["secuencias"]->id->setQueryStringValue($_GET["id"]);
					$secuencias_escenas->secuencia->setQueryStringValue($GLOBALS["secuencias"]->id->QueryStringValue);
					$secuencias_escenas->secuencia->setSessionValue($secuencias_escenas->secuencia->QueryStringValue);
					if (!is_numeric($GLOBALS["secuencias"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["secuencias"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@secuencia@", ew_AdjustSql($GLOBALS["secuencias"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$secuencias_escenas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$secuencias_escenas->setStartRecordNumber($this->lStartRec);
			$secuencias_escenas->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$secuencias_escenas->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "secuencias") {
				if ($secuencias_escenas->secuencia->QueryStringValue == "") $secuencias_escenas->secuencia->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $secuencias_escenas->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $secuencias_escenas->getDetailFilter(); // Restore detail filter
		}
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
