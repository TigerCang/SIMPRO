<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($jarak ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($jarak ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($jarak && $jarak[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="idcamp" name="idcamp" value="<?= ($jarak[0]->camp_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idproyek" name="idproyek" value="<?= ($jarak[0]->proyek_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idruas" name="idruas" value="<?= ($jarak[0]->ruas_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="koderuas" name="koderuas" value="<?= ($jarak ? substr($jarak[0]->kode, 0, 4) : '') ?>">
                    <div class="form-group row" <?= $chid ?>>
                        <label for="camp" class="col-sm-1 col-form-label"><?= lang('app.camp') ?></label>
                        <div class="col-sm-11">
                            <select id="camp" class="js-example-basic-single" name="camp">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($camp as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= ($jarak ? ($db->id == $jarak[0]->camp_id ? 'selected' : ($jarak[0]->is_confirm != '0' ? 'disabled' : '')) : '') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errcamp"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $phid ?>>
                        <label for="proyek" class="col-sm-1 col-form-label"><?= lang('app.proyek') ?></label>
                        <div class="col-sm-11">
                            <select id="proyek" class="js-example-data-ajax" name="proyek" <?= (($jarak && $jarak[0]->is_confirm != '0') ? 'disabled' : '') ?> onchange="loadruas()">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($proyek1) : ?> <option value="<?= $proyek1['0']->id ?>" selected><?= "{$proyek1['0']->kode} => {$proyek1['0']->paket}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errproyek"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $phid ?>>
                        <label for="ruas" class="col-sm-1 col-form-label"><?= lang('app.ruas') ?></label>
                        <div class="col-sm-8">
                            <select id="ruas" class="js-example-basic-single" name="ruas" <?= (($jarak && $jarak[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                            </select>
                            <div id="error" class="invalid-feedback d-block errruas"></div>
                        </div>
                        <label for="ruas" class="col-sm-1 col-form-label text-right"><?= lang('app.sub') ?>&ensp;</label>
                        <div class="col-sm-2">
                            <input type="text" harusisi <?= (($jarak && $jarak[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase" id="nomor" name="nomor" maxlength="3" value="<?= ($jarak ? substr($jarak[0]->kode, -3) : '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-2">
                            <input type="text" harusisi <?= (($bkode == 'off' || ($jarak && $jarak[0]->is_confirm != '0')) ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="6" placeholder="<?= ($bkode == 'on' ? lang('app.min6kar') : '') ?>" value="<?= ($jarak[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="km" class="col-sm-1 col-form-label"><?= lang('app.jarak') ?></label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="0" data-a-sep="." data-a-dec="," id="km" name="km" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($jarak[0]->jarak ?? '') ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><label class="col-form-label">&ensp;Km</label></span>
                                </div>
                            </div>
                            <div id="error" class="invalid-feedback d-block errkm"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($jarak[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($jarak[0]->catatan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errcatatan"></div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($jarak[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($jarak[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($jarak[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    </form>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    $("#camp").on("change", () => $("#idcamp").val($("#camp").val()));
    $("#proyek").on("change", () => $("#idproyek").val($("#proyek").val()));
    $("#nomor").on("change", () => $("#kode").val($("#koderuas").val() + '.' + $('#nomor').val()));
    $("#ruas").change(function() {
        $('#idruas').val($('#ruas').val());
        $('#koderuas').val($('#ruas').find(':selected').data('kode'));
    });

    function loadruas() {
        var getProyek = $("#idproyek").val();
        var getRuas = $("#idruas").val();
        $.ajax({
            type: "post",
            url: "/subruas/ruas",
            data: {
                proyek: getProyek,
                ruas: getRuas,
                pilih: 'ruas',
            },
            dataType: "json",
            success: function(response) { // Ketika proses pengiriman berhasil
                if (response.ruas) $("#ruas").html(response.ruas);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    $(document).ready(function() {
        loadruas();

        $("#proyek").select2({
            ajax: {
                url: "/<?= $menu ?>/loadproyek",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        perusahaan: '',
                        wilayah: '',
                        divisi: '',
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            <?= lang("app.inputminimum") ?>,
        });

        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/<?= $menu ?>/save';
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
                    $('#kode, #nama, #camp, #proyek, #ruas, #catatan, #km').removeClass('is-invalid');
                    $('.errkode, .errnama, .errcamp, .errproyek, .errruas, .errcatatan, .errkm').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('camp', response.error.camp);
                        handleFieldError('proyek', response.error.proyek);
                        handleFieldError('ruas', response.error.ruas);
                        handleFieldError('catatan', response.error.catatan);
                        handleFieldError('km', response.error.km);
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