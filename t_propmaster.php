<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_prop->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_propmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_prop->kdprop->Visible) { // kdprop ?>
		<tr id="r_kdprop">
			<td class="<?php echo $t_prop->TableLeftColumnClass ?>"><?php echo $t_prop->kdprop->caption() ?></td>
			<td <?php echo $t_prop->kdprop->cellAttributes() ?>>
<span id="el_t_prop_kdprop">
<span<?php echo $t_prop->kdprop->viewAttributes() ?>><?php echo $t_prop->kdprop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_prop->prop->Visible) { // prop ?>
		<tr id="r_prop">
			<td class="<?php echo $t_prop->TableLeftColumnClass ?>"><?php echo $t_prop->prop->caption() ?></td>
			<td <?php echo $t_prop->prop->cellAttributes() ?>>
<span id="el_t_prop_prop">
<span<?php echo $t_prop->prop->viewAttributes() ?>><?php echo $t_prop->prop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_prop->jpelatihan->Visible) { // jpelatihan ?>
		<tr id="r_jpelatihan">
			<td class="<?php echo $t_prop->TableLeftColumnClass ?>"><?php echo $t_prop->jpelatihan->caption() ?></td>
			<td <?php echo $t_prop->jpelatihan->cellAttributes() ?>>
<span id="el_t_prop_jpelatihan">
<span<?php echo $t_prop->jpelatihan->viewAttributes() ?>><?php echo $t_prop->jpelatihan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_prop->jpeserta->Visible) { // jpeserta ?>
		<tr id="r_jpeserta">
			<td class="<?php echo $t_prop->TableLeftColumnClass ?>"><?php echo $t_prop->jpeserta->caption() ?></td>
			<td <?php echo $t_prop->jpeserta->cellAttributes() ?>>
<span id="el_t_prop_jpeserta">
<span<?php echo $t_prop->jpeserta->viewAttributes() ?>><?php echo $t_prop->jpeserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>