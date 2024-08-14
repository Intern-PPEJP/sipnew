<?php
namespace PHPMaker2020\ppei_20;
?>
<?php if ($t_pelatihan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_pelatihanmaster" class="table ew-view-table ew-master-table ew-vertical d-none">
	<tbody>
<?php if ($t_pelatihan->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_kdjudul" type="text/html"><?php echo $t_pelatihan->kdjudul->caption() ?></script></td>
			<td <?php echo $t_pelatihan->kdjudul->cellAttributes() ?>>
<script id="tpx_t_pelatihan_kdjudul" type="text/html"><span id="el_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan->kdjudul->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->tawal->Visible) { // tawal ?>
		<tr id="r_tawal">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_tawal" type="text/html"><?php echo $t_pelatihan->tawal->caption() ?></script></td>
			<td <?php echo $t_pelatihan->tawal->cellAttributes() ?>>
<script id="tpx_t_pelatihan_tawal" type="text/html"><span id="el_t_pelatihan_tawal">
<span<?php echo $t_pelatihan->tawal->viewAttributes() ?>><?php echo $t_pelatihan->tawal->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->takhir->Visible) { // takhir ?>
		<tr id="r_takhir">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_takhir" type="text/html"><?php echo $t_pelatihan->takhir->caption() ?></script></td>
			<td <?php echo $t_pelatihan->takhir->cellAttributes() ?>>
<script id="tpx_t_pelatihan_takhir" type="text/html"><span id="el_t_pelatihan_takhir">
<span<?php echo $t_pelatihan->takhir->viewAttributes() ?>><?php echo $t_pelatihan->takhir->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->tglpel->Visible) { // tglpel ?>
		<tr id="r_tglpel">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_tglpel" type="text/html"><?php echo $t_pelatihan->tglpel->caption() ?></script></td>
			<td <?php echo $t_pelatihan->tglpel->cellAttributes() ?>>
<script id="tpx_t_pelatihan_tglpel" type="text/html"><span id="el_t_pelatihan_tglpel">
<span<?php echo $t_pelatihan->tglpel->viewAttributes() ?>><?php echo $t_pelatihan->tglpel->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->jenispel->Visible) { // jenispel ?>
		<tr id="r_jenispel">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_jenispel" type="text/html"><?php echo $t_pelatihan->jenispel->caption() ?></script></td>
			<td <?php echo $t_pelatihan->jenispel->cellAttributes() ?>>
<script id="tpx_t_pelatihan_jenispel" type="text/html"><span id="el_t_pelatihan_jenispel">
<span<?php echo $t_pelatihan->jenispel->viewAttributes() ?>><?php echo $t_pelatihan->jenispel->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->kerjasama->Visible) { // kerjasama ?>
		<tr id="r_kerjasama">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_kerjasama" type="text/html"><?php echo $t_pelatihan->kerjasama->caption() ?></script></td>
			<td <?php echo $t_pelatihan->kerjasama->cellAttributes() ?>>
<script id="tpx_t_pelatihan_kerjasama" type="text/html"><span id="el_t_pelatihan_kerjasama">
<span<?php echo $t_pelatihan->kerjasama->viewAttributes() ?>><?php echo $t_pelatihan->kerjasama->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->biaya->Visible) { // biaya ?>
		<tr id="r_biaya">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_biaya" type="text/html"><?php echo $t_pelatihan->biaya->caption() ?></script></td>
			<td <?php echo $t_pelatihan->biaya->cellAttributes() ?>>
<script id="tpx_t_pelatihan_biaya" type="text/html"><span id="el_t_pelatihan_biaya">
<span<?php echo $t_pelatihan->biaya->viewAttributes() ?>><?php echo $t_pelatihan->biaya->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->coachingprogr->Visible) { // coachingprogr ?>
		<tr id="r_coachingprogr">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_coachingprogr" type="text/html"><?php echo $t_pelatihan->coachingprogr->caption() ?></script></td>
			<td <?php echo $t_pelatihan->coachingprogr->cellAttributes() ?>>
<script id="tpx_t_pelatihan_coachingprogr" type="text/html"><span id="el_t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan->coachingprogr->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->area->Visible) { // area ?>
		<tr id="r_area">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_area" type="text/html"><?php echo $t_pelatihan->area->caption() ?></script></td>
			<td <?php echo $t_pelatihan->area->cellAttributes() ?>>
<script id="tpx_t_pelatihan_area" type="text/html"><span id="el_t_pelatihan_area">
<span<?php echo $t_pelatihan->area->viewAttributes() ?>><?php echo $t_pelatihan->area->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->periode_awal->Visible) { // periode_awal ?>
		<tr id="r_periode_awal">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_periode_awal" type="text/html"><?php echo $t_pelatihan->periode_awal->caption() ?></script></td>
			<td <?php echo $t_pelatihan->periode_awal->cellAttributes() ?>>
<script id="tpx_t_pelatihan_periode_awal" type="text/html"><span id="el_t_pelatihan_periode_awal">
<span<?php echo $t_pelatihan->periode_awal->viewAttributes() ?>><?php echo $t_pelatihan->periode_awal->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->periode_akhir->Visible) { // periode_akhir ?>
		<tr id="r_periode_akhir">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_periode_akhir" type="text/html"><?php echo $t_pelatihan->periode_akhir->caption() ?></script></td>
			<td <?php echo $t_pelatihan->periode_akhir->cellAttributes() ?>>
<script id="tpx_t_pelatihan_periode_akhir" type="text/html"><span id="el_t_pelatihan_periode_akhir">
<span<?php echo $t_pelatihan->periode_akhir->viewAttributes() ?>><?php echo $t_pelatihan->periode_akhir->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->tahapan->Visible) { // tahapan ?>
		<tr id="r_tahapan">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_tahapan" type="text/html"><?php echo $t_pelatihan->tahapan->caption() ?></script></td>
			<td <?php echo $t_pelatihan->tahapan->cellAttributes() ?>>
<script id="tpx_t_pelatihan_tahapan" type="text/html"><span id="el_t_pelatihan_tahapan">
<span<?php echo $t_pelatihan->tahapan->viewAttributes() ?>><?php echo $t_pelatihan->tahapan->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->namaberkas->Visible) { // namaberkas ?>
		<tr id="r_namaberkas">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_namaberkas" type="text/html"><?php echo $t_pelatihan->namaberkas->caption() ?></script></td>
			<td <?php echo $t_pelatihan->namaberkas->cellAttributes() ?>>
<script id="tpx_t_pelatihan_namaberkas" type="text/html"><span id="el_t_pelatihan_namaberkas">
<span<?php echo $t_pelatihan->namaberkas->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan->namaberkas, $t_pelatihan->namaberkas->getViewValue(), FALSE) ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->instruktur->Visible) { // instruktur ?>
		<tr id="r_instruktur">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_instruktur" type="text/html"><?php echo $t_pelatihan->instruktur->caption() ?></script></td>
			<td <?php echo $t_pelatihan->instruktur->cellAttributes() ?>>
<script id="tpx_t_pelatihan_instruktur" type="text/html"><span id="el_t_pelatihan_instruktur">
<span<?php echo $t_pelatihan->instruktur->viewAttributes() ?>><?php echo $t_pelatihan->instruktur->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->tempat->Visible) { // tempat ?>
		<tr id="r_tempat">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_tempat" type="text/html"><?php echo $t_pelatihan->tempat->caption() ?></script></td>
			<td <?php echo $t_pelatihan->tempat->cellAttributes() ?>>
<script id="tpx_t_pelatihan_tempat" type="text/html"><span id="el_t_pelatihan_tempat">
<span<?php echo $t_pelatihan->tempat->viewAttributes() ?>><?php echo $t_pelatihan->tempat->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->jpeserta->Visible) { // jpeserta ?>
		<tr id="r_jpeserta">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_jpeserta" type="text/html"><?php echo $t_pelatihan->jpeserta->caption() ?></script></td>
			<td <?php echo $t_pelatihan->jpeserta->cellAttributes() ?>>
<script id="tpx_t_pelatihan_jpeserta" type="text/html"><span id="el_t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan->jpeserta->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->targetpes->Visible) { // targetpes ?>
		<tr id="r_targetpes">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_targetpes" type="text/html"><?php echo $t_pelatihan->targetpes->caption() ?></script></td>
			<td <?php echo $t_pelatihan->targetpes->cellAttributes() ?>>
<script id="tpx_t_pelatihan_targetpes" type="text/html"><span id="el_t_pelatihan_targetpes">
<span<?php echo $t_pelatihan->targetpes->viewAttributes() ?>><?php echo $t_pelatihan->targetpes->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->Tahun->Visible) { // Tahun ?>
		<tr id="r_Tahun">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><script id="tpc_t_pelatihan_Tahun" type="text/html"><?php echo $t_pelatihan->Tahun->caption() ?></script></td>
			<td <?php echo $t_pelatihan->Tahun->cellAttributes() ?>>
<script id="tpx_t_pelatihan_Tahun" type="text/html"><span id="el_t_pelatihan_Tahun">
<span<?php echo $t_pelatihan->Tahun->viewAttributes() ?>><?php echo $t_pelatihan->Tahun->getViewValue() ?></span>
</span></script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_t_pelatihanmaster" class="ew-custom-template"></div>
<script id="tpm_t_pelatihanmaster" type="text/html">
<div id="ct_t_pelatihan_master"><div class="ew-master-div">
<table id="tbl_t_pelatihanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_pelatihan->kdjudul->Visible) { // kdjudul ?>
		<tr id="r_kdjudul">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->kdjudul->caption() ?></td>
			<td <?php echo $t_pelatihan->kdjudul->cellAttributes() ?>>
<span id="el_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan->kdjudul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->tawal->Visible) { // tawal ?>
		<tr id="r_tawal">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->tawal->caption() ?></td>
			<td <?php echo $t_pelatihan->tawal->cellAttributes() ?>>
<span id="el_t_pelatihan_tawal">
<span<?php echo $t_pelatihan->tawal->viewAttributes() ?>><?php echo $t_pelatihan->tawal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->takhir->Visible) { // takhir ?>
		<tr id="r_takhir">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->takhir->caption() ?></td>
			<td <?php echo $t_pelatihan->takhir->cellAttributes() ?>>
<span id="el_t_pelatihan_takhir">
<span<?php echo $t_pelatihan->takhir->viewAttributes() ?>><?php echo $t_pelatihan->takhir->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->ketua->Visible) { // ketua ?>
		<tr id="r_ketua">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->ketua->caption() ?></td>
			<td <?php echo $t_pelatihan->ketua->cellAttributes() ?>>
<span id="el_t_pelatihan_ketua">
<span<?php echo $t_pelatihan->ketua->viewAttributes() ?>><?php echo $t_pelatihan->ketua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->jenispel->Visible) { // jenispel ?>
		<tr id="r_jenispel">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->jenispel->caption() ?></td>
			<td <?php echo $t_pelatihan->jenispel->cellAttributes() ?>>
<span id="el_t_pelatihan_jenispel">
<span<?php echo $t_pelatihan->jenispel->viewAttributes() ?>><?php echo $t_pelatihan->jenispel->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->biaya->Visible) { // biaya ?>
		<tr id="r_biaya">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->biaya->caption() ?></td>
			<td <?php echo $t_pelatihan->biaya->cellAttributes() ?>>
<span id="el_t_pelatihan_biaya">
<span<?php echo $t_pelatihan->biaya->viewAttributes() ?>><?php echo $t_pelatihan->biaya->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->coachingprogr->Visible) { // coachingprogr ?>
		<tr id="r_coachingprogr">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->coachingprogr->caption() ?></td>
			<td <?php echo $t_pelatihan->coachingprogr->cellAttributes() ?>>
<span id="el_t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan->coachingprogr->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_pelatihan->jpeserta->Visible) { // jpeserta ?>
		<tr id="r_jpeserta">
			<td class="<?php echo $t_pelatihan->TableLeftColumnClass ?>"><?php echo $t_pelatihan->jpeserta->caption() ?></td>
			<td <?php echo $t_pelatihan->jpeserta->cellAttributes() ?>>
<span id="el_t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan->jpeserta->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</div>
</script>

<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($t_pelatihan->Rows) ?> };
	ew.applyTemplate("tpd_t_pelatihanmaster", "tpm_t_pelatihanmaster", "t_pelatihanmaster", "<?php echo $t_pelatihan->CustomExport ?>", ew.templateData.rows[0]);
	$("script.t_pelatihanmaster_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php } ?>