<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_judul->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_judulmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_judul->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $t_judul->TableLeftColumnClass ?>"><?php echo $t_judul->kdjudul->caption() ?></td>
			<td <?php echo $t_judul->kdjudul->cellAttributes() ?>>
<span id="el_t_judul_kdjudul">
<span<?php echo $t_judul->kdjudul->viewAttributes() ?>><?php echo $t_judul->kdjudul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_judul->kdbidang->Visible) { // kdbidang ?>
		<tr id="r_kdbidang">
			<td class="<?php echo $t_judul->TableLeftColumnClass ?>"><?php echo $t_judul->kdbidang->caption() ?></td>
			<td <?php echo $t_judul->kdbidang->cellAttributes() ?>>
<span id="el_t_judul_kdbidang">
<span<?php echo $t_judul->kdbidang->viewAttributes() ?>><?php echo $t_judul->kdbidang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_judul->judul->Visible) { // judul ?>
		<tr id="r_judul">
			<td class="<?php echo $t_judul->TableLeftColumnClass ?>"><?php echo $t_judul->judul->caption() ?></td>
			<td <?php echo $t_judul->judul->cellAttributes() ?>>
<span id="el_t_judul_judul">
<span<?php echo $t_judul->judul->viewAttributes() ?>><?php echo $t_judul->judul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_judul->singkatan->Visible) { // singkatan ?>
		<tr id="r_singkatan">
			<td class="<?php echo $t_judul->TableLeftColumnClass ?>"><?php echo $t_judul->singkatan->caption() ?></td>
			<td <?php echo $t_judul->singkatan->cellAttributes() ?>>
<span id="el_t_judul_singkatan">
<span<?php echo $t_judul->singkatan->viewAttributes() ?>><?php echo $t_judul->singkatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_judul->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $t_judul->TableLeftColumnClass ?>"><?php echo $t_judul->created_at->caption() ?></td>
			<td <?php echo $t_judul->created_at->cellAttributes() ?>>
<span id="el_t_judul_created_at">
<span<?php echo $t_judul->created_at->viewAttributes() ?>><?php echo $t_judul->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>