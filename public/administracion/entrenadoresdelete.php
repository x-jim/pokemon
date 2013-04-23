<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$entrenadores_delete = new centrenadores_delete();
$Page =& $entrenadores_delete;

// Page init
$entrenadores_delete->Page_Init();

// Page main
$entrenadores_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_delete = new ew_Page("entrenadores_delete");

// page properties
entrenadores_delete.PageID = "delete"; // page ID
entrenadores_delete.FormID = "fentrenadoresdelete"; // form ID
var EW_PAGE_ID = entrenadores_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $entrenadores_delete->LoadRecordset())
	$entrenadores_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($entrenadores_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$entrenadores_delete->Page_Terminate("entrenadoreslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="entrenadores">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($entrenadores_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $entrenadores->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $entrenadores->id->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->passwd->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->iniciado->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->en_secuencia->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->map->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->secuencia->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores->escena->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$entrenadores_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$entrenadores_delete->lRecCnt++;

	// Set row properties
	$entrenadores->CssClass = "";
	$entrenadores->CssStyle = "";
	$entrenadores->RowAttrs = array();
	$entrenadores->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$entrenadores_delete->LoadRowValues($rs);

	// Render row
	$entrenadores_delete->RenderRow();
?>
	<tr<?php echo $entrenadores->RowAttributes() ?>>
		<td<?php echo $entrenadores->id->CellAttributes() ?>>
<div<?php echo $entrenadores->id->ViewAttributes() ?>><?php echo $entrenadores->id->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->nombre->CellAttributes() ?>>
<div<?php echo $entrenadores->nombre->ViewAttributes() ?>><?php echo $entrenadores->nombre->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->zemail->CellAttributes() ?>>
<div<?php echo $entrenadores->zemail->ViewAttributes() ?>><?php echo $entrenadores->zemail->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->passwd->CellAttributes() ?>>
<div<?php echo $entrenadores->passwd->ViewAttributes() ?>><?php echo $entrenadores->passwd->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->iniciado->CellAttributes() ?>>
<div<?php echo $entrenadores->iniciado->ViewAttributes() ?>><?php echo $entrenadores->iniciado->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->en_secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores->en_secuencia->ViewAttributes() ?>><?php echo $entrenadores->en_secuencia->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->map->CellAttributes() ?>>
<div<?php echo $entrenadores->map->ViewAttributes() ?>><?php echo $entrenadores->map->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->secuencia->CellAttributes() ?>>
<div<?php echo $entrenadores->secuencia->ViewAttributes() ?>><?php echo $entrenadores->secuencia->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores->escena->CellAttributes() ?>>
<div<?php echo $entrenadores->escena->ViewAttributes() ?>><?php echo $entrenadores->escena->ListViewValue() ?></div></td>
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
$entrenadores_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'entrenadores';

	// Page object name
	var $PageObjName = 'entrenadores_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores;
		if ($entrenadores->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores;
		if ($entrenadores->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores)
		$GLOBALS["entrenadores"] = new centrenadores();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores', TRUE);

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
		global $entrenadores;

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
		global $Language, $entrenadores;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$entrenadores->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($entrenadores->id->QueryStringValue))
				$this->Page_Terminate("entrenadoreslist.php"); // Prevent SQL injection, exit
			$sKey .= $entrenadores->id->QueryStringValue;
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
			$this->Page_Terminate("entrenadoreslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("entrenadoreslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in entrenadores class, entrenadoresinfo.php

		$entrenadores->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$entrenadores->CurrentAction = $_POST["a_delete"];
		} else {
			$entrenadores->CurrentAction = "I"; // Display record
		}
		switch ($entrenadores->CurrentAction) {
			case "D": // Delete
				$entrenadores->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($entrenadores->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $entrenadores;
		$DeleteRows = TRUE;
		$sWrkFilter = $entrenadores->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in entrenadores class, entrenadoresinfo.php

		$entrenadores->CurrentFilter = $sWrkFilter;
		$sSql = $entrenadores->SQL();
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
				$DeleteRows = $entrenadores->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($entrenadores->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($entrenadores->CancelMessage <> "") {
				$this->setMessage($entrenadores->CancelMessage);
				$entrenadores->CancelMessage = "";
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
				$entrenadores->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores;

		// Call Recordset Selecting event
		$entrenadores->Recordset_Selecting($entrenadores->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores;
		$sFilter = $entrenadores->KeyFilter();

		// Call Row Selecting event
		$entrenadores->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores->CurrentFilter = $sFilter;
		$sSql = $entrenadores->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores;
		$entrenadores->id->setDbValue($rs->fields('id'));
		$entrenadores->nombre->setDbValue($rs->fields('nombre'));
		$entrenadores->zemail->setDbValue($rs->fields('email'));
		$entrenadores->passwd->setDbValue($rs->fields('passwd'));
		$entrenadores->iniciado->setDbValue($rs->fields('iniciado'));
		$entrenadores->en_secuencia->setDbValue($rs->fields('en_secuencia'));
		$entrenadores->map->setDbValue($rs->fields('map'));
		$entrenadores->secuencia->setDbValue($rs->fields('secuencia'));
		$entrenadores->escena->setDbValue($rs->fields('escena'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores;

		// Initialize URLs
		// Call Row_Rendering event

		$entrenadores->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores->id->CellCssStyle = ""; $entrenadores->id->CellCssClass = "";
		$entrenadores->id->CellAttrs = array(); $entrenadores->id->ViewAttrs = array(); $entrenadores->id->EditAttrs = array();

		// nombre
		$entrenadores->nombre->CellCssStyle = ""; $entrenadores->nombre->CellCssClass = "";
		$entrenadores->nombre->CellAttrs = array(); $entrenadores->nombre->ViewAttrs = array(); $entrenadores->nombre->EditAttrs = array();

		// email
		$entrenadores->zemail->CellCssStyle = ""; $entrenadores->zemail->CellCssClass = "";
		$entrenadores->zemail->CellAttrs = array(); $entrenadores->zemail->ViewAttrs = array(); $entrenadores->zemail->EditAttrs = array();

		// passwd
		$entrenadores->passwd->CellCssStyle = ""; $entrenadores->passwd->CellCssClass = "";
		$entrenadores->passwd->CellAttrs = array(); $entrenadores->passwd->ViewAttrs = array(); $entrenadores->passwd->EditAttrs = array();

		// iniciado
		$entrenadores->iniciado->CellCssStyle = ""; $entrenadores->iniciado->CellCssClass = "";
		$entrenadores->iniciado->CellAttrs = array(); $entrenadores->iniciado->ViewAttrs = array(); $entrenadores->iniciado->EditAttrs = array();

		// en_secuencia
		$entrenadores->en_secuencia->CellCssStyle = ""; $entrenadores->en_secuencia->CellCssClass = "";
		$entrenadores->en_secuencia->CellAttrs = array(); $entrenadores->en_secuencia->ViewAttrs = array(); $entrenadores->en_secuencia->EditAttrs = array();

		// map
		$entrenadores->map->CellCssStyle = ""; $entrenadores->map->CellCssClass = "";
		$entrenadores->map->CellAttrs = array(); $entrenadores->map->ViewAttrs = array(); $entrenadores->map->EditAttrs = array();

		// secuencia
		$entrenadores->secuencia->CellCssStyle = ""; $entrenadores->secuencia->CellCssClass = "";
		$entrenadores->secuencia->CellAttrs = array(); $entrenadores->secuencia->ViewAttrs = array(); $entrenadores->secuencia->EditAttrs = array();

		// escena
		$entrenadores->escena->CellCssStyle = ""; $entrenadores->escena->CellCssClass = "";
		$entrenadores->escena->CellAttrs = array(); $entrenadores->escena->ViewAttrs = array(); $entrenadores->escena->EditAttrs = array();
		if ($entrenadores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores->id->ViewValue = $entrenadores->id->CurrentValue;
			$entrenadores->id->CssStyle = "";
			$entrenadores->id->CssClass = "";
			$entrenadores->id->ViewCustomAttributes = "";

			// nombre
			$entrenadores->nombre->ViewValue = $entrenadores->nombre->CurrentValue;
			$entrenadores->nombre->CssStyle = "";
			$entrenadores->nombre->CssClass = "";
			$entrenadores->nombre->ViewCustomAttributes = "";

			// email
			$entrenadores->zemail->ViewValue = $entrenadores->zemail->CurrentValue;
			$entrenadores->zemail->CssStyle = "";
			$entrenadores->zemail->CssClass = "";
			$entrenadores->zemail->ViewCustomAttributes = "";

			// passwd
			$entrenadores->passwd->ViewValue = $entrenadores->passwd->CurrentValue;
			$entrenadores->passwd->CssStyle = "";
			$entrenadores->passwd->CssClass = "";
			$entrenadores->passwd->ViewCustomAttributes = "";

			// iniciado
			$entrenadores->iniciado->ViewValue = $entrenadores->iniciado->CurrentValue;
			$entrenadores->iniciado->CssStyle = "";
			$entrenadores->iniciado->CssClass = "";
			$entrenadores->iniciado->ViewCustomAttributes = "";

			// en_secuencia
			$entrenadores->en_secuencia->ViewValue = $entrenadores->en_secuencia->CurrentValue;
			$entrenadores->en_secuencia->CssStyle = "";
			$entrenadores->en_secuencia->CssClass = "";
			$entrenadores->en_secuencia->ViewCustomAttributes = "";

			// map
			$entrenadores->map->ViewValue = $entrenadores->map->CurrentValue;
			$entrenadores->map->CssStyle = "";
			$entrenadores->map->CssClass = "";
			$entrenadores->map->ViewCustomAttributes = "";

			// secuencia
			$entrenadores->secuencia->ViewValue = $entrenadores->secuencia->CurrentValue;
			$entrenadores->secuencia->CssStyle = "";
			$entrenadores->secuencia->CssClass = "";
			$entrenadores->secuencia->ViewCustomAttributes = "";

			// escena
			$entrenadores->escena->ViewValue = $entrenadores->escena->CurrentValue;
			$entrenadores->escena->CssStyle = "";
			$entrenadores->escena->CssClass = "";
			$entrenadores->escena->ViewCustomAttributes = "";

			// id
			$entrenadores->id->HrefValue = "";
			$entrenadores->id->TooltipValue = "";

			// nombre
			$entrenadores->nombre->HrefValue = "";
			$entrenadores->nombre->TooltipValue = "";

			// email
			$entrenadores->zemail->HrefValue = "";
			$entrenadores->zemail->TooltipValue = "";

			// passwd
			$entrenadores->passwd->HrefValue = "";
			$entrenadores->passwd->TooltipValue = "";

			// iniciado
			$entrenadores->iniciado->HrefValue = "";
			$entrenadores->iniciado->TooltipValue = "";

			// en_secuencia
			$entrenadores->en_secuencia->HrefValue = "";
			$entrenadores->en_secuencia->TooltipValue = "";

			// map
			$entrenadores->map->HrefValue = "";
			$entrenadores->map->TooltipValue = "";

			// secuencia
			$entrenadores->secuencia->HrefValue = "";
			$entrenadores->secuencia->TooltipValue = "";

			// escena
			$entrenadores->escena->HrefValue = "";
			$entrenadores->escena->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores->Row_Rendered();
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
