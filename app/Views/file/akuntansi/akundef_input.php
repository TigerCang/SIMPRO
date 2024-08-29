<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($defakun ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($defakun ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($defakun && $defakun[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="xsubmenu" name="xsubmenu" value="<?= ($defakun[0]->submenu ?? '') ?>">
                    <input type="hidden" class="form-control" id="xkelompok" name="xkelompok" value="<?= ($defakun[0]->kelompok ?? '') ?>">
                    <div class="form-group row">
                        <label for="kelompok" class="col-sm-1 col-form-label"><?= lang('app.kelompok') ?></label>
                        <div class="col-sm-4">
                            <select id="kelompok" class="js-example-basic-single" name="kelompok" <?= (($defakun && $defakun[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selkel as $db1) : ?>
                                    <optgroup label="<?= lang('app.' . $db1->kelompok) ?>">
                                        <?php foreach ($selnama as $db) : ?>
                                            <?php if ($db->kelompok == $db1->kelompok) : ?><option value="<?= $db->nama ?>" data-submenu="<?= $db1->kelompok ?>" <?= (($defakun && $defakun[0]->kelompok == $db->nama) ? 'selected' : '') . ">" . lang('app.' . $db->nama) ?></option><?php endif; ?>
                                            <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelompok"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($defakun[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="znilai">
                        <label for="nilai" class="col-sm-1 col-form-label"><?= ($menu == 'akunpajak' ? lang('app.nilai') : lang('app.umuraset')) ?></label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="text" class="form-control autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nilai" name="nilai" value="<?= ($defakun[0]->nilai ?? '') ?>" placeholder="<?= lang('app.harusisi') ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><label class="col-form-label">&ensp;<?= ($menu == 'akunpajak' ? '%' : ucfirst(lang('app.bulan'))) ?></label></span>
                                </div>
                            </div>
                            <div id="error" class="invalid-feedback d-block errnilai"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="zperusahaan">
                        <label for="perusahaan" class="col-sm-1 col-form-label"><?= lang('app.perusahaan') ?></label>
                        <div class="col-sm-11">
                            <select id="perusahaan" class="js-example-basic-single" name="perusahaan">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($perusahaan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($defakun && $defakun[0]->perusahaan_id == $db->id) ? 'selected' : '') . " " . ($tuser['act_perusahaan'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['perusahaan']) ? '' : 'disabled') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errperusahaan"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="zwilayah">
                        <label for="wilayah" class="col-sm-1 col-form-label"><?= lang('app.wilayah') ?></label>
                        <div class="col-sm-4">
                            <select id="wilayah" class="js-example-basic-single" name="wilayah">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($wilayah as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($defakun && $defakun[0]->wilayah_id == $db->id) ? 'selected' : '') . " " . ($tuser['act_wilayah'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['wilayah']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errwilayah"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="divisi" class="col-sm-1 col-form-label"><?= lang('app.divisi') ?></label>
                        <div class="col-sm-4">
                            <select id="divisi" class="js-example-basic-single" name="divisi">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($divisi as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($defakun && $defakun[0]->divisi_id == $db->id) ? 'selected' : '') . " " . ($tuser['act_divisi'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['divisi']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errdivisi"></div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="noakun1" id="zlabel1" class="col-sm-1 col-form-label"><?= lang('app.noakun') ?></label>
                        <div class="col-sm-11">
                            <select id="noakun1" class="js-example-data-ajax" name="noakun1">
                                <option value="" selected><?= lang('app.pilihsr') ?></option>
                                <?php if ($akun1) : ?><option value="<?= $akun1[0]->id ?>" selected><?= "{$akun1[0]->noakun} => {$akun1[0]->nama}" ?></option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="zakun2">
                        <label for="noakun2" id="zlabel2" class="col-sm-1 col-form-label"></label>
                        <div class="col-sm-11">
                            <select id="noakun2" class="js-example-data-ajax" name="noakun2">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if (!empty($akun2)) : ?><option value="<?= $akun2[0]->id ?>" selected><?= "{$akun2[0]->noakun} => {$akun2[0]->nama}" ?></option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="zakun3">
                        <label for="noakun3" class="col-sm-1 col-form-label"><?= lang('app.uangjalan') ?></label>
                        <div class="col-sm-11">
                            <select id="noakun3" class="js-example-data-ajax" name="noakun3">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if (!empty($akun3)) : ?><option value="<?= $akun3[0]->id ?>" selected><?= "{$akun3[0]->noakun} => {$akun3[0]->nama}" ?></option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="zakun4">
                        <label for="noakun4" class="col-sm-1 col-form-label"><?= lang('app.kasbon') ?></label>
                        <div class="col-sm-11">
                            <select id="noakun4" class="js-example-data-ajax" name="noakun4">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if (!empty($akun4)) : ?><option value="<?= $akun4[0]->id ?>" selected><?= "{$akun4[0]->noakun} => {$akun4[0]->nama}" ?></option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($defakun[0]->catatan ?? '') ?></textarea>
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
                                    <span><?= lang("app.upby") . ' : ' . ($defakun[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($defakun[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($defakun[0]->akby ?? '') ?></span>
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
    $("#kelompok").change(function() {
        $("#xkelompok").val($("#kelompok").val());
        var menu = "<?= $menu ?>";
        var submenu = $("#kelompok").find(':selected').data('submenu');
        $("#xsubmenu").val(submenu); // document.getElementById('xsubmenu').value = submenu;

        if (menu == 'akungrup') {
            switch (submenu) {
                case 'aset':
                    $('#znilai, #zakun2').removeAttr('hidden');
                    $('#zakun3, #zakun4').attr('hidden', 'hidden');
                    $('#zlabel1').text('<?= lang('app.aset') ?>');
                    $('#zlabel2').text('<?= lang('app.akumulasisusut') ?>');
                    break;
                case 'penerima':
                    $('#znilai').attr('hidden', 'hidden');
                    $('#zakun2, #zakun3, #zakun4').removeAttr('hidden');
                    $('#zlabel1').text('<?= lang('app.kasum') ?>');
                    $('#zlabel2').text('<?= lang('app.ummasuk') ?>');
                    break;
                case 'stok':
                    $('#znilai, #zakun2, #zakun3, #zakun4').attr('hidden', 'hidden');
                    $('#zlabel1').text('<?= lang('app.stok') ?>');
                    break;
                default:
                    break;
            }
        }
    });

    function loadsubmenu() {
        var menu = "<?= $menu ?>";
        switch (menu) {
            case 'akunpajak':
                $('#zperusahaan, #zwilayah, #zakun2, #zakun3, #zakun4').attr('hidden', 'hidden');
                $('#znilai').removeAttr('hidden');
                break;
            case 'akunkas':
                $('#zperusahaan, #zwilayah').removeAttr('hidden');
                $('#znilai, #zakun2, #zakun3, #zakun4').attr('hidden', 'hidden');
                break;
            case 'akungrup':
                $('#zperusahaan, #zwilayah, #znilai, #zakun2, #zakun3, #zakun4').attr('hidden', 'hidden');
                break;
            default:
                break;
        }
    }

    $(document).ready(function() {
        loadsubmenu();
        $("#kelompok").trigger("change");

        $("#noakun1, #noakun2, #noakun3, #noakun4").select2({
            ajax: {
                url: "/<?= $menu ?>/akun",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        awal: '',
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
                    $('#kelompok, #nama, #nilai, #perusahaan, #wilayah, #divisi, #catatan').removeClass('is-invalid');
                    $('.errkelompok, .errnama, .errnilai, .errperusahaan, .errwilayah, .errdivisi, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('kelompok', response.error.kelompok);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('nilai', response.error.nilai);
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