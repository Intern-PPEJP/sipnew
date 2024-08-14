<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_rkcoaching->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_rkcoachingmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_rkcoaching->kdkategori->Visible) { // kdkategori ?>
		<tr id="r_kdkategori">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->kdkategori->caption() ?></td>
			<td <?php echo $t_rkcoaching->kdkategori->cellAttributes() ?>>
<span id="el_t_rkcoaching_kdkategori">
<span<?php echo $t_rkcoaching->kdkategori->viewAttributes() ?>><?php echo $t_rkcoaching->kdkategori->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->kerjasama->Visible) { // kerjasama ?>
		<tr id="r_kerjasama">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->kerjasama->caption() ?></td>
			<td <?php echo $t_rkcoaching->kerjasama->cellAttributes() ?>>
<span id="el_t_rkcoaching_kerjasama">
<span<?php echo $t_rkcoaching->kerjasama->viewAttributes() ?>><?php echo $t_rkcoaching->kerjasama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->area->Visible) { // area ?>
		<tr id="r_area">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->area->caption() ?></td>
			<td <?php echo $t_rkcoaching->area->cellAttributes() ?>>
<span id="el_t_rkcoaching_area">
<span<?php echo $t_rkcoaching->area->viewAttributes() ?>><?php echo $t_rkcoaching->area->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->area2->Visible) { // area2 ?>
		<tr id="r_area2">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->area2->caption() ?></td>
			<td <?php echo $t_rkcoaching->area2->cellAttributes() ?>>
<span id="el_t_rkcoaching_area2">
<span<?php echo $t_rkcoaching->area2->viewAttributes() ?>><?php echo $t_rkcoaching->area2->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->tempat->Visible) { // tempat ?>
		<tr id="r_tempat">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->tempat->caption() ?></td>
			<td <?php echo $t_rkcoaching->tempat->cellAttributes() ?>>
<span id="el_t_rkcoaching_tempat">
<span<?php echo $t_rkcoaching->tempat->viewAttributes() ?>><?php echo $t_rkcoaching->tempat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->jml_tahapan->Visible) { // jml_tahapan ?>
		<tr id="r_jml_tahapan">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->jml_tahapan->caption() ?></td>
			<td <?php echo $t_rkcoaching->jml_tahapan->cellAttributes() ?>>
<span id="el_t_rkcoaching_jml_tahapan">
<span<?php echo $t_rkcoaching->jml_tahapan->viewAttributes() ?>><?php echo $t_rkcoaching->jml_tahapan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->jml_peserta->Visible) { // jml_peserta ?>
		<tr id="r_jml_peserta">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->jml_peserta->caption() ?></td>
			<td <?php echo $t_rkcoaching->jml_peserta->cellAttributes() ?>>
<span id="el_t_rkcoaching_jml_peserta">
<span<?php echo $t_rkcoaching->jml_peserta->viewAttributes() ?>><?php echo $t_rkcoaching->jml_peserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->tahun_keg->Visible) { // tahun_keg ?>
		<tr id="r_tahun_keg">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->tahun_keg->caption() ?></td>
			<td <?php echo $t_rkcoaching->tahun_keg->cellAttributes() ?>>
<span id="el_t_rkcoaching_tahun_keg">
<span<?php echo $t_rkcoaching->tahun_keg->viewAttributes() ?>><?php echo $t_rkcoaching->tahun_keg->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->mou->Visible) { // mou ?>
		<tr id="r_mou">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->mou->caption() ?></td>
			<td <?php echo $t_rkcoaching->mou->cellAttributes() ?>>
<span id="el_t_rkcoaching_mou">
<span<?php echo $t_rkcoaching->mou->viewAttributes() ?>><?php echo GetFileViewTag($t_rkcoaching->mou, $t_rkcoaching->mou->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkcoaching->real->Visible) { // real ?>
		<tr id="r_real">
			<td class="<?php echo $t_rkcoaching->TableLeftColumnClass ?>"><?php echo $t_rkcoaching->real->caption() ?></td>
			<td <?php echo $t_rkcoaching->real->cellAttributes() ?>>
<span id="el_t_rkcoaching_real">
<span<?php echo $t_rkcoaching->real->viewAttributes() ?>><?php echo $t_rkcoaching->real->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>