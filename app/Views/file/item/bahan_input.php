<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($bahan ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($bahan ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($bahan && $bahan[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="kodebiaya" name="kodebiaya" value="<?= ($bahan[0]->kode ?? '') ?>">
                    <input type="hidden" class="form-control" id="namabiaya" name="namabiaya" value="<?= ($bahan[0]->nama ?? '') ?>">
                    <input type="hidden" class="form-control" name="namagambar" value="<?= ($bahan[0]->gambar ?? 'default.png') ?>">
                    <div class="form-group row">
                        <label for="biaya" class="col-sm-1 col-form-label"><?= lang('app.bahan') ?></label>
                        <div class="col-sm-11">
                            <select id="biaya" class="js-example-data-ajax" name="biaya">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($biaya1) : ?> <option value="<?= $biaya1[0]->id ?>" selected><?= "{$biaya1[0]->kode} => {$biaya1[0]->nama}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errbiaya"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelakun" class="col-sm-1 col-form-label"><?= lang('app.kelakun') ?></label>
                        <div class="col-sm-11">
                            <select id="kelakun" class="js-example-basic-single" name="kelakun">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($bahan && $bahan[0]->kakun_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-11">
                            <select id="kategori" class="js-example-tokenizer" name="kategori">
                                <option value="" selected disabled><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($katbahan as $db) : ?>
                                    <option value="<?= $db->kategori ?>" <?= (($bahan && $bahan[0]->kategori == $db->kategori) ? 'selected' : '') ?>><?= $db->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkategori"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-1 col-form-label"><?= lang('app.satuan') ?></label>
                        <div class="col-sm-2">
                            <input type="text" readonly class="form-control" id="satuan" name="satuan" value="<?= ($bahan[0]->satuan ?? '') ?>">
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="harga" class="col-sm-1 col-form-label"><?= lang('app.harga') ?></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="harga" name="harga" maxlength="20" value="<?= ($bahan[0]->harga ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($bahan[0]->catatan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errcatatan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-sm-1 col-form-label"><?= lang('app.gambar') ?></label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()" />
                            <div id="error" class="invalid-feedback errgambar"></div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <img src="/assets/fileimg/barang/<?= ($bahan[0]->gambar ?? 'default.png') ?>" class="img-thumbnail img-preview mx-auto my-auto d-block">
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
                                    <span><?= lang("app.upby") . ' : ' . ($bahan[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($bahan[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($bahan[0]->akby ?? '') ?></span>
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
    $("#biaya").change(function() {
        var getBiaya = $("#biaya").val();
        $.ajax({
            type: "post",
            url: "/bahan/gantibiaya",
            data: {
                biaya: getBiaya,
            },
            dataType: "json",
            success: function(response) { // Ketika proses pengiriman berhasil
                if (response.biaya.length > 0) {
                    $("#kodebiaya").val(response.biaya[0].kode);
                    $("#namabiaya").val(response.biaya[0].nama);
                    $("#satuan").val(response.biaya[0].satuan);
                } else {
                    $("#kodebiaya").val('');
                    $("#namabiaya").val('');
                    $("#satuan").val('');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    });

    $(document).ready(function() {
        $("#biaya").select2({
            ajax: {
                url: "/bahan/biaya",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        pilih: 'sumberdaya',
                        ruas: '0000',
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
            var url = '/bahan/save';
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
                    $('#biaya, #kelakun, #kategori, #catatan, #gambar').removeClass('is-invalid');
                    $('.errbiaya, .errkelakun, .errkategori, .errcatatan, .errgambar').html('');
                    if (response.error) {
                        console.log(response);
                        handleFieldError('biaya', response.error.biaya);
                        handleFieldError('kelakun', response.error.kelakun);
                        handleFieldError('kategori', response.error.kategori);
                        handleFieldError('catatan', response.error.catatan);
                        handleFieldError('gambar', response.error.gambar);
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