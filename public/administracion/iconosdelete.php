<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "iconosinfo.php" ?>
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
$iconos_delete = new ciconos_delete();
$Page =& $iconos_delete;

// Page init
$iconos_delete->Page_Init();

// Page main
$iconos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var iconos_delete = new ew_Page("iconos_delete");

// page properties
iconos_delete.PageID = "delete"; // page ID
iconos_delete.FormID = "ficonosdelete"; // form ID
var EW_PAGE_ID = iconos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
iconos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
iconos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
iconos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $iconos_delete->LoadRecordset())
	$iconos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($iconos_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$iconos_delete->Page_Terminate("iconoslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $iconos->TableCaption() ?><br><br>
<a href="<?php echo $iconos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$iconos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="iconos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($iconos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $iconos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $iconos->id->FldCaption() ?></td>
		<td valign="top"><?php echo $iconos->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $iconos->x->FldCaption() ?></td>
		<td valign="top"><?php echo $iconos->y->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$iconos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$iconos_delete->lRecCnt++;

	// Set row properties
	$iconos->CssClass = "";
	$iconos->CssStyle = "";
	$iconos->RowAttrs = array();
	$iconos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$iconos_delete->LoadRowValues($rs);

	// Render row
	$iconos_delete->RenderRow();
?>
	<tr<?php echo $iconos->RowAttributes() ?>>
		<td<?php echo $iconos->id->CellAttributes() ?>>
<div<?php echo $iconos->id->ViewAttributes() ?>><?php echo $iconos->id->ListViewValue() ?></div></td>
		<td<?php echo $iconos->nombre->CellAttributes() ?>>
<div<?php echo $iconos->nombre->ViewAttributes() ?>><?php echo $iconos->nombre->ListViewValue() ?></div></td>
		<td<?php echo $iconos->x->CellAttributes() ?>>
<div<?php echo $iconos->x->ViewAttributes() ?>><?php echo $iconos->x->ListViewValue() ?></div></td>
		<td<?php echo $iconos->y->CellAttributes() ?>>
<div<?php echo $iconos->y->ViewAttributes() ?>><?php echo $iconos->y->ListViewValue() ?></div></td>
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
$iconos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ciconos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'iconos';

	// Page object name
	var $PageObjName = 'iconos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $iconos;
		if ($iconos->UseTokenInUrl) $PageUrl .= "t=" . $iconos->TableVar . "&"; // Add page token
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
		global $objForm, $iconos;
		if ($iconos->UseTokenInUrl) {
			if ($objForm)
				return ($iconos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($iconos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ciconos_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (iconos)
		$GLOBALS["iconos"] = new ciconos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'iconos', TRUE);

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
		global $iconos;

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
		global $Language, $iconos;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$iconos->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($iconos->id->QueryStringValue))
				$this->Page_Terminate("iconoslist.php"); // Prevent SQL injection, exit
			$sKey .= $iconos->id->QueryStringValue;
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
			$this->Page_Terminate("iconoslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("iconoslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in iconos class, iconosinfo.php

		$iconos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$iconos->CurrentAction = $_POST["a_delete"];
		} else {
			$iconos->CurrentAction = "I"; // Display record
		}
		switch ($iconos->CurrentAction) {
			case "D": // Delete
				$iconos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($iconos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $iconos;
		$DeleteRows = TRUE;
		$sWrkFilter = $iconos->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in iconos class, iconosinfo.php

		$iconos->CurrentFilter = $sWrkFilter;
		$sSql = $iconos->SQL();
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
				$DeleteRows = $iconos->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($iconos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($iconos->CancelMessage <> "") {
				$this->setMessage($iconos->CancelMessage);
				$iconos->CancelMessage = "";
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
				$iconos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $iconos;

		// Call Recordset Selecting event
		$iconos->Recordset_Selecting($iconos->CurrentFilter);

		// Load List page SQL
		$sSql = $iconos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$iconos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $iconos;
		$sFilter = $iconos->KeyFilter();

		// Call Row Selecting event
		$iconos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$iconos->CurrentFilter = $sFilter;
		$sSql = $iconos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$iconos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $iconos;
		$iconos->id->setDbValue($rs->fields('id'));
		$iconos->nombre->setDbValue($rs->fields('nombre'));
		$iconos->x->setDbValue($rs->fields('x'));
		$iconos->y->setDbValue($rs->fields('y'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $iconos;

		// Initialize URLs
		// Call Row_Rendering event

		$iconos->Row_Rendering();

		// Common render codes for all row types
		// id

		$iconos->id->CellCssStyle = ""; $iconos->id->CellCssClass = "";
		$iconos->id->CellAttrs = array(); $iconos->id->ViewAttrs = array(); $iconos->id->EditAttrs = array();

		// nombre
		$iconos->nombre->CellCssStyle = ""; $iconos->nombre->CellCssClass = "";
		$iconos->nombre->CellAttrs = array(); $iconos->nombre->ViewAttrs = array(); $iconos->nombre->EditAttrs = array();

		// x
		$iconos->x->CellCssStyle = ""; $iconos->x->CellCssClass = "";
		$iconos->x->CellAttrs = array(); $iconos->x->ViewAttrs = array(); $iconos->x->EditAttrs = array();

		// y
		$iconos->y->CellCssStyle = ""; $iconos->y->CellCssClass = "";
		$iconos->y->CellAttrs = array(); $iconos->y->ViewAttrs = array(); $iconos->y->EditAttrs = array();
		if ($iconos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$iconos->id->ViewValue = $iconos->id->CurrentValue;
			$iconos->id->CssStyle = "";
			$iconos->id->CssClass = "";
			$iconos->id->ViewCustomAttributes = "";

			// nombre
			$iconos->nombre->ViewValue = $iconos->nombre->CurrentValue;
			$iconos->nombre->CssStyle = "";
			$iconos->nombre->CssClass = "";
			$iconos->nombre->ViewCustomAttributes = "";

			// x
			$iconos->x->ViewValue = $iconos->x->CurrentValue;
			$iconos->x->CssStyle = "";
			$iconos->x->CssClass = "";
			$iconos->x->ViewCustomAttributes = "";

			// y
			$iconos->y->ViewValue = $iconos->y->CurrentValue;
			$iconos->y->CssStyle = "";
			$iconos->y->CssClass = "";
			$iconos->y->ViewCustomAttributes = "";

			// id
			$iconos->id->HrefValue = "";
			$iconos->id->TooltipValue = "";

			// nombre
			$iconos->nombre->HrefValue = "";
			$iconos->nombre->TooltipValue = "";

			// x
			$iconos->x->HrefValue = "";
			$iconos->x->TooltipValue = "";

			// y
			$iconos->y->HrefValue = "";
			$iconos->y->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($iconos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$iconos->Row_Rendered();
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
