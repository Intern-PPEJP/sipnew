<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_peserta->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_pesertamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_peserta->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->id->caption() ?></td>
			<td <?php echo $t_peserta->id->cellAttributes() ?>>
<span id="el_t_peserta_id">
<span<?php echo $t_peserta->id->viewAttributes() ?>><?php echo $t_peserta->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->nama->caption() ?></td>
			<td <?php echo $t_peserta->nama->cellAttributes() ?>>
<span id="el_t_peserta_nama">
<span<?php echo $t_peserta->nama->viewAttributes() ?>><?php echo $t_peserta->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->idp->Visible) { // idp ?>
		<tr id="r_idp">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->idp->caption() ?></td>
			<td <?php echo $t_peserta->idp->cellAttributes() ?>>
<span id="el_t_peserta_idp">
<span<?php echo $t_peserta->idp->viewAttributes() ?>><?php echo $t_peserta->idp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->tempat->Visible) { // tempat ?>
		<tr id="r_tempat">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->tempat->caption() ?></td>
			<td <?php echo $t_peserta->tempat->cellAttributes() ?>>
<span id="el_t_peserta_tempat">
<span<?php echo $t_peserta->tempat->viewAttributes() ?>><?php echo $t_peserta->tempat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdagama->Visible) { // kdagama ?>
		<tr id="r_kdagama">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdagama->caption() ?></td>
			<td <?php echo $t_peserta->kdagama->cellAttributes() ?>>
<span id="el_t_peserta_kdagama">
<span<?php echo $t_peserta->kdagama->viewAttributes() ?>><?php echo $t_peserta->kdagama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdsex->Visible) { // kdsex ?>
		<tr id="r_kdsex">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdsex->caption() ?></td>
			<td <?php echo $t_peserta->kdsex->cellAttributes() ?>>
<span id="el_t_peserta_kdsex">
<span<?php echo $t_peserta->kdsex->viewAttributes() ?>><?php echo $t_peserta->kdsex->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdprop->Visible) { // kdprop ?>
		<tr id="r_kdprop">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdprop->caption() ?></td>
			<td <?php echo $t_peserta->kdprop->cellAttributes() ?>>
<span id="el_t_peserta_kdprop">
<span<?php echo $t_peserta->kdprop->viewAttributes() ?>><?php echo $t_peserta->kdprop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdkota->Visible) { // kdkota ?>
		<tr id="r_kdkota">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdkota->caption() ?></td>
			<td <?php echo $t_peserta->kdkota->cellAttributes() ?>>
<span id="el_t_peserta_kdkota">
<span<?php echo $t_peserta->kdkota->viewAttributes() ?>><?php echo $t_peserta->kdkota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdkec->Visible) { // kdkec ?>
		<tr id="r_kdkec">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdkec->caption() ?></td>
			<td <?php echo $t_peserta->kdkec->cellAttributes() ?>>
<span id="el_t_peserta_kdkec">
<span<?php echo $t_peserta->kdkec->viewAttributes() ?>><?php echo $t_peserta->kdkec->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->alamat->Visible) { // alamat ?>
		<tr id="r_alamat">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->alamat->caption() ?></td>
			<td <?php echo $t_peserta->alamat->cellAttributes() ?>>
<span id="el_t_peserta_alamat">
<span<?php echo $t_peserta->alamat->viewAttributes() ?>><?php echo $t_peserta->alamat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->telp->Visible) { // telp ?>
		<tr id="r_telp">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->telp->caption() ?></td>
			<td <?php echo $t_peserta->telp->cellAttributes() ?>>
<span id="el_t_peserta_telp">
<span<?php echo $t_peserta->telp->viewAttributes() ?>><?php echo $t_peserta->telp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->hp->Visible) { // hp ?>
		<tr id="r_hp">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->hp->caption() ?></td>
			<td <?php echo $t_peserta->hp->cellAttributes() ?>>
<span id="el_t_peserta_hp">
<span<?php echo $t_peserta->hp->viewAttributes() ?>><?php echo $t_peserta->hp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdjabat->Visible) { // kdjabat ?>
		<tr id="r_kdjabat">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdjabat->caption() ?></td>
			<td <?php echo $t_peserta->kdjabat->cellAttributes() ?>>
<span id="el_t_peserta_kdjabat">
<span<?php echo $t_peserta->kdjabat->viewAttributes() ?>><?php echo $t_peserta->kdjabat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdpend->Visible) { // kdpend ?>
		<tr id="r_kdpend">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdpend->caption() ?></td>
			<td <?php echo $t_peserta->kdpend->cellAttributes() ?>>
<span id="el_t_peserta_kdpend">
<span<?php echo $t_peserta->kdpend->viewAttributes() ?>><?php echo $t_peserta->kdpend->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->kdbahasa->Visible) { // kdbahasa ?>
		<tr id="r_kdbahasa">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->kdbahasa->caption() ?></td>
			<td <?php echo $t_peserta->kdbahasa->cellAttributes() ?>>
<span id="el_t_peserta_kdbahasa">
<span<?php echo $t_peserta->kdbahasa->viewAttributes() ?>><?php echo $t_peserta->kdbahasa->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_peserta->jpelatihan->Visible) { // jpelatihan ?>
		<tr id="r_jpelatihan">
			<td class="<?php echo $t_peserta->TableLeftColumnClass ?>"><?php echo $t_peserta->jpelatihan->caption() ?></td>
			<td <?php echo $t_peserta->jpelatihan->cellAttributes() ?>>
<span id="el_t_peserta_jpelatihan">
<span<?php echo $t_peserta->jpelatihan->viewAttributes() ?>><?php echo $t_peserta->jpelatihan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>