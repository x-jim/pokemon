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
$secuencias_escenas_delete = new csecuencias_escenas_delete();
$Page =& $secuencias_escenas_delete;

// Page init
$secuencias_escenas_delete->Page_Init();

// Page main
$secuencias_escenas_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_escenas_delete = new ew_Page("secuencias_escenas_delete");

// page properties
secuencias_escenas_delete.PageID = "delete"; // page ID
secuencias_escenas_delete.FormID = "fsecuencias_escenasdelete"; // form ID
var EW_PAGE_ID = secuencias_escenas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_escenas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_escenas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_escenas_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $secuencias_escenas_delete->LoadRecordset())
	$secuencias_escenas_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($secuencias_escenas_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$secuencias_escenas_delete->Page_Terminate("secuencias_escenaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias_escenas->TableCaption() ?><br><br>
<a href="<?php echo $secuencias_escenas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_escenas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="secuencias_escenas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($secuencias_escenas_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $secuencias_escenas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $secuencias_escenas->id->FldCaption() ?></td>
		<td valign="top"><?php echo $secuencias_escenas->secuencia->FldCaption() ?></td>
		<td valign="top"><?php echo $secuencias_escenas->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $secuencias_escenas->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $secuencias_escenas->orden->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$secuencias_escenas_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$secuencias_escenas_delete->lRecCnt++;

	// Set row properties
	$secuencias_escenas->CssClass = "";
	$secuencias_escenas->CssStyle = "";
	$secuencias_escenas->RowAttrs = array();
	$secuencias_escenas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$secuencias_escenas_delete->LoadRowValues($rs);

	// Render row
	$secuencias_escenas_delete->RenderRow();
?>
	<tr<?php echo $secuencias_escenas->RowAttributes() ?>>
		<td<?php echo $secuencias_escenas->id->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->id->ViewAttributes() ?>><?php echo $secuencias_escenas->id->ListViewValue() ?></div></td>
		<td<?php echo $secuencias_escenas->secuencia->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->secuencia->ViewAttributes() ?>><?php echo $secuencias_escenas->secuencia->ListViewValue() ?></div></td>
		<td<?php echo $secuencias_escenas->nombre->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->nombre->ViewAttributes() ?>><?php echo $secuencias_escenas->nombre->ListViewValue() ?></div></td>
		<td<?php echo $secuencias_escenas->imagen->CellAttributes() ?>>
<?php if ($secuencias_escenas->imagen->HrefValue <> "" || $secuencias_escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $secuencias_escenas->imagen->HrefValue ?>"><?php echo $secuencias_escenas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($secuencias_escenas->imagen->Upload->DbValue)) { ?>
<?php echo $secuencias_escenas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($secuencias_escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $secuencias_escenas->orden->CellAttributes() ?>>
<div<?php echo $secuencias_escenas->orden->ViewAttributes() ?>><?php echo $secuencias_escenas->orden->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$secuencias_escenas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_escenas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'secuencias_escenas';

	// Page object name
	var $PageObjName = 'secuencias_escenas_delete';

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
	function csecuencias_escenas_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias_escenas)
		$GLOBALS["secuencias_escenas"] = new csecuencias_escenas();

		// Table object (secuencias)
		$GLOBALS['secuencias'] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $secuencias_escenas;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$secuencias_escenas->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($secuencias_escenas->id->QueryStringValue))
				$this->Page_Terminate("secuencias_escenaslist.php"); // Prevent SQL injection, exit
			$sKey .= $secuencias_escenas->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("secuencias_escenaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("secuencias_escenaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in secuencias_escenas class, secuencias_escenasinfo.php

		$secuencias_escenas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$secuencias_escenas->CurrentAction = $_POST["a_delete"];
		} else {
			$secuencias_escenas->CurrentAction = "I"; // Display record
		}
		switch ($secuencias_escenas->CurrentAction) {
			case "D": // Delete
				$secuencias_escenas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($secuencias_escenas->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $secuencias_escenas;
		$DeleteRows = TRUE;
		$sWrkFilter = $secuencias_escenas->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in secuencias_escenas class, secuencias_escenasinfo.php

		$secuencias_escenas->CurrentFilter = $sWrkFilter;
		$sSql = $secuencias_escenas->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $secuencias_escenas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, $secuencias_escenas->imagen->UploadPath) . $row['imagen']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($secuencias_escenas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($secuencias_escenas->CancelMessage <> "") {
				$this->setMessage($secuencias_escenas->CancelMessage);
				$secuencias_escenas->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$secuencias_escenas->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secuencias_escenas;

		// Call Recordset Selecting event
		$secuencias_escenas->Recordset_Selecting($secuencias_escenas->CurrentFilter);

		// Load List page SQL
		$sSql = $secuencias_escenas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secuencias_escenas->Recordset_Selected($rs);
		return $rs;
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
		// id

		$secuencias_escenas->id->CellCssStyle = ""; $secuencias_escenas->id->CellCssClass = "";
		$secuencias_escenas->id->CellAttrs = array(); $secuencias_escenas->id->ViewAttrs = array(); $secuencias_escenas->id->EditAttrs = array();

		// secuencia
		$secuencias_escenas->secuencia->CellCssStyle = ""; $secuencias_escenas->secuencia->CellCssClass = "";
		$secuencias_escenas->secuencia->CellAttrs = array(); $secuencias_escenas->secuencia->ViewAttrs = array(); $secuencias_escenas->secuencia->EditAttrs = array();

		// nombre
		$secuencias_escenas->nombre->CellCssStyle = ""; $secuencias_escenas->nombre->CellCssClass = "";
		$secuencias_escenas->nombre->CellAttrs = array(); $secuencias_escenas->nombre->ViewAttrs = array(); $secuencias_escenas->nombre->EditAttrs = array();

		// imagen
		$secuencias_escenas->imagen->CellCssStyle = ""; $secuencias_escenas->imagen->CellCssClass = "";
		$secuencias_escenas->imagen->CellAttrs = array(); $secuencias_escenas->imagen->ViewAttrs = array(); $secuencias_escenas->imagen->EditAttrs = array();

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

			// orden
			$secuencias_escenas->orden->ViewValue = $secuencias_escenas->orden->CurrentValue;
			$secuencias_escenas->orden->CssStyle = "";
			$secuencias_escenas->orden->CssClass = "";
			$secuencias_escenas->orden->ViewCustomAttributes = "";

			// id
			$secuencias_escenas->id->HrefValue = "";
			$secuencias_escenas->id->TooltipValue = "";

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

			// orden
			$secuencias_escenas->orden->HrefValue = "";
			$secuencias_escenas->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias_escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias_escenas->Row_Rendered();
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
}
?>
