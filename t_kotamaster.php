<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_kota->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_kotamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_kota->kdkota->Visible) { // kdkota ?>
		<tr id="r_kdkota">
			<td class="<?php echo $t_kota->TableLeftColumnClass ?>"><?php echo $t_kota->kdkota->caption() ?></td>
			<td <?php echo $t_kota->kdkota->cellAttributes() ?>>
<span id="el_t_kota_kdkota">
<span<?php echo $t_kota->kdkota->viewAttributes() ?>><?php echo $t_kota->kdkota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_kota->kdprop->Visible) { // kdprop ?>
		<tr id="r_kdprop">
			<td class="<?php echo $t_kota->TableLeftColumnClass ?>"><?php echo $t_kota->kdprop->caption() ?></td>
			<td <?php echo $t_kota->kdprop->cellAttributes() ?>>
<span id="el_t_kota_kdprop">
<span<?php echo $t_kota->kdprop->viewAttributes() ?>><?php echo $t_kota->kdprop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_kota->kota->Visible) { // kota ?>
		<tr id="r_kota">
			<td class="<?php echo $t_kota->TableLeftColumnClass ?>"><?php echo $t_kota->kota->caption() ?></td>
			<td <?php echo $t_kota->kota->cellAttributes() ?>>
<span id="el_t_kota_kota">
<span<?php echo $t_kota->kota->viewAttributes() ?>><?php echo $t_kota->kota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_kota->jpelatihan->Visible) { // jpelatihan ?>
		<tr id="r_jpelatihan">
			<td class="<?php echo $t_kota->TableLeftColumnClass ?>"><?php echo $t_kota->jpelatihan->caption() ?></td>
			<td <?php echo $t_kota->jpelatihan->cellAttributes() ?>>
<span id="el_t_kota_jpelatihan">
<span<?php echo $t_kota->jpelatihan->viewAttributes() ?>><?php echo $t_kota->jpelatihan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_kota->jpeserta->Visible) { // jpeserta ?>
		<tr id="r_jpeserta">
			<td class="<?php echo $t_kota->TableLeftColumnClass ?>"><?php echo $t_kota->jpeserta->caption() ?></td>
			<td <?php echo $t_kota->jpeserta->cellAttributes() ?>>
<span id="el_t_kota_jpeserta">
<span<?php echo $t_kota->jpeserta->viewAttributes() ?>><?php echo $t_kota->jpeserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>