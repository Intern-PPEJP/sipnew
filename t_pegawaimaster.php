<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_pegawai->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_pegawaimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_pegawai->nip->Visible) { // nip ?>
		<tr id="r_nip">
			<td class="<?php echo $t_pegawai->TableLeftColumnClass ?>"><?php echo $t_pegawai->nip->caption() ?></td>
			<td <?php echo $t_pegawai->nip->cellAttributes() ?>>
<span id="el_t_pegawai_nip">
<span<?php echo $t_pegawai->nip->viewAttributes() ?>><?php echo $t_pegawai->nip->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pegawai->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $t_pegawai->TableLeftColumnClass ?>"><?php echo $t_pegawai->nama->caption() ?></td>
			<td <?php echo $t_pegawai->nama->cellAttributes() ?>>
<span id="el_t_pegawai_nama">
<span<?php echo $t_pegawai->nama->viewAttributes() ?>><?php echo $t_pegawai->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pegawai->bagian->Visible) { // bagian ?>
		<tr id="r_bagian">
			<td class="<?php echo $t_pegawai->TableLeftColumnClass ?>"><?php echo $t_pegawai->bagian->caption() ?></td>
			<td <?php echo $t_pegawai->bagian->cellAttributes() ?>>
<span id="el_t_pegawai_bagian">
<span<?php echo $t_pegawai->bagian->viewAttributes() ?>><?php echo $t_pegawai->bagian->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pegawai->aktif->Visible) { // aktif ?>
		<tr id="r_aktif">
			<td class="<?php echo $t_pegawai->TableLeftColumnClass ?>"><?php echo $t_pegawai->aktif->caption() ?></td>
			<td <?php echo $t_pegawai->aktif->cellAttributes() ?>>
<span id="el_t_pegawai_aktif">
<span<?php echo $t_pegawai->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_pegawai->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_pegawai->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>