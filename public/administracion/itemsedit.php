<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "itemsinfo.php" ?>
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
$items_edit = new citems_edit();
$Page =& $items_edit;

// Page init
$items_edit->Page_Init();

// Page main
$items_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var items_edit = new ew_Page("items_edit");

// page properties
items_edit.PageID = "edit"; // page ID
items_edit.FormID = "fitemsedit"; // form ID
var EW_PAGE_ID = items_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
items_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($items->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_icono"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($items->icono->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
items_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
items_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
items_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $items->TableCaption() ?><br><br>
<a href="<?php echo $items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$items_edit->ShowMessage();
?>
<form name="fitemsedit" id="fitemsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return items_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="items">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($items->id->Visible) { // id ?>
	<tr<?php echo $items->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $items->id->FldCaption() ?></td>
		<td<?php echo $items->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $items->id->ViewAttributes() ?>><?php echo $items->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($items->id->CurrentValue) ?>">
</span><?php echo $items->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($items->nombre->Visible) { // nombre ?>
	<tr<?php echo $items->nombre->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $items->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $items->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="<?php echo $items->nombre->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $items->nombre->EditValue ?>"<?php echo $items->nombre->EditAttributes() ?>>
</span><?php echo $items->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($items->icono->Visible) { // icono ?>
	<tr<?php echo $items->icono->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $items->icono->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $items->icono->CellAttributes() ?>><span id="el_icono">
<select id="x_icono" name="x_icono" title="<?php echo $items->icono->FldTitle() ?>"<?php echo $items->icono->EditAttributes() ?>>
<?php
if (is_array($items->icono->EditValue)) {
	$arwrk = $items->icono->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($items->icono->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $items->icono->CustomMsg ?></td>
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
$items_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class citems_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'items';

	// Page object name
	var $PageObjName = 'items_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $items;
		if ($items->UseTokenInUrl) $PageUrl .= "t=" . $items->TableVar . "&"; // Add page token
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
		global $objForm, $items;
		if ($items->UseTokenInUrl) {
			if ($objForm)
				return ($items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function citems_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (items)
		$GLOBALS["items"] = new citems();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'items', TRUE);

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
		global $items;

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
		global $objForm, $Language, $gsFormError, $items;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$items->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$items->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$items->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$items->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$items->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($items->id->CurrentValue == "")
			$this->Page_Terminate("itemslist.php"); // Invalid key, return to list
		switch ($items->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("itemslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$items->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $items->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$items->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$items->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $items;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $items;
		$items->id->setFormValue($objForm->GetValue("x_id"));
		$items->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$items->icono->setFormValue($objForm->GetValue("x_icono"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $items;
		$this->LoadRow();
		$items->id->CurrentValue = $items->id->FormValue;
		$items->nombre->CurrentValue = $items->nombre->FormValue;
		$items->icono->CurrentValue = $items->icono->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $items;
		$sFilter = $items->KeyFilter();

		// Call Row Selecting event
		$items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$items->CurrentFilter = $sFilter;
		$sSql = $items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $items;
		$items->id->setDbValue($rs->fields('id'));
		$items->nombre->setDbValue($rs->fields('nombre'));
		$items->icono->setDbValue($rs->fields('icono'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $items;

		// Initialize URLs
		// Call Row_Rendering event

		$items->Row_Rendering();

		// Common render codes for all row types
		// id

		$items->id->CellCssStyle = ""; $items->id->CellCssClass = "";
		$items->id->CellAttrs = array(); $items->id->ViewAttrs = array(); $items->id->EditAttrs = array();

		// nombre
		$items->nombre->CellCssStyle = ""; $items->nombre->CellCssClass = "";
		$items->nombre->CellAttrs = array(); $items->nombre->ViewAttrs = array(); $items->nombre->EditAttrs = array();

		// icono
		$items->icono->CellCssStyle = ""; $items->icono->CellCssClass = "";
		$items->icono->CellAttrs = array(); $items->icono->ViewAttrs = array(); $items->icono->EditAttrs = array();
		if ($items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$items->id->ViewValue = $items->id->CurrentValue;
			$items->id->CssStyle = "";
			$items->id->CssClass = "";
			$items->id->ViewCustomAttributes = "";

			// nombre
			$items->nombre->ViewValue = $items->nombre->CurrentValue;
			$items->nombre->CssStyle = "";
			$items->nombre->CssClass = "";
			$items->nombre->ViewCustomAttributes = "";

			// icono
			if (strval($items->icono->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($items->icono->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `iconos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$items->icono->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$items->icono->ViewValue = $items->icono->CurrentValue;
				}
			} else {
				$items->icono->ViewValue = NULL;
			}
			$items->icono->CssStyle = "";
			$items->icono->CssClass = "";
			$items->icono->ViewCustomAttributes = "";

			// id
			$items->id->HrefValue = "";
			$items->id->TooltipValue = "";

			// nombre
			$items->nombre->HrefValue = "";
			$items->nombre->TooltipValue = "";

			// icono
			$items->icono->HrefValue = "";
			$items->icono->TooltipValue = "";
		} elseif ($items->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$items->id->EditCustomAttributes = "";
			$items->id->EditValue = $items->id->CurrentValue;
			$items->id->CssStyle = "";
			$items->id->CssClass = "";
			$items->id->ViewCustomAttributes = "";

			// nombre
			$items->nombre->EditCustomAttributes = "";
			$items->nombre->EditValue = ew_HtmlEncode($items->nombre->CurrentValue);

			// icono
			$items->icono->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `iconos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$items->icono->EditValue = $arwrk;

			// Edit refer script
			// id

			$items->id->HrefValue = "";

			// nombre
			$items->nombre->HrefValue = "";

			// icono
			$items->icono->HrefValue = "";
		}

		// Call Row Rendered event
		if ($items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$items->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $items;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($items->nombre->FormValue) && $items->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $items->nombre->FldCaption();
		}
		if (!is_null($items->icono->FormValue) && $items->icono->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $items->icono->FldCaption();
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
		global $conn, $Security, $Language, $items;
		$sFilter = $items->KeyFilter();
		$items->CurrentFilter = $sFilter;
		$sSql = $items->SQL();
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
			$items->nombre->SetDbValueDef($rsnew, $items->nombre->CurrentValue, "", FALSE);

			// icono
			$items->icono->SetDbValueDef($rsnew, $items->icono->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $items->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($items->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($items->CancelMessage <> "") {
					$this->setMessage($items->CancelMessage);
					$items->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$items->Row_Updated($rsold, $rsnew);
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
