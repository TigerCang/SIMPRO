<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($biaya ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($biaya ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($biaya && $biaya[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($biaya && $biaya[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="8" placeholder="<?= lang('app.min8kar') ?>" value="<?= ($biaya[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="matabayar" class="col-sm-1 col-form-label" <?= $lhid ?>><?= lang('app.matabayar') ?></label>
                        <div class="col-sm-1" <?= $lhid ?>>
                            <input type="text" class="form-control" id="matabayar" name="matabayar" value="<?= ($biaya[0]->matabayar ?? '') ?>">
                        </div>
                        <label for="voljum" class="col-sm-1 col-form-label" <?= $shid ?>><?= lang('app.volume+') ?></label>
                        <div class="col-sm-1" <?= $shid ?>>
                            <input type="checkbox" id="volum" name="voljum" data-toggle="toggle" <?= (($biaya && $biaya[0]->is_jumlah == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($biaya[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $khid ?>>
                        <label for="katproyek" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-11">
                            <select id="katproyek" class="js-example-basic-single" name="katproyek">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($katproyek as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= ($biaya ? ($db->id == $biaya[0]->tipe_id ? 'selected' : ($biaya[0]->is_confirm != '0' ? 'disabled' : '')) : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkatproyek"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-1 col-form-label"><?= lang('app.satuan') ?></label>
                        <div class="col-sm-2">
                            <select id="satuan" class="js-example-basic-single" name="satuan">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($satuan as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($biaya && $db->nama == $biaya[0]->satuan) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errsatuan"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $ahid ?>>
                        <label for="noakun" class="col-sm-1 col-form-label"><?= lang('app.noakun') ?></label>
                        <div class="col-sm-11">
                            <select id="noakun" class="js-example-data-ajax" name="noakun">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($akun1) : ?> <option value="<?= $akun1[0]->id ?>" selected><?= $akun1[0]->noakun . ' => ' . $akun1[0]->nama ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errnoakun"></div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($biaya[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($biaya[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($biaya[0]->akby ?? '') ?></span>
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
        $("#noakun").select2({
            ajax: {
                url: "/<?= $menu ?>/akun",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        awal: '6',
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
        })

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
                    $('#kode, #nama, #katproyek, #satuan, #noakun').removeClass('is-invalid');
                    $('.errkode, .errnama, .errkatproyek, .errsatuan, .errnoakun').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('katproyek', response.error.katproyek);
                        handleFieldError('satuan', response.error.satuan);
                        handleFieldError('noakun', response.error.noakun);
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