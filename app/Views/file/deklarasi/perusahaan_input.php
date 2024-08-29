<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($perusahaan ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($perusahaan ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($perusahaan && $perusahaan[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" name="namagambar" value="<?= ($perusahaan[0]->logo ?? 'default.png') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= $penro . " " . (($perusahaan && $perusahaan[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control" id="kode" name="kode" maxlength="50" placeholder="<?= lang('app.min3kar') ?>" value="<?= ($perusahaan[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="kui" class="col-sm-1 col-form-label"><?= lang('app.inisial') ?></label>
                        <div class="col-sm-2">
                            <input type="text" harusisi <?= $penro ?> class="form-control text-uppercase" id="kui" name="kui" maxlength="3" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($perusahaan[0]->kui ?? '') ?>">
                            <div id="error" class="invalid-feedback errkui"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= $penro ?> class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($perusahaan[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-1 col-form-label"><?= lang('app.alamat') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= $penro ?> class="form-control" id="alamat" name="alamat" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($perusahaan[0]->alamat ?? '') ?>">
                            <div id="error" class="invalid-feedback erralamat"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp" class="col-sm-1 col-form-label"><?= lang('app.telp') ?></label>
                        <div class="col-sm-11">
                            <input type="text" <?= $penro ?> class="form-control" id="telp" name="telp" value="<?= ($perusahaan[0]->telp ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kota" class="col-sm-1 col-form-label"><?= lang('app.kota') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= $penro ?> class="form-control" id="kota" name="kota" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($perusahaan[0]->kota ?? '') ?>">
                            <div id="error" class="invalid-feedback errkota"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="direktur" class="col-sm-1 col-form-label"><?= lang('app.direktur') ?></label>
                        <div class="col-sm-11">
                            <input type="text" <?= $penro ?> class="form-control" id="direktur" name="direktur" value="<?= ($perusahaan[0]->direktur ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row" <?= $phid ?>>
                        <label for="penerima" class="col-sm-1 col-form-label"><?= lang('app.penerima') ?></label>
                        <div class="col-sm-11">
                            <select id="penerima" class="js-example-data-ajax" name="penerima">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($penerima1) : ?> <option value="<?= $penerima1[0]->id ?>" selected><?= "{$penerima1[0]->kode} => {$penerima1[0]->nama}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errpenerima"></div>
                        </div>
                    </div>
                    <div class="form-group row" <?= $ahid ?>>
                        <label for="gambar" class="col-sm-1 col-form-label"><?= lang('app.logo') ?></label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()" />
                            <div id="error" class="invalid-feedback errgambar"></div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <img src="/assets/fileimg/perusahaan/<?= ($perusahaan ? $perusahaan[0]->logo : 'default.png') ?>" class="img-thumbnail img-preview mx-auto my-auto d-block">
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn <?= lang('app.btncLampir') . $actcreate ?> tambahlampiran" <?= $btnlam ?>><?= lang('app.btnLampir') ?></button>
                            <button disabled hidden type="button" class="btn <?= lang('app.btncSave') ?> dropdown-toggle" data-toggle="dropdown"><?= lang('app.btnSave') ?></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <php $style = ($beda == 'disabled' ? "style='pointer-events: none; opacity: 0.5;'" : ''); ?> -->
                                <a class="dropdown-item" onclick="updatedata()"><?= lang('app.update') ?></a>
                                <a class="dropdown-item" onclick="deletedata()"><?= lang('app.hapus') ?></a>
                                <a class="dropdown-item" onclick="bataldoc()"><?= lang('app.pasti') ?></a>
                                <a class="dropdown-item" onclick="bataldoc()"><?= lang('app.aktif') ?></a>
                            </div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($perusahaan[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($perusahaan[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($perusahaan[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
    <div class="row" <?= ($perusahaan ? '' : 'hidden') ?>>
        <div class="col-sm-12">
            <div class="dt-responsive table-responsive tabellampiran"></div>
        </div>
    </div>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    function datalampiran() {
        var getIDU = "<?= $idunik ?>";
        $.ajax({
            url: "/perusahaan/tablampir",
            data: {
                idunik: getIDU,
                xpilih: 'perusahaan',
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
                url: "/perusahaan/modallampir",
                data: {
                    idunik: getIDU,
                    xpilih: 'perusahaan',
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

        $("#penerima").select2({
            ajax: {
                url: "/tautp/penerima",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        pilih: '1110', //pelanggan suplier lain pegawai 
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
                    $('#kode, #kui, #nama, #alamat, #kota, #penerima, #gambar').removeClass('is-invalid');
                    $('.errkode, .errkui, .errnama, .erralamat, .errkota, .errpenerima, .errgambar').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('kui', response.error.kui);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('alamat', response.error.alamat);
                        handleFieldError('kota', response.error.kota);
                        handleFieldError('penerima', response.error.penerima);
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