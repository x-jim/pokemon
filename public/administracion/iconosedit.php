<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "iconosinfo.php" ?>
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
$iconos_edit = new ciconos_edit();
$Page =& $iconos_edit;

// Page init
$iconos_edit->Page_Init();

// Page main
$iconos_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var iconos_edit = new ew_Page("iconos_edit");

// page properties
iconos_edit.PageID = "edit"; // page ID
iconos_edit.FormID = "ficonosedit"; // form ID
var EW_PAGE_ID = iconos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
iconos_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($iconos->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_x"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($iconos->x->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_x"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($iconos->x->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_y"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($iconos->y->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_y"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($iconos->y->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
iconos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
iconos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
iconos_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $iconos->TableCaption() ?><br><br>
<a href="<?php echo $iconos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$iconos_edit->ShowMessage();
?>
<form name="ficonosedit" id="ficonosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return iconos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="iconos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($iconos->id->Visible) { // id ?>
	<tr<?php echo $iconos->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $iconos->id->FldCaption() ?></td>
		<td<?php echo $iconos->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $iconos->id->ViewAttributes() ?>><?php echo $iconos->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($iconos->id->CurrentValue) ?>">
</span><?php echo $iconos->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($iconos->nombre->Visible) { // nombre ?>
	<tr<?php echo $iconos->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $iconos->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $iconos->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $iconos->nombre->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $iconos->nombre->EditValue ?>"<?php echo $iconos->nombre->EditAttributes() ?>>
</span><?php echo $iconos->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($iconos->x->Visible) { // x ?>
	<tr<?php echo $iconos->x->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $iconos->x->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $iconos->x->CellAttributes() ?>><span id="el_x">
<input type="text" name="x_x" id="x_x" title="<?php echo $iconos->x->FldTitle() ?>" size="30" value="<?php echo $iconos->x->EditValue ?>"<?php echo $iconos->x->EditAttributes() ?>>
</span><?php echo $iconos->x->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($iconos->y->Visible) { // y ?>
	<tr<?php echo $iconos->y->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $iconos->y->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $iconos->y->CellAttributes() ?>><span id="el_y">
<input type="text" name="x_y" id="x_y" title="<?php echo $iconos->y->FldTitle() ?>" size="30" value="<?php echo $iconos->y->EditValue ?>"<?php echo $iconos->y->EditAttributes() ?>>
</span><?php echo $iconos->y->CustomMsg ?></td>
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
$iconos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ciconos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'iconos';

	// Page object name
	var $PageObjName = 'iconos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $iconos;
		if ($iconos->UseTokenInUrl) $PageUrl .= "t=" . $iconos->TableVar . "&"; // Add page token
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
		global $objForm, $iconos;
		if ($iconos->UseTokenInUrl) {
			if ($objForm)
				return ($iconos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($iconos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ciconos_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (iconos)
		$GLOBALS["iconos"] = new ciconos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'iconos', TRUE);

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
		global $iconos;

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
		global $objForm, $Language, $gsFormError, $iconos;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$iconos->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$iconos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$iconos->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$iconos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$iconos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($iconos->id->CurrentValue == "")
			$this->Page_Terminate("iconoslist.php"); // Invalid key, return to list
		switch ($iconos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("iconoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$iconos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $iconos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$iconos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$iconos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $iconos;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $iconos;
		$iconos->id->setFormValue($objForm->GetValue("x_id"));
		$iconos->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$iconos->x->setFormValue($objForm->GetValue("x_x"));
		$iconos->y->setFormValue($objForm->GetValue("x_y"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $iconos;
		$this->LoadRow();
		$iconos->id->CurrentValue = $iconos->id->FormValue;
		$iconos->nombre->CurrentValue = $iconos->nombre->FormValue;
		$iconos->x->CurrentValue = $iconos->x->FormValue;
		$iconos->y->CurrentValue = $iconos->y->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $iconos;
		$sFilter = $iconos->KeyFilter();

		// Call Row Selecting event
		$iconos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$iconos->CurrentFilter = $sFilter;
		$sSql = $iconos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$iconos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $iconos;
		$iconos->id->setDbValue($rs->fields('id'));
		$iconos->nombre->setDbValue($rs->fields('nombre'));
		$iconos->x->setDbValue($rs->fields('x'));
		$iconos->y->setDbValue($rs->fields('y'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $iconos;

		// Initialize URLs
		// Call Row_Rendering event

		$iconos->Row_Rendering();

		// Common render codes for all row types
		// id

		$iconos->id->CellCssStyle = ""; $iconos->id->CellCssClass = "";
		$iconos->id->CellAttrs = array(); $iconos->id->ViewAttrs = array(); $iconos->id->EditAttrs = array();

		// nombre
		$iconos->nombre->CellCssStyle = ""; $iconos->nombre->CellCssClass = "";
		$iconos->nombre->CellAttrs = array(); $iconos->nombre->ViewAttrs = array(); $iconos->nombre->EditAttrs = array();

		// x
		$iconos->x->CellCssStyle = ""; $iconos->x->CellCssClass = "";
		$iconos->x->CellAttrs = array(); $iconos->x->ViewAttrs = array(); $iconos->x->EditAttrs = array();

		// y
		$iconos->y->CellCssStyle = ""; $iconos->y->CellCssClass = "";
		$iconos->y->CellAttrs = array(); $iconos->y->ViewAttrs = array(); $iconos->y->EditAttrs = array();
		if ($iconos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$iconos->id->ViewValue = $iconos->id->CurrentValue;
			$iconos->id->CssStyle = "";
			$iconos->id->CssClass = "";
			$iconos->id->ViewCustomAttributes = "";

			// nombre
			$iconos->nombre->ViewValue = $iconos->nombre->CurrentValue;
			$iconos->nombre->CssStyle = "";
			$iconos->nombre->CssClass = "";
			$iconos->nombre->ViewCustomAttributes = "";

			// x
			$iconos->x->ViewValue = $iconos->x->CurrentValue;
			$iconos->x->CssStyle = "";
			$iconos->x->CssClass = "";
			$iconos->x->ViewCustomAttributes = "";

			// y
			$iconos->y->ViewValue = $iconos->y->CurrentValue;
			$iconos->y->CssStyle = "";
			$iconos->y->CssClass = "";
			$iconos->y->ViewCustomAttributes = "";

			// id
			$iconos->id->HrefValue = "";
			$iconos->id->TooltipValue = "";

			// nombre
			$iconos->nombre->HrefValue = "";
			$iconos->nombre->TooltipValue = "";

			// x
			$iconos->x->HrefValue = "";
			$iconos->x->TooltipValue = "";

			// y
			$iconos->y->HrefValue = "";
			$iconos->y->TooltipValue = "";
		} elseif ($iconos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$iconos->id->EditCustomAttributes = "";
			$iconos->id->EditValue = $iconos->id->CurrentValue;
			$iconos->id->CssStyle = "";
			$iconos->id->CssClass = "";
			$iconos->id->ViewCustomAttributes = "";

			// nombre
			$iconos->nombre->EditCustomAttributes = "";
			$iconos->nombre->EditValue = ew_HtmlEncode($iconos->nombre->CurrentValue);

			// x
			$iconos->x->EditCustomAttributes = "";
			$iconos->x->EditValue = ew_HtmlEncode($iconos->x->CurrentValue);

			// y
			$iconos->y->EditCustomAttributes = "";
			$iconos->y->EditValue = ew_HtmlEncode($iconos->y->CurrentValue);

			// Edit refer script
			// id

			$iconos->id->HrefValue = "";

			// nombre
			$iconos->nombre->HrefValue = "";

			// x
			$iconos->x->HrefValue = "";

			// y
			$iconos->y->HrefValue = "";
		}

		// Call Row Rendered event
		if ($iconos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$iconos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $iconos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($iconos->nombre->FormValue) && $iconos->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $iconos->nombre->FldCaption();
		}
		if (!is_null($iconos->x->FormValue) && $iconos->x->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $iconos->x->FldCaption();
		}
		if (!ew_CheckInteger($iconos->x->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $iconos->x->FldErrMsg();
		}
		if (!is_null($iconos->y->FormValue) && $iconos->y->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $iconos->y->FldCaption();
		}
		if (!ew_CheckInteger($iconos->y->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $iconos->y->FldErrMsg();
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
		global $conn, $Security, $Language, $iconos;
		$sFilter = $iconos->KeyFilter();
		$iconos->CurrentFilter = $sFilter;
		$sSql = $iconos->SQL();
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

			// nombre
			$iconos->nombre->SetDbValueDef($rsnew, $iconos->nombre->CurrentValue, "", FALSE);

			// x
			$iconos->x->SetDbValueDef($rsnew, $iconos->x->CurrentValue, 0, FALSE);

			// y
			$iconos->y->SetDbValueDef($rsnew, $iconos->y->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $iconos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($iconos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($iconos->CancelMessage <> "") {
					$this->setMessage($iconos->CancelMessage);
					$iconos->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$iconos->Row_Updated($rsold, $rsnew);
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
