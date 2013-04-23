<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "entrenadores_pokemonsinfo.php" ?>
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
$entrenadores_pokemons_delete = new centrenadores_pokemons_delete();
$Page =& $entrenadores_pokemons_delete;

// Page init
$entrenadores_pokemons_delete->Page_Init();

// Page main
$entrenadores_pokemons_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var entrenadores_pokemons_delete = new ew_Page("entrenadores_pokemons_delete");

// page properties
entrenadores_pokemons_delete.PageID = "delete"; // page ID
entrenadores_pokemons_delete.FormID = "fentrenadores_pokemonsdelete"; // form ID
var EW_PAGE_ID = entrenadores_pokemons_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
entrenadores_pokemons_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
entrenadores_pokemons_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
entrenadores_pokemons_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $entrenadores_pokemons_delete->LoadRecordset())
	$entrenadores_pokemons_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($entrenadores_pokemons_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$entrenadores_pokemons_delete->Page_Terminate("entrenadores_pokemonslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $entrenadores_pokemons->TableCaption() ?><br><br>
<a href="<?php echo $entrenadores_pokemons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$entrenadores_pokemons_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="entrenadores_pokemons">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($entrenadores_pokemons_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $entrenadores_pokemons->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $entrenadores_pokemons->id->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_pokemons->entrenador->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_pokemons->pokemon->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_pokemons->nivel->FldCaption() ?></td>
		<td valign="top"><?php echo $entrenadores_pokemons->experiencia->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$entrenadores_pokemons_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$entrenadores_pokemons_delete->lRecCnt++;

	// Set row properties
	$entrenadores_pokemons->CssClass = "";
	$entrenadores_pokemons->CssStyle = "";
	$entrenadores_pokemons->RowAttrs = array();
	$entrenadores_pokemons->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$entrenadores_pokemons_delete->LoadRowValues($rs);

	// Render row
	$entrenadores_pokemons_delete->RenderRow();
?>
	<tr<?php echo $entrenadores_pokemons->RowAttributes() ?>>
		<td<?php echo $entrenadores_pokemons->id->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->id->ViewAttributes() ?>><?php echo $entrenadores_pokemons->id->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_pokemons->entrenador->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->entrenador->ViewAttributes() ?>><?php echo $entrenadores_pokemons->entrenador->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_pokemons->pokemon->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->pokemon->ViewAttributes() ?>><?php echo $entrenadores_pokemons->pokemon->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_pokemons->nivel->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->nivel->ViewAttributes() ?>><?php echo $entrenadores_pokemons->nivel->ListViewValue() ?></div></td>
		<td<?php echo $entrenadores_pokemons->experiencia->CellAttributes() ?>>
<div<?php echo $entrenadores_pokemons->experiencia->ViewAttributes() ?>><?php echo $entrenadores_pokemons->experiencia->ListViewValue() ?></div></td>
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
$entrenadores_pokemons_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class centrenadores_pokemons_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'entrenadores_pokemons';

	// Page object name
	var $PageObjName = 'entrenadores_pokemons_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) $PageUrl .= "t=" . $entrenadores_pokemons->TableVar . "&"; // Add page token
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
		global $objForm, $entrenadores_pokemons;
		if ($entrenadores_pokemons->UseTokenInUrl) {
			if ($objForm)
				return ($entrenadores_pokemons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($entrenadores_pokemons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function centrenadores_pokemons_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (entrenadores_pokemons)
		$GLOBALS["entrenadores_pokemons"] = new centrenadores_pokemons();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'entrenadores_pokemons', TRUE);

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
		global $entrenadores_pokemons;

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
		global $Language, $entrenadores_pokemons;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$entrenadores_pokemons->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($entrenadores_pokemons->id->QueryStringValue))
				$this->Page_Terminate("entrenadores_pokemonslist.php"); // Prevent SQL injection, exit
			$sKey .= $entrenadores_pokemons->id->QueryStringValue;
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
			$this->Page_Terminate("entrenadores_pokemonslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("entrenadores_pokemonslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in entrenadores_pokemons class, entrenadores_pokemonsinfo.php

		$entrenadores_pokemons->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$entrenadores_pokemons->CurrentAction = $_POST["a_delete"];
		} else {
			$entrenadores_pokemons->CurrentAction = "I"; // Display record
		}
		switch ($entrenadores_pokemons->CurrentAction) {
			case "D": // Delete
				$entrenadores_pokemons->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($entrenadores_pokemons->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $entrenadores_pokemons;
		$DeleteRows = TRUE;
		$sWrkFilter = $entrenadores_pokemons->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in entrenadores_pokemons class, entrenadores_pokemonsinfo.php

		$entrenadores_pokemons->CurrentFilter = $sWrkFilter;
		$sSql = $entrenadores_pokemons->SQL();
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
				$DeleteRows = $entrenadores_pokemons->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($entrenadores_pokemons->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($entrenadores_pokemons->CancelMessage <> "") {
				$this->setMessage($entrenadores_pokemons->CancelMessage);
				$entrenadores_pokemons->CancelMessage = "";
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
				$entrenadores_pokemons->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $entrenadores_pokemons;

		// Call Recordset Selecting event
		$entrenadores_pokemons->Recordset_Selecting($entrenadores_pokemons->CurrentFilter);

		// Load List page SQL
		$sSql = $entrenadores_pokemons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$entrenadores_pokemons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $entrenadores_pokemons;
		$sFilter = $entrenadores_pokemons->KeyFilter();

		// Call Row Selecting event
		$entrenadores_pokemons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$entrenadores_pokemons->CurrentFilter = $sFilter;
		$sSql = $entrenadores_pokemons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$entrenadores_pokemons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $entrenadores_pokemons;
		$entrenadores_pokemons->id->setDbValue($rs->fields('id'));
		$entrenadores_pokemons->entrenador->setDbValue($rs->fields('entrenador'));
		$entrenadores_pokemons->pokemon->setDbValue($rs->fields('pokemon'));
		$entrenadores_pokemons->nivel->setDbValue($rs->fields('nivel'));
		$entrenadores_pokemons->experiencia->setDbValue($rs->fields('experiencia'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $entrenadores_pokemons;

		// Initialize URLs
		// Call Row_Rendering event

		$entrenadores_pokemons->Row_Rendering();

		// Common render codes for all row types
		// id

		$entrenadores_pokemons->id->CellCssStyle = ""; $entrenadores_pokemons->id->CellCssClass = "";
		$entrenadores_pokemons->id->CellAttrs = array(); $entrenadores_pokemons->id->ViewAttrs = array(); $entrenadores_pokemons->id->EditAttrs = array();

		// entrenador
		$entrenadores_pokemons->entrenador->CellCssStyle = ""; $entrenadores_pokemons->entrenador->CellCssClass = "";
		$entrenadores_pokemons->entrenador->CellAttrs = array(); $entrenadores_pokemons->entrenador->ViewAttrs = array(); $entrenadores_pokemons->entrenador->EditAttrs = array();

		// pokemon
		$entrenadores_pokemons->pokemon->CellCssStyle = ""; $entrenadores_pokemons->pokemon->CellCssClass = "";
		$entrenadores_pokemons->pokemon->CellAttrs = array(); $entrenadores_pokemons->pokemon->ViewAttrs = array(); $entrenadores_pokemons->pokemon->EditAttrs = array();

		// nivel
		$entrenadores_pokemons->nivel->CellCssStyle = ""; $entrenadores_pokemons->nivel->CellCssClass = "";
		$entrenadores_pokemons->nivel->CellAttrs = array(); $entrenadores_pokemons->nivel->ViewAttrs = array(); $entrenadores_pokemons->nivel->EditAttrs = array();

		// experiencia
		$entrenadores_pokemons->experiencia->CellCssStyle = ""; $entrenadores_pokemons->experiencia->CellCssClass = "";
		$entrenadores_pokemons->experiencia->CellAttrs = array(); $entrenadores_pokemons->experiencia->ViewAttrs = array(); $entrenadores_pokemons->experiencia->EditAttrs = array();
		if ($entrenadores_pokemons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$entrenadores_pokemons->id->ViewValue = $entrenadores_pokemons->id->CurrentValue;
			$entrenadores_pokemons->id->CssStyle = "";
			$entrenadores_pokemons->id->CssClass = "";
			$entrenadores_pokemons->id->ViewCustomAttributes = "";

			// entrenador
			$entrenadores_pokemons->entrenador->ViewValue = $entrenadores_pokemons->entrenador->CurrentValue;
			$entrenadores_pokemons->entrenador->CssStyle = "";
			$entrenadores_pokemons->entrenador->CssClass = "";
			$entrenadores_pokemons->entrenador->ViewCustomAttributes = "";

			// pokemon
			$entrenadores_pokemons->pokemon->ViewValue = $entrenadores_pokemons->pokemon->CurrentValue;
			$entrenadores_pokemons->pokemon->CssStyle = "";
			$entrenadores_pokemons->pokemon->CssClass = "";
			$entrenadores_pokemons->pokemon->ViewCustomAttributes = "";

			// nivel
			$entrenadores_pokemons->nivel->ViewValue = $entrenadores_pokemons->nivel->CurrentValue;
			$entrenadores_pokemons->nivel->CssStyle = "";
			$entrenadores_pokemons->nivel->CssClass = "";
			$entrenadores_pokemons->nivel->ViewCustomAttributes = "";

			// experiencia
			$entrenadores_pokemons->experiencia->ViewValue = $entrenadores_pokemons->experiencia->CurrentValue;
			$entrenadores_pokemons->experiencia->CssStyle = "";
			$entrenadores_pokemons->experiencia->CssClass = "";
			$entrenadores_pokemons->experiencia->ViewCustomAttributes = "";

			// id
			$entrenadores_pokemons->id->HrefValue = "";
			$entrenadores_pokemons->id->TooltipValue = "";

			// entrenador
			$entrenadores_pokemons->entrenador->HrefValue = "";
			$entrenadores_pokemons->entrenador->TooltipValue = "";

			// pokemon
			$entrenadores_pokemons->pokemon->HrefValue = "";
			$entrenadores_pokemons->pokemon->TooltipValue = "";

			// nivel
			$entrenadores_pokemons->nivel->HrefValue = "";
			$entrenadores_pokemons->nivel->TooltipValue = "";

			// experiencia
			$entrenadores_pokemons->experiencia->HrefValue = "";
			$entrenadores_pokemons->experiencia->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($entrenadores_pokemons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$entrenadores_pokemons->Row_Rendered();
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
