<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$secuencias_add = new csecuencias_add();
$Page =& $secuencias_add;

// Page init
$secuencias_add->Page_Init();

// Page main
$secuencias_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_add = new ew_Page("secuencias_add");

// page properties
secuencias_add.PageID = "add"; // page ID
secuencias_add.FormID = "fsecuenciasadd"; // form ID
var EW_PAGE_ID = secuencias_add.PageID; // for backward compatibility

// extend page with ValidateForm function
secuencias_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($secuencias->nombre->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
secuencias_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias->TableCaption() ?><br><br>
<a href="<?php echo $secuencias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_add->ShowMessage();
?>
<form name="fsecuenciasadd" id="fsecuenciasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return secuencias_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="secuencias">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secuencias->nombre->Visible) { // nombre ?>
	<tr<?php echo $secuencias->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $secuencias->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $secuencias->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $secuencias->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $secuencias->nombre->EditValue ?>"<?php echo $secuencias->nombre->EditAttributes() ?>>
</span><?php echo $secuencias->nombre->CustomMsg ?></td>
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
$secuencias_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'secuencias';

	// Page object name
	var $PageObjName = 'secuencias_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secuencias;
		if ($secuencias->UseTokenInUrl) $PageUrl .= "t=" . $secuencias->TableVar . "&"; // Add page token
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
		global $objForm, $secuencias;
		if ($secuencias->UseTokenInUrl) {
			if ($objForm)
				return ($secuencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secuencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecuencias_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias)
		$GLOBALS["secuencias"] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secuencias', TRUE);

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
		global $secuencias;

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
		global $objForm, $Language, $gsFormError, $secuencias;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $secuencias->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $secuencias->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$secuencias->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $secuencias->CurrentAction = "C"; // Copy record
		  } else {
		    $secuencias->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($secuencias->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("secuenciaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$secuencias->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $secuencias->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$secuencias->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $secuencias;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $secuencias;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $secuencias;
		$secuencias->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$secuencias->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $secuencias;
		$secuencias->id->CurrentValue = $secuencias->id->FormValue;
		$secuencias->nombre->CurrentValue = $secuencias->nombre->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secuencias;
		$sFilter = $secuencias->KeyFilter();

		// Call Row Selecting event
		$secuencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secuencias->CurrentFilter = $sFilter;
		$sSql = $secuencias->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$secuencias->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $secuencias;
		$secuencias->id->setDbValue($rs->fields('id'));
		$secuencias->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secuencias;

		// Initialize URLs
		// Call Row_Rendering event

		$secuencias->Row_Rendering();

		// Common render codes for all row types
		// nombre

		$secuencias->nombre->CellCssStyle = ""; $secuencias->nombre->CellCssClass = "";
		$secuencias->nombre->CellAttrs = array(); $secuencias->nombre->ViewAttrs = array(); $secuencias->nombre->EditAttrs = array();
		if ($secuencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$secuencias->id->ViewValue = $secuencias->id->CurrentValue;
			$secuencias->id->CssStyle = "";
			$secuencias->id->CssClass = "";
			$secuencias->id->ViewCustomAttributes = "";

			// nombre
			$secuencias->nombre->ViewValue = $secuencias->nombre->CurrentValue;
			$secuencias->nombre->CssStyle = "";
			$secuencias->nombre->CssClass = "";
			$secuencias->nombre->ViewCustomAttributes = "";

			// nombre
			$secuencias->nombre->HrefValue = "";
			$secuencias->nombre->TooltipValue = "";
		} elseif ($secuencias->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$secuencias->nombre->EditCustomAttributes = "";
			$secuencias->nombre->EditValue = ew_HtmlEncode($secuencias->nombre->CurrentValue);
		}

		// Call Row Rendered event
		if ($secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $secuencias;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($secuencias->nombre->FormValue) && $secuencias->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $secuencias->nombre->FldCaption();
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
		global $conn, $Language, $Security, $secuencias;
		$rsnew = array();

		// nombre
		$secuencias->nombre->SetDbValueDef($rsnew, $secuencias->nombre->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $secuencias->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($secuencias->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($secuencias->CancelMessage <> "") {
				$this->setMessage($secuencias->CancelMessage);
				$secuencias->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$secuencias->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $secuencias->id->DbValue;

			// Call Row Inserted event
			$secuencias->Row_Inserted($rsnew);
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
