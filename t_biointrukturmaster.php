<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_biointruktur->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_biointrukturmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_biointruktur->bioid->Visible) { // bioid ?>
		<tr id="r_bioid">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->bioid->caption() ?></td>
			<td <?php echo $t_biointruktur->bioid->cellAttributes() ?>>
<span id="el_t_biointruktur_bioid">
<span<?php echo $t_biointruktur->bioid->viewAttributes() ?>><?php echo $t_biointruktur->bioid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->kdinstruktur->Visible) { // kdinstruktur ?>
		<tr id="r_kdinstruktur">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->kdinstruktur->caption() ?></td>
			<td <?php echo $t_biointruktur->kdinstruktur->cellAttributes() ?>>
<span id="el_t_biointruktur_kdinstruktur">
<span<?php echo $t_biointruktur->kdinstruktur->viewAttributes() ?>><?php echo $t_biointruktur->kdinstruktur->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->revisi->Visible) { // revisi ?>
		<tr id="r_revisi">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->revisi->caption() ?></td>
			<td <?php echo $t_biointruktur->revisi->cellAttributes() ?>>
<span id="el_t_biointruktur_revisi">
<span<?php echo $t_biointruktur->revisi->viewAttributes() ?>><?php echo $t_biointruktur->revisi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->tglterbit->Visible) { // tglterbit ?>
		<tr id="r_tglterbit">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->tglterbit->caption() ?></td>
			<td <?php echo $t_biointruktur->tglterbit->cellAttributes() ?>>
<span id="el_t_biointruktur_tglterbit">
<span<?php echo $t_biointruktur->tglterbit->viewAttributes() ?>><?php echo $t_biointruktur->tglterbit->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->nama->caption() ?></td>
			<td <?php echo $t_biointruktur->nama->cellAttributes() ?>>
<span id="el_t_biointruktur_nama">
<span<?php echo $t_biointruktur->nama->viewAttributes() ?>><?php echo $t_biointruktur->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->komp_materi->Visible) { // komp_materi ?>
		<tr id="r_komp_materi">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->komp_materi->caption() ?></td>
			<td <?php echo $t_biointruktur->komp_materi->cellAttributes() ?>>
<span id="el_t_biointruktur_komp_materi">
<span<?php echo $t_biointruktur->komp_materi->viewAttributes() ?>><?php echo $t_biointruktur->komp_materi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->instansi->Visible) { // instansi ?>
		<tr id="r_instansi">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->instansi->caption() ?></td>
			<td <?php echo $t_biointruktur->instansi->cellAttributes() ?>>
<span id="el_t_biointruktur_instansi">
<span<?php echo $t_biointruktur->instansi->viewAttributes() ?>><?php echo $t_biointruktur->instansi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_biointruktur->pekerjaan->Visible) { // pekerjaan ?>
		<tr id="r_pekerjaan">
			<td class="<?php echo $t_biointruktur->TableLeftColumnClass ?>"><?php echo $t_biointruktur->pekerjaan->caption() ?></td>
			<td <?php echo $t_biointruktur->pekerjaan->cellAttributes() ?>>
<span id="el_t_biointruktur_pekerjaan">
<span<?php echo $t_biointruktur->pekerjaan->viewAttributes() ?>><?php echo $t_biointruktur->pekerjaan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>