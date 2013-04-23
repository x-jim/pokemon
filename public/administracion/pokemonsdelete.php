<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "pokemonsinfo.php" ?>
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
$pokemons_delete = new cpokemons_delete();
$Page =& $pokemons_delete;

// Page init
$pokemons_delete->Page_Init();

// Page main
$pokemons_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pokemons_delete = new ew_Page("pokemons_delete");

// page properties
pokemons_delete.PageID = "delete"; // page ID
pokemons_delete.FormID = "fpokemonsdelete"; // form ID
var EW_PAGE_ID = pokemons_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pokemons_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pokemons_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pokemons_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $pokemons_delete->LoadRecordset())
	$pokemons_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($pokemons_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$pokemons_delete->Page_Terminate("pokemonslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pokemons->TableCaption() ?><br><br>
<a href="<?php echo $pokemons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pokemons_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pokemons">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pokemons_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pokemons->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pokemons->id->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons->numero->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $pokemons->icono->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pokemons_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$pokemons_delete->lRecCnt++;

	// Set row properties
	$pokemons->CssClass = "";
	$pokemons->CssStyle = "";
	$pokemons->RowAttrs = array();
	$pokemons->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pokemons_delete->LoadRowValues($rs);

	// Render row
	$pokemons_delete->RenderRow();
?>
	<tr<?php echo $pokemons->RowAttributes() ?>>
		<td<?php echo $pokemons->id->CellAttributes() ?>>
<div<?php echo $pokemons->id->ViewAttributes() ?>><?php echo $pokemons->id->ListViewValue() ?></div></td>
		<td<?php echo $pokemons->numero->CellAttributes() ?>>
<div<?php echo $pokemons->numero->ViewAttributes() ?>><?php echo $pokemons->numero->ListViewValue() ?></div></td>
		<td<?php echo $pokemons->nombre->CellAttributes() ?>>
<div<?php echo $pokemons->nombre->ViewAttributes() ?>><?php echo $pokemons->nombre->ListViewValue() ?></div></td>
		<td<?php echo $pokemons->icono->CellAttributes() ?>>
<?php if ($pokemons->icono->HrefValue <> "" || $pokemons->icono->TooltipValue <> "") { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($pokemons->icono->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $pokemons->icono->UploadPath) . $pokemons->icono->Upload->DbValue ?>" border=0<?php echo $pokemons->icono->ViewAttributes() ?>>
<?php } elseif (!in_array($pokemons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
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
$pokemons_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpokemons_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pokemons';

	// Page object name
	var $PageObjName = 'pokemons_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pokemons;
		if ($pokemons->UseTokenInUrl) $PageUrl .= "t=" . $pokemons->TableVar . "&"; // Add page token
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
		global $objForm, $pokemons;
		if ($pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpokemons_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pokemons)
		$GLOBALS["pokemons"] = new cpokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pokemons', TRUE);

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
		global $pokemons;

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
		global $Language, $pokemons;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$pokemons->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($pokemons->id->QueryStringValue))
				$this->Page_Terminate("pokemonslist.php"); // Prevent SQL injection, exit
			$sKey .= $pokemons->id->QueryStringValue;
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
			$this->Page_Terminate("pokemonslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("pokemonslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pokemons class, pokemonsinfo.php

		$pokemons->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pokemons->CurrentAction = $_POST["a_delete"];
		} else {
			$pokemons->CurrentAction = "I"; // Display record
		}
		switch ($pokemons->CurrentAction) {
			case "D": // Delete
				$pokemons->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pokemons->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pokemons;
		$DeleteRows = TRUE;
		$sWrkFilter = $pokemons->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in pokemons class, pokemonsinfo.php

		$pokemons->CurrentFilter = $sWrkFilter;
		$sSql = $pokemons->SQL();
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
				$DeleteRows = $pokemons->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, $pokemons->imagen->UploadPath) . $row['imagen']);
				@unlink(ew_UploadPathEx(TRUE, $pokemons->icono->UploadPath) . $row['icono']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($pokemons->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pokemons->CancelMessage <> "") {
				$this->setMessage($pokemons->CancelMessage);
				$pokemons->CancelMessage = "";
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
				$pokemons->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pokemons;

		// Call Recordset Selecting event
		$pokemons->Recordset_Selecting($pokemons->CurrentFilter);

		// Load List page SQL
		$sSql = $pokemons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pokemons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pokemons;
		$sFilter = $pokemons->KeyFilter();

		// Call Row Selecting event
		$pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pokemons->CurrentFilter = $sFilter;
		$sSql = $pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pokemons;
		$pokemons->id->setDbValue($rs->fields('id'));
		$pokemons->numero->setDbValue($rs->fields('numero'));
		$pokemons->nombre->setDbValue($rs->fields('nombre'));
		$pokemons->imagen->Upload->DbValue = $rs->fields('imagen');
		$pokemons->icono->Upload->DbValue = $rs->fields('icono');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pokemons;

		// Initialize URLs
		// Call Row_Rendering event

		$pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$pokemons->id->CellCssStyle = ""; $pokemons->id->CellCssClass = "";
		$pokemons->id->CellAttrs = array(); $pokemons->id->ViewAttrs = array(); $pokemons->id->EditAttrs = array();

		// numero
		$pokemons->numero->CellCssStyle = ""; $pokemons->numero->CellCssClass = "";
		$pokemons->numero->CellAttrs = array(); $pokemons->numero->ViewAttrs = array(); $pokemons->numero->EditAttrs = array();

		// nombre
		$pokemons->nombre->CellCssStyle = ""; $pokemons->nombre->CellCssClass = "";
		$pokemons->nombre->CellAttrs = array(); $pokemons->nombre->ViewAttrs = array(); $pokemons->nombre->EditAttrs = array();

		// icono
		$pokemons->icono->CellCssStyle = ""; $pokemons->icono->CellCssClass = "";
		$pokemons->icono->CellAttrs = array(); $pokemons->icono->ViewAttrs = array(); $pokemons->icono->EditAttrs = array();
		if ($pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pokemons->id->ViewValue = $pokemons->id->CurrentValue;
			$pokemons->id->CssStyle = "";
			$pokemons->id->CssClass = "";
			$pokemons->id->ViewCustomAttributes = "";

			// numero
			$pokemons->numero->ViewValue = $pokemons->numero->CurrentValue;
			$pokemons->numero->CssStyle = "";
			$pokemons->numero->CssClass = "";
			$pokemons->numero->ViewCustomAttributes = "";

			// nombre
			$pokemons->nombre->ViewValue = $pokemons->nombre->CurrentValue;
			$pokemons->nombre->CssStyle = "";
			$pokemons->nombre->CssClass = "";
			$pokemons->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($pokemons->imagen->Upload->DbValue)) {
				$pokemons->imagen->ViewValue = $pokemons->imagen->Upload->DbValue;
			} else {
				$pokemons->imagen->ViewValue = "";
			}
			$pokemons->imagen->CssStyle = "";
			$pokemons->imagen->CssClass = "";
			$pokemons->imagen->ViewCustomAttributes = "";

			// icono
			if (!ew_Empty($pokemons->icono->Upload->DbValue)) {
				$pokemons->icono->ViewValue = $pokemons->icono->Upload->DbValue;
				$pokemons->icono->ImageWidth = 32;
				$pokemons->icono->ImageHeight = 32;
				$pokemons->icono->ImageAlt = $pokemons->icono->FldAlt();
			} else {
				$pokemons->icono->ViewValue = "";
			}
			$pokemons->icono->CssStyle = "";
			$pokemons->icono->CssClass = "";
			$pokemons->icono->ViewCustomAttributes = "";

			// id
			$pokemons->id->HrefValue = "";
			$pokemons->id->TooltipValue = "";

			// numero
			$pokemons->numero->HrefValue = "";
			$pokemons->numero->TooltipValue = "";

			// nombre
			$pokemons->nombre->HrefValue = "";
			$pokemons->nombre->TooltipValue = "";

			// icono
			$pokemons->icono->HrefValue = "";
			$pokemons->icono->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pokemons->Row_Rendered();
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
