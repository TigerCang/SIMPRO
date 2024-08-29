<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($iso ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($iso ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($iso && $iso[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="pilihan" name="pilihan" value="dokumen">
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" id="kategori" name="kategori" value="<?= lang('app.dokumen') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formulir" class="col-sm-1 col-form-label"><?= lang('app.form') ?></label>
                        <div class="col-sm-4">
                            <select id="formulir" class="js-example-basic-single" name="formulir">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selkel as $db1) : ?>
                                    <optgroup label="<?= lang('app.' . $db1->kelompok) ?>">
                                        <?php foreach ($selnama as $db) : ?>
                                            <?php if ($db->kelompok == $db1->kelompok) : ?> <option value="<?= $db->nama ?>" <?= (($iso && $iso[0]->param == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option><?php endif; ?>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errformulir"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="nodokumen" class="col-sm-2 col-form-label"><?= lang('app.nodokumen') ?></label>
                        <div class="col-sm-3">
                            <input type="text" harusisi class="form-control text-uppercase" id="nodokumen" name="nodokumen" maxlength="3" value="<?= ($iso[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnodokumen"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div>
                            <button type="reset" class="btn <?= lang('app.btncReset') ?>" <?= $btnhid ?>><?= lang('app.btnReset') ?></button>
                            <button type="button" name="action" value="aktif" class="btn <?= $btnclas2 ?> btnsave" <?= $actaktif ?>><?= $btntext2 ?></button>
                            <button type="button" name="action" value="confirm" class="btn <?= lang('app.btncConfirm') ?> btnsave" <?= $btnsama . $actconf ?>><?= lang('app.btnConfirm') ?></button>
                            <button type="button" name="action" value="save" class="btn <?= $btnclas1 ?> btnsave" <?= $actcreate ?>><?= $btntext1 ?></button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.upby") . ' : ' . ($iso[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($iso[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($iso[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
</div><!-- body end -->

<script>
    $(document).ready(function() {
        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/nodokumen/save';
            formData.append('postaction', getAction);
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsave').attr('disabled', 'disabled');
                    $('.btnsave').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsave').removeAttr('disabled');
                    $('.btnsave').each(function() {
                        var value = $(this).val();
                        if (value === 'aktif') {
                            $(this).html('<?= $btntext2 ?>');
                        } else if (value === 'confirm') {
                            $(this).html('<?= lang("app.btnConfirm") ?>');
                        } else if (value === 'save') {
                            $(this).html('<?= $btntext1 ?>');
                        }
                        $(this).attr('name', 'action');
                    });
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.formulir) {
                            $('#formulir').addClass('is-invalid');
                            $('.errformulir').html(response.error.formulir);
                        } else {
                            $('#formulir').removeClass('is-invalid');
                            $('.errformulir').html('');
                        }
                        if (response.error.nodokumen) {
                            $('#nodokumen').addClass('is-invalid');
                            $('.errnodokumen').html(response.error.nodokumen);
                        } else {
                            $('#nodokumen').removeClass('is-invalid');
                            $('.errnodokumen').html('');
                        }
                    } else {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText);
                    alert(thrownError);
                }
            });
            return false;
        })
    });
</script>

<?= $this->endSection() ?>