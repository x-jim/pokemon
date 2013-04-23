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
$secuencias_delete = new csecuencias_delete();
$Page =& $secuencias_delete;

// Page init
$secuencias_delete->Page_Init();

// Page main
$secuencias_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secuencias_delete = new ew_Page("secuencias_delete");

// page properties
secuencias_delete.PageID = "delete"; // page ID
secuencias_delete.FormID = "fsecuenciasdelete"; // form ID
var EW_PAGE_ID = secuencias_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secuencias_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secuencias_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secuencias_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $secuencias_delete->LoadRecordset())
	$secuencias_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($secuencias_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$secuencias_delete->Page_Terminate("secuenciaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secuencias->TableCaption() ?><br><br>
<a href="<?php echo $secuencias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$secuencias_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="secuencias">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($secuencias_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $secuencias->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $secuencias->id->FldCaption() ?></td>
		<td valign="top"><?php echo $secuencias->nombre->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$secuencias_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$secuencias_delete->lRecCnt++;

	// Set row properties
	$secuencias->CssClass = "";
	$secuencias->CssStyle = "";
	$secuencias->RowAttrs = array();
	$secuencias->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$secuencias_delete->LoadRowValues($rs);

	// Render row
	$secuencias_delete->RenderRow();
?>
	<tr<?php echo $secuencias->RowAttributes() ?>>
		<td<?php echo $secuencias->id->CellAttributes() ?>>
<div<?php echo $secuencias->id->ViewAttributes() ?>><?php echo $secuencias->id->ListViewValue() ?></div></td>
		<td<?php echo $secuencias->nombre->CellAttributes() ?>>
<div<?php echo $secuencias->nombre->ViewAttributes() ?>><?php echo $secuencias->nombre->ListViewValue() ?></div></td>
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
$secuencias_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csecuencias_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'secuencias';

	// Page object name
	var $PageObjName = 'secuencias_delete';

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
	function csecuencias_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (secuencias)
		$GLOBALS["secuencias"] = new csecuencias();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $secuencias;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$secuencias->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($secuencias->id->QueryStringValue))
				$this->Page_Terminate("secuenciaslist.php"); // Prevent SQL injection, exit
			$sKey .= $secuencias->id->QueryStringValue;
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
			$this->Page_Terminate("secuenciaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("secuenciaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in secuencias class, secuenciasinfo.php

		$secuencias->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$secuencias->CurrentAction = $_POST["a_delete"];
		} else {
			$secuencias->CurrentAction = "I"; // Display record
		}
		switch ($secuencias->CurrentAction) {
			case "D": // Delete
				$secuencias->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($secuencias->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $secuencias;
		$DeleteRows = TRUE;
		$sWrkFilter = $secuencias->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in secuencias class, secuenciasinfo.php

		$secuencias->CurrentFilter = $sWrkFilter;
		$sSql = $secuencias->SQL();
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
				$DeleteRows = $secuencias->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($secuencias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($secuencias->CancelMessage <> "") {
				$this->setMessage($secuencias->CancelMessage);
				$secuencias->CancelMessage = "";
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
				$secuencias->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secuencias;

		// Call Recordset Selecting event
		$secuencias->Recordset_Selecting($secuencias->CurrentFilter);

		// Load List page SQL
		$sSql = $secuencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secuencias->Recordset_Selected($rs);
		return $rs;
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
		// id

		$secuencias->id->CellCssStyle = ""; $secuencias->id->CellCssClass = "";
		$secuencias->id->CellAttrs = array(); $secuencias->id->ViewAttrs = array(); $secuencias->id->EditAttrs = array();

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

			// id
			$secuencias->id->HrefValue = "";
			$secuencias->id->TooltipValue = "";

			// nombre
			$secuencias->nombre->HrefValue = "";
			$secuencias->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secuencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secuencias->Row_Rendered();
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
