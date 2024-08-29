<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($camp ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($camp ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($camp && $camp[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="idperusahaan" name="idperusahaan" value="<?= ($camp[0]->perusahaan_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idwilayah" name="idwilayah" value="<?= ($camp[0]->wilayah_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="iddivisi" name="iddivisi" value="<?= ($camp[0]->divisi_id ?? '') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($camp && $camp[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="10" placeholder="<?= lang('app.min10kar') ?>" value="<?= ($camp[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($camp[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perusahaan" class="col-sm-1 col-form-label"><?= lang('app.perusahaan') ?></label>
                        <div class="col-sm-11">
                            <select id="perusahaan" class="js-example-basic-single" name="perusahaan" <?= (($camp && $camp[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($perusahaan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($camp && $camp[0]->perusahaan_id == $db->id) ? 'selected' : '') . ($tuser['act_perusahaan'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['perusahaan']) ? '' : 'disabled') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errperusahaan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wilayah" class="col-sm-1 col-form-label"><?= lang('app.wilayah') ?></label>
                        <div class="col-sm-4">
                            <select id="wilayah" class="js-example-basic-single" name="wilayah" <?= (($camp && $camp[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($wilayah as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($camp && $camp[0]->wilayah_id == $db->id) ? 'selected' : '') . ($tuser['act_wilayah'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['wilayah']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errwilayah"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="divisi" class="col-sm-1 col-form-label"><?= lang('app.divisi') ?></label>
                        <div class="col-sm-4">
                            <select id="divisi" class="js-example-basic-single" name="divisi" <?= (($camp && $camp[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($divisi as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($camp && $camp[0]->divisi_id == $db->id) ? 'selected' : '') . ($tuser['act_divisi'] == '1' || preg_match("/,$db->id,/i", $tuser['divisi']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errdivisi"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-1 col-form-label"><?= lang('app.alamat') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"><?= ($camp[0]->alamat ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($camp[0]->catatan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errcatatan"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn <?= lang('app.btncLampir') . $actcreate ?> tambahlampiran" <?= $btnlam ?>><?= lang('app.btnLampir') ?></button>
                        </div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($camp[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($camp[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($camp[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
    <div class="row" <?= ($camp ? '' : 'hidden') ?>>
        <div class="col-sm-12">
            <div class="dt-responsive table-responsive tabellampiran"></div>
        </div>
    </div>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    $("#perusahaan").on("change", () => $("#idperusahaan").val($("#perusahaan").val()));
    $("#wilayah").on("change", () => $("#idwilayah").val($("#wilayah").val()));
    $("#divisi").on("change", () => $("#iddivisi").val($("#divisi").val()));

    function datalampiran() {
        var getIDU = "<?= $idunik ?>";
        $.ajax({
            url: "/camp/tablampir",
            data: {
                idunik: getIDU,
                xpilih: 'camp',
            },
            dataType: "json",
            success: function(response) {
                $('.tabellampiran').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    $(document).ready(function() {
        datalampiran();

        $('.tambahlampiran').click(function(e) {
            e.preventDefault();
            var getIDU = "<?= $idunik ?>";
            $.ajax({
                url: "/camp/modallampir",
                data: {
                    idunik: getIDU,
                    xpilih: 'camp',
                },
                dataType: "json",
                success: function(response) {
                    $('.modallampiran').html(response.data).show();
                    $('#modal-lampiran').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText);
                    alert(thrownError);
                }
            });
        })

        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/camp/save';
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
                    $('#kode, #nama, #perusahaan, #wilayah, #divisi, #catatan').removeClass('is-invalid');
                    $('.errkode, .errnama, .errperusahaan, .errwilayah, .errdivisi, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('perusahaan', response.error.perusahaan);
                        handleFieldError('wilayah', response.error.wilayah);
                        handleFieldError('divisi', response.error.divisi);
                        handleFieldError('catatan', response.error.catatan);
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