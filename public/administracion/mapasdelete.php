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
$mapas_delete = new cmapas_delete();
$Page =& $mapas_delete;

// Page init
$mapas_delete->Page_Init();

// Page main
$mapas_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mapas_delete = new ew_Page("mapas_delete");

// page properties
mapas_delete.PageID = "delete"; // page ID
mapas_delete.FormID = "fmapasdelete"; // form ID
var EW_PAGE_ID = mapas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mapas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mapas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mapas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $mapas_delete->LoadRecordset())
	$mapas_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mapas_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$mapas_delete->Page_Terminate("mapaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $mapas->TableCaption() ?><br><br>
<a href="<?php echo $mapas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$mapas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mapas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mapas_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mapas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $mapas->id->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas->mapa_norte->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas->mapa_este->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas->mapa_sur->FldCaption() ?></td>
		<td valign="top"><?php echo $mapas->mapa_oeste->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$mapas_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mapas_delete->lRecCnt++;

	// Set row properties
	$mapas->CssClass = "";
	$mapas->CssStyle = "";
	$mapas->RowAttrs = array();
	$mapas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mapas_delete->LoadRowValues($rs);

	// Render row
	$mapas_delete->RenderRow();
?>
	<tr<?php echo $mapas->RowAttributes() ?>>
		<td<?php echo $mapas->id->CellAttributes() ?>>
<div<?php echo $mapas->id->ViewAttributes() ?>><?php echo $mapas->id->ListViewValue() ?></div></td>
		<td<?php echo $mapas->imagen->CellAttributes() ?>>
<?php if ($mapas->imagen->HrefValue <> "" || $mapas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $mapas->imagen->HrefValue ?>"><?php echo $mapas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($mapas->imagen->Upload->DbValue)) { ?>
<?php echo $mapas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($mapas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $mapas->mapa_norte->CellAttributes() ?>>
<div<?php echo $mapas->mapa_norte->ViewAttributes() ?>><?php echo $mapas->mapa_norte->ListViewValue() ?></div></td>
		<td<?php echo $mapas->mapa_este->CellAttributes() ?>>
<div<?php echo $mapas->mapa_este->ViewAttributes() ?>><?php echo $mapas->mapa_este->ListViewValue() ?></div></td>
		<td<?php echo $mapas->mapa_sur->CellAttributes() ?>>
<div<?php echo $mapas->mapa_sur->ViewAttributes() ?>><?php echo $mapas->mapa_sur->ListViewValue() ?></div></td>
		<td<?php echo $mapas->mapa_oeste->CellAttributes() ?>>
<div<?php echo $mapas->mapa_oeste->ViewAttributes() ?>><?php echo $mapas->mapa_oeste->ListViewValue() ?></div></td>
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
$mapas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmapas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'mapas';

	// Page object name
	var $PageObjName = 'mapas_delete';

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
	function cmapas_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (mapas)
		$GLOBALS["mapas"] = new cmapas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $mapas;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mapas->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($mapas->id->QueryStringValue))
				$this->Page_Terminate("mapaslist.php"); // Prevent SQL injection, exit
			$sKey .= $mapas->id->QueryStringValue;
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
			$this->Page_Terminate("mapaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("mapaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in mapas class, mapasinfo.php

		$mapas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mapas->CurrentAction = $_POST["a_delete"];
		} else {
			$mapas->CurrentAction = "I"; // Display record
		}
		switch ($mapas->CurrentAction) {
			case "D": // Delete
				$mapas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($mapas->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $mapas;
		$DeleteRows = TRUE;
		$sWrkFilter = $mapas->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in mapas class, mapasinfo.php

		$mapas->CurrentFilter = $sWrkFilter;
		$sSql = $mapas->SQL();
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
				$DeleteRows = $mapas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, $mapas->imagen->UploadPath) . $row['imagen']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($mapas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mapas->CancelMessage <> "") {
				$this->setMessage($mapas->CancelMessage);
				$mapas->CancelMessage = "";
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
				$mapas->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mapas;

		// Call Recordset Selecting event
		$mapas->Recordset_Selecting($mapas->CurrentFilter);

		// Load List page SQL
		$sSql = $mapas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$mapas->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($mapas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$mapas->Row_Rendered();
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
