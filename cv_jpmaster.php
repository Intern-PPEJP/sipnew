<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($cv_jp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_cv_jpmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($cv_jp->idpelat->Visible) { // idpelat ?>
		<tr id="r_idpelat">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->idpelat->caption() ?></td>
			<td <?php echo $cv_jp->idpelat->cellAttributes() ?>>
<span id="el_cv_jp_idpelat">
<span<?php echo $cv_jp->idpelat->viewAttributes() ?>><?php echo $cv_jp->idpelat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->kurikulumid->Visible) { // kurikulumid ?>
		<tr id="r_kurikulumid">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->kurikulumid->caption() ?></td>
			<td <?php echo $cv_jp->kurikulumid->cellAttributes() ?>>
<span id="el_cv_jp_kurikulumid">
<span<?php echo $cv_jp->kurikulumid->viewAttributes() ?>><?php echo $cv_jp->kurikulumid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->tahun->caption() ?></td>
			<td <?php echo $cv_jp->tahun->cellAttributes() ?>>
<span id="el_cv_jp_tahun">
<span<?php echo $cv_jp->tahun->viewAttributes() ?>><?php echo $cv_jp->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->kdjudul->caption() ?></td>
			<td <?php echo $cv_jp->kdjudul->cellAttributes() ?>>
<span id="el_cv_jp_kdjudul">
<span<?php echo $cv_jp->kdjudul->viewAttributes() ?>><?php echo $cv_jp->kdjudul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->tgl->Visible) { // tgl ?>
		<tr id="r_tgl">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->tgl->caption() ?></td>
			<td <?php echo $cv_jp->tgl->cellAttributes() ?>>
<span id="el_cv_jp_tgl">
<span<?php echo $cv_jp->tgl->viewAttributes() ?>><?php echo $cv_jp->tgl->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->bioid->Visible) { // bioid ?>
		<tr id="r_bioid">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->bioid->caption() ?></td>
			<td <?php echo $cv_jp->bioid->cellAttributes() ?>>
<span id="el_cv_jp_bioid">
<span<?php echo $cv_jp->bioid->viewAttributes() ?>><?php echo $cv_jp->bioid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->nilai->Visible) { // nilai ?>
		<tr id="r_nilai">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->nilai->caption() ?></td>
			<td <?php echo $cv_jp->nilai->cellAttributes() ?>>
<span id="el_cv_jp_nilai">
<span<?php echo $cv_jp->nilai->viewAttributes() ?>><?php echo $cv_jp->nilai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cv_jp->komentar->Visible) { // komentar ?>
		<tr id="r_komentar">
			<td class="<?php echo $cv_jp->TableLeftColumnClass ?>"><?php echo $cv_jp->komentar->caption() ?></td>
			<td <?php echo $cv_jp->komentar->cellAttributes() ?>>
<span id="el_cv_jp_komentar">
<span<?php echo $cv_jp->komentar->viewAttributes() ?>><?php echo $cv_jp->komentar->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>