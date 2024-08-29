<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($penerima ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($penerima ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($penerima && $penerima[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($penerima && ($penerima[0]->is_confirm != '0' || $penerima[0]->st_peg == '1')) ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="16" placeholder="<?= lang('app.min16kar') ?>" value="<?= ($penerima[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-5"></div>
                        <label for="rating" class="col-sm-1 col-form-label"><?= lang('app.rating') ?></label>
                        <div class="col-sm-1 text-right">
                            <div class="stars stars-example-fontawesome-o">
                                <select id="example-fontawesome-o" name="rating">
                                    <option value="" label="0"></option>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <option value="<?= $i ?>" <?= (($penerima && $penerima[0]->rating == $i) ? 'selected' : '') ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" id="nilairating" name="nilairating" value="<?= ($penerima[0]->rating ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.nama') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= (($penerima && $penerima[0]->st_peg == '1') ? 'readonly' : '') ?> class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($penerima[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-11">
                            <select id="kategori" class="js-example-tokenizer" name="kategori">
                                <option value="" selected disabled><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($kategori as $db) : ?>
                                    <option value="<?= $db->kategori ?>" <?= (($penerima && $penerima[0]->kategori == $db->kategori) ? 'selected' : '') ?>><?= $db->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkategori"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-1 col-form-label"><?= lang('app.alamat') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" <?= (($penerima && $penerima[0]->st_peg == '1') ? 'readonly' : '') ?> rows="3" id="alamat" name="alamat"><?= ($penerima[0]->alamat ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kontak" class="col-sm-1 col-form-label"><?= lang('app.kontak') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" <?= (($penerima && $penerima[0]->st_peg == '1') ? 'readonly' : '') ?> rows="3" id="kontak" name="kontak"><?= ($penerima[0]->kontak ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pelanggan" class="col-sm-1 col-form-label"><?= lang('app.pelanggan') ?></label>
                        <div class="col-sm-1"><input type="checkbox" id="pelanggan" name="pelanggan" data-toggle="toggle" <?= (($penerima && $penerima[0]->st_pel == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light"></div>
                        <div class="col-sm-10">
                            <select id="kelakun1" class="js-example-basic-single" name="kelakun1">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun1 as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($penerima && $penerima[0]->kakun_pel == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun1"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suplier" class="col-sm-1 col-form-label"><?= lang('app.suplier') ?></label>
                        <div class="col-sm-1"><input type="checkbox" id="suplier" name="suplier" data-toggle="toggle" <?= (($penerima && $penerima[0]->st_sup == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light"></div>
                        <div class="col-sm-10">
                            <select id="kelakun2" class="js-example-basic-single" name="kelakun2">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun2 as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($penerima && $penerima[0]->kakun_sup == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun2"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subkon" class="col-sm-1 col-form-label"><?= lang('app.subkon') ?></label>
                        <div class="col-sm-1"><input type="checkbox" id="subkon" name="subkon" data-toggle="toggle" <?= (($penerima && $penerima[0]->st_lain == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light"></div>
                        <div class="col-sm-10">
                            <select id="kelakun3" class="js-example-basic-single" name="kelakun3">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun3 as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($penerima && $penerima[0]->kakun_lain == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun3"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pegawai" class="col-sm-1 col-form-label"><?= lang('app.pegawai') ?></label>
                        <div class="col-sm-1"><input type="checkbox" id="pegawai" name="pegawai" disabled data-toggle="toggle" <?= (($penerima && $penerima[0]->st_peg == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light"></div>
                        <div class="col-sm-10">
                            <select id="kelakun4" class="js-example-basic-single" name="kelakun4" disabled>
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun4 as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($penerima && $penerima[0]->kakun_peg == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi <?= (($penerima && $penerima[0]->st_peg == '1') ? 'readonly' : '') ?> class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($penerima[0]->catatan ?? '') ?></textarea>
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
                                    <span><?= lang("app.upby") . ' : ' . ($penerima[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($penerima[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($penerima[0]->akby ?? '') ?></span>
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
    $("#example-fontawesome-o").on("change", () => $("#nilairating").val($("#example-fontawesome-o").val()));

    $(document).ready(function() {
        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/penerima/save';
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
                    $('#kode, #nama, #kategori, #kelakun1, #kelakun2, #kelakun3, #catatan').removeClass('is-invalid');
                    $('.errkode, .errnama, .errkategori, .errkelakun1, .errkelakun2, .errkelakun3, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('kategori', response.error.kategori);
                        handleFieldError('kelakun1', response.error.kelakun1);
                        handleFieldError('kelakun2', response.error.kelakun2);
                        handleFieldError('kelakun3', response.error.kelakun3);
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