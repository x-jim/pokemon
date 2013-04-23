<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "graficosinfo.php" ?>
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
$graficos_delete = new cgraficos_delete();
$Page =& $graficos_delete;

// Page init
$graficos_delete->Page_Init();

// Page main
$graficos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var graficos_delete = new ew_Page("graficos_delete");

// page properties
graficos_delete.PageID = "delete"; // page ID
graficos_delete.FormID = "fgraficosdelete"; // form ID
var EW_PAGE_ID = graficos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
graficos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
graficos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
graficos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $graficos_delete->LoadRecordset())
	$graficos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($graficos_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$graficos_delete->Page_Terminate("graficoslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $graficos->TableCaption() ?><br><br>
<a href="<?php echo $graficos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$graficos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="graficos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($graficos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $graficos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $graficos->id->FldCaption() ?></td>
		<td valign="top"><?php echo $graficos->grafico->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$graficos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$graficos_delete->lRecCnt++;

	// Set row properties
	$graficos->CssClass = "";
	$graficos->CssStyle = "";
	$graficos->RowAttrs = array();
	$graficos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$graficos_delete->LoadRowValues($rs);

	// Render row
	$graficos_delete->RenderRow();
?>
	<tr<?php echo $graficos->RowAttributes() ?>>
		<td<?php echo $graficos->id->CellAttributes() ?>>
<div<?php echo $graficos->id->ViewAttributes() ?>><?php echo $graficos->id->ListViewValue() ?></div></td>
		<td<?php echo $graficos->grafico->CellAttributes() ?>>
<?php if ($graficos->grafico->HrefValue <> "" || $graficos->grafico->TooltipValue <> "") { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<a href="<?php echo $graficos->grafico->HrefValue ?>"><?php echo $graficos->grafico->ListViewValue() ?></a>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($graficos->grafico->Upload->DbValue)) { ?>
<?php echo $graficos->grafico->ListViewValue() ?>
<?php } elseif (!in_array($graficos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
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
$graficos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgraficos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'graficos';

	// Page object name
	var $PageObjName = 'graficos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $graficos;
		if ($graficos->UseTokenInUrl) $PageUrl .= "t=" . $graficos->TableVar . "&"; // Add page token
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
		global $objForm, $graficos;
		if ($graficos->UseTokenInUrl) {
			if ($objForm)
				return ($graficos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($graficos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgraficos_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (graficos)
		$GLOBALS["graficos"] = new cgraficos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'graficos', TRUE);

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
		global $graficos;

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
		global $Language, $graficos;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$graficos->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($graficos->id->QueryStringValue))
				$this->Page_Terminate("graficoslist.php"); // Prevent SQL injection, exit
			$sKey .= $graficos->id->QueryStringValue;
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
			$this->Page_Terminate("graficoslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("graficoslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in graficos class, graficosinfo.php

		$graficos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$graficos->CurrentAction = $_POST["a_delete"];
		} else {
			$graficos->CurrentAction = "I"; // Display record
		}
		switch ($graficos->CurrentAction) {
			case "D": // Delete
				$graficos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($graficos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $graficos;
		$DeleteRows = TRUE;
		$sWrkFilter = $graficos->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in graficos class, graficosinfo.php

		$graficos->CurrentFilter = $sWrkFilter;
		$sSql = $graficos->SQL();
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
				$DeleteRows = $graficos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, $graficos->grafico->UploadPath) . $row['grafico']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($graficos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($graficos->CancelMessage <> "") {
				$this->setMessage($graficos->CancelMessage);
				$graficos->CancelMessage = "";
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
				$graficos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $graficos;

		// Call Recordset Selecting event
		$graficos->Recordset_Selecting($graficos->CurrentFilter);

		// Load List page SQL
		$sSql = $graficos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$graficos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $graficos;
		$sFilter = $graficos->KeyFilter();

		// Call Row Selecting event
		$graficos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$graficos->CurrentFilter = $sFilter;
		$sSql = $graficos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$graficos->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $graficos;
		$graficos->id->setDbValue($rs->fields('id'));
		$graficos->grafico->Upload->DbValue = $rs->fields('grafico');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $graficos;

		// Initialize URLs
		// Call Row_Rendering event

		$graficos->Row_Rendering();

		// Common render codes for all row types
		// id

		$graficos->id->CellCssStyle = ""; $graficos->id->CellCssClass = "";
		$graficos->id->CellAttrs = array(); $graficos->id->ViewAttrs = array(); $graficos->id->EditAttrs = array();

		// grafico
		$graficos->grafico->CellCssStyle = ""; $graficos->grafico->CellCssClass = "";
		$graficos->grafico->CellAttrs = array(); $graficos->grafico->ViewAttrs = array(); $graficos->grafico->EditAttrs = array();
		if ($graficos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$graficos->id->ViewValue = $graficos->id->CurrentValue;
			$graficos->id->CssStyle = "";
			$graficos->id->CssClass = "";
			$graficos->id->ViewCustomAttributes = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->ViewValue = $graficos->grafico->Upload->DbValue;
			} else {
				$graficos->grafico->ViewValue = "";
			}
			$graficos->grafico->CssStyle = "";
			$graficos->grafico->CssClass = "";
			$graficos->grafico->ViewCustomAttributes = "";

			// id
			$graficos->id->HrefValue = "";
			$graficos->id->TooltipValue = "";

			// grafico
			if (!ew_Empty($graficos->grafico->Upload->DbValue)) {
				$graficos->grafico->HrefValue = ew_UploadPathEx(FALSE, $graficos->grafico->UploadPath) . ((!empty($graficos->grafico->ViewValue)) ? $graficos->grafico->ViewValue : $graficos->grafico->CurrentValue);
				if ($graficos->Export <> "") $graficos->grafico->HrefValue = ew_ConvertFullUrl($graficos->grafico->HrefValue);
			} else {
				$graficos->grafico->HrefValue = "";
			}
			$graficos->grafico->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($graficos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$graficos->Row_Rendered();
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
