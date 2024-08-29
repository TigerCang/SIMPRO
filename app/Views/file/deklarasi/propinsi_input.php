<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($kabupaten ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($kabupaten ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($kabupaten && $kabupaten[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="xpropinsi" name="xpropinsi" value="<?= ($kabupaten[0]->propinsi ?? '') ?>">
                    <div class="form-group row">
                        <label for="propinsi" class="col-sm-1 col-form-label"><?= lang('app.propinsi') ?></label>
                        <div class="col-sm-11">
                            <select id="propinsi" class="js-example-tokenizer" name="propinsi" <?= ($kabupaten && $kabupaten[0]->is_confirm != '0' ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($propinsi as $db) : ?>
                                    <option value="<?= $db->propinsi ?>" <?= (($kabupaten && $db->propinsi == $kabupaten[0]->propinsi) ? 'selected' : '') ?>><?= $db->propinsi ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errpropinsi"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kabupaten" class="col-sm-1 col-form-label"><?= lang('app.kabupaten') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= (($kabupaten && $kabupaten[0]->is_confirm == '1') ? 'readonly' : '') ?> class="form-control" id="kabupaten" name="kabupaten" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($kabupaten[0]->kabupaten ?? '') ?>">
                            <div id="error" class="invalid-feedback errkabupaten"></div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($kabupaten[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($kabupaten[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($kabupaten[0]->akby ?? '') ?></span>
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
    $("#propinsi").on("change", () => $("#xpropinsi").val($("#propinsi").val()));

    $(document).ready(function() {
        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/propinsi/save';
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
                    if (response.error) {
                        if (response.error.propinsi) {
                            $('#propinsi').addClass('is-invalid');
                            $('.errpropinsi').html(response.error.propinsi);
                        } else {
                            $('#propinsi').removeClass('is-invalid');
                            $('.errpropinsi').html('');
                        }
                        if (response.error.kabupaten) {
                            $('#kabupaten').addClass('is-invalid');
                            $('.errkabupaten').html(response.error.kabupaten);
                        } else {
                            $('#kabupaten').removeClass('is-invalid');
                            $('.errkabupaten').html('');
                        }
                    } else {
                        window.location.href = response.redirect;
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