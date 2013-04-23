<?php

// Call Row_Rendering event
$entrenadores->Row_Rendering();

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

// Call Row_Rendered event
$entrenadores->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $entrenadores->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $entrenadores->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->nombre->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->zemail->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->passwd->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->iniciado->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->en_secuencia->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->map->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->secuencia->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $entrenadores->escena->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
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
	</tbody>
</table>
</div>
</td></tr></table>
<br>
