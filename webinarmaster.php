<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($webinar->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_webinarmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($webinar->rkwid->Visible) { // rkwid ?>
		<tr id="r_rkwid">
			<td class="<?php echo $webinar->TableLeftColumnClass ?>"><?php echo $webinar->rkwid->caption() ?></td>
			<td <?php echo $webinar->rkwid->cellAttributes() ?>>
<span id="el_webinar_rkwid">
<span<?php echo $webinar->rkwid->viewAttributes() ?>><?php echo $webinar->rkwid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($webinar->kegiatan->Visible) { // kegiatan ?>
		<tr id="r_kegiatan">
			<td class="<?php echo $webinar->TableLeftColumnClass ?>"><?php echo $webinar->kegiatan->caption() ?></td>
			<td <?php echo $webinar->kegiatan->cellAttributes() ?>>
<span id="el_webinar_kegiatan">
<span<?php echo $webinar->kegiatan->viewAttributes() ?>><?php echo $webinar->kegiatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($webinar->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<tr id="r_tanggal_kegiatan">
			<td class="<?php echo $webinar->TableLeftColumnClass ?>"><?php echo $webinar->tanggal_kegiatan->caption() ?></td>
			<td <?php echo $webinar->tanggal_kegiatan->cellAttributes() ?>>
<span id="el_webinar_tanggal_kegiatan">
<span<?php echo $webinar->tanggal_kegiatan->viewAttributes() ?>><?php echo $webinar->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($webinar->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $webinar->TableLeftColumnClass ?>"><?php echo $webinar->tahun->caption() ?></td>
			<td <?php echo $webinar->tahun->cellAttributes() ?>>
<span id="el_webinar_tahun">
<span<?php echo $webinar->tahun->viewAttributes() ?>><?php echo $webinar->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>