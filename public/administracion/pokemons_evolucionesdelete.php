<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "pokemons_evolucionesinfo.php" ?>
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
$pokemons_evoluciones_delete = new cpokemons_evoluciones_delete();
$Page =& $pokemons_evoluciones_delete;

// Page init
$pokemons_evoluciones_delete->Page_Init();

// Page main
$pokemons_evoluciones_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_evoluciones_delete = new ew_Page("pokemons_evoluciones_delete");

// page properties
pokemons_evoluciones_delete.PageID = "delete"; // page ID
pokemons_evoluciones_delete.FormID = "fpokemons_evolucionesdelete"; // form ID
var EW_PAGE_ID = pokemons_evoluciones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_evoluciones_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_evoluciones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_evoluciones_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $pokemons_evoluciones_delete->LoadRecordset())
	$pokemons_evoluciones_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($pokemons_evoluciones_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$pokemons_evoluciones_delete->Page_Terminate("pokemons_evolucioneslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons_evoluciones->TableCaption() ?><br><br>
<a href="<?php echo $pokemons_evoluciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_evoluciones_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pokemons_evoluciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pokemons_evoluciones_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pokemons_evoluciones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pokemons_evoluciones->de->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons_evoluciones->a->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons_evoluciones->nivel->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons_evoluciones->item->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pokemons_evoluciones_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$pokemons_evoluciones_delete->lRecCnt++;

	// Set row properties
	$pokemons_evoluciones->CssClass = "";
	$pokemons_evoluciones->CssStyle = "";
	$pokemons_evoluciones->RowAttrs = array();
	$pokemons_evoluciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pokemons_evoluciones_delete->LoadRowValues($rs);

	// Render row
	$pokemons_evoluciones_delete->RenderRow();
?>
	<tr<?php echo $pokemons_evoluciones->RowAttributes() ?>>
		<td<?php echo $pokemons_evoluciones->de->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->de->ViewAttributes() ?>><?php echo $pokemons_evoluciones->de->ListViewValue() ?></div></td>
		<td<?php echo $pokemons_evoluciones->a->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->a->ViewAttributes() ?>><?php echo $pokemons_evoluciones->a->ListViewValue() ?></div></td>
		<td<?php echo $pokemons_evoluciones->nivel->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->nivel->ViewAttributes() ?>><?php echo $pokemons_evoluciones->nivel->ListViewValue() ?></div></td>
		<td<?php echo $pokemons_evoluciones->item->CellAttributes() ?>>
<div<?php echo $pokemons_evoluciones->item->ViewAttributes() ?>><?php echo $pokemons_evoluciones->item->ListViewValue() ?></div></td>
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
$pokemons_evoluciones_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_evoluciones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pokemons_evoluciones';

	// Page object name
	var $PageObjName = 'pokemons_evoluciones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokemons_evoluciones;
		if ($pokemons_evoluciones->UseTokenInUrl) $PageUrl .= "t=" . $pokemons_evoluciones->TableVar . "&"; // Add page token
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
		global $objForm, $pokemons_evoluciones;
		if ($pokemons_evoluciones->UseTokenInUrl) {
			if ($objForm)
				return ($pokemons_evoluciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokemons_evoluciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokemons_evoluciones_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons_evoluciones)
		$GLOBALS["pokemons_evoluciones"] = new cpokemons_evoluciones();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons_evoluciones', TRUE);

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
		global $pokemons_evoluciones;

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
		global $Language, $pokemons_evoluciones;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["de"] <> "") {
			$pokemons_evoluciones->de->setQueryStringValue($_GET["de"]);
			if (!is_numeric($pokemons_evoluciones->de->QueryStringValue))
				$this->Page_Terminate("pokemons_evolucioneslist.php"); // Prevent SQL injection, exit
			$sKey .= $pokemons_evoluciones->de->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["a"] <> "") {
			$pokemons_evoluciones->a->setQueryStringValue($_GET["a"]);
			if (!is_numeric($pokemons_evoluciones->a->QueryStringValue))
				$this->Page_Terminate("pokemons_evolucioneslist.php"); // Prevent SQL injection, exit
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $pokemons_evoluciones->a->QueryStringValue;
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
			$this->Page_Terminate("pokemons_evolucioneslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 2)
				$this->Page_Terminate($pokemons_evoluciones->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("pokemons_evolucioneslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`de`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("pokemons_evolucioneslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`a`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pokemons_evoluciones class, pokemons_evolucionesinfo.php

		$pokemons_evoluciones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pokemons_evoluciones->CurrentAction = $_POST["a_delete"];
		} else {
			$pokemons_evoluciones->CurrentAction = "I"; // Display record
		}
		switch ($pokemons_evoluciones->CurrentAction) {
			case "D": // Delete
				$pokemons_evoluciones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pokemons_evoluciones->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pokemons_evoluciones;
		$DeleteRows = TRUE;
		$sWrkFilter = $pokemons_evoluciones->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in pokemons_evoluciones class, pokemons_evolucionesinfo.php

		$pokemons_evoluciones->CurrentFilter = $sWrkFilter;
		$sSql = $pokemons_evoluciones->SQL();
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
				$DeleteRows = $pokemons_evoluciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['de'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['a'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($pokemons_evoluciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pokemons_evoluciones->CancelMessage <> "") {
				$this->setMessage($pokemons_evoluciones->CancelMessage);
				$pokemons_evoluciones->CancelMessage = "";
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
				$pokemons_evoluciones->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pokemons_evoluciones;

		// Call Recordset Selecting event
		$pokemons_evoluciones->Recordset_Selecting($pokemons_evoluciones->CurrentFilter);

		// Load List page SQL
		$sSql = $pokemons_evoluciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pokemons_evoluciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokemons_evoluciones;
		$sFilter = $pokemons_evoluciones->KeyFilter();

		// Call Row Selecting event
		$pokemons_evoluciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokemons_evoluciones->CurrentFilter = $sFilter;
		$sSql = $pokemons_evoluciones->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pokemons_evoluciones->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pokemons_evoluciones;
		$pokemons_evoluciones->de->setDbValue($rs->fields('de'));
		$pokemons_evoluciones->a->setDbValue($rs->fields('a'));
		$pokemons_evoluciones->nivel->setDbValue($rs->fields('nivel'));
		$pokemons_evoluciones->item->setDbValue($rs->fields('item'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons_evoluciones;

		// Initialize URLs
		// Call Row_Rendering event

		$pokemons_evoluciones->Row_Rendering();

		// Common render codes for all row types
		// de

		$pokemons_evoluciones->de->CellCssStyle = ""; $pokemons_evoluciones->de->CellCssClass = "";
		$pokemons_evoluciones->de->CellAttrs = array(); $pokemons_evoluciones->de->ViewAttrs = array(); $pokemons_evoluciones->de->EditAttrs = array();

		// a
		$pokemons_evoluciones->a->CellCssStyle = ""; $pokemons_evoluciones->a->CellCssClass = "";
		$pokemons_evoluciones->a->CellAttrs = array(); $pokemons_evoluciones->a->ViewAttrs = array(); $pokemons_evoluciones->a->EditAttrs = array();

		// nivel
		$pokemons_evoluciones->nivel->CellCssStyle = ""; $pokemons_evoluciones->nivel->CellCssClass = "";
		$pokemons_evoluciones->nivel->CellAttrs = array(); $pokemons_evoluciones->nivel->ViewAttrs = array(); $pokemons_evoluciones->nivel->EditAttrs = array();

		// item
		$pokemons_evoluciones->item->CellCssStyle = ""; $pokemons_evoluciones->item->CellCssClass = "";
		$pokemons_evoluciones->item->CellAttrs = array(); $pokemons_evoluciones->item->ViewAttrs = array(); $pokemons_evoluciones->item->EditAttrs = array();
		if ($pokemons_evoluciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// de
			$pokemons_evoluciones->de->ViewValue = $pokemons_evoluciones->de->CurrentValue;
			$pokemons_evoluciones->de->CssStyle = "";
			$pokemons_evoluciones->de->CssClass = "";
			$pokemons_evoluciones->de->ViewCustomAttributes = "";

			// a
			$pokemons_evoluciones->a->ViewValue = $pokemons_evoluciones->a->CurrentValue;
			$pokemons_evoluciones->a->CssStyle = "";
			$pokemons_evoluciones->a->CssClass = "";
			$pokemons_evoluciones->a->ViewCustomAttributes = "";

			// nivel
			$pokemons_evoluciones->nivel->ViewValue = $pokemons_evoluciones->nivel->CurrentValue;
			$pokemons_evoluciones->nivel->CssStyle = "";
			$pokemons_evoluciones->nivel->CssClass = "";
			$pokemons_evoluciones->nivel->ViewCustomAttributes = "";

			// item
			$pokemons_evoluciones->item->ViewValue = $pokemons_evoluciones->item->CurrentValue;
			$pokemons_evoluciones->item->CssStyle = "";
			$pokemons_evoluciones->item->CssClass = "";
			$pokemons_evoluciones->item->ViewCustomAttributes = "";

			// de
			$pokemons_evoluciones->de->HrefValue = "";
			$pokemons_evoluciones->de->TooltipValue = "";

			// a
			$pokemons_evoluciones->a->HrefValue = "";
			$pokemons_evoluciones->a->TooltipValue = "";

			// nivel
			$pokemons_evoluciones->nivel->HrefValue = "";
			$pokemons_evoluciones->nivel->TooltipValue = "";

			// item
			$pokemons_evoluciones->item->HrefValue = "";
			$pokemons_evoluciones->item->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokemons_evoluciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons_evoluciones->Row_Rendered();
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
