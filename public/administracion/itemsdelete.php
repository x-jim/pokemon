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
$items_delete = new citems_delete();
$Page =& $items_delete;

// Page init
$items_delete->Page_Init();

// Page main
$items_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var items_delete = new ew_Page("items_delete");

// page properties
items_delete.PageID = "delete"; // page ID
items_delete.FormID = "fitemsdelete"; // form ID
var EW_PAGE_ID = items_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
items_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
items_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
items_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $items_delete->LoadRecordset())
	$items_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($items_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$items_delete->Page_Terminate("itemslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $items->TableCaption() ?><br><br>
<a href="<?php echo $items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$items_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="items">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($items_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $items->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $items->id->FldCaption() ?></td>
		<td valign="top"><?php echo $items->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $items->icono->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$items_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$items_delete->lRecCnt++;

	// Set row properties
	$items->CssClass = "";
	$items->CssStyle = "";
	$items->RowAttrs = array();
	$items->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$items_delete->LoadRowValues($rs);

	// Render row
	$items_delete->RenderRow();
?>
	<tr<?php echo $items->RowAttributes() ?>>
		<td<?php echo $items->id->CellAttributes() ?>>
<div<?php echo $items->id->ViewAttributes() ?>><?php echo $items->id->ListViewValue() ?></div></td>
		<td<?php echo $items->nombre->CellAttributes() ?>>
<div<?php echo $items->nombre->ViewAttributes() ?>><?php echo $items->nombre->ListViewValue() ?></div></td>
		<td<?php echo $items->icono->CellAttributes() ?>>
<div<?php echo $items->icono->ViewAttributes() ?>><?php echo $items->icono->ListViewValue() ?></div></td>
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
$items_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class citems_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'items';

	// Page object name
	var $PageObjName = 'items_delete';

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
	function citems_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (items)
		$GLOBALS["items"] = new citems();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $items;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$items->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($items->id->QueryStringValue))
				$this->Page_Terminate("itemslist.php"); // Prevent SQL injection, exit
			$sKey .= $items->id->QueryStringValue;
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
			$this->Page_Terminate("itemslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("itemslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in items class, itemsinfo.php

		$items->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$items->CurrentAction = $_POST["a_delete"];
		} else {
			$items->CurrentAction = "I"; // Display record
		}
		switch ($items->CurrentAction) {
			case "D": // Delete
				$items->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($items->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $items;
		$DeleteRows = TRUE;
		$sWrkFilter = $items->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in items class, itemsinfo.php

		$items->CurrentFilter = $sWrkFilter;
		$sSql = $items->SQL();
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
				$DeleteRows = $items->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($items->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($items->CancelMessage <> "") {
				$this->setMessage($items->CancelMessage);
				$items->CancelMessage = "";
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
				$items->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $items;

		// Call Recordset Selecting event
		$items->Recordset_Selecting($items->CurrentFilter);

		// Load List page SQL
		$sSql = $items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$items->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$items->Row_Rendered();
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
