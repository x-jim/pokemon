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
$graficos_add = new cgraficos_add();
$Page =& $graficos_add;

// Page init
$graficos_add->Page_Init();

// Page main
$graficos_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var graficos_add = new ew_Page("graficos_add");

// page properties
graficos_add.PageID = "add"; // page ID
graficos_add.FormID = "fgraficosadd"; // form ID
var EW_PAGE_ID = graficos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
graficos_add.ValidateForm = function(fobj) {
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
graficos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
graficos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
graficos_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $graficos->TableCaption() ?><br><br>
<a href="<?php echo $graficos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$graficos_add->ShowMessage();
?>
<form name="fgraficosadd" id="fgraficosadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return graficos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="graficos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($graficos->grafico->Visible) { // grafico ?>
	<tr<?php echo $graficos->grafico->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $graficos->grafico->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $graficos->grafico->CellAttributes() ?>><span id="el_grafico">
<input type="file" name="x_grafico" id="x_grafico" title="<?php echo $graficos->grafico->FldTitle() ?>" size="30"<?php echo $graficos->grafico->EditAttributes() ?>>
</div>
</span><?php echo $graficos->grafico->CustomMsg ?></td>
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
$graficos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgraficos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'graficos';

	// Page object name
	var $PageObjName = 'graficos_add';

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
	function cgraficos_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (graficos)
		$GLOBALS["graficos"] = new cgraficos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $graficos;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $graficos->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $graficos->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$graficos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $graficos->CurrentAction = "C"; // Copy record
		  } else {
		    $graficos->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($graficos->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("graficoslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$graficos->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $graficos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$graficos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $graficos;
		$graficos->grafico->CurrentValue = NULL; // Clear file related field
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

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->HrefValue = ew_UploadPathEx(FALSE, $graficos->grafico->UploadPath) . ((!empty($graficos->grafico->ViewValue)) ? $graficos->grafico->ViewValue : $graficos->grafico->CurrentValue);
				if ($graficos->Export <> "") $graficos->grafico->HrefValue = ew_ConvertFullUrl($graficos->grafico->HrefValue);
			} else {
				$graficos->grafico->HrefValue = "";
			}
			$graficos->grafico->TooltipValue = "";
		} elseif ($graficos->RowType == EW_ROWTYPE_ADD) { // Add row

			// grafico
			$graficos->grafico->EditCustomAttributes = "";
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->EditValue = $graficos->grafico->Upload->DbValue;
			} else {
				$graficos->grafico->EditValue = "";
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
		if (is_null($graficos->grafico->Upload->Value)) {
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $graficos;
		$rsnew = array();

		// grafico
		$graficos->grafico->Upload->SaveToSession(); // Save file value to Session
		if (is_null($graficos->grafico->Upload->Value)) {
			$rsnew['grafico'] = NULL;
		} else {
			$rsnew['grafico'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $graficos->grafico->UploadPath), $graficos->grafico->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $graficos->Row_Inserting($rsnew);
		if ($bInsertRow) {
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
			$AddRow = $conn->Execute($graficos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($graficos->CancelMessage <> "") {
				$this->setMessage($graficos->CancelMessage);
				$graficos->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$graficos->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $graficos->id->DbValue;

			// Call Row Inserted event
			$graficos->Row_Inserted($rsnew);
		}

		// grafico
		$graficos->grafico->Upload->RemoveFromSession(); // Remove file value from Session
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
