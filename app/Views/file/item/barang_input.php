<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($barang ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($barang ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($barang && $barang[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" name="namagambar" value="<?= ($barang[0]->gambar ?? 'default.png') ?>">
                    <div class="form-group row" <?= $ihid ?>>
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($barang && $barang[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase barang" id="kode" name="kode" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($barang[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="sn" class="col-sm-2 col-form-label text-right"><?= lang('app.sn') ?>&emsp;</label>
                        <div class="col-sm-1 text-right">
                            <input type="checkbox" id="sn" name="sn" data-toggle="toggle" <?= (($barang && $barang[0]->use_serial == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light">
                        </div>
                    </div>
                    <div class="form-group row" <?= $shid ?>>
                        <label for="kode2" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($barang && $barang[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase barangbekas" id="kode2" name="kode2" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($barang[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode2"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $nhid ?>>
                        <label for="kodens" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($barang && $barang[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase barangns" id="kodens" name="kodens" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($barang[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkodens"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $ihid ?>>
                        <label for="partnumber" class="col-sm-1 col-form-label"><?= lang('app.partnumber') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="partnumber" name="partnumber" value="<?= ($barang[0]->partnumber ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($barang[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-11">
                            <select id="kategori" class="js-example-tokenizer" name="kategori">
                                <option value="" selected disabled><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($katbarang as $db) : ?>
                                    <option value="<?= $db->kategori ?>" <?= (($barang && $barang[0]->kategori == $db->kategori) ? 'selected' : '') ?>><?= $db->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkategori"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $ihid ?>>
                        <label for="merk" class="col-sm-1 col-form-label"><?= lang('app.merk') ?></label>
                        <div class="col-sm-11">
                            <select id="merk" class="js-example-tokenizer" name="merk">
                                <option value=""><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($merkbarang as $db) : ?>
                                    <option value="<?= $db->merk ?>" <?= (($barang && $barang[0]->merk == $db->merk) ? 'selected' : '') ?>><?= $db->merk ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-1 col-form-label"><?= lang('app.satuan') ?></label>
                        <div class="col-sm-2">
                            <select id="satuan" class="js-example-basic-single" name="satuan">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($satuan as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($barang && $barang[0]->satuan == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errsatuan"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="stokmin" class="col-sm-1 col-form-label" <?= $ihid ?>><?= lang('app.stokmin') ?></label>
                        <div class="col-sm-2" <?= $ihid ?>>
                            <input type="number" class="form-control" id="stokmin" name="stokmin" value="<?= ($barang[0]->stokmin ?? '') ?>" min="0">
                        </div>
                    </div>
                    <div class="form-group row" <?= $ahid ?>>
                        <label for="kelakun" class="col-sm-1 col-form-label"><?= lang('app.kelakun') ?></label>
                        <div class="col-sm-11">
                            <select id="kelakun" class="js-example-basic-single" name="kelakun">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($barang && $barang[0]->kakun_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" harusisi rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($barang[0]->catatan ?? '') ?></textarea>
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
                            <img src="/assets/fileimg/barang/<?= ($barang[0]->gambar ?? 'default.png') ?>" class="img-thumbnail img-preview mx-auto my-auto d-block">
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
                                    <span><?= lang("app.upby") . ' : ' . ($barang[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($barang[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($barang[0]->akby ?? '') ?></span>
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
                    $('#kode, #kode2, #kodens, #nama, #kelakun, #kategori, #satuan, #catatan, #gambar').removeClass('is-invalid');
                    $('.errkode, .errkode2, .errkodens, .errnama, .errkelakun, .errkategori, .errsatuan, .errcatatan, .errgambar').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('kode2', response.error.kode2);
                        handleFieldError('kodens', response.error.kodens);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('kelakun', response.error.kelakun);
                        handleFieldError('kategori', response.error.kategori);
                        handleFieldError('satuan', response.error.satuan);
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