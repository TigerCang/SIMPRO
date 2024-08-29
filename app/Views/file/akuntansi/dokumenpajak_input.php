<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($baku ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($baku ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($baku && $baku[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="xpilih" name="xpilih" value="<?= $baku[0]->pilihan ?? '' ?>">
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-1 col-form-label"><?= lang('app.pilihan') ?></label>
                        <div class="col-sm-4">
                            <select id="pilihan" class="js-example-basic-single" name="pilihan" <?= (($baku && $baku[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selnama as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($baku && $baku[0]->pilihan == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errxpilih"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="zpilih1">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-2">
                            <input type="text" harusisi <?= (($baku && $baku[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control" id="kode" name="kode" placeholder="<?= lang('app.min5kar') ?>" maxlength="5" value="<?= ($baku[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="zpilih2">
                        <label for="kode2" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-2">
                            <input type="text" harusisi <?= (($baku && $baku[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control obpajak" id="kode2" name="kode2" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($baku[0]->kode ?? '') ?>" data-mask="99-999-99">
                            <div id="error" class="invalid-feedback errkode2"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($baku[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="zpilih3">
                        <label for="pajak" class="col-sm-1 col-form-label"><?= lang('app.pajak') ?></label>
                        <div class="col-sm-11">
                            <select id="pajak" class="js-example-basic-single" name="pajak">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($pajak as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($baku && $baku[0]->pajak_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errpajak"></div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($baku[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($baku[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($baku[0]->akby ?? '') ?></span>
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
    $("#pilihan").change(function() {
        $("#xpilih").val($(this).val());
        $('#zpilih1, #zpilih2, #zpilih3').removeAttr('hidden');
        if ($("#xpilih").val() == '' || $("#xpilih").val() == 'dokumenref') {
            $('#zpilih1, #zpilih2, #zpilih3').attr('hidden', 'hidden');
        } else if ($("#xpilih").val() == 'objekpajak') {
            $('#zpilih1').attr('hidden', 'hidden');
        } else if ($("#xpilih").val() == 'kbli') {
            $('#zpilih2, #zpilih3').attr('hidden', 'hidden');
        }
    });

    $(document).ready(function() {
        $("#pilihan").trigger("change");

        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/dokumenpajak/save';
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
                    $('#pilihan, #kode, #kode2, #nama, #pajak').removeClass('is-invalid');
                    $('.errxpilih, .errkode, .errkode2, .errnama, .errpajak').html('');
                    if (response.error) {
                        handleFieldError('xpilih', response.error.xpilih);
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('kode2', response.error.kode2);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('pajak', response.error.pajak);
                    } else {
                        window.location.href = response.redirect;
                    }

                    function handleFieldError(field, error) {
                        if (error) {
                            $('#' + field).addClass('is-invalid');
                            $('.err' + field).html(error);
                        } else {
                            $('#' + field).removeClass('is-invalid');
                        }
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