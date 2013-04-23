<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "escenasinfo.php" ?>
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
$escenas_add = new cescenas_add();
$Page =& $escenas_add;

// Page init
$escenas_add->Page_Init();

// Page main
$escenas_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var escenas_add = new ew_Page("escenas_add");

// page properties
escenas_add.PageID = "add"; // page ID
escenas_add.FormID = "fescenasadd"; // form ID
var EW_PAGE_ID = escenas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
escenas_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($escenas->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
escenas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
escenas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
escenas_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $escenas->TableCaption() ?><br><br>
<a href="<?php echo $escenas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$escenas_add->ShowMessage();
?>
<form name="fescenasadd" id="fescenasadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return escenas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="escenas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($escenas->nombre->Visible) { // nombre ?>
	<tr<?php echo $escenas->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $escenas->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $escenas->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $escenas->nombre->EditValue ?>"<?php echo $escenas->nombre->EditAttributes() ?>>
</span><?php echo $escenas->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($escenas->imagen->Visible) { // imagen ?>
	<tr<?php echo $escenas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->imagen->FldCaption() ?></td>
		<td<?php echo $escenas->imagen->CellAttributes() ?>><span id="el_imagen">
<input type="file" name="x_imagen" id="x_imagen" title="<?php echo $escenas->imagen->FldTitle() ?>" size="30"<?php echo $escenas->imagen->EditAttributes() ?>>
</div>
</span><?php echo $escenas->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($escenas->texto->Visible) { // texto ?>
	<tr<?php echo $escenas->texto->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->texto->FldCaption() ?></td>
		<td<?php echo $escenas->texto->CellAttributes() ?>><span id="el_texto">
<textarea name="x_texto" id="x_texto" title="<?php echo $escenas->texto->FldTitle() ?>" cols="35" rows="4"<?php echo $escenas->texto->EditAttributes() ?>><?php echo $escenas->texto->EditValue ?></textarea>
</span><?php echo $escenas->texto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($escenas->script->Visible) { // script ?>
	<tr<?php echo $escenas->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $escenas->script->FldCaption() ?></td>
		<td<?php echo $escenas->script->CellAttributes() ?>><span id="el_script">
<textarea name="x_script" id="x_script" title="<?php echo $escenas->script->FldTitle() ?>" cols="35" rows="8"<?php echo $escenas->script->EditAttributes() ?>><?php echo $escenas->script->EditValue ?></textarea>
</span><?php echo $escenas->script->CustomMsg ?></td>
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
$escenas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cescenas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'escenas';

	// Page object name
	var $PageObjName = 'escenas_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $escenas;
		if ($escenas->UseTokenInUrl) $PageUrl .= "t=" . $escenas->TableVar . "&"; // Add page token
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
		global $objForm, $escenas;
		if ($escenas->UseTokenInUrl) {
			if ($objForm)
				return ($escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cescenas_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (escenas)
		$GLOBALS["escenas"] = new cescenas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'escenas', TRUE);

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
		global $escenas;

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
		global $objForm, $Language, $gsFormError, $escenas;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $escenas->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $escenas->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$escenas->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $escenas->CurrentAction = "C"; // Copy record
		  } else {
		    $escenas->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($escenas->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("escenaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$escenas->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $escenas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$escenas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $escenas;

		// Get upload data
			if ($escenas->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $escenas->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $escenas;
		$escenas->imagen->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $escenas;
		$escenas->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$escenas->texto->setFormValue($objForm->GetValue("x_texto"));
		$escenas->script->setFormValue($objForm->GetValue("x_script"));
		$escenas->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $escenas;
		$escenas->id->CurrentValue = $escenas->id->FormValue;
		$escenas->nombre->CurrentValue = $escenas->nombre->FormValue;
		$escenas->texto->CurrentValue = $escenas->texto->FormValue;
		$escenas->script->CurrentValue = $escenas->script->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $escenas;
		$sFilter = $escenas->KeyFilter();

		// Call Row Selecting event
		$escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$escenas->CurrentFilter = $sFilter;
		$sSql = $escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $escenas;
		$escenas->id->setDbValue($rs->fields('id'));
		$escenas->nombre->setDbValue($rs->fields('nombre'));
		$escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$escenas->texto->setDbValue($rs->fields('texto'));
		$escenas->script->setDbValue($rs->fields('script'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $escenas;

		// Initialize URLs
		// Call Row_Rendering event

		$escenas->Row_Rendering();

		// Common render codes for all row types
		// nombre

		$escenas->nombre->CellCssStyle = ""; $escenas->nombre->CellCssClass = "";
		$escenas->nombre->CellAttrs = array(); $escenas->nombre->ViewAttrs = array(); $escenas->nombre->EditAttrs = array();

		// imagen
		$escenas->imagen->CellCssStyle = ""; $escenas->imagen->CellCssClass = "";
		$escenas->imagen->CellAttrs = array(); $escenas->imagen->ViewAttrs = array(); $escenas->imagen->EditAttrs = array();

		// texto
		$escenas->texto->CellCssStyle = ""; $escenas->texto->CellCssClass = "";
		$escenas->texto->CellAttrs = array(); $escenas->texto->ViewAttrs = array(); $escenas->texto->EditAttrs = array();

		// script
		$escenas->script->CellCssStyle = ""; $escenas->script->CellCssClass = "";
		$escenas->script->CellAttrs = array(); $escenas->script->ViewAttrs = array(); $escenas->script->EditAttrs = array();
		if ($escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$escenas->id->ViewValue = $escenas->id->CurrentValue;
			$escenas->id->CssStyle = "";
			$escenas->id->CssClass = "";
			$escenas->id->ViewCustomAttributes = "";

			// nombre
			$escenas->nombre->ViewValue = $escenas->nombre->CurrentValue;
			$escenas->nombre->CssStyle = "";
			$escenas->nombre->CssClass = "";
			$escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->ViewValue = $escenas->imagen->Upload->DbValue;
			} else {
				$escenas->imagen->ViewValue = "";
			}
			$escenas->imagen->CssStyle = "";
			$escenas->imagen->CssClass = "";
			$escenas->imagen->ViewCustomAttributes = "";

			// texto
			$escenas->texto->ViewValue = $escenas->texto->CurrentValue;
			$escenas->texto->CssStyle = "";
			$escenas->texto->CssClass = "";
			$escenas->texto->ViewCustomAttributes = "";

			// script
			$escenas->script->ViewValue = $escenas->script->CurrentValue;
			$escenas->script->CssStyle = "";
			$escenas->script->CssClass = "";
			$escenas->script->ViewCustomAttributes = "";

			// nombre
			$escenas->nombre->HrefValue = "";
			$escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $escenas->imagen->UploadPath) . ((!empty($escenas->imagen->ViewValue)) ? $escenas->imagen->ViewValue : $escenas->imagen->CurrentValue);
				if ($escenas->Export <> "") $escenas->imagen->HrefValue = ew_ConvertFullUrl($escenas->imagen->HrefValue);
			} else {
				$escenas->imagen->HrefValue = "";
			}
			$escenas->imagen->TooltipValue = "";

			// texto
			$escenas->texto->HrefValue = "";
			$escenas->texto->TooltipValue = "";

			// script
			$escenas->script->HrefValue = "";
			$escenas->script->TooltipValue = "";
		} elseif ($escenas->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$escenas->nombre->EditCustomAttributes = "";
			$escenas->nombre->EditValue = ew_HtmlEncode($escenas->nombre->CurrentValue);

			// imagen
			$escenas->imagen->EditCustomAttributes = "";
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->EditValue = $escenas->imagen->Upload->DbValue;
			} else {
				$escenas->imagen->EditValue = "";
			}

			// texto
			$escenas->texto->EditCustomAttributes = "";
			$escenas->texto->EditValue = ew_HtmlEncode($escenas->texto->CurrentValue);

			// script
			$escenas->script->EditCustomAttributes = "";
			$escenas->script->EditValue = ew_HtmlEncode($escenas->script->CurrentValue);
		}

		// Call Row Rendered event
		if ($escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$escenas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $escenas;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($escenas->imagen->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($escenas->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $escenas->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($escenas->nombre->FormValue) && $escenas->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $escenas->nombre->FldCaption();
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
		global $conn, $Language, $Security, $escenas;
		$rsnew = array();

		// nombre
		$escenas->nombre->SetDbValueDef($rsnew, $escenas->nombre->CurrentValue, "", FALSE);

		// imagen
		$escenas->imagen->Upload->SaveToSession(); // Save file value to Session
		if (is_null($escenas->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $escenas->imagen->UploadPath), $escenas->imagen->Upload->FileName);
		}

		// texto
		$escenas->texto->SetDbValueDef($rsnew, $escenas->texto->CurrentValue, NULL, FALSE);

		// script
		$escenas->script->SetDbValueDef($rsnew, $escenas->script->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $escenas->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($escenas->imagen->Upload->Value)) {
				if ($escenas->imagen->Upload->FileName == $escenas->imagen->Upload->DbValue) { // Overwrite if same file name
					$escenas->imagen->Upload->SaveToFile($escenas->imagen->UploadPath, $rsnew['imagen'], TRUE);
					$escenas->imagen->Upload->DbValue = ""; // No need to delete any more
				} else {
					$escenas->imagen->Upload->SaveToFile($escenas->imagen->UploadPath, $rsnew['imagen'], FALSE);
				}
			}
			if ($escenas->imagen->Upload->Action == "2" || $escenas->imagen->Upload->Action == "3") { // Update/Remove
				if ($escenas->imagen->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $escenas->imagen->UploadPath) . $escenas->imagen->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($escenas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($escenas->CancelMessage <> "") {
				$this->setMessage($escenas->CancelMessage);
				$escenas->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$escenas->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $escenas->id->DbValue;

			// Call Row Inserted event
			$escenas->Row_Inserted($rsnew);
		}

		// imagen
		$escenas->imagen->Upload->RemoveFromSession(); // Remove file value from Session
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
