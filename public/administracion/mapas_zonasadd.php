<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "mapas_zonasinfo.php" ?>
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
$mapas_zonas_add = new cmapas_zonas_add();
$Page =& $mapas_zonas_add;

// Page init
$mapas_zonas_add->Page_Init();

// Page main
$mapas_zonas_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_zonas_add = new ew_Page("mapas_zonas_add");

// page properties
mapas_zonas_add.PageID = "add"; // page ID
mapas_zonas_add.FormID = "fmapas_zonasadd"; // form ID
var EW_PAGE_ID = mapas_zonas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
mapas_zonas_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_mapa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->mapa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mapa"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($mapas_zonas->mapa->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pos_x"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->pos_x->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pos_x"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($mapas_zonas->pos_x->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pos_y"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->pos_y->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pos_y"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($mapas_zonas->pos_y->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_secuencia"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->secuencia->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_width"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->width->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_width"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($mapas_zonas->width->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_height"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($mapas_zonas->height->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_height"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($mapas_zonas->height->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mapas_zonas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_zonas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_zonas_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas_zonas->TableCaption() ?><br><br>
<a href="<?php echo $mapas_zonas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_zonas_add->ShowMessage();
?>
<form name="fmapas_zonasadd" id="fmapas_zonasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mapas_zonas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mapas_zonas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mapas_zonas->mapa->Visible) { // mapa ?>
	<tr<?php echo $mapas_zonas->mapa->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->mapa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->mapa->CellAttributes() ?>><span id="el_mapa">
<?php if ($mapas_zonas->mapa->getSessionValue() <> "") { ?>
<div<?php echo $mapas_zonas->mapa->ViewAttributes() ?>><?php echo $mapas_zonas->mapa->ViewValue ?></div>
<input type="hidden" id="x_mapa" name="x_mapa" value="<?php echo ew_HtmlEncode($mapas_zonas->mapa->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_mapa" id="x_mapa" title="<?php echo $mapas_zonas->mapa->FldTitle() ?>" size="30" value="<?php echo $mapas_zonas->mapa->EditValue ?>"<?php echo $mapas_zonas->mapa->EditAttributes() ?>>
<?php } ?>
</span><?php echo $mapas_zonas->mapa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->pos_x->Visible) { // pos_x ?>
	<tr<?php echo $mapas_zonas->pos_x->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->pos_x->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->pos_x->CellAttributes() ?>><span id="el_pos_x">
<input type="text" name="x_pos_x" id="x_pos_x" title="<?php echo $mapas_zonas->pos_x->FldTitle() ?>" size="30" value="<?php echo $mapas_zonas->pos_x->EditValue ?>"<?php echo $mapas_zonas->pos_x->EditAttributes() ?>>
</span><?php echo $mapas_zonas->pos_x->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->pos_y->Visible) { // pos_y ?>
	<tr<?php echo $mapas_zonas->pos_y->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->pos_y->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->pos_y->CellAttributes() ?>><span id="el_pos_y">
<input type="text" name="x_pos_y" id="x_pos_y" title="<?php echo $mapas_zonas->pos_y->FldTitle() ?>" size="30" value="<?php echo $mapas_zonas->pos_y->EditValue ?>"<?php echo $mapas_zonas->pos_y->EditAttributes() ?>>
</span><?php echo $mapas_zonas->pos_y->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->secuencia->Visible) { // secuencia ?>
	<tr<?php echo $mapas_zonas->secuencia->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->secuencia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->secuencia->CellAttributes() ?>><span id="el_secuencia">
<select id="x_secuencia" name="x_secuencia" title="<?php echo $mapas_zonas->secuencia->FldTitle() ?>"<?php echo $mapas_zonas->secuencia->EditAttributes() ?>>
<?php
if (is_array($mapas_zonas->secuencia->EditValue)) {
	$arwrk = $mapas_zonas->secuencia->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mapas_zonas->secuencia->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mapas_zonas->secuencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->width->Visible) { // width ?>
	<tr<?php echo $mapas_zonas->width->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->width->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->width->CellAttributes() ?>><span id="el_width">
<input type="text" name="x_width" id="x_width" title="<?php echo $mapas_zonas->width->FldTitle() ?>" size="30" value="<?php echo $mapas_zonas->width->EditValue ?>"<?php echo $mapas_zonas->width->EditAttributes() ?>>
</span><?php echo $mapas_zonas->width->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->height->Visible) { // height ?>
	<tr<?php echo $mapas_zonas->height->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->height->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $mapas_zonas->height->CellAttributes() ?>><span id="el_height">
<input type="text" name="x_height" id="x_height" title="<?php echo $mapas_zonas->height->FldTitle() ?>" size="30" value="<?php echo $mapas_zonas->height->EditValue ?>"<?php echo $mapas_zonas->height->EditAttributes() ?>>
</span><?php echo $mapas_zonas->height->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mapas_zonas->titulo->Visible) { // titulo ?>
	<tr<?php echo $mapas_zonas->titulo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $mapas_zonas->titulo->FldCaption() ?></td>
		<td<?php echo $mapas_zonas->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" title="<?php echo $mapas_zonas->titulo->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $mapas_zonas->titulo->EditValue ?>"<?php echo $mapas_zonas->titulo->EditAttributes() ?>>
</span><?php echo $mapas_zonas->titulo->CustomMsg ?></td>
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
$mapas_zonas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_zonas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'mapas_zonas';

	// Page object name
	var $PageObjName = 'mapas_zonas_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mapas_zonas;
		if ($mapas_zonas->UseTokenInUrl) $PageUrl .= "t=" . $mapas_zonas->TableVar . "&"; // Add page token
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
		global $objForm, $mapas_zonas;
		if ($mapas_zonas->UseTokenInUrl) {
			if ($objForm)
				return ($mapas_zonas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mapas_zonas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmapas_zonas_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas_zonas)
		$GLOBALS["mapas_zonas"] = new cmapas_zonas();

		// Table object (mapas)
		$GLOBALS['mapas'] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mapas_zonas', TRUE);

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
		global $mapas_zonas;

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
		global $objForm, $Language, $gsFormError, $mapas_zonas;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $mapas_zonas->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $mapas_zonas->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$mapas_zonas->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $mapas_zonas->CurrentAction = "C"; // Copy record
		  } else {
		    $mapas_zonas->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($mapas_zonas->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("mapas_zonaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$mapas_zonas->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $mapas_zonas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$mapas_zonas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mapas_zonas;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $mapas_zonas;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mapas_zonas;
		$mapas_zonas->mapa->setFormValue($objForm->GetValue("x_mapa"));
		$mapas_zonas->pos_x->setFormValue($objForm->GetValue("x_pos_x"));
		$mapas_zonas->pos_y->setFormValue($objForm->GetValue("x_pos_y"));
		$mapas_zonas->secuencia->setFormValue($objForm->GetValue("x_secuencia"));
		$mapas_zonas->width->setFormValue($objForm->GetValue("x_width"));
		$mapas_zonas->height->setFormValue($objForm->GetValue("x_height"));
		$mapas_zonas->titulo->setFormValue($objForm->GetValue("x_titulo"));
		$mapas_zonas->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $mapas_zonas;
		$mapas_zonas->id->CurrentValue = $mapas_zonas->id->FormValue;
		$mapas_zonas->mapa->CurrentValue = $mapas_zonas->mapa->FormValue;
		$mapas_zonas->pos_x->CurrentValue = $mapas_zonas->pos_x->FormValue;
		$mapas_zonas->pos_y->CurrentValue = $mapas_zonas->pos_y->FormValue;
		$mapas_zonas->secuencia->CurrentValue = $mapas_zonas->secuencia->FormValue;
		$mapas_zonas->width->CurrentValue = $mapas_zonas->width->FormValue;
		$mapas_zonas->height->CurrentValue = $mapas_zonas->height->FormValue;
		$mapas_zonas->titulo->CurrentValue = $mapas_zonas->titulo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mapas_zonas;
		$sFilter = $mapas_zonas->KeyFilter();

		// Call Row Selecting event
		$mapas_zonas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$mapas_zonas->CurrentFilter = $sFilter;
		$sSql = $mapas_zonas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$mapas_zonas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $mapas_zonas;
		$mapas_zonas->id->setDbValue($rs->fields('id'));
		$mapas_zonas->mapa->setDbValue($rs->fields('mapa'));
		$mapas_zonas->pos_x->setDbValue($rs->fields('pos_x'));
		$mapas_zonas->pos_y->setDbValue($rs->fields('pos_y'));
		$mapas_zonas->secuencia->setDbValue($rs->fields('secuencia'));
		$mapas_zonas->width->setDbValue($rs->fields('width'));
		$mapas_zonas->height->setDbValue($rs->fields('height'));
		$mapas_zonas->titulo->setDbValue($rs->fields('titulo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $mapas_zonas;

		// Initialize URLs
		// Call Row_Rendering event

		$mapas_zonas->Row_Rendering();

		// Common render codes for all row types
		// mapa

		$mapas_zonas->mapa->CellCssStyle = ""; $mapas_zonas->mapa->CellCssClass = "";
		$mapas_zonas->mapa->CellAttrs = array(); $mapas_zonas->mapa->ViewAttrs = array(); $mapas_zonas->mapa->EditAttrs = array();

		// pos_x
		$mapas_zonas->pos_x->CellCssStyle = ""; $mapas_zonas->pos_x->CellCssClass = "";
		$mapas_zonas->pos_x->CellAttrs = array(); $mapas_zonas->pos_x->ViewAttrs = array(); $mapas_zonas->pos_x->EditAttrs = array();

		// pos_y
		$mapas_zonas->pos_y->CellCssStyle = ""; $mapas_zonas->pos_y->CellCssClass = "";
		$mapas_zonas->pos_y->CellAttrs = array(); $mapas_zonas->pos_y->ViewAttrs = array(); $mapas_zonas->pos_y->EditAttrs = array();

		// secuencia
		$mapas_zonas->secuencia->CellCssStyle = ""; $mapas_zonas->secuencia->CellCssClass = "";
		$mapas_zonas->secuencia->CellAttrs = array(); $mapas_zonas->secuencia->ViewAttrs = array(); $mapas_zonas->secuencia->EditAttrs = array();

		// width
		$mapas_zonas->width->CellCssStyle = ""; $mapas_zonas->width->CellCssClass = "";
		$mapas_zonas->width->CellAttrs = array(); $mapas_zonas->width->ViewAttrs = array(); $mapas_zonas->width->EditAttrs = array();

		// height
		$mapas_zonas->height->CellCssStyle = ""; $mapas_zonas->height->CellCssClass = "";
		$mapas_zonas->height->CellAttrs = array(); $mapas_zonas->height->ViewAttrs = array(); $mapas_zonas->height->EditAttrs = array();

		// titulo
		$mapas_zonas->titulo->CellCssStyle = ""; $mapas_zonas->titulo->CellCssClass = "";
		$mapas_zonas->titulo->CellAttrs = array(); $mapas_zonas->titulo->ViewAttrs = array(); $mapas_zonas->titulo->EditAttrs = array();
		if ($mapas_zonas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mapas_zonas->id->ViewValue = $mapas_zonas->id->CurrentValue;
			$mapas_zonas->id->CssStyle = "";
			$mapas_zonas->id->CssClass = "";
			$mapas_zonas->id->ViewCustomAttributes = "";

			// mapa
			$mapas_zonas->mapa->ViewValue = $mapas_zonas->mapa->CurrentValue;
			$mapas_zonas->mapa->CssStyle = "";
			$mapas_zonas->mapa->CssClass = "";
			$mapas_zonas->mapa->ViewCustomAttributes = "";

			// pos_x
			$mapas_zonas->pos_x->ViewValue = $mapas_zonas->pos_x->CurrentValue;
			$mapas_zonas->pos_x->CssStyle = "";
			$mapas_zonas->pos_x->CssClass = "";
			$mapas_zonas->pos_x->ViewCustomAttributes = "";

			// pos_y
			$mapas_zonas->pos_y->ViewValue = $mapas_zonas->pos_y->CurrentValue;
			$mapas_zonas->pos_y->CssStyle = "";
			$mapas_zonas->pos_y->CssClass = "";
			$mapas_zonas->pos_y->ViewCustomAttributes = "";

			// secuencia
			if (strval($mapas_zonas->secuencia->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($mapas_zonas->secuencia->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `secuencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$mapas_zonas->secuencia->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$mapas_zonas->secuencia->ViewValue = $mapas_zonas->secuencia->CurrentValue;
				}
			} else {
				$mapas_zonas->secuencia->ViewValue = NULL;
			}
			$mapas_zonas->secuencia->CssStyle = "";
			$mapas_zonas->secuencia->CssClass = "";
			$mapas_zonas->secuencia->ViewCustomAttributes = "";

			// width
			$mapas_zonas->width->ViewValue = $mapas_zonas->width->CurrentValue;
			$mapas_zonas->width->CssStyle = "";
			$mapas_zonas->width->CssClass = "";
			$mapas_zonas->width->ViewCustomAttributes = "";

			// height
			$mapas_zonas->height->ViewValue = $mapas_zonas->height->CurrentValue;
			$mapas_zonas->height->CssStyle = "";
			$mapas_zonas->height->CssClass = "";
			$mapas_zonas->height->ViewCustomAttributes = "";

			// titulo
			$mapas_zonas->titulo->ViewValue = $mapas_zonas->titulo->CurrentValue;
			$mapas_zonas->titulo->CssStyle = "";
			$mapas_zonas->titulo->CssClass = "";
			$mapas_zonas->titulo->ViewCustomAttributes = "";

			// mapa
			$mapas_zonas->mapa->HrefValue = "";
			$mapas_zonas->mapa->TooltipValue = "";

			// pos_x
			$mapas_zonas->pos_x->HrefValue = "";
			$mapas_zonas->pos_x->TooltipValue = "";

			// pos_y
			$mapas_zonas->pos_y->HrefValue = "";
			$mapas_zonas->pos_y->TooltipValue = "";

			// secuencia
			$mapas_zonas->secuencia->HrefValue = "";
			$mapas_zonas->secuencia->TooltipValue = "";

			// width
			$mapas_zonas->width->HrefValue = "";
			$mapas_zonas->width->TooltipValue = "";

			// height
			$mapas_zonas->height->HrefValue = "";
			$mapas_zonas->height->TooltipValue = "";

			// titulo
			$mapas_zonas->titulo->HrefValue = "";
			$mapas_zonas->titulo->TooltipValue = "";
		} elseif ($mapas_zonas->RowType == EW_ROWTYPE_ADD) { // Add row

			// mapa
			$mapas_zonas->mapa->EditCustomAttributes = "";
			if ($mapas_zonas->mapa->getSessionValue() <> "") {
				$mapas_zonas->mapa->CurrentValue = $mapas_zonas->mapa->getSessionValue();
			$mapas_zonas->mapa->ViewValue = $mapas_zonas->mapa->CurrentValue;
			$mapas_zonas->mapa->CssStyle = "";
			$mapas_zonas->mapa->CssClass = "";
			$mapas_zonas->mapa->ViewCustomAttributes = "";
			} else {
			$mapas_zonas->mapa->EditValue = ew_HtmlEncode($mapas_zonas->mapa->CurrentValue);
			}

			// pos_x
			$mapas_zonas->pos_x->EditCustomAttributes = "";
			$mapas_zonas->pos_x->EditValue = ew_HtmlEncode($mapas_zonas->pos_x->CurrentValue);

			// pos_y
			$mapas_zonas->pos_y->EditCustomAttributes = "";
			$mapas_zonas->pos_y->EditValue = ew_HtmlEncode($mapas_zonas->pos_y->CurrentValue);

			// secuencia
			$mapas_zonas->secuencia->EditCustomAttributes = "";
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
			$mapas_zonas->secuencia->EditValue = $arwrk;

			// width
			$mapas_zonas->width->EditCustomAttributes = "";
			$mapas_zonas->width->EditValue = ew_HtmlEncode($mapas_zonas->width->CurrentValue);

			// height
			$mapas_zonas->height->EditCustomAttributes = "";
			$mapas_zonas->height->EditValue = ew_HtmlEncode($mapas_zonas->height->CurrentValue);

			// titulo
			$mapas_zonas->titulo->EditCustomAttributes = "";
			$mapas_zonas->titulo->EditValue = ew_HtmlEncode($mapas_zonas->titulo->CurrentValue);
		}

		// Call Row Rendered event
		if ($mapas_zonas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas_zonas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $mapas_zonas;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($mapas_zonas->mapa->FormValue) && $mapas_zonas->mapa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->mapa->FldCaption();
		}
		if (!ew_CheckInteger($mapas_zonas->mapa->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $mapas_zonas->mapa->FldErrMsg();
		}
		if (!is_null($mapas_zonas->pos_x->FormValue) && $mapas_zonas->pos_x->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->pos_x->FldCaption();
		}
		if (!ew_CheckInteger($mapas_zonas->pos_x->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $mapas_zonas->pos_x->FldErrMsg();
		}
		if (!is_null($mapas_zonas->pos_y->FormValue) && $mapas_zonas->pos_y->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->pos_y->FldCaption();
		}
		if (!ew_CheckInteger($mapas_zonas->pos_y->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $mapas_zonas->pos_y->FldErrMsg();
		}
		if (!is_null($mapas_zonas->secuencia->FormValue) && $mapas_zonas->secuencia->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->secuencia->FldCaption();
		}
		if (!is_null($mapas_zonas->width->FormValue) && $mapas_zonas->width->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->width->FldCaption();
		}
		if (!ew_CheckInteger($mapas_zonas->width->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $mapas_zonas->width->FldErrMsg();
		}
		if (!is_null($mapas_zonas->height->FormValue) && $mapas_zonas->height->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $mapas_zonas->height->FldCaption();
		}
		if (!ew_CheckInteger($mapas_zonas->height->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $mapas_zonas->height->FldErrMsg();
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
		global $conn, $Language, $Security, $mapas_zonas;
		$rsnew = array();

		// mapa
		$mapas_zonas->mapa->SetDbValueDef($rsnew, $mapas_zonas->mapa->CurrentValue, 0, FALSE);

		// pos_x
		$mapas_zonas->pos_x->SetDbValueDef($rsnew, $mapas_zonas->pos_x->CurrentValue, 0, FALSE);

		// pos_y
		$mapas_zonas->pos_y->SetDbValueDef($rsnew, $mapas_zonas->pos_y->CurrentValue, 0, FALSE);

		// secuencia
		$mapas_zonas->secuencia->SetDbValueDef($rsnew, $mapas_zonas->secuencia->CurrentValue, 0, FALSE);

		// width
		$mapas_zonas->width->SetDbValueDef($rsnew, $mapas_zonas->width->CurrentValue, 0, FALSE);

		// height
		$mapas_zonas->height->SetDbValueDef($rsnew, $mapas_zonas->height->CurrentValue, 0, FALSE);

		// titulo
		$mapas_zonas->titulo->SetDbValueDef($rsnew, $mapas_zonas->titulo->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $mapas_zonas->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mapas_zonas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mapas_zonas->CancelMessage <> "") {
				$this->setMessage($mapas_zonas->CancelMessage);
				$mapas_zonas->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$mapas_zonas->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $mapas_zonas->id->DbValue;

			// Call Row Inserted event
			$mapas_zonas->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $mapas_zonas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "mapas") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $mapas_zonas->SqlMasterFilter_mapas();
				$this->sDbDetailFilter = $mapas_zonas->SqlDetailFilter_mapas();
				if (@$_GET["id"] <> "") {
					$GLOBALS["mapas"]->id->setQueryStringValue($_GET["id"]);
					$mapas_zonas->mapa->setQueryStringValue($GLOBALS["mapas"]->id->QueryStringValue);
					$mapas_zonas->mapa->setSessionValue($mapas_zonas->mapa->QueryStringValue);
					if (!is_numeric($GLOBALS["mapas"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["mapas"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@mapa@", ew_AdjustSql($GLOBALS["mapas"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$mapas_zonas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$mapas_zonas->setStartRecordNumber($this->lStartRec);
			$mapas_zonas->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$mapas_zonas->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "mapas") {
				if ($mapas_zonas->mapa->QueryStringValue == "") $mapas_zonas->mapa->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $mapas_zonas->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $mapas_zonas->getDetailFilter(); // Restore detail filter
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
