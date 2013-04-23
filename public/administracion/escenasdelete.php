<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "escenasinfo.php" ?>
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
$escenas_delete = new cescenas_delete();
$Page =& $escenas_delete;

// Page init
$escenas_delete->Page_Init();

// Page main
$escenas_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var escenas_delete = new ew_Page("escenas_delete");

// page properties
escenas_delete.PageID = "delete"; // page ID
escenas_delete.FormID = "fescenasdelete"; // form ID
var EW_PAGE_ID = escenas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
escenas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
escenas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
escenas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $escenas_delete->LoadRecordset())
	$escenas_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($escenas_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$escenas_delete->Page_Terminate("escenaslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $escenas->TableCaption() ?><br><br>
<a href="<?php echo $escenas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$escenas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="escenas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($escenas_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $escenas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $escenas->id->FldCaption() ?></td>
		<td valign="top"><?php echo $escenas->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $escenas->imagen->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$escenas_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$escenas_delete->lRecCnt++;

	// Set row properties
	$escenas->CssClass = "";
	$escenas->CssStyle = "";
	$escenas->RowAttrs = array();
	$escenas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$escenas_delete->LoadRowValues($rs);

	// Render row
	$escenas_delete->RenderRow();
?>
	<tr<?php echo $escenas->RowAttributes() ?>>
		<td<?php echo $escenas->id->CellAttributes() ?>>
<div<?php echo $escenas->id->ViewAttributes() ?>><?php echo $escenas->id->ListViewValue() ?></div></td>
		<td<?php echo $escenas->nombre->CellAttributes() ?>>
<div<?php echo $escenas->nombre->ViewAttributes() ?>><?php echo $escenas->nombre->ListViewValue() ?></div></td>
		<td<?php echo $escenas->imagen->CellAttributes() ?>>
<?php if ($escenas->imagen->HrefValue <> "" || $escenas->imagen->TooltipValue <> "") { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<a href="<?php echo $escenas->imagen->HrefValue ?>"><?php echo $escenas->imagen->ListViewValue() ?></a>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($escenas->imagen->Upload->DbValue)) { ?>
<?php echo $escenas->imagen->ListViewValue() ?>
<?php } elseif (!in_array($escenas->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
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
$escenas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cescenas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'escenas';

	// Page object name
	var $PageObjName = 'escenas_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $escenas;
		if ($escenas->UseTokenInUrl) $PageUrl .= "t=" . $escenas->TableVar . "&"; // Add page token
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
		global $objForm, $escenas;
		if ($escenas->UseTokenInUrl) {
			if ($objForm)
				return ($escenas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($escenas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cescenas_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (escenas)
		$GLOBALS["escenas"] = new cescenas();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'escenas', TRUE);

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
		global $escenas;

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
		global $Language, $escenas;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$escenas->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($escenas->id->QueryStringValue))
				$this->Page_Terminate("escenaslist.php"); // Prevent SQL injection, exit
			$sKey .= $escenas->id->QueryStringValue;
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
			$this->Page_Terminate("escenaslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("escenaslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in escenas class, escenasinfo.php

		$escenas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$escenas->CurrentAction = $_POST["a_delete"];
		} else {
			$escenas->CurrentAction = "I"; // Display record
		}
		switch ($escenas->CurrentAction) {
			case "D": // Delete
				$escenas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($escenas->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $escenas;
		$DeleteRows = TRUE;
		$sWrkFilter = $escenas->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in escenas class, escenasinfo.php

		$escenas->CurrentFilter = $sWrkFilter;
		$sSql = $escenas->SQL();
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
				$DeleteRows = $escenas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, $escenas->imagen->UploadPath) . $row['imagen']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($escenas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($escenas->CancelMessage <> "") {
				$this->setMessage($escenas->CancelMessage);
				$escenas->CancelMessage = "";
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
				$escenas->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $escenas;

		// Call Recordset Selecting event
		$escenas->Recordset_Selecting($escenas->CurrentFilter);

		// Load List page SQL
		$sSql = $escenas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$escenas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $escenas;
		$sFilter = $escenas->KeyFilter();

		// Call Row Selecting event
		$escenas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$escenas->CurrentFilter = $sFilter;
		$sSql = $escenas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$escenas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $escenas;
		$escenas->id->setDbValue($rs->fields('id'));
		$escenas->nombre->setDbValue($rs->fields('nombre'));
		$escenas->imagen->Upload->DbValue = $rs->fields('imagen');
		$escenas->texto->setDbValue($rs->fields('texto'));
		$escenas->script->setDbValue($rs->fields('script'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $escenas;

		// Initialize URLs
		// Call Row_Rendering event

		$escenas->Row_Rendering();

		// Common render codes for all row types
		// id

		$escenas->id->CellCssStyle = ""; $escenas->id->CellCssClass = "";
		$escenas->id->CellAttrs = array(); $escenas->id->ViewAttrs = array(); $escenas->id->EditAttrs = array();

		// nombre
		$escenas->nombre->CellCssStyle = ""; $escenas->nombre->CellCssClass = "";
		$escenas->nombre->CellAttrs = array(); $escenas->nombre->ViewAttrs = array(); $escenas->nombre->EditAttrs = array();

		// imagen
		$escenas->imagen->CellCssStyle = ""; $escenas->imagen->CellCssClass = "";
		$escenas->imagen->CellAttrs = array(); $escenas->imagen->ViewAttrs = array(); $escenas->imagen->EditAttrs = array();
		if ($escenas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$escenas->id->ViewValue = $escenas->id->CurrentValue;
			$escenas->id->CssStyle = "";
			$escenas->id->CssClass = "";
			$escenas->id->ViewCustomAttributes = "";

			// nombre
			$escenas->nombre->ViewValue = $escenas->nombre->CurrentValue;
			$escenas->nombre->CssStyle = "";
			$escenas->nombre->CssClass = "";
			$escenas->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->ViewValue = $escenas->imagen->Upload->DbValue;
			} else {
				$escenas->imagen->ViewValue = "";
			}
			$escenas->imagen->CssStyle = "";
			$escenas->imagen->CssClass = "";
			$escenas->imagen->ViewCustomAttributes = "";

			// id
			$escenas->id->HrefValue = "";
			$escenas->id->TooltipValue = "";

			// nombre
			$escenas->nombre->HrefValue = "";
			$escenas->nombre->TooltipValue = "";

			// imagen
			if (!ew_Empty($escenas->imagen->Upload->DbValue)) {
				$escenas->imagen->HrefValue = ew_UploadPathEx(FALSE, $escenas->imagen->UploadPath) . ((!empty($escenas->imagen->ViewValue)) ? $escenas->imagen->ViewValue : $escenas->imagen->CurrentValue);
				if ($escenas->Export <> "") $escenas->imagen->HrefValue = ew_ConvertFullUrl($escenas->imagen->HrefValue);
			} else {
				$escenas->imagen->HrefValue = "";
			}
			$escenas->imagen->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($escenas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$escenas->Row_Rendered();
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
