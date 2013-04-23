<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_itemsinfo.php" ?>
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
$entrenadores_items_add = new centrenadores_items_add();
$Page =& $entrenadores_items_add;

// Page init
$entrenadores_items_add->Page_Init();

// Page main
$entrenadores_items_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_items_add = new ew_Page("entrenadores_items_add");

// page properties
entrenadores_items_add.PageID = "add"; // page ID
entrenadores_items_add.FormID = "fentrenadores_itemsadd"; // form ID
var EW_PAGE_ID = entrenadores_items_add.PageID; // for backward compatibility

// extend page with ValidateForm function
entrenadores_items_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_item"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_items->item->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_entrenador"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($entrenadores_items->entrenador->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_entrenador"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_items->entrenador->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cantidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($entrenadores_items->cantidad->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
entrenadores_items_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_items_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_items_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_items->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_items_add->ShowMessage();
?>
<form name="fentrenadores_itemsadd" id="fentrenadores_itemsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return entrenadores_items_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="entrenadores_items">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($entrenadores_items->item->Visible) { // item ?>
	<tr<?php echo $entrenadores_items->item->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_items->item->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_items->item->CellAttributes() ?>><span id="el_item">
<select id="x_item" name="x_item" title="<?php echo $entrenadores_items->item->FldTitle() ?>"<?php echo $entrenadores_items->item->EditAttributes() ?>>
<?php
if (is_array($entrenadores_items->item->EditValue)) {
	$arwrk = $entrenadores_items->item->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($entrenadores_items->item->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $entrenadores_items->item->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_items->entrenador->Visible) { // entrenador ?>
	<tr<?php echo $entrenadores_items->entrenador->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_items->entrenador->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_items->entrenador->CellAttributes() ?>><span id="el_entrenador">
<?php if ($entrenadores_items->entrenador->getSessionValue() <> "") { ?>
<div<?php echo $entrenadores_items->entrenador->ViewAttributes() ?>><?php echo $entrenadores_items->entrenador->ViewValue ?></div>
<input type="hidden" id="x_entrenador" name="x_entrenador" value="<?php echo ew_HtmlEncode($entrenadores_items->entrenador->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_entrenador" id="x_entrenador" title="<?php echo $entrenadores_items->entrenador->FldTitle() ?>" size="30" value="<?php echo $entrenadores_items->entrenador->EditValue ?>"<?php echo $entrenadores_items->entrenador->EditAttributes() ?>>
<?php } ?>
</span><?php echo $entrenadores_items->entrenador->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($entrenadores_items->cantidad->Visible) { // cantidad ?>
	<tr<?php echo $entrenadores_items->cantidad->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $entrenadores_items->cantidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $entrenadores_items->cantidad->CellAttributes() ?>><span id="el_cantidad">
<input type="text" name="x_cantidad" id="x_cantidad" title="<?php echo $entrenadores_items->cantidad->FldTitle() ?>" size="30" value="<?php echo $entrenadores_items->cantidad->EditValue ?>"<?php echo $entrenadores_items->cantidad->EditAttributes() ?>>
</span><?php echo $entrenadores_items->cantidad->CustomMsg ?></td>
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
$entrenadores_items_add->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_items_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'entrenadores_items';

	// Page object name
	var $PageObjName = 'entrenadores_items_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_items;
		if ($entrenadores_items->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_items->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_items;
		if ($entrenadores_items->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_items_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_items)
		$GLOBALS["entrenadores_items"] = new centrenadores_items();

		// Table object (entrenadores)
		$GLOBALS['entrenadores'] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_items', TRUE);

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
		global $entrenadores_items;

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
		global $objForm, $Language, $gsFormError, $entrenadores_items;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $entrenadores_items->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $entrenadores_items->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$entrenadores_items->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $entrenadores_items->CurrentAction = "C"; // Copy record
		  } else {
		    $entrenadores_items->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($entrenadores_items->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("entrenadores_itemslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$entrenadores_items->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $entrenadores_items->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$entrenadores_items->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $entrenadores_items;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $entrenadores_items;
		$entrenadores_items->cantidad->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $entrenadores_items;
		$entrenadores_items->item->setFormValue($objForm->GetValue("x_item"));
		$entrenadores_items->entrenador->setFormValue($objForm->GetValue("x_entrenador"));
		$entrenadores_items->cantidad->setFormValue($objForm->GetValue("x_cantidad"));
		$entrenadores_items->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $entrenadores_items;
		$entrenadores_items->id->CurrentValue = $entrenadores_items->id->FormValue;
		$entrenadores_items->item->CurrentValue = $entrenadores_items->item->FormValue;
		$entrenadores_items->entrenador->CurrentValue = $entrenadores_items->entrenador->FormValue;
		$entrenadores_items->cantidad->CurrentValue = $entrenadores_items->cantidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_items;
		$sFilter = $entrenadores_items->KeyFilter();

		// Call Row Selecting event
		$entrenadores_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_items->CurrentFilter = $sFilter;
		$sSql = $entrenadores_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_items;
		$entrenadores_items->id->setDbValue($rs->fields('id'));
		$entrenadores_items->item->setDbValue($rs->fields('item'));
		$entrenadores_items->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_items->cantidad->setDbValue($rs->fields('cantidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_items;

		// Initialize URLs
		// Call Row_Rendering event

		$entrenadores_items->Row_Rendering();

		// Common render codes for all row types
		// item

		$entrenadores_items->item->CellCssStyle = ""; $entrenadores_items->item->CellCssClass = "";
		$entrenadores_items->item->CellAttrs = array(); $entrenadores_items->item->ViewAttrs = array(); $entrenadores_items->item->EditAttrs = array();

		// entrenador
		$entrenadores_items->entrenador->CellCssStyle = ""; $entrenadores_items->entrenador->CellCssClass = "";
		$entrenadores_items->entrenador->CellAttrs = array(); $entrenadores_items->entrenador->ViewAttrs = array(); $entrenadores_items->entrenador->EditAttrs = array();

		// cantidad
		$entrenadores_items->cantidad->CellCssStyle = ""; $entrenadores_items->cantidad->CellCssClass = "";
		$entrenadores_items->cantidad->CellAttrs = array(); $entrenadores_items->cantidad->ViewAttrs = array(); $entrenadores_items->cantidad->EditAttrs = array();
		if ($entrenadores_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_items->id->ViewValue = $entrenadores_items->id->CurrentValue;
			$entrenadores_items->id->CssStyle = "";
			$entrenadores_items->id->CssClass = "";
			$entrenadores_items->id->ViewCustomAttributes = "";

			// item
			if (strval($entrenadores_items->item->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($entrenadores_items->item->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `items`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$entrenadores_items->item->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$entrenadores_items->item->ViewValue = $entrenadores_items->item->CurrentValue;
				}
			} else {
				$entrenadores_items->item->ViewValue = NULL;
			}
			$entrenadores_items->item->CssStyle = "";
			$entrenadores_items->item->CssClass = "";
			$entrenadores_items->item->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_items->entrenador->ViewValue = $entrenadores_items->entrenador->CurrentValue;
			$entrenadores_items->entrenador->CssStyle = "";
			$entrenadores_items->entrenador->CssClass = "";
			$entrenadores_items->entrenador->ViewCustomAttributes = "";

			// cantidad
			$entrenadores_items->cantidad->ViewValue = $entrenadores_items->cantidad->CurrentValue;
			$entrenadores_items->cantidad->CssStyle = "";
			$entrenadores_items->cantidad->CssClass = "";
			$entrenadores_items->cantidad->ViewCustomAttributes = "";

			// item
			$entrenadores_items->item->HrefValue = "";
			$entrenadores_items->item->TooltipValue = "";

			// entrenador
			$entrenadores_items->entrenador->HrefValue = "";
			$entrenadores_items->entrenador->TooltipValue = "";

			// cantidad
			$entrenadores_items->cantidad->HrefValue = "";
			$entrenadores_items->cantidad->TooltipValue = "";
		} elseif ($entrenadores_items->RowType == EW_ROWTYPE_ADD) { // Add row

			// item
			$entrenadores_items->item->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `items`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre` Desc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$entrenadores_items->item->EditValue = $arwrk;

			// entrenador
			$entrenadores_items->entrenador->EditCustomAttributes = "";
			if ($entrenadores_items->entrenador->getSessionValue() <> "") {
				$entrenadores_items->entrenador->CurrentValue = $entrenadores_items->entrenador->getSessionValue();
			$entrenadores_items->entrenador->ViewValue = $entrenadores_items->entrenador->CurrentValue;
			$entrenadores_items->entrenador->CssStyle = "";
			$entrenadores_items->entrenador->CssClass = "";
			$entrenadores_items->entrenador->ViewCustomAttributes = "";
			} else {
			$entrenadores_items->entrenador->EditValue = ew_HtmlEncode($entrenadores_items->entrenador->CurrentValue);
			}

			// cantidad
			$entrenadores_items->cantidad->EditCustomAttributes = "";
			$entrenadores_items->cantidad->EditValue = ew_HtmlEncode($entrenadores_items->cantidad->CurrentValue);
		}

		// Call Row Rendered event
		if ($entrenadores_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_items->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $entrenadores_items;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($entrenadores_items->item->FormValue) && $entrenadores_items->item->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_items->item->FldCaption();
		}
		if (!is_null($entrenadores_items->entrenador->FormValue) && $entrenadores_items->entrenador->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $entrenadores_items->entrenador->FldCaption();
		}
		if (!ew_CheckInteger($entrenadores_items->entrenador->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_items->entrenador->FldErrMsg();
		}
		if (!ew_CheckInteger($entrenadores_items->cantidad->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $entrenadores_items->cantidad->FldErrMsg();
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
		global $conn, $Language, $Security, $entrenadores_items;
		$rsnew = array();

		// item
		$entrenadores_items->item->SetDbValueDef($rsnew, $entrenadores_items->item->CurrentValue, 0, FALSE);

		// entrenador
		$entrenadores_items->entrenador->SetDbValueDef($rsnew, $entrenadores_items->entrenador->CurrentValue, 0, FALSE);

		// cantidad
		$entrenadores_items->cantidad->SetDbValueDef($rsnew, $entrenadores_items->cantidad->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $entrenadores_items->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($entrenadores_items->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($entrenadores_items->CancelMessage <> "") {
				$this->setMessage($entrenadores_items->CancelMessage);
				$entrenadores_items->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$entrenadores_items->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $entrenadores_items->id->DbValue;

			// Call Row Inserted event
			$entrenadores_items->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $entrenadores_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "entrenadores") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $entrenadores_items->SqlMasterFilter_entrenadores();
				$this->sDbDetailFilter = $entrenadores_items->SqlDetailFilter_entrenadores();
				if (@$_GET["id"] <> "") {
					$GLOBALS["entrenadores"]->id->setQueryStringValue($_GET["id"]);
					$entrenadores_items->entrenador->setQueryStringValue($GLOBALS["entrenadores"]->id->QueryStringValue);
					$entrenadores_items->entrenador->setSessionValue($entrenadores_items->entrenador->QueryStringValue);
					if (!is_numeric($GLOBALS["entrenadores"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["entrenadores"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@entrenador@", ew_AdjustSql($GLOBALS["entrenadores"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$entrenadores_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$entrenadores_items->setStartRecordNumber($this->lStartRec);
			$entrenadores_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$entrenadores_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "entrenadores") {
				if ($entrenadores_items->entrenador->QueryStringValue == "") $entrenadores_items->entrenador->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $entrenadores_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $entrenadores_items->getDetailFilter(); // Restore detail filter
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
