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
$graficos_edit = new cgraficos_edit();
$Page =& $graficos_edit;

// Page init
$graficos_edit->Page_Init();

// Page main
$graficos_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var graficos_edit = new ew_Page("graficos_edit");

// page properties
graficos_edit.PageID = "edit"; // page ID
graficos_edit.FormID = "fgraficosedit"; // form ID
var EW_PAGE_ID = graficos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
graficos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_grafico"];
		aelm = fobj.elements["a" + infix + "_grafico"];
		var chk_grafico = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_grafico && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($graficos->grafico->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_grafico"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
graficos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
graficos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
graficos_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $graficos->TableCaption() ?><br><br>
<a href="<?php echo $graficos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$graficos_edit->ShowMessage();
?>
<form name="fgraficosedit" id="fgraficosedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return graficos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="graficos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($graficos->id->Visible) { // id ?>
	<tr<?php echo $graficos->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $graficos->id->FldCaption() ?></td>
		<td<?php echo $graficos->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $graficos->id->ViewAttributes() ?>><?php echo $graficos->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($graficos->id->CurrentValue) ?>">
</span><?php echo $graficos->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($graficos->grafico->Visible) { // grafico ?>
	<tr<?php echo $graficos->grafico->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $graficos->grafico->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $graficos->grafico->CellAttributes() ?>><span id="el_grafico">
<div id="old_x_grafico">
<?php if ($graficos->grafico->HrefValue <> "" || $graficos->grafico->TooltipValue <> "") { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<a href="<?php echo $graficos->grafico->HrefValue ?>"><?php echo $graficos->grafico->EditValue ?></a>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<?php echo $graficos->grafico->EditValue ?>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_grafico">
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<label><input type="radio" name="a_grafico" id="a_grafico" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_grafico" id="a_grafico" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_grafico" id="a_grafico" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $graficos->grafico->EditAttrs["onchange"] = "this.form.a_grafico[2].checked=true;" . @$graficos->grafico->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_grafico" id="a_grafico" value="3">
<?php } ?>
<input type="file" name="x_grafico" id="x_grafico" title="<?php echo $graficos->grafico->FldTitle() ?>" size="30"<?php echo $graficos->grafico->EditAttributes() ?>>
</div>
</span><?php echo $graficos->grafico->CustomMsg ?></td>
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
$graficos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cgraficos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'graficos';

	// Page object name
	var $PageObjName = 'graficos_edit';

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
	function cgraficos_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (graficos)
		$GLOBALS["graficos"] = new cgraficos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $graficos;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$graficos->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$graficos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$graficos->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$graficos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$graficos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($graficos->id->CurrentValue == "")
			$this->Page_Terminate("graficoslist.php"); // Invalid key, return to list
		switch ($graficos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("graficoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$graficos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $graficos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$graficos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$graficos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $graficos;

		// Get upload data
			if ($graficos->grafico->Upload->UploadFile()) {

				// No action required
			} else {
				echo $graficos->grafico->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $graficos;
		$graficos->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $graficos;
		$this->LoadRow();
		$graficos->id->CurrentValue = $graficos->id->FormValue;
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
		} elseif ($graficos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$graficos->id->EditCustomAttributes = "";
			$graficos->id->EditValue = $graficos->id->CurrentValue;
			$graficos->id->CssStyle = "";
			$graficos->id->CssClass = "";
			$graficos->id->ViewCustomAttributes = "";

			// grafico
			$graficos->grafico->EditCustomAttributes = "";
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->EditValue = $graficos->grafico->Upload->DbValue;
			} else {
				$graficos->grafico->EditValue = "";
			}

			// Edit refer script
			// id

			$graficos->id->HrefValue = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->HrefValue = ew_UploadPathEx(FALSE, $graficos->grafico->UploadPath) . ((!empty($graficos->grafico->EditValue)) ? $graficos->grafico->EditValue : $graficos->grafico->CurrentValue);
				if ($graficos->Export <> "") $graficos->grafico->HrefValue = ew_ConvertFullUrl($graficos->grafico->HrefValue);
			} else {
				$graficos->grafico->HrefValue = "";
			}
		}

		// Call Row Rendered event
		if ($graficos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$graficos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $graficos;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($graficos->grafico->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($graficos->grafico->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $graficos->grafico->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($graficos->grafico->Upload->Action == "3" && is_null($graficos->grafico->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $graficos->grafico->FldCaption();
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
		global $conn, $Security, $Language, $graficos;
		$sFilter = $graficos->KeyFilter();
		$graficos->CurrentFilter = $sFilter;
		$sSql = $graficos->SQL();
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

			// grafico
			$graficos->grafico->Upload->SaveToSession(); // Save file value to Session
						if ($graficos->grafico->Upload->Action == "2" || $graficos->grafico->Upload->Action == "3") { // Update/Remove
			$graficos->grafico->Upload->DbValue = $rs->fields('grafico'); // Get original value
			if (is_null($graficos->grafico->Upload->Value)) {
				$rsnew['grafico'] = NULL;
			} else {
				if ($graficos->grafico->Upload->FileName == $graficos->grafico->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['grafico'] = $graficos->grafico->Upload->FileName;
				} else {
					$rsnew['grafico'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $graficos->grafico->UploadPath), $graficos->grafico->Upload->FileName);
				}
			}
			}

			// Call Row Updating event
			$bUpdateRow = $graficos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($graficos->grafico->Upload->Value)) {
				if ($graficos->grafico->Upload->FileName == $graficos->grafico->Upload->DbValue) { // Overwrite if same file name
					$graficos->grafico->Upload->SaveToFile($graficos->grafico->UploadPath, $rsnew['grafico'], TRUE);
					$graficos->grafico->Upload->DbValue = ""; // No need to delete any more
				} else {
					$graficos->grafico->Upload->SaveToFile($graficos->grafico->UploadPath, $rsnew['grafico'], FALSE);
				}
			}
			if ($graficos->grafico->Upload->Action == "2" || $graficos->grafico->Upload->Action == "3") { // Update/Remove
				if ($graficos->grafico->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $graficos->grafico->UploadPath) . $graficos->grafico->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($graficos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($graficos->CancelMessage <> "") {
					$this->setMessage($graficos->CancelMessage);
					$graficos->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$graficos->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// grafico
		$graficos->grafico->Upload->RemoveFromSession(); // Remove file value from Session
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
