<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "mapasinfo.php" ?>
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
$mapas_edit = new cmapas_edit();
$Page =& $mapas_edit;

// Page init
$mapas_edit->Page_Init();

// Page main
$mapas_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_edit = new ew_Page("mapas_edit");

// page properties
mapas_edit.PageID = "edit"; // page ID
mapas_edit.FormID = "fmapasedit"; // form ID
var EW_PAGE_ID = mapas_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
mapas_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_imagen"];
		aelm = fobj.elements["a" + infix + "_imagen"];
		var chk_imagen = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_imagen && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas->imagen->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mapas_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas->TableCaption() ?><br><br>
<a href="<?php echo $mapas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_edit->ShowMessage();
?>
<form name="fmapasedit" id="fmapasedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return mapas_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="mapas">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mapas->id->Visible) { // id ?>
	<tr<?php echo $mapas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->id->FldCaption() ?></td>
		<td<?php echo $mapas->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $mapas->id->ViewAttributes() ?>><?php echo $mapas->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($mapas->id->CurrentValue) ?>">
</span><?php echo $mapas->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas->imagen->Visible) { // imagen ?>
	<tr<?php echo $mapas->imagen->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->imagen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($mapas->imagen->HrefValue <> "" || $mapas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $mapas->imagen->HrefValue ?>"><?php echo $mapas->imagen->EditValue ?></a>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<?php echo $mapas->imagen->EditValue ?>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $mapas->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$mapas->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" title="<?php echo $mapas->imagen->FldTitle() ?>" size="30"<?php echo $mapas->imagen->EditAttributes() ?>>
</div>
</span><?php echo $mapas->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_norte->Visible) { // mapa_norte ?>
	<tr<?php echo $mapas->mapa_norte->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_norte->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_norte->CellAttributes() ?>><span id="el_mapa_norte">
<select id="x_mapa_norte" name="x_mapa_norte" title="<?php echo $mapas->mapa_norte->FldTitle() ?>"<?php echo $mapas->mapa_norte->EditAttributes() ?>>
<?php
if (is_array($mapas->mapa_norte->EditValue)) {
	$arwrk = $mapas->mapa_norte->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mapas->mapa_norte->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mapas->mapa_norte->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_este->Visible) { // mapa_este ?>
	<tr<?php echo $mapas->mapa_este->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_este->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_este->CellAttributes() ?>><span id="el_mapa_este">
<select id="x_mapa_este" name="x_mapa_este" title="<?php echo $mapas->mapa_este->FldTitle() ?>"<?php echo $mapas->mapa_este->EditAttributes() ?>>
<?php
if (is_array($mapas->mapa_este->EditValue)) {
	$arwrk = $mapas->mapa_este->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mapas->mapa_este->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mapas->mapa_este->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_sur->Visible) { // mapa_sur ?>
	<tr<?php echo $mapas->mapa_sur->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_sur->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_sur->CellAttributes() ?>><span id="el_mapa_sur">
<select id="x_mapa_sur" name="x_mapa_sur" title="<?php echo $mapas->mapa_sur->FldTitle() ?>"<?php echo $mapas->mapa_sur->EditAttributes() ?>>
<?php
if (is_array($mapas->mapa_sur->EditValue)) {
	$arwrk = $mapas->mapa_sur->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mapas->mapa_sur->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mapas->mapa_sur->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas->mapa_oeste->Visible) { // mapa_oeste ?>
	<tr<?php echo $mapas->mapa_oeste->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas->mapa_oeste->FldCaption() ?></td>
		<td<?php echo $mapas->mapa_oeste->CellAttributes() ?>><span id="el_mapa_oeste">
<select id="x_mapa_oeste" name="x_mapa_oeste" title="<?php echo $mapas->mapa_oeste->FldTitle() ?>"<?php echo $mapas->mapa_oeste->EditAttributes() ?>>
<?php
if (is_array($mapas->mapa_oeste->EditValue)) {
	$arwrk = $mapas->mapa_oeste->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mapas->mapa_oeste->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mapas->mapa_oeste->CustomMsg ?></td>
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
$mapas_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'mapas';

	// Page object name
	var $PageObjName = 'mapas_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mapas;
		if ($mapas->UseTokenInUrl) $PageUrl .= "t=" . $mapas->TableVar . "&"; // Add page token
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
		global $objForm, $mapas;
		if ($mapas->UseTokenInUrl) {
			if ($objForm)
				return ($mapas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mapas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmapas_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas)
		$GLOBALS["mapas"] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas', TRUE);

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
		global $mapas;

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
		global $objForm, $Language, $gsFormError, $mapas;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$mapas->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$mapas->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$mapas->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$mapas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$mapas->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($mapas->id->CurrentValue == "")
			$this->Page_Terminate("mapaslist.php"); // Invalid key, return to list
		switch ($mapas->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("mapaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$mapas->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $mapas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$mapas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$mapas->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mapas;

		// Get upload data
			if ($mapas->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $mapas->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mapas;
		$mapas->id->setFormValue($objForm->GetValue("x_id"));
		$mapas->mapa_norte->setFormValue($objForm->GetValue("x_mapa_norte"));
		$mapas->mapa_este->setFormValue($objForm->GetValue("x_mapa_este"));
		$mapas->mapa_sur->setFormValue($objForm->GetValue("x_mapa_sur"));
		$mapas->mapa_oeste->setFormValue($objForm->GetValue("x_mapa_oeste"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $mapas;
		$this->LoadRow();
		$mapas->id->CurrentValue = $mapas->id->FormValue;
		$mapas->mapa_norte->CurrentValue = $mapas->mapa_norte->FormValue;
		$mapas->mapa_este->CurrentValue = $mapas->mapa_este->FormValue;
		$mapas->mapa_sur->CurrentValue = $mapas->mapa_sur->FormValue;
		$mapas->mapa_oeste->CurrentValue = $mapas->mapa_oeste->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mapas;
		$sFilter = $mapas->KeyFilter();

		// Call Row Selecting event
		$mapas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$mapas->CurrentFilter = $sFilter;
		$sSql = $mapas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$mapas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $mapas;
		$mapas->id->setDbValue($rs->fields('id'));
		$mapas->imagen->Upload->DbValue = $rs->fields('imagen');
		$mapas->mapa_norte->setDbValue($rs->fields('mapa_norte'));
		$mapas->mapa_este->setDbValue($rs->fields('mapa_este'));
		$mapas->mapa_sur->setDbValue($rs->fields('mapa_sur'));
		$mapas->mapa_oeste->setDbValue($rs->fields('mapa_oeste'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $mapas;

		// Initialize URLs
		// Call Row_Rendering event

		$mapas->Row_Rendering();

		// Common render codes for all row types
		// id

		$mapas->id->CellCssStyle = ""; $mapas->id->CellCssClass = "";
		$mapas->id->CellAttrs = array(); $mapas->id->ViewAttrs = array(); $mapas->id->EditAttrs = array();

		// imagen
		$mapas->imagen->CellCssStyle = ""; $mapas->imagen->CellCssClass = "";
		$mapas->imagen->CellAttrs = array(); $mapas->imagen->ViewAttrs = array(); $mapas->imagen->EditAttrs = array();

		// mapa_norte
		$mapas->mapa_norte->CellCssStyle = ""; $mapas->mapa_norte->CellCssClass = "";
		$mapas->mapa_norte->CellAttrs = array(); $mapas->mapa_norte->ViewAttrs = array(); $mapas->mapa_norte->EditAttrs = array();

		// mapa_este
		$mapas->mapa_este->CellCssStyle = ""; $mapas->mapa_este->CellCssClass = "";
		$mapas->mapa_este->CellAttrs = array(); $mapas->mapa_este->ViewAttrs = array(); $mapas->mapa_este->EditAttrs = array();

		// mapa_sur
		$mapas->mapa_sur->CellCssStyle = ""; $mapas->mapa_sur->CellCssClass = "";
		$mapas->mapa_sur->CellAttrs = array(); $mapas->mapa_sur->ViewAttrs = array(); $mapas->mapa_sur->EditAttrs = array();

		// mapa_oeste
		$mapas->mapa_oeste->CellCssStyle = ""; $mapas->mapa_oeste->CellCssClass = "";
		$mapas->mapa_oeste->CellAttrs = array(); $mapas->mapa_oeste->ViewAttrs = array(); $mapas->mapa_oeste->EditAttrs = array();
		if ($mapas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mapas->id->ViewValue = $mapas->id->CurrentValue;
			$mapas->id->CssStyle = "";
			$mapas->id->CssClass = "";
			$mapas->id->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->ViewValue = $mapas->imagen->Upload->DbValue;
			} else {
				$mapas->imagen->ViewValue = "";
			}
			$mapas->imagen->CssStyle = "";
			$mapas->imagen->CssClass = "";
			$mapas->imagen->ViewCustomAttributes = "";

			// mapa_norte
			if (strval($mapas->mapa_norte->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_norte->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_norte->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_norte->ViewValue = $mapas->mapa_norte->CurrentValue;
				}
			} else {
				$mapas->mapa_norte->ViewValue = NULL;
			}
			$mapas->mapa_norte->CssStyle = "";
			$mapas->mapa_norte->CssClass = "";
			$mapas->mapa_norte->ViewCustomAttributes = "";

			// mapa_este
			if (strval($mapas->mapa_este->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_este->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_este->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_este->ViewValue = $mapas->mapa_este->CurrentValue;
				}
			} else {
				$mapas->mapa_este->ViewValue = NULL;
			}
			$mapas->mapa_este->CssStyle = "";
			$mapas->mapa_este->CssClass = "";
			$mapas->mapa_este->ViewCustomAttributes = "";

			// mapa_sur
			if (strval($mapas->mapa_sur->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_sur->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_sur->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_sur->ViewValue = $mapas->mapa_sur->CurrentValue;
				}
			} else {
				$mapas->mapa_sur->ViewValue = NULL;
			}
			$mapas->mapa_sur->CssStyle = "";
			$mapas->mapa_sur->CssClass = "";
			$mapas->mapa_sur->ViewCustomAttributes = "";

			// mapa_oeste
			if (strval($mapas->mapa_oeste->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas->mapa_oeste->CurrentValue) . "";
			$sSqlWrk = "SELECT `id` FROM `mapas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas->mapa_oeste->ViewValue = $rswrk->fields('id');
					$rswrk->Close();
				} else {
					$mapas->mapa_oeste->ViewValue = $mapas->mapa_oeste->CurrentValue;
				}
			} else {
				$mapas->mapa_oeste->ViewValue = NULL;
			}
			$mapas->mapa_oeste->CssStyle = "";
			$mapas->mapa_oeste->CssClass = "";
			$mapas->mapa_oeste->ViewCustomAttributes = "";

			// id
			$mapas->id->HrefValue = "";
			$mapas->id->TooltipValue = "";

			// imagen
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->HrefValue = ew_UploadPathEx(FALSE, $mapas->imagen->UploadPath) . ((!empty($mapas->imagen->ViewValue)) ? $mapas->imagen->ViewValue : $mapas->imagen->CurrentValue);
				if ($mapas->Export <> "") $mapas->imagen->HrefValue = ew_ConvertFullUrl($mapas->imagen->HrefValue);
			} else {
				$mapas->imagen->HrefValue = "";
			}
			$mapas->imagen->TooltipValue = "";

			// mapa_norte
			$mapas->mapa_norte->HrefValue = "";
			$mapas->mapa_norte->TooltipValue = "";

			// mapa_este
			$mapas->mapa_este->HrefValue = "";
			$mapas->mapa_este->TooltipValue = "";

			// mapa_sur
			$mapas->mapa_sur->HrefValue = "";
			$mapas->mapa_sur->TooltipValue = "";

			// mapa_oeste
			$mapas->mapa_oeste->HrefValue = "";
			$mapas->mapa_oeste->TooltipValue = "";
		} elseif ($mapas->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$mapas->id->EditCustomAttributes = "";
			$mapas->id->EditValue = $mapas->id->CurrentValue;
			$mapas->id->CssStyle = "";
			$mapas->id->CssClass = "";
			$mapas->id->ViewCustomAttributes = "";

			// imagen
			$mapas->imagen->EditCustomAttributes = "";
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->EditValue = $mapas->imagen->Upload->DbValue;
			} else {
				$mapas->imagen->EditValue = "";
			}

			// mapa_norte
			$mapas->mapa_norte->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `id`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mapas`";
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
			$mapas->mapa_norte->EditValue = $arwrk;

			// mapa_este
			$mapas->mapa_este->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `id`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mapas`";
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
			$mapas->mapa_este->EditValue = $arwrk;

			// mapa_sur
			$mapas->mapa_sur->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `id`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mapas`";
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
			$mapas->mapa_sur->EditValue = $arwrk;

			// mapa_oeste
			$mapas->mapa_oeste->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `id`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mapas`";
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
			$mapas->mapa_oeste->EditValue = $arwrk;

			// Edit refer script
			// id

			$mapas->id->HrefValue = "";

			// imagen
			if (!ew_Empty($mapas->imagen->Upload->DbValue)) {
				$mapas->imagen->HrefValue = ew_UploadPathEx(FALSE, $mapas->imagen->UploadPath) . ((!empty($mapas->imagen->EditValue)) ? $mapas->imagen->EditValue : $mapas->imagen->CurrentValue);
				if ($mapas->Export <> "") $mapas->imagen->HrefValue = ew_ConvertFullUrl($mapas->imagen->HrefValue);
			} else {
				$mapas->imagen->HrefValue = "";
			}

			// mapa_norte
			$mapas->mapa_norte->HrefValue = "";

			// mapa_este
			$mapas->mapa_este->HrefValue = "";

			// mapa_sur
			$mapas->mapa_sur->HrefValue = "";

			// mapa_oeste
			$mapas->mapa_oeste->HrefValue = "";
		}

		// Call Row Rendered event
		if ($mapas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $mapas;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($mapas->imagen->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($mapas->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $mapas->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mapas->imagen->Upload->Action == "3" && is_null($mapas->imagen->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas->imagen->FldCaption();
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
		global $conn, $Security, $Language, $mapas;
		$sFilter = $mapas->KeyFilter();
		$mapas->CurrentFilter = $sFilter;
		$sSql = $mapas->SQL();
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

			// imagen
			$mapas->imagen->Upload->SaveToSession(); // Save file value to Session
						if ($mapas->imagen->Upload->Action == "2" || $mapas->imagen->Upload->Action == "3") { // Update/Remove
			$mapas->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($mapas->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				if ($mapas->imagen->Upload->FileName == $mapas->imagen->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['imagen'] = $mapas->imagen->Upload->FileName;
				} else {
					$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $mapas->imagen->UploadPath), $mapas->imagen->Upload->FileName);
				}
			}
			}

			// mapa_norte
			$mapas->mapa_norte->SetDbValueDef($rsnew, $mapas->mapa_norte->CurrentValue, NULL, FALSE);

			// mapa_este
			$mapas->mapa_este->SetDbValueDef($rsnew, $mapas->mapa_este->CurrentValue, NULL, FALSE);

			// mapa_sur
			$mapas->mapa_sur->SetDbValueDef($rsnew, $mapas->mapa_sur->CurrentValue, NULL, FALSE);

			// mapa_oeste
			$mapas->mapa_oeste->SetDbValueDef($rsnew, $mapas->mapa_oeste->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $mapas->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($mapas->imagen->Upload->Value)) {
				if ($mapas->imagen->Upload->FileName == $mapas->imagen->Upload->DbValue) { // Overwrite if same file name
					$mapas->imagen->Upload->SaveToFile($mapas->imagen->UploadPath, $rsnew['imagen'], TRUE);
					$mapas->imagen->Upload->DbValue = ""; // No need to delete any more
				} else {
					$mapas->imagen->Upload->SaveToFile($mapas->imagen->UploadPath, $rsnew['imagen'], FALSE);
				}
			}
			if ($mapas->imagen->Upload->Action == "2" || $mapas->imagen->Upload->Action == "3") { // Update/Remove
				if ($mapas->imagen->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $mapas->imagen->UploadPath) . $mapas->imagen->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mapas->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mapas->CancelMessage <> "") {
					$this->setMessage($mapas->CancelMessage);
					$mapas->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mapas->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// imagen
		$mapas->imagen->Upload->RemoveFromSession(); // Remove file value from Session
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
