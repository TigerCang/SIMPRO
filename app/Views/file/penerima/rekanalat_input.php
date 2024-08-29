<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($alat ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($alat ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($alat && $alat[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <div class="form-group row">
                        <label for="rekan" class="col-sm-1 col-form-label"><?= lang('app.rekan') ?></label>
                        <div class="col-sm-11">
                            <select id="rekan" class="js-example-data-ajax" name="rekan">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($penerima1) : ?> <option value="<?= $penerima1['0']->id ?>" selected><?= "{$penerima1['0']->kode} => {$penerima1['0']->nama}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errrekan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor" class="col-sm-1 col-form-label"><?= lang('app.nomor') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi class="form-control text-uppercase" id="nomor" name="nomor" value="<?= ($alat[0]->nomor ?? '') ?>">
                            <div id="error" class="invalid-feedback errnomor"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bentuk" class="col-sm-1 col-form-label"><?= lang('app.bentuk') ?></label>
                        <div class="col-sm-4">
                            <select id="bentuk" class="js-example-basic-single" name="bentuk">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selbentuk as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($alat && $alat[0]->bentuk == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errbentuk"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-4">
                            <select id="kategori" class="js-example-tokenizer" name="kategori">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($katalat as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($alat && $alat[0]->kategori_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkategori"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($alat[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($alat[0]->catatan ?? '') ?></textarea>
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
                                    <span><?= lang("app.upby") . ' : ' . ($alat[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($alat[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($alat[0]->akby ?? '') ?></span>
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
        $("#rekan").select2({
            ajax: {
                url: "/rekanalat/penerima",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        pilih: '0010',
                        osm: '0',
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
            var url = '/rekanalat/save';
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
                    $('#rekan, #nomor, #nama, #bentuk, #kategori, #catatan').removeClass('is-invalid');
                    $('.errrekan, .errnomor, .errnama, .errbentuk, .errkategori, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('rekan', response.error.rekan);
                        handleFieldError('nomor', response.error.nomor);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('bentuk', response.error.bentuk);
                        handleFieldError('kategori', response.error.kategori);
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