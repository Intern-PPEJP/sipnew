<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_rpkerjasama->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_rpkerjasamamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_rpkerjasama->jenispel->Visible) { // jenispel ?>
		<tr id="r_jenispel">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->jenispel->caption() ?></td>
			<td <?php echo $t_rpkerjasama->jenispel->cellAttributes() ?>>
<span id="el_t_rpkerjasama_jenispel">
<span<?php echo $t_rpkerjasama->jenispel->viewAttributes() ?>><?php echo $t_rpkerjasama->jenispel->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->kerjasama->Visible) { // kerjasama ?>
		<tr id="r_kerjasama">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->kerjasama->caption() ?></td>
			<td <?php echo $t_rpkerjasama->kerjasama->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kerjasama">
<span<?php echo $t_rpkerjasama->kerjasama->viewAttributes() ?>><?php echo $t_rpkerjasama->kerjasama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->angkatan->Visible) { // angkatan ?>
		<tr id="r_angkatan">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->angkatan->caption() ?></td>
			<td <?php echo $t_rpkerjasama->angkatan->cellAttributes() ?>>
<span id="el_t_rpkerjasama_angkatan">
<span<?php echo $t_rpkerjasama->angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama->angkatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<tr id="r_sisa_angkatan">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->sisa_angkatan->caption() ?></td>
			<td <?php echo $t_rpkerjasama->sisa_angkatan->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sisa_angkatan">
<span<?php echo $t_rpkerjasama->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->targetpes->Visible) { // targetpes ?>
		<tr id="r_targetpes">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->targetpes->caption() ?></td>
			<td <?php echo $t_rpkerjasama->targetpes->cellAttributes() ?>>
<span id="el_t_rpkerjasama_targetpes">
<span<?php echo $t_rpkerjasama->targetpes->viewAttributes() ?>><?php echo $t_rpkerjasama->targetpes->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->kontak_person->Visible) { // kontak_person ?>
		<tr id="r_kontak_person">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->kontak_person->caption() ?></td>
			<td <?php echo $t_rpkerjasama->kontak_person->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kontak_person">
<span<?php echo $t_rpkerjasama->kontak_person->viewAttributes() ?>><?php echo $t_rpkerjasama->kontak_person->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_rpkerjasama->tahun_rencana->Visible) { // tahun_rencana ?>
		<tr id="r_tahun_rencana">
			<td class="<?php echo $t_rpkerjasama->TableLeftColumnClass ?>"><?php echo $t_rpkerjasama->tahun_rencana->caption() ?></td>
			<td <?php echo $t_rpkerjasama->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpkerjasama_tahun_rencana">
<span<?php echo $t_rpkerjasama->tahun_rencana->viewAttributes() ?>><?php echo $t_rpkerjasama->tahun_rencana->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>