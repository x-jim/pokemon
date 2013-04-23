<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_secuenciasinfo.php" ?>
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
$entrenadores_secuencias_delete = new centrenadores_secuencias_delete();
$Page =& $entrenadores_secuencias_delete;

// Page init
$entrenadores_secuencias_delete->Page_Init();

// Page main
$entrenadores_secuencias_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_secuencias_delete = new ew_Page("entrenadores_secuencias_delete");

// page properties
entrenadores_secuencias_delete.PageID = "delete"; // page ID
entrenadores_secuencias_delete.FormID = "fentrenadores_secuenciasdelete"; // form ID
var EW_PAGE_ID = entrenadores_secuencias_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_secuencias_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_secuencias_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_secuencias_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $entrenadores_secuencias_delete->LoadRecordset())
	$entrenadores_secuencias_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($entrenadores_secuencias_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$entrenadores_secuencias_delete->Page_Terminate("entrenadores_secuenciaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_secuencias->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_secuencias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_secuencias_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="entrenadores_secuencias">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($entrenadores_secuencias_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $entrenadores_secuencias->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $entrenadores_secuencias->id->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_secuencias->entrenador->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_secuencias->secuencia->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_secuencias->escena->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_secuencias->fecha->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$entrenadores_secuencias_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$entrenadores_secuencias_delete->lRecCnt++;

	// Set row properties
	$entrenadores_secuencias->CssClass = "";
	$entrenadores_secuencias->CssStyle = "";
	$entrenadores_secuencias->RowAttrs = array();
	$entrenadores_secuencias->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$entrenadores_secuencias_delete->LoadRowValues($rs);

	// Render row
	$entrenadores_secuencias_delete->RenderRow();
?>
	<tr<?php echo $entrenadores_secuencias->RowAttributes() ?>>
		<td<?php echo $entrenadores_secuencias->id->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->id->ViewAttributes() ?>><?php echo $entrenadores_secuencias->id->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_secuencias->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->entrenador->ViewAttributes() ?>><?php echo $entrenadores_secuencias->entrenador->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_secuencias->secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->secuencia->ViewAttributes() ?>><?php echo $entrenadores_secuencias->secuencia->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_secuencias->escena->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->escena->ViewAttributes() ?>><?php echo $entrenadores_secuencias->escena->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_secuencias->fecha->CellAttributes() ?>>
<div<?php echo $entrenadores_secuencias->fecha->ViewAttributes() ?>><?php echo $entrenadores_secuencias->fecha->ListViewValue() ?></div></td>
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
$entrenadores_secuencias_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_secuencias_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'entrenadores_secuencias';

	// Page object name
	var $PageObjName = 'entrenadores_secuencias_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_secuencias;
		if ($entrenadores_secuencias->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_secuencias->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_secuencias;
		if ($entrenadores_secuencias->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_secuencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_secuencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_secuencias_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_secuencias)
		$GLOBALS["entrenadores_secuencias"] = new centrenadores_secuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_secuencias', TRUE);

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
		global $entrenadores_secuencias;

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
		global $Language, $entrenadores_secuencias;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$entrenadores_secuencias->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($entrenadores_secuencias->id->QueryStringValue))
				$this->Page_Terminate("entrenadores_secuenciaslist.php"); // Prevent SQL injection, exit
			$sKey .= $entrenadores_secuencias->id->QueryStringValue;
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
			$this->Page_Terminate("entrenadores_secuenciaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("entrenadores_secuenciaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in entrenadores_secuencias class, entrenadores_secuenciasinfo.php

		$entrenadores_secuencias->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$entrenadores_secuencias->CurrentAction = $_POST["a_delete"];
		} else {
			$entrenadores_secuencias->CurrentAction = "I"; // Display record
		}
		switch ($entrenadores_secuencias->CurrentAction) {
			case "D": // Delete
				$entrenadores_secuencias->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($entrenadores_secuencias->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $entrenadores_secuencias;
		$DeleteRows = TRUE;
		$sWrkFilter = $entrenadores_secuencias->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in entrenadores_secuencias class, entrenadores_secuenciasinfo.php

		$entrenadores_secuencias->CurrentFilter = $sWrkFilter;
		$sSql = $entrenadores_secuencias->SQL();
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
				$DeleteRows = $entrenadores_secuencias->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($entrenadores_secuencias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($entrenadores_secuencias->CancelMessage <> "") {
				$this->setMessage($entrenadores_secuencias->CancelMessage);
				$entrenadores_secuencias->CancelMessage = "";
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
				$entrenadores_secuencias->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_secuencias;

		// Call Recordset Selecting event
		$entrenadores_secuencias->Recordset_Selecting($entrenadores_secuencias->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_secuencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_secuencias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_secuencias;
		$sFilter = $entrenadores_secuencias->KeyFilter();

		// Call Row Selecting event
		$entrenadores_secuencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_secuencias->CurrentFilter = $sFilter;
		$sSql = $entrenadores_secuencias->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_secuencias->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_secuencias;
		$entrenadores_secuencias->id->setDbValue($rs->fields('id'));
		$entrenadores_secuencias->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_secuencias->secuencia->setDbValue($rs->fields('secuencia'));
		$entrenadores_secuencias->escena->setDbValue($rs->fields('escena'));
		$entrenadores_secuencias->fecha->setDbValue($rs->fields('fecha'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_secuencias;

		// Initialize URLs
		// Call Row_Rendering event

		$entrenadores_secuencias->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_secuencias->id->CellCssStyle = ""; $entrenadores_secuencias->id->CellCssClass = "";
		$entrenadores_secuencias->id->CellAttrs = array(); $entrenadores_secuencias->id->ViewAttrs = array(); $entrenadores_secuencias->id->EditAttrs = array();

		// entrenador
		$entrenadores_secuencias->entrenador->CellCssStyle = ""; $entrenadores_secuencias->entrenador->CellCssClass = "";
		$entrenadores_secuencias->entrenador->CellAttrs = array(); $entrenadores_secuencias->entrenador->ViewAttrs = array(); $entrenadores_secuencias->entrenador->EditAttrs = array();

		// secuencia
		$entrenadores_secuencias->secuencia->CellCssStyle = ""; $entrenadores_secuencias->secuencia->CellCssClass = "";
		$entrenadores_secuencias->secuencia->CellAttrs = array(); $entrenadores_secuencias->secuencia->ViewAttrs = array(); $entrenadores_secuencias->secuencia->EditAttrs = array();

		// escena
		$entrenadores_secuencias->escena->CellCssStyle = ""; $entrenadores_secuencias->escena->CellCssClass = "";
		$entrenadores_secuencias->escena->CellAttrs = array(); $entrenadores_secuencias->escena->ViewAttrs = array(); $entrenadores_secuencias->escena->EditAttrs = array();

		// fecha
		$entrenadores_secuencias->fecha->CellCssStyle = ""; $entrenadores_secuencias->fecha->CellCssClass = "";
		$entrenadores_secuencias->fecha->CellAttrs = array(); $entrenadores_secuencias->fecha->ViewAttrs = array(); $entrenadores_secuencias->fecha->EditAttrs = array();
		if ($entrenadores_secuencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_secuencias->id->ViewValue = $entrenadores_secuencias->id->CurrentValue;
			$entrenadores_secuencias->id->CssStyle = "";
			$entrenadores_secuencias->id->CssClass = "";
			$entrenadores_secuencias->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_secuencias->entrenador->ViewValue = $entrenadores_secuencias->entrenador->CurrentValue;
			$entrenadores_secuencias->entrenador->CssStyle = "";
			$entrenadores_secuencias->entrenador->CssClass = "";
			$entrenadores_secuencias->entrenador->ViewCustomAttributes = "";

			// secuencia
			$entrenadores_secuencias->secuencia->ViewValue = $entrenadores_secuencias->secuencia->CurrentValue;
			$entrenadores_secuencias->secuencia->CssStyle = "";
			$entrenadores_secuencias->secuencia->CssClass = "";
			$entrenadores_secuencias->secuencia->ViewCustomAttributes = "";

			// escena
			$entrenadores_secuencias->escena->ViewValue = $entrenadores_secuencias->escena->CurrentValue;
			$entrenadores_secuencias->escena->CssStyle = "";
			$entrenadores_secuencias->escena->CssClass = "";
			$entrenadores_secuencias->escena->ViewCustomAttributes = "";

			// fecha
			$entrenadores_secuencias->fecha->ViewValue = $entrenadores_secuencias->fecha->CurrentValue;
			$entrenadores_secuencias->fecha->ViewValue = ew_FormatDateTime($entrenadores_secuencias->fecha->ViewValue, 7);
			$entrenadores_secuencias->fecha->CssStyle = "";
			$entrenadores_secuencias->fecha->CssClass = "";
			$entrenadores_secuencias->fecha->ViewCustomAttributes = "";

			// id
			$entrenadores_secuencias->id->HrefValue = "";
			$entrenadores_secuencias->id->TooltipValue = "";

			// entrenador
			$entrenadores_secuencias->entrenador->HrefValue = "";
			$entrenadores_secuencias->entrenador->TooltipValue = "";

			// secuencia
			$entrenadores_secuencias->secuencia->HrefValue = "";
			$entrenadores_secuencias->secuencia->TooltipValue = "";

			// escena
			$entrenadores_secuencias->escena->HrefValue = "";
			$entrenadores_secuencias->escena->TooltipValue = "";

			// fecha
			$entrenadores_secuencias->fecha->HrefValue = "";
			$entrenadores_secuencias->fecha->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_secuencias->Row_Rendered();
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
