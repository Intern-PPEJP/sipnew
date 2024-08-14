<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_pcp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_pcpmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_pcp->nama_peserta->Visible) { // nama_peserta ?>
		<tr id="r_nama_peserta">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->nama_peserta->caption() ?></td>
			<td <?php echo $t_pcp->nama_peserta->cellAttributes() ?>>
<span id="el_t_pcp_nama_peserta">
<span<?php echo $t_pcp->nama_peserta->viewAttributes() ?>><?php echo $t_pcp->nama_peserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->email_add->Visible) { // email_add ?>
		<tr id="r_email_add">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->email_add->caption() ?></td>
			<td <?php echo $t_pcp->email_add->cellAttributes() ?>>
<span id="el_t_pcp_email_add">
<span<?php echo $t_pcp->email_add->viewAttributes() ?>><?php echo $t_pcp->email_add->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->handphone->Visible) { // handphone ?>
		<tr id="r_handphone">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->handphone->caption() ?></td>
			<td <?php echo $t_pcp->handphone->cellAttributes() ?>>
<span id="el_t_pcp_handphone">
<span<?php echo $t_pcp->handphone->viewAttributes() ?>><?php echo $t_pcp->handphone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->namap->Visible) { // namap ?>
		<tr id="r_namap">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->namap->caption() ?></td>
			<td <?php echo $t_pcp->namap->cellAttributes() ?>>
<span id="el_t_pcp_namap">
<span<?php echo $t_pcp->namap->viewAttributes() ?>><?php echo $t_pcp->namap->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->kategori_produk->Visible) { // kategori_produk ?>
		<tr id="r_kategori_produk">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->kategori_produk->caption() ?></td>
			<td <?php echo $t_pcp->kategori_produk->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk">
<span<?php echo $t_pcp->kategori_produk->viewAttributes() ?>><?php echo $t_pcp->kategori_produk->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->kategori_produk2->Visible) { // kategori_produk2 ?>
		<tr id="r_kategori_produk2">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->kategori_produk2->caption() ?></td>
			<td <?php echo $t_pcp->kategori_produk2->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk2">
<span<?php echo $t_pcp->kategori_produk2->viewAttributes() ?>><?php echo $t_pcp->kategori_produk2->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->kategori_produk3->Visible) { // kategori_produk3 ?>
		<tr id="r_kategori_produk3">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->kategori_produk3->caption() ?></td>
			<td <?php echo $t_pcp->kategori_produk3->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk3">
<span<?php echo $t_pcp->kategori_produk3->viewAttributes() ?>><?php echo $t_pcp->kategori_produk3->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->produk->Visible) { // produk ?>
		<tr id="r_produk">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->produk->caption() ?></td>
			<td <?php echo $t_pcp->produk->cellAttributes() ?>>
<span id="el_t_pcp_produk">
<span<?php echo $t_pcp->produk->viewAttributes() ?>><?php echo $t_pcp->produk->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->merek_dagang->Visible) { // merek_dagang ?>
		<tr id="r_merek_dagang">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->merek_dagang->caption() ?></td>
			<td <?php echo $t_pcp->merek_dagang->cellAttributes() ?>>
<span id="el_t_pcp_merek_dagang">
<span<?php echo $t_pcp->merek_dagang->viewAttributes() ?>><?php echo $t_pcp->merek_dagang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<tr id="r_jenis_perusahaan">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->jenis_perusahaan->caption() ?></td>
			<td <?php echo $t_pcp->jenis_perusahaan->cellAttributes() ?>>
<span id="el_t_pcp_jenis_perusahaan">
<span<?php echo $t_pcp->jenis_perusahaan->viewAttributes() ?>><?php echo $t_pcp->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<tr id="r_kapasitas_produksi">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->kapasitas_produksi->caption() ?></td>
			<td <?php echo $t_pcp->kapasitas_produksi->cellAttributes() ?>>
<span id="el_t_pcp_kapasitas_produksi">
<span<?php echo $t_pcp->kapasitas_produksi->viewAttributes() ?>><?php echo $t_pcp->kapasitas_produksi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->omset->Visible) { // omset ?>
		<tr id="r_omset">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->omset->caption() ?></td>
			<td <?php echo $t_pcp->omset->cellAttributes() ?>>
<span id="el_t_pcp_omset">
<span<?php echo $t_pcp->omset->viewAttributes() ?>><?php echo $t_pcp->omset->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->website->Visible) { // website ?>
		<tr id="r_website">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->website->caption() ?></td>
			<td <?php echo $t_pcp->website->cellAttributes() ?>>
<span id="el_t_pcp_website">
<span<?php echo $t_pcp->website->viewAttributes() ?>><?php echo $t_pcp->website->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->jml_pegawai->Visible) { // jml_pegawai ?>
		<tr id="r_jml_pegawai">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->jml_pegawai->caption() ?></td>
			<td <?php echo $t_pcp->jml_pegawai->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai">
<span<?php echo $t_pcp->jml_pegawai->viewAttributes() ?>><?php echo $t_pcp->jml_pegawai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<tr id="r_jml_pegawai2">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->jml_pegawai2->caption() ?></td>
			<td <?php echo $t_pcp->jml_pegawai2->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai2">
<span<?php echo $t_pcp->jml_pegawai2->viewAttributes() ?>><?php echo $t_pcp->jml_pegawai2->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<tr id="r_jml_pegawai_tidaktetap">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->jml_pegawai_tidaktetap->caption() ?></td>
			<td <?php echo $t_pcp->jml_pegawai_tidaktetap->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai_tidaktetap">
<span<?php echo $t_pcp->jml_pegawai_tidaktetap->viewAttributes() ?>><?php echo $t_pcp->jml_pegawai_tidaktetap->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->legalitas->Visible) { // legalitas ?>
		<tr id="r_legalitas">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->legalitas->caption() ?></td>
			<td <?php echo $t_pcp->legalitas->cellAttributes() ?>>
<span id="el_t_pcp_legalitas">
<span<?php echo $t_pcp->legalitas->viewAttributes() ?>><?php echo $t_pcp->legalitas->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->legalitas_lain->Visible) { // legalitas_lain ?>
		<tr id="r_legalitas_lain">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->legalitas_lain->caption() ?></td>
			<td <?php echo $t_pcp->legalitas_lain->cellAttributes() ?>>
<span id="el_t_pcp_legalitas_lain">
<span<?php echo $t_pcp->legalitas_lain->viewAttributes() ?>><?php echo $t_pcp->legalitas_lain->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->sertifikat->Visible) { // sertifikat ?>
		<tr id="r_sertifikat">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->sertifikat->caption() ?></td>
			<td <?php echo $t_pcp->sertifikat->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat">
<span<?php echo $t_pcp->sertifikat->viewAttributes() ?>><?php echo $t_pcp->sertifikat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<tr id="r_sertifikat_lain">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->sertifikat_lain->caption() ?></td>
			<td <?php echo $t_pcp->sertifikat_lain->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat_lain">
<span<?php echo $t_pcp->sertifikat_lain->viewAttributes() ?>><?php echo $t_pcp->sertifikat_lain->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->alat_promosi->Visible) { // alat_promosi ?>
		<tr id="r_alat_promosi">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->alat_promosi->caption() ?></td>
			<td <?php echo $t_pcp->alat_promosi->cellAttributes() ?>>
<span id="el_t_pcp_alat_promosi">
<span<?php echo $t_pcp->alat_promosi->viewAttributes() ?>><?php echo $t_pcp->alat_promosi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->promosi_lain->Visible) { // promosi_lain ?>
		<tr id="r_promosi_lain">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->promosi_lain->caption() ?></td>
			<td <?php echo $t_pcp->promosi_lain->cellAttributes() ?>>
<span id="el_t_pcp_promosi_lain">
<span<?php echo $t_pcp->promosi_lain->viewAttributes() ?>><?php echo $t_pcp->promosi_lain->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->tahun_ecp->Visible) { // tahun_ecp ?>
		<tr id="r_tahun_ecp">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->tahun_ecp->caption() ?></td>
			<td <?php echo $t_pcp->tahun_ecp->cellAttributes() ?>>
<span id="el_t_pcp_tahun_ecp">
<span<?php echo $t_pcp->tahun_ecp->viewAttributes() ?>><?php echo $t_pcp->tahun_ecp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pcp->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<tr id="r_wilayah_ecp">
			<td class="<?php echo $t_pcp->TableLeftColumnClass ?>"><?php echo $t_pcp->wilayah_ecp->caption() ?></td>
			<td <?php echo $t_pcp->wilayah_ecp->cellAttributes() ?>>
<span id="el_t_pcp_wilayah_ecp">
<span<?php echo $t_pcp->wilayah_ecp->viewAttributes() ?>><?php echo $t_pcp->wilayah_ecp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>