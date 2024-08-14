<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_rkwebinar->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_rkwebinarmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_rkwebinar->kegiatan->Visible) { // kegiatan ?>
		<tr id="r_kegiatan">
			<td class="<?php echo $t_rkwebinar->TableLeftColumnClass ?>"><?php echo $t_rkwebinar->kegiatan->caption() ?></td>
			<td <?php echo $t_rkwebinar->kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_kegiatan">
<span<?php echo $t_rkwebinar->kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar->kegiatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkwebinar->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<tr id="r_tanggal_kegiatan">
			<td class="<?php echo $t_rkwebinar->TableLeftColumnClass ?>"><?php echo $t_rkwebinar->tanggal_kegiatan->caption() ?></td>
			<td <?php echo $t_rkwebinar->tanggal_kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_tanggal_kegiatan">
<span<?php echo $t_rkwebinar->tanggal_kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rkwebinar->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $t_rkwebinar->TableLeftColumnClass ?>"><?php echo $t_rkwebinar->tahun->caption() ?></td>
			<td <?php echo $t_rkwebinar->tahun->cellAttributes() ?>>
<span id="el_t_rkwebinar_tahun">
<span<?php echo $t_rkwebinar->tahun->viewAttributes() ?>><?php echo $t_rkwebinar->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>