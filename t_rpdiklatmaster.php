<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_rpdiklat->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_rpdiklatmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_rpdiklat->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->kdjudul->caption() ?></td>
			<td <?php echo $t_rpdiklat->kdjudul->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdjudul">
<span<?php echo $t_rpdiklat->kdjudul->viewAttributes() ?>><?php echo $t_rpdiklat->kdjudul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->kdbidang->Visible) { // kdbidang ?>
		<tr id="r_kdbidang">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->kdbidang->caption() ?></td>
			<td <?php echo $t_rpdiklat->kdbidang->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdbidang">
<span<?php echo $t_rpdiklat->kdbidang->viewAttributes() ?>><?php echo $t_rpdiklat->kdbidang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->jml_hari->Visible) { // jml_hari ?>
		<tr id="r_jml_hari">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->jml_hari->caption() ?></td>
			<td <?php echo $t_rpdiklat->jml_hari->cellAttributes() ?>>
<span id="el_t_rpdiklat_jml_hari">
<span<?php echo $t_rpdiklat->jml_hari->viewAttributes() ?>><?php echo $t_rpdiklat->jml_hari->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->jenisdurasi->Visible) { // jenisdurasi ?>
		<tr id="r_jenisdurasi">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->jenisdurasi->caption() ?></td>
			<td <?php echo $t_rpdiklat->jenisdurasi->cellAttributes() ?>>
<span id="el_t_rpdiklat_jenisdurasi">
<span<?php echo $t_rpdiklat->jenisdurasi->viewAttributes() ?>><?php echo $t_rpdiklat->jenisdurasi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->targetpes->Visible) { // targetpes ?>
		<tr id="r_targetpes">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->targetpes->caption() ?></td>
			<td <?php echo $t_rpdiklat->targetpes->cellAttributes() ?>>
<span id="el_t_rpdiklat_targetpes">
<span<?php echo $t_rpdiklat->targetpes->viewAttributes() ?>><?php echo $t_rpdiklat->targetpes->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->angkatan->Visible) { // angkatan ?>
		<tr id="r_angkatan">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->angkatan->caption() ?></td>
			<td <?php echo $t_rpdiklat->angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_angkatan">
<span<?php echo $t_rpdiklat->angkatan->viewAttributes() ?>><?php echo $t_rpdiklat->angkatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<tr id="r_sisa_angkatan">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->sisa_angkatan->caption() ?></td>
			<td <?php echo $t_rpdiklat->sisa_angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_sisa_angkatan">
<span<?php echo $t_rpdiklat->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpdiklat->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->harga_satuan->Visible) { // harga_satuan ?>
		<tr id="r_harga_satuan">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->harga_satuan->caption() ?></td>
			<td <?php echo $t_rpdiklat->harga_satuan->cellAttributes() ?>>
<span id="el_t_rpdiklat_harga_satuan">
<span<?php echo $t_rpdiklat->harga_satuan->viewAttributes() ?>><?php echo $t_rpdiklat->harga_satuan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpdiklat->tahun_rencana->Visible) { // tahun_rencana ?>
		<tr id="r_tahun_rencana">
			<td class="<?php echo $t_rpdiklat->TableLeftColumnClass ?>"><?php echo $t_rpdiklat->tahun_rencana->caption() ?></td>
			<td <?php echo $t_rpdiklat->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpdiklat_tahun_rencana">
<span<?php echo $t_rpdiklat->tahun_rencana->viewAttributes() ?>><?php echo $t_rpdiklat->tahun_rencana->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>