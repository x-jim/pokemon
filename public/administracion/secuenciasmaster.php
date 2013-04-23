<?php

// Call Row_Rendering event
$secuencias->Row_Rendering();

// id
$secuencias->id->CellCssStyle = ""; $secuencias->id->CellCssClass = "";
$secuencias->id->CellAttrs = array(); $secuencias->id->ViewAttrs = array(); $secuencias->id->EditAttrs = array();

// nombre
$secuencias->nombre->CellCssStyle = ""; $secuencias->nombre->CellCssClass = "";
$secuencias->nombre->CellAttrs = array(); $secuencias->nombre->ViewAttrs = array(); $secuencias->nombre->EditAttrs = array();

// Call Row_Rendered event
$secuencias->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $secuencias->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $secuencias->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $secuencias->nombre->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $secuencias->id->CellAttributes() ?>>
<div<?php echo $secuencias->id->ViewAttributes() ?>><?php echo $secuencias->id->ListViewValue() ?></div></td>
			<td<?php echo $secuencias->nombre->CellAttributes() ?>>
<div<?php echo $secuencias->nombre->ViewAttributes() ?>><?php echo $secuencias->nombre->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
