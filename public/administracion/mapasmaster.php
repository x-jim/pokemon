<?php

// Call Row_Rendering event
$mapas->Row_Rendering();

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

// Call Row_Rendered event
$mapas->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $mapas->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $mapas->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $mapas->imagen->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $mapas->mapa_norte->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $mapas->mapa_este->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $mapas->mapa_sur->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $mapas->mapa_oeste->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
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
	</tbody>
</table>
</div>
</td></tr></table>
<br>
