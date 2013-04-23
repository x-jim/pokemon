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
$mapas_zonas_delete = new cmapas_zonas_delete();
$Page =& $mapas_zonas_delete;

// Page init
$mapas_zonas_delete->Page_Init();

// Page main
$mapas_zonas_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_zonas_delete = new ew_Page("mapas_zonas_delete");

// page properties
mapas_zonas_delete.PageID = "delete"; // page ID
mapas_zonas_delete.FormID = "fmapas_zonasdelete"; // form ID
var EW_PAGE_ID = mapas_zonas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_zonas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_zonas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_zonas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $mapas_zonas_delete->LoadRecordset())
	$mapas_zonas_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mapas_zonas_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$mapas_zonas_delete->Page_Terminate("mapas_zonaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas_zonas->TableCaption() ?><br><br>
<a href="<?php echo $mapas_zonas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_zonas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mapas_zonas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mapas_zonas_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mapas_zonas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $mapas_zonas->id->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->mapa->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->pos_x->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->pos_y->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->secuencia->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->width->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->height->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas_zonas->titulo->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$mapas_zonas_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mapas_zonas_delete->lRecCnt++;

	// Set row properties
	$mapas_zonas->CssClass = "";
	$mapas_zonas->CssStyle = "";
	$mapas_zonas->RowAttrs = array();
	$mapas_zonas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mapas_zonas_delete->LoadRowValues($rs);

	// Render row
	$mapas_zonas_delete->RenderRow();
?>
	<tr<?php echo $mapas_zonas->RowAttributes() ?>>
		<td<?php echo $mapas_zonas->id->CellAttributes() ?>>
<div<?php echo $mapas_zonas->id->ViewAttributes() ?>><?php echo $mapas_zonas->id->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->mapa->CellAttributes() ?>>
<div<?php echo $mapas_zonas->mapa->ViewAttributes() ?>><?php echo $mapas_zonas->mapa->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->pos_x->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_x->ViewAttributes() ?>><?php echo $mapas_zonas->pos_x->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->pos_y->CellAttributes() ?>>
<div<?php echo $mapas_zonas->pos_y->ViewAttributes() ?>><?php echo $mapas_zonas->pos_y->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->secuencia->CellAttributes() ?>>
<div<?php echo $mapas_zonas->secuencia->ViewAttributes() ?>><?php echo $mapas_zonas->secuencia->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->width->CellAttributes() ?>>
<div<?php echo $mapas_zonas->width->ViewAttributes() ?>><?php echo $mapas_zonas->width->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->height->CellAttributes() ?>>
<div<?php echo $mapas_zonas->height->ViewAttributes() ?>><?php echo $mapas_zonas->height->ListViewValue() ?></div></td>
		<td<?php echo $mapas_zonas->titulo->CellAttributes() ?>>
<div<?php echo $mapas_zonas->titulo->ViewAttributes() ?>><?php echo $mapas_zonas->titulo->ListViewValue() ?></div></td>
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
$mapas_zonas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_zonas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'mapas_zonas';

	// Page object name
	var $PageObjName = 'mapas_zonas_delete';

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
	function cmapas_zonas_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas_zonas)
		$GLOBALS["mapas_zonas"] = new cmapas_zonas();

		// Table object (mapas)
		$GLOBALS['mapas'] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $mapas_zonas;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mapas_zonas->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($mapas_zonas->id->QueryStringValue))
				$this->Page_Terminate("mapas_zonaslist.php"); // Prevent SQL injection, exit
			$sKey .= $mapas_zonas->id->QueryStringValue;
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
			$this->Page_Terminate("mapas_zonaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("mapas_zonaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in mapas_zonas class, mapas_zonasinfo.php

		$mapas_zonas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mapas_zonas->CurrentAction = $_POST["a_delete"];
		} else {
			$mapas_zonas->CurrentAction = "I"; // Display record
		}
		switch ($mapas_zonas->CurrentAction) {
			case "D": // Delete
				$mapas_zonas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($mapas_zonas->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $mapas_zonas;
		$DeleteRows = TRUE;
		$sWrkFilter = $mapas_zonas->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in mapas_zonas class, mapas_zonasinfo.php

		$mapas_zonas->CurrentFilter = $sWrkFilter;
		$sSql = $mapas_zonas->SQL();
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
				$DeleteRows = $mapas_zonas->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mapas_zonas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mapas_zonas->CancelMessage <> "") {
				$this->setMessage($mapas_zonas->CancelMessage);
				$mapas_zonas->CancelMessage = "";
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
				$mapas_zonas->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mapas_zonas;

		// Call Recordset Selecting event
		$mapas_zonas->Recordset_Selecting($mapas_zonas->CurrentFilter);

		// Load List page SQL
		$sSql = $mapas_zonas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$mapas_zonas->Recordset_Selected($rs);
		return $rs;
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
		// id

		$mapas_zonas->id->CellCssStyle = ""; $mapas_zonas->id->CellCssClass = "";
		$mapas_zonas->id->CellAttrs = array(); $mapas_zonas->id->ViewAttrs = array(); $mapas_zonas->id->EditAttrs = array();

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

			// id
			$mapas_zonas->id->HrefValue = "";
			$mapas_zonas->id->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($mapas_zonas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas_zonas->Row_Rendered();
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
