<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($cv_pelrepes->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_cv_pelrepesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($cv_pelrepes->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->kdjudul->caption() ?></td>
			<td <?php echo $cv_pelrepes->kdjudul->cellAttributes() ?>>
<span id="el_cv_pelrepes_kdjudul">
<span<?php echo $cv_pelrepes->kdjudul->viewAttributes() ?>><?php echo $cv_pelrepes->kdjudul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->tawal->Visible) { // tawal ?>
		<tr id="r_tawal">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->tawal->caption() ?></td>
			<td <?php echo $cv_pelrepes->tawal->cellAttributes() ?>>
<span id="el_cv_pelrepes_tawal">
<span<?php echo $cv_pelrepes->tawal->viewAttributes() ?>><?php echo $cv_pelrepes->tawal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->takhir->Visible) { // takhir ?>
		<tr id="r_takhir">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->takhir->caption() ?></td>
			<td <?php echo $cv_pelrepes->takhir->cellAttributes() ?>>
<span id="el_cv_pelrepes_takhir">
<span<?php echo $cv_pelrepes->takhir->viewAttributes() ?>><?php echo $cv_pelrepes->takhir->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->kdprop->Visible) { // kdprop ?>
		<tr id="r_kdprop">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->kdprop->caption() ?></td>
			<td <?php echo $cv_pelrepes->kdprop->cellAttributes() ?>>
<span id="el_cv_pelrepes_kdprop">
<span<?php echo $cv_pelrepes->kdprop->viewAttributes() ?>><?php echo $cv_pelrepes->kdprop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->kdkota->Visible) { // kdkota ?>
		<tr id="r_kdkota">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->kdkota->caption() ?></td>
			<td <?php echo $cv_pelrepes->kdkota->cellAttributes() ?>>
<span id="el_cv_pelrepes_kdkota">
<span<?php echo $cv_pelrepes->kdkota->viewAttributes() ?>><?php echo $cv_pelrepes->kdkota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->kdkec->Visible) { // kdkec ?>
		<tr id="r_kdkec">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->kdkec->caption() ?></td>
			<td <?php echo $cv_pelrepes->kdkec->cellAttributes() ?>>
<span id="el_cv_pelrepes_kdkec">
<span<?php echo $cv_pelrepes->kdkec->viewAttributes() ?>><?php echo $cv_pelrepes->kdkec->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->statuspel->Visible) { // statuspel ?>
		<tr id="r_statuspel">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->statuspel->caption() ?></td>
			<td <?php echo $cv_pelrepes->statuspel->cellAttributes() ?>>
<span id="el_cv_pelrepes_statuspel">
<span<?php echo $cv_pelrepes->statuspel->viewAttributes() ?>><?php echo $cv_pelrepes->statuspel->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_pelrepes->tahun_pelatihan->Visible) { // tahun_pelatihan ?>
		<tr id="r_tahun_pelatihan">
			<td class="<?php echo $cv_pelrepes->TableLeftColumnClass ?>"><?php echo $cv_pelrepes->tahun_pelatihan->caption() ?></td>
			<td <?php echo $cv_pelrepes->tahun_pelatihan->cellAttributes() ?>>
<span id="el_cv_pelrepes_tahun_pelatihan">
<span<?php echo $cv_pelrepes->tahun_pelatihan->viewAttributes() ?>><?php echo $cv_pelrepes->tahun_pelatihan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>