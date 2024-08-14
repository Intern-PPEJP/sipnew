<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($excp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_excpmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($excp->tahun_keg->Visible) { // tahun_keg ?>
		<tr id="r_tahun_keg">
			<td class="<?php echo $excp->TableLeftColumnClass ?>"><?php echo $excp->tahun_keg->caption() ?></td>
			<td <?php echo $excp->tahun_keg->cellAttributes() ?>>
<span id="el_excp_tahun_keg">
<span<?php echo $excp->tahun_keg->viewAttributes() ?>><?php echo $excp->tahun_keg->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($excp->area2->Visible) { // area2 ?>
		<tr id="r_area2">
			<td class="<?php echo $excp->TableLeftColumnClass ?>"><?php echo $excp->area2->caption() ?></td>
			<td <?php echo $excp->area2->cellAttributes() ?>>
<span id="el_excp_area2">
<span<?php echo $excp->area2->viewAttributes() ?>><?php echo $excp->area2->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($excp->kerjasama->Visible) { // kerjasama ?>
		<tr id="r_kerjasama">
			<td class="<?php echo $excp->TableLeftColumnClass ?>"><?php echo $excp->kerjasama->caption() ?></td>
			<td <?php echo $excp->kerjasama->cellAttributes() ?>>
<span id="el_excp_kerjasama">
<span<?php echo $excp->kerjasama->viewAttributes() ?>><?php echo $excp->kerjasama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($excp->jml_peserta->Visible) { // jml_peserta ?>
		<tr id="r_jml_peserta">
			<td class="<?php echo $excp->TableLeftColumnClass ?>"><?php echo $excp->jml_peserta->caption() ?></td>
			<td <?php echo $excp->jml_peserta->cellAttributes() ?>>
<span id="el_excp_jml_peserta">
<span<?php echo $excp->jml_peserta->viewAttributes() ?>><?php echo $excp->jml_peserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>