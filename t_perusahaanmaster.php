<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_perusahaan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_perusahaanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_perusahaan->namap->Visible) { // namap ?>
		<tr id="r_namap">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->namap->caption() ?></td>
			<td <?php echo $t_perusahaan->namap->cellAttributes() ?>>
<span id="el_t_perusahaan_namap">
<span<?php echo $t_perusahaan->namap->viewAttributes() ?>><?php echo $t_perusahaan->namap->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->idp->Visible) { // idp ?>
		<tr id="r_idp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->idp->caption() ?></td>
			<td <?php echo $t_perusahaan->idp->cellAttributes() ?>>
<span id="el_t_perusahaan_idp">
<span<?php echo $t_perusahaan->idp->viewAttributes() ?>><?php echo $t_perusahaan->idp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kontak->Visible) { // kontak ?>
		<tr id="r_kontak">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kontak->caption() ?></td>
			<td <?php echo $t_perusahaan->kontak->cellAttributes() ?>>
<span id="el_t_perusahaan_kontak">
<span<?php echo $t_perusahaan->kontak->viewAttributes() ?>><?php echo $t_perusahaan->kontak->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdlokasi->Visible) { // kdlokasi ?>
		<tr id="r_kdlokasi">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdlokasi->caption() ?></td>
			<td <?php echo $t_perusahaan->kdlokasi->cellAttributes() ?>>
<span id="el_t_perusahaan_kdlokasi">
<span<?php echo $t_perusahaan->kdlokasi->viewAttributes() ?>><?php echo $t_perusahaan->kdlokasi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdprop->Visible) { // kdprop ?>
		<tr id="r_kdprop">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdprop->caption() ?></td>
			<td <?php echo $t_perusahaan->kdprop->cellAttributes() ?>>
<span id="el_t_perusahaan_kdprop">
<span<?php echo $t_perusahaan->kdprop->viewAttributes() ?>><?php echo $t_perusahaan->kdprop->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdkota->Visible) { // kdkota ?>
		<tr id="r_kdkota">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdkota->caption() ?></td>
			<td <?php echo $t_perusahaan->kdkota->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkota">
<span<?php echo $t_perusahaan->kdkota->viewAttributes() ?>><?php echo $t_perusahaan->kdkota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdkec->Visible) { // kdkec ?>
		<tr id="r_kdkec">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdkec->caption() ?></td>
			<td <?php echo $t_perusahaan->kdkec->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkec">
<span<?php echo $t_perusahaan->kdkec->viewAttributes() ?>><?php echo $t_perusahaan->kdkec->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->alamatp->Visible) { // alamatp ?>
		<tr id="r_alamatp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->alamatp->caption() ?></td>
			<td <?php echo $t_perusahaan->alamatp->cellAttributes() ?>>
<span id="el_t_perusahaan_alamatp">
<span<?php echo $t_perusahaan->alamatp->viewAttributes() ?>><?php echo $t_perusahaan->alamatp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->telpp->Visible) { // telpp ?>
		<tr id="r_telpp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->telpp->caption() ?></td>
			<td <?php echo $t_perusahaan->telpp->cellAttributes() ?>>
<span id="el_t_perusahaan_telpp">
<span<?php echo $t_perusahaan->telpp->viewAttributes() ?>><?php echo $t_perusahaan->telpp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->faxp->Visible) { // faxp ?>
		<tr id="r_faxp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->faxp->caption() ?></td>
			<td <?php echo $t_perusahaan->faxp->cellAttributes() ?>>
<span id="el_t_perusahaan_faxp">
<span<?php echo $t_perusahaan->faxp->viewAttributes() ?>><?php echo $t_perusahaan->faxp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->emailp->Visible) { // emailp ?>
		<tr id="r_emailp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->emailp->caption() ?></td>
			<td <?php echo $t_perusahaan->emailp->cellAttributes() ?>>
<span id="el_t_perusahaan_emailp">
<span<?php echo $t_perusahaan->emailp->viewAttributes() ?>><?php echo $t_perusahaan->emailp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->webp->Visible) { // webp ?>
		<tr id="r_webp">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->webp->caption() ?></td>
			<td <?php echo $t_perusahaan->webp->cellAttributes() ?>>
<span id="el_t_perusahaan_webp">
<span<?php echo $t_perusahaan->webp->viewAttributes() ?>><?php echo $t_perusahaan->webp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->medsos->Visible) { // medsos ?>
		<tr id="r_medsos">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->medsos->caption() ?></td>
			<td <?php echo $t_perusahaan->medsos->cellAttributes() ?>>
<span id="el_t_perusahaan_medsos">
<span<?php echo $t_perusahaan->medsos->viewAttributes() ?>><?php echo $t_perusahaan->medsos->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdjenis->Visible) { // kdjenis ?>
		<tr id="r_kdjenis">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdjenis->caption() ?></td>
			<td <?php echo $t_perusahaan->kdjenis->cellAttributes() ?>>
<span id="el_t_perusahaan_kdjenis">
<span<?php echo $t_perusahaan->kdjenis->viewAttributes() ?>><?php echo $t_perusahaan->kdjenis->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdproduknafed->Visible) { // kdproduknafed ?>
		<tr id="r_kdproduknafed">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdproduknafed->caption() ?></td>
			<td <?php echo $t_perusahaan->kdproduknafed->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed">
<span<?php echo $t_perusahaan->kdproduknafed->viewAttributes() ?>><?php echo $t_perusahaan->kdproduknafed->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdproduknafed2->Visible) { // kdproduknafed2 ?>
		<tr id="r_kdproduknafed2">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdproduknafed2->caption() ?></td>
			<td <?php echo $t_perusahaan->kdproduknafed2->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed2">
<span<?php echo $t_perusahaan->kdproduknafed2->viewAttributes() ?>><?php echo $t_perusahaan->kdproduknafed2->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdproduknafed3->Visible) { // kdproduknafed3 ?>
		<tr id="r_kdproduknafed3">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdproduknafed3->caption() ?></td>
			<td <?php echo $t_perusahaan->kdproduknafed3->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed3">
<span<?php echo $t_perusahaan->kdproduknafed3->viewAttributes() ?>><?php echo $t_perusahaan->kdproduknafed3->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->pproduk->Visible) { // pproduk ?>
		<tr id="r_pproduk">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->pproduk->caption() ?></td>
			<td <?php echo $t_perusahaan->pproduk->cellAttributes() ?>>
<span id="el_t_perusahaan_pproduk">
<span<?php echo $t_perusahaan->pproduk->viewAttributes() ?>><?php echo $t_perusahaan->pproduk->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdexport->Visible) { // kdexport ?>
		<tr id="r_kdexport">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdexport->caption() ?></td>
			<td <?php echo $t_perusahaan->kdexport->cellAttributes() ?>>
<span id="el_t_perusahaan_kdexport">
<span<?php echo $t_perusahaan->kdexport->viewAttributes() ?>><?php echo $t_perusahaan->kdexport->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->nexport->Visible) { // nexport ?>
		<tr id="r_nexport">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->nexport->caption() ?></td>
			<td <?php echo $t_perusahaan->nexport->cellAttributes() ?>>
<span id="el_t_perusahaan_nexport">
<span<?php echo $t_perusahaan->nexport->viewAttributes() ?>><?php echo $t_perusahaan->nexport->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdskala->Visible) { // kdskala ?>
		<tr id="r_kdskala">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdskala->caption() ?></td>
			<td <?php echo $t_perusahaan->kdskala->cellAttributes() ?>>
<span id="el_t_perusahaan_kdskala">
<span<?php echo $t_perusahaan->kdskala->viewAttributes() ?>><?php echo $t_perusahaan->kdskala->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->kdkategori->Visible) { // kdkategori ?>
		<tr id="r_kdkategori">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->kdkategori->caption() ?></td>
			<td <?php echo $t_perusahaan->kdkategori->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkategori">
<span<?php echo $t_perusahaan->kdkategori->viewAttributes() ?>><?php echo $t_perusahaan->kdkategori->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_perusahaan->jpeserta->Visible) { // jpeserta ?>
		<tr id="r_jpeserta">
			<td class="<?php echo $t_perusahaan->TableLeftColumnClass ?>"><?php echo $t_perusahaan->jpeserta->caption() ?></td>
			<td <?php echo $t_perusahaan->jpeserta->cellAttributes() ?>>
<span id="el_t_perusahaan_jpeserta">
<span<?php echo $t_perusahaan->jpeserta->viewAttributes() ?>><?php echo $t_perusahaan->jpeserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>