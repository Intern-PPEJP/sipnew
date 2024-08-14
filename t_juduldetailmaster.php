<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_juduldetail->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_juduldetailmaster" class="table ew-view-table ew-master-table ew-vertical d-none">
	<tbody>
<?php if ($t_juduldetail->singbagian->Visible) { // singbagian ?>
		<tr id="r_singbagian">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_singbagian" type="text/html"><?php echo $t_juduldetail->singbagian->caption() ?></script></td>
			<td <?php echo $t_juduldetail->singbagian->cellAttributes() ?>>
<script id="tpx_t_juduldetail_singbagian" type="text/html"><span id="el_t_juduldetail_singbagian">
<span<?php echo $t_juduldetail->singbagian->viewAttributes() ?>><?php echo $t_juduldetail->singbagian->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->jpel->Visible) { // jpel ?>
		<tr id="r_jpel">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_jpel" type="text/html"><?php echo $t_juduldetail->jpel->caption() ?></script></td>
			<td <?php echo $t_juduldetail->jpel->cellAttributes() ?>>
<script id="tpx_t_juduldetail_jpel" type="text/html"><span id="el_t_juduldetail_jpel">
<span<?php echo $t_juduldetail->jpel->viewAttributes() ?>><?php echo $t_juduldetail->jpel->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_kdjudul" type="text/html"><?php echo $t_juduldetail->kdjudul->caption() ?></script></td>
			<td <?php echo $t_juduldetail->kdjudul->cellAttributes() ?>>
<script id="tpx_t_juduldetail_kdjudul" type="text/html"><span id="el_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail->kdjudul->viewAttributes() ?>><?php echo $t_juduldetail->kdjudul->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->kdkursil->Visible) { // kdkursil ?>
		<tr id="r_kdkursil">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_kdkursil" type="text/html"><?php echo $t_juduldetail->kdkursil->caption() ?></script></td>
			<td <?php echo $t_juduldetail->kdkursil->cellAttributes() ?>>
<script id="tpx_t_juduldetail_kdkursil" type="text/html"><span id="el_t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail->kdkursil->viewAttributes() ?>><?php echo $t_juduldetail->kdkursil->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->revisi->Visible) { // revisi ?>
		<tr id="r_revisi">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_revisi" type="text/html"><?php echo $t_juduldetail->revisi->caption() ?></script></td>
			<td <?php echo $t_juduldetail->revisi->cellAttributes() ?>>
<script id="tpx_t_juduldetail_revisi" type="text/html"><span id="el_t_juduldetail_revisi">
<span<?php echo $t_juduldetail->revisi->viewAttributes() ?>><?php echo $t_juduldetail->revisi->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->tgl_terbit->Visible) { // tgl_terbit ?>
		<tr id="r_tgl_terbit">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_tgl_terbit" type="text/html"><?php echo $t_juduldetail->tgl_terbit->caption() ?></script></td>
			<td <?php echo $t_juduldetail->tgl_terbit->cellAttributes() ?>>
<script id="tpx_t_juduldetail_tgl_terbit" type="text/html"><span id="el_t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail->tgl_terbit->viewAttributes() ?>><?php echo $t_juduldetail->tgl_terbit->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<tr id="r_deskripsi_singkat">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_deskripsi_singkat" type="text/html"><?php echo $t_juduldetail->deskripsi_singkat->caption() ?></script></td>
			<td <?php echo $t_juduldetail->deskripsi_singkat->cellAttributes() ?>>
<script id="tpx_t_juduldetail_deskripsi_singkat" type="text/html"><span id="el_t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail->deskripsi_singkat->TooltipValue) && $t_juduldetail->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail->deskripsi_singkat->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail->deskripsi_singkat->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail->deskripsi_singkat->TooltipValue ?>
</span></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->tujuan->Visible) { // tujuan ?>
		<tr id="r_tujuan">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_tujuan" type="text/html"><?php echo $t_juduldetail->tujuan->caption() ?></script></td>
			<td <?php echo $t_juduldetail->tujuan->cellAttributes() ?>>
<script id="tpx_t_juduldetail_tujuan" type="text/html"><span id="el_t_juduldetail_tujuan">
<span<?php echo $t_juduldetail->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail->tujuan->TooltipValue) && $t_juduldetail->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail->tujuan->linkAttributes() ?>><?php echo $t_juduldetail->tujuan->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail->tujuan->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_tujuan" class="d-none">
<?php echo $t_juduldetail->tujuan->TooltipValue ?>
</span></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->target_peserta->Visible) { // target_peserta ?>
		<tr id="r_target_peserta">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_target_peserta" type="text/html"><?php echo $t_juduldetail->target_peserta->caption() ?></script></td>
			<td <?php echo $t_juduldetail->target_peserta->cellAttributes() ?>>
<script id="tpx_t_juduldetail_target_peserta" type="text/html"><span id="el_t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail->target_peserta->TooltipValue) && $t_juduldetail->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail->target_peserta->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail->target_peserta->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_target_peserta" class="d-none">
<?php echo $t_juduldetail->target_peserta->TooltipValue ?>
</span></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<tr id="r_lama_pelatihan">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_lama_pelatihan" type="text/html"><?php echo $t_juduldetail->lama_pelatihan->caption() ?></script></td>
			<td <?php echo $t_juduldetail->lama_pelatihan->cellAttributes() ?>>
<script id="tpx_t_juduldetail_lama_pelatihan" type="text/html"><span id="el_t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail->lama_pelatihan->viewAttributes() ?>><?php echo $t_juduldetail->lama_pelatihan->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_juduldetail->catatan->Visible) { // catatan ?>
		<tr id="r_catatan">
			<td class="<?php echo $t_juduldetail->TableLeftColumnClass ?>"><script id="tpc_t_juduldetail_catatan" type="text/html"><?php echo $t_juduldetail->catatan->caption() ?></script></td>
			<td <?php echo $t_juduldetail->catatan->cellAttributes() ?>>
<script id="tpx_t_juduldetail_catatan" type="text/html"><span id="el_t_juduldetail_catatan">
<span<?php echo $t_juduldetail->catatan->viewAttributes() ?>><?php echo $t_juduldetail->catatan->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_t_juduldetailmaster" class="ew-custom-template"></div>
<script id="tpm_t_juduldetailmaster" type="text/html">
<div id="ct_t_juduldetail_master"><table class="table table-bordered table-striped ewViewTable">
	<tbody>
		<tr id="r_singbagian">
			<td>Bidang</td>
			<td>
<span id="el_t_juduldetail_singbagian">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_singbagian")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_jpel">
			<td>Jenis Pelatihan</td>
			<td>
<span id="el_t_juduldetail_jpel">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_jpel")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_kdjudul">
			<td>Judul</td>
			<td>
<span id="el_t_juduldetail_kdjudul">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_kdjudul")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_kdkursil">
			<td>Kode Kursil</td>
			<td>
<span id="el_t_juduldetail_kdkursil">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_kdkursil")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_revisi">
			<td>Revisi</td>
			<td>
<span id="el_t_juduldetail_revisi">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_revisi")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_tgl_terbit">
			<td>Tanggal Terbit</td>
			<td>
<span id="el_t_juduldetail_tgl_terbit">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_tgl_terbit")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_deskripsi_singkat">
			<td>Deskripsi Singkat</td>
			<td>
<span id="el_t_juduldetail_deskripsi_singkat">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_deskripsi_singkat")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_tujuan">
			<td>Tujuan Pelatihan</td>
			<td>
<span id="el_t_juduldetail_tujuan">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_tujuan")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_target_peserta">
			<td>Target Peserta</td>
			<td>
<span id="el_t_juduldetail_target_peserta">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_target_peserta")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_lama_pelatihan">
			<td>Lama Pelatihan</td>
			<td>
<span id="el_t_juduldetail_lama_pelatihan">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_lama_pelatihan")/}}</span>
</span>
</td>
		</tr>
		<tr id="r_catatan">
			<td>Catatan</td>
			<td>
<span id="el_t_juduldetail_catatan">
<span>
{{include tmpl=~getTemplate("#tpx_t_juduldetail_catatan")/}}</span>
</span>
</td>
		</tr>
	</tbody>
</table>
</div>
</script>

<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($t_juduldetail->Rows) ?> };
	ew.applyTemplate("tpd_t_juduldetailmaster", "tpm_t_juduldetailmaster", "t_juduldetailmaster", "<?php echo $t_juduldetail->CustomExport ?>", ew.templateData.rows[0]);
	$("script.t_juduldetailmaster_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php } ?>