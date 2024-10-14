<?php

namespace PHPMaker2020\ppei_20; ?>

<?php if (!IsExport()) { ?>
	<?php if (@!$SkipHeaderFooter) { ?>
		<?php if (isset($DebugTimer)) $DebugTimer->stop() ?>
		</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<!-- Main Footer -->
		<footer class="main-footer" style="font-family: 'Poppins', sans-serif; font-size: 15px;">
			<div class="ew-footer-text"><?php echo "SISTEM INFORMASI PPEJP &copy; " . date("Y") . " All Right Reserved.";  ?></div>
			<div class="float-right d-none d-sm-inline-block"></div>
		</footer>
		<?php
		?>
		<script type="text/html" class="ew-js-template" data-name="myDropdown" data-method="prependTo" data-target="#ew-navbar-right" data-seq="10">
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<?php
					$me_user = CurrentUserName();
					if (CurrentUserName() <> "admin") {
						$me_user = ExecuteScalar("SELECT nama FROM t_pegawai WHERE nip = '" . CurrentUserName() . "'");
					}
					?>
					Welcome, <?php echo $me_user; ?>
				</a>
			</li>
		</script>
		<script type="text/html" class="ew-js-template" data-name="myControlSidebar" data-method="insertBefore" data-target="#ew-navbar-right" data-seq="10">
			<span data-widget="pushmenu" href="#" style="color:#11101D; font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 400; line-height: 40px;">
				<?php
				$me_level = "Administrator";
				if (CurrentUserName() <> "admin") {
					$me_level = ExecuteScalar("SELECT b.user_level_name FROM `t_users` a INNER JOIN `t_userlevels` b ON a.userlevel = user_level_id WHERE a.username = '" . CurrentUserName() . "'");
				}
				?>
				<?php echo '<strong>' . $me_level . '-PPEJP</strong>'; ?>
			</span>
		</script>
		<?php
		?>
		</div>
		<!-- ./wrapper -->
	<?php } ?>
	<!-- template upload (for file upload) -->
	<script id="template-upload" type="text/html">
	{{for files}}
	<tr class="template-upload">
		<td>
			<span class="preview"></span>
		</td>
		<td>
			<p class="name">{{:name}}</p>
			<p class="error text-danger"></p>
		</td>
		<td>
			<div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				<div class="progress-bar bg-success" style="width: 0%;"></div>
			</div>
		</td>
		<td>
			{{if !#index && !~root.options.autoUpload}}
			<button class="btn btn-default btn-sm start" disabled><?php echo $Language->phrase("UploadStart") ?></button>
			{{/if}}
			{{if !#index}}
			<button class="btn btn-default btn-sm cancel"><?php echo $Language->phrase("UploadCancel") ?></button>
			{{/if}}
		</td>
	</tr>
	{{/for}}
	</script>
	<!-- template download (for file upload) -->
	<script id="template-download" type="text/html">
	{{for files}}
	<tr class="template-download">
		<td>
			<span class="preview">
				{{if !exists}}
				<span class="text-danger"><?php echo $Language->phrase("FileNotFound") ?></span>
				{{else url && extension == "pdf"}}
					<div class="ew-pdfobject" data-url="{{>url}}" style="width: <?php echo Config("UPLOAD_THUMBNAIL_WIDTH") ?>px;"></div>
					{{else url && extension == "mp3"}}
						<audio controls>
							<source type="audio/mpeg" src="{{>url}}">
						</audio>
						{{else url && extension == "mp4"}}
							<video controls>
								<source type="video/mp4" src="{{>url}}">
							</video>
							{{else thumbnailUrl}}
								<a href="{{>url}}" title="{{>name}}" download="{{>name}}" class="ew-lightbox">
									<img src="{{>thumbnailUrl}}">
								</a>
								{{/if}}
			</span>
		</td>
		<td>
			<p class="name">
				{{if !exists}}
				<span class="text-muted">{{:name}}</span>
				{{else url && thumbnailUrl && extension != "pdf" && extension != "mp3" && extension != "mp4"}}
					<a href="{{>url}}" title="{{>name}}" download="{{>name}}" class="ew-lightbox">{{:name}}</a>
					{{else url}}
						<a href="{{>url}}" title="{{>name}}" download="{{>name}}">{{:name}}</a>
						{{else}}
							<span>{{:name}}</span>
							{{/if}}
			</p>
			{{if error}}
			<div><span class="error text-danger">{{:error}}</span></div>
			{{/if}}
		</td>
		<td>
			<span class="size">{{:~root.formatFileSize(size)}}</span>
		</td>
		<td>
			{{if !~root.options.readOnly && deleteUrl}}
			<button class="btn btn-default btn-sm delete" data-type="{{>deleteType}}" data-url="{{>deleteUrl}}"><?php echo $Language->phrase("UploadDelete") ?></button>
			{{else !~root.options.readOnly}}
				<button class="btn btn-default btn-sm cancel"><?php echo $Language->phrase("UploadCancel") ?></button>
				{{/if}}
		</td>
	</tr>
	{{/for}}
	</script>
	<!-- modal dialog -->
	<div id="ew-modal-dialog" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- modal lookup dialog -->
	<div id="ew-modal-lookup-dialog" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- add option dialog -->
	<div id="ew-add-opt-dialog" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer"><button type="button" class="btn btn-primary ew-btn"><?php echo $Language->phrase("AddBtn") ?></button><button type="button" class="btn btn-default ew-btn" data-dismiss="modal"><?php echo $Language->phrase("CancelBtn") ?></button></div>
			</div>
		</div>
	</div>
	<!-- import dialog -->
	<div id="ew-import-dialog" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="importfiles" title=" " name="importfiles[]" multiple lang="<?php echo CurrentLanguageID() ?>">
						<label class="custom-file-label ew-file-label" for="importfiles"><?php echo $Language->phrase("ChooseFiles") ?></label>
					</div>
					<div class="message d-none mt-3"></div>
					<div class="progress d-none mt-3">
						<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
					</div>
				</div>
				<div class="modal-footer"><button type="button" class="btn btn-default ew-close-btn" data-dismiss="modal"><?php echo $Language->phrase("CloseBtn") ?></button></div>
			</div>
		</div>
	</div>
	<!-- message box -->
	<div id="ew-message-box" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"></div>
				<div class="modal-footer"><button type="button" class="btn btn-primary ew-btn" data-dismiss="modal"><?php echo $Language->phrase("MessageOK") ?></button></div>
			</div>
		</div>
	</div>
	<!-- prompt -->
	<div id="ew-prompt" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"></div>
				<div class="modal-footer"><button type="button" class="btn btn-primary ew-btn"><?php echo $Language->phrase("MessageOK") ?></button><button type="button" class="btn btn-default ew-btn" data-dismiss="modal"><?php echo $Language->phrase("CancelBtn") ?></button></div>
			</div>
		</div>
	</div>
	<!-- session timer -->
	<div id="ew-timer" class="modal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"></div>
				<div class="modal-footer"><button type="button" class="btn btn-primary ew-btn" data-dismiss="modal"><?php echo $Language->phrase("MessageOK") ?></button></div>
			</div>
		</div>
	</div>
	<!-- tooltip -->
	<div id="ew-tooltip"></div>
	<?php if (@!$DrillDownInPanel) { ?>
		<!-- drill down -->
		<div id="ew-drilldown-panel"></div>
	<?php } ?>
<?php } ?>
<?php if (!IsExport() || IsExport("print")) { ?>
	<script>
		// User event handlers
		ew.ready(ew.bundleIds, "<?php echo $RELATIVE_PATH ?>js/userevt.js", "load", function() {

			// Global startup script
			// Write your global startup script here
			// console.log("page loaded");
			<?php if (CurrentPageID() == "list") { ?>
				$('.ew-add-edit.ew-add').html('<i data-phrase="AddLink" class="fas fa-plus ew-icon" data-caption="Tambah Data"></i> Tambah Data');
				$(".ew-add-edit.ew-add").removeClass("btn-default");
				$(".ew-add-edit.ew-add").addClass("btn-secondary");

				$(".ew-detail-add-group.ew-detail-add").removeClass("btn-default");
				$(".ew-detail-add-group.ew-detail-add").addClass("btn-info");
				$('.ew-detail-add-group.ew-detail-add').html('<i data-phrase="AddMasterDetailLink" class="icon-md-add ew-icon" data-caption="Tambah Master/Detail"></i> Tambah Master/Detail');

				$(".ew-row-link.ew-detail").removeClass("btn-default");
				$(".ew-row-link.ew-detail").addClass("btn-outline-dark");

			<?php } ?>

			<?php if (CurrentPageName() == "t_kurikulumlist.php" || (CurrentUserLevel() == 1 && CurrentPageName() == "beranda.php")) { ?>
				$(".main-sidebar").removeClass("layout-fixed");
				$("body").addClass("sidebar-collapse");
			<?php } ?>
		});
	</script>
<?php } ?>
</body>

</html>