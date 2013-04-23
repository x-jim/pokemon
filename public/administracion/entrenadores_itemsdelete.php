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
$entrenadores_items_delete = new centrenadores_items_delete();
$Page =& $entrenadores_items_delete;

// Page init
$entrenadores_items_delete->Page_Init();

// Page main
$entrenadores_items_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_items_delete = new ew_Page("entrenadores_items_delete");

// page properties
entrenadores_items_delete.PageID = "delete"; // page ID
entrenadores_items_delete.FormID = "fentrenadores_itemsdelete"; // form ID
var EW_PAGE_ID = entrenadores_items_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_items_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_items_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_items_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $entrenadores_items_delete->LoadRecordset())
	$entrenadores_items_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($entrenadores_items_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$entrenadores_items_delete->Page_Terminate("entrenadores_itemslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_items->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_items_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="entrenadores_items">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($entrenadores_items_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $entrenadores_items->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $entrenadores_items->id->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_items->item->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_items->entrenador->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_items->cantidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$entrenadores_items_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$entrenadores_items_delete->lRecCnt++;

	// Set row properties
	$entrenadores_items->CssClass = "";
	$entrenadores_items->CssStyle = "";
	$entrenadores_items->RowAttrs = array();
	$entrenadores_items->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$entrenadores_items_delete->LoadRowValues($rs);

	// Render row
	$entrenadores_items_delete->RenderRow();
?>
	<tr<?php echo $entrenadores_items->RowAttributes() ?>>
		<td<?php echo $entrenadores_items->id->CellAttributes() ?>>
<div<?php echo $entrenadores_items->id->ViewAttributes() ?>><?php echo $entrenadores_items->id->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_items->item->CellAttributes() ?>>
<div<?php echo $entrenadores_items->item->ViewAttributes() ?>><?php echo $entrenadores_items->item->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_items->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_items->entrenador->ViewAttributes() ?>><?php echo $entrenadores_items->entrenador->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_items->cantidad->CellAttributes() ?>>
<div<?php echo $entrenadores_items->cantidad->ViewAttributes() ?>><?php echo $entrenadores_items->cantidad->ListViewValue() ?></div></td>
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
$entrenadores_items_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_items_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'entrenadores_items';

	// Page object name
	var $PageObjName = 'entrenadores_items_delete';

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
	function centrenadores_items_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_items)
		$GLOBALS["entrenadores_items"] = new centrenadores_items();

		// Table object (entrenadores)
		$GLOBALS['entrenadores'] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $entrenadores_items;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$entrenadores_items->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($entrenadores_items->id->QueryStringValue))
				$this->Page_Terminate("entrenadores_itemslist.php"); // Prevent SQL injection, exit
			$sKey .= $entrenadores_items->id->QueryStringValue;
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
			$this->Page_Terminate("entrenadores_itemslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("entrenadores_itemslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in entrenadores_items class, entrenadores_itemsinfo.php

		$entrenadores_items->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$entrenadores_items->CurrentAction = $_POST["a_delete"];
		} else {
			$entrenadores_items->CurrentAction = "I"; // Display record
		}
		switch ($entrenadores_items->CurrentAction) {
			case "D": // Delete
				$entrenadores_items->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($entrenadores_items->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $entrenadores_items;
		$DeleteRows = TRUE;
		$sWrkFilter = $entrenadores_items->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in entrenadores_items class, entrenadores_itemsinfo.php

		$entrenadores_items->CurrentFilter = $sWrkFilter;
		$sSql = $entrenadores_items->SQL();
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
				$DeleteRows = $entrenadores_items->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($entrenadores_items->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($entrenadores_items->CancelMessage <> "") {
				$this->setMessage($entrenadores_items->CancelMessage);
				$entrenadores_items->CancelMessage = "";
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
				$entrenadores_items->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_items;

		// Call Recordset Selecting event
		$entrenadores_items->Recordset_Selecting($entrenadores_items->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_items->Recordset_Selected($rs);
		return $rs;
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
		// id

		$entrenadores_items->id->CellCssStyle = ""; $entrenadores_items->id->CellCssClass = "";
		$entrenadores_items->id->CellAttrs = array(); $entrenadores_items->id->ViewAttrs = array(); $entrenadores_items->id->EditAttrs = array();

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

			// id
			$entrenadores_items->id->HrefValue = "";
			$entrenadores_items->id->TooltipValue = "";

			// item
			$entrenadores_items->item->HrefValue = "";
			$entrenadores_items->item->TooltipValue = "";

			// entrenador
			$entrenadores_items->entrenador->HrefValue = "";
			$entrenadores_items->entrenador->TooltipValue = "";

			// cantidad
			$entrenadores_items->cantidad->HrefValue = "";
			$entrenadores_items->cantidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_items->Row_Rendered();
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
