<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($akun ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($akun ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($akun && $akun[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="xkategori" name="xkategori" value="<?= ($akun[0]->kategori ?? '') ?>">
                    <div class="form-group row" <?= ($akun ? '' : 'hidden') ?>>
                        <label for="noakun" class="col-sm-1 col-form-label"><?= lang('app.noakun') ?></label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" id="noakun" name="noakun" value="<?= ($akun[0]->noakun ?? '') ?>">
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="level" class="col-sm-1 col-form-label"><?= lang('app.level') ?></label>
                        <div class="col-sm-2">
                            <input type="text" readonly class="form-control" id="level" name="level" value="<?= ($akun[0]->level ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($akun && $akun[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control noakun" id="kode" name="kode" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($akun[0]->kode ?? '') ?>" data-mask="999.9999">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($akun[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-4">
                            <select id="kategori" class="js-example-basic-single" name="kategori" <?= (($akun && $akun[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selnama as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($akun && $akun[0]->kategori == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option>";
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkategori"></div>
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="posisi" class="col-sm-1 col-form-label"><?= lang('app.posisi') ?> (+)</label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="posisi" name="posisi" data-toggle="toggle" <?= (($akun && $akun[0]->posisi == '1') ? 'checked' : '') ?> data-on="<?= lang('app.debit') ?>" data-off="<?= lang('app.kredit') ?>" data-onstyle="primary" data-offstyle="warning">
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
                                    <span><?= lang("app.upby") . ' : ' . ($akun[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($akun[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($akun[0]->akby ?? '') ?></span>
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

<script>
    $(document).ready(function() {
        $('#kategori').change(function() {
            var angka = $(this).val().charAt(0); // ambil satu huruf dari kategori yang dipilih
            $('#xkategori').val($(this).val());
            if (angka == '1' || angka == '3' || angka == '5' || angka == '6' || angka == '8') {
                $('#posisi').bootstrapToggle('on'); // Menyalakan checkbox
            } else {
                $('#posisi').bootstrapToggle('off');
            }
        });

        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/akuntansi/save';
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
                    $('#kode, #nama, #kategori').removeClass('is-invalid');
                    $('.errkode, .errnama, .errkategori').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('kategori', response.error.kategori);
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