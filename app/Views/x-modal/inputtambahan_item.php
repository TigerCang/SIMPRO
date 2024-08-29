<div class="modal fade" id="modal-lampiran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header <?= lang('app.bgMinput') ?>">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formbarang']) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-block">
                            <input type="hidden" class="form-control" id="mid" name="mid" value="<?= $anak[0]->id ?>">
                            <div class="form-group row">
                                <label for="mitem" class="col-sm-1 col-form-label"><?= lang('app.item') ?></label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control" id="mkode" name="mkode" value="<?= $biaya[0]->kode ?>" />
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control" id="mnama" name="mnama" value="<?= $biaya[0]->nama ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mjumlah" class="col-sm-1 col-form-label"><?= lang('app.jumlah') ?></label>
                                <div class="col-sm-2">
                                    <input type="text" <?= ($pilih == 'harga' ? 'readonly' : '') ?> class="form-control form-control-right autonumber" data-digit-after-decimal="4" data-a-sep="." data-a-dec="," id="mjumlah" name="mjumlah" value="<?= $anak[0]->jumlah ?>" onchange="hitung()" />
                                </div>
                                <label for="mharga" class="col-sm-1 col-form-label"><?= lang('app.harga') ?></label>
                                <div class="col-sm-2">
                                    <input type="text" <?= ($pilih == 'jumlah' ? 'readonly' : '') ?> class="form-control form-control-right autonumber" data-digit-after-decimal="4" data-a-sep="." data-a-dec="," id="mharga" name="mharga" value="<?= $anak[0]->harga ?>" onchange="hitung()" />
                                </div>
                                <div class="col-sm-3"></div>
                                <label for="mtotal" class="col-sm-1 col-form-label"><?= lang('app.total') ?></label>
                                <div class="col-sm-2">
                                    <input type="text" harusisi class="form-control form-control-right autonumber" data-digit-after-decimal="4" data-a-sep="." data-a-dec="," id="mtotal" name="mtotal" value="<?= $anak[0]->debit ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mcatatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                                <div class="col-sm-11">
                                    <textarea harusisi class="form-control" rows="3" id="mcatatan" name="mcatatan" placeholder="<?= lang('app.harusisi') ?>"></textarea>
                                    <div class="invalid-feedback errmcatatan"></div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="modal-footer"><?= "<button type='submit' class='btn " . lang('app.btncOK') . " btnok'>" . lang('app.btnOK') . "</button>"; ?></div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>

        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/bower_components/extra/css/modal.css">
<script type="text/javascript" src="<?= base_url('libraries') ?>/assets/pages/form-masking/form-mask.js"></script>
<script type="text/javascript" src="<?= base_url('libraries') ?>/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/select2/js/select2.full.min.js"></script>
<script>
    function hitung() {
        if (document.getElementById('mjumlah').value === '') document.getElementById('mjumlah').value = '0,00';
        if (document.getElementById('mharga').value === '') document.getElementById('mharga').value = '0,00';

        var jumlah = formatAngka(document.getElementById('mjumlah').value, 'nol');
        var harga = formatAngka(document.getElementById('mharga').value, 'nol');
        var total = parseFloat(jumlah) * parseFloat(harga);
        $('#mtotal').val(formatAngka(total, 'rp'));

    }

    $(document).ready(function() {
        // $('.btnok').click(function(e) {
        //     e.preventDefault();
        //     var form = $('.formbarang')[0];
        //     var formData = new FormData(form);
        //     var url = '/ambilbarang/edititem';
        //     $.ajax({
        //         type: 'post',
        //         url: url,
        //         data: formData,
        //         enctype: "multipart/form-data",
        //         cache: false,
        //         processData: false,
        //         contentType: false,
        //         dataType: "json",
        //         beforeSend: function() {
        //             $('.btnok').attr('disable', 'disabled');
        //             $('.btnok').html('<i class="fa fa-spin fa-spinner"></i>');
        //         },
        //         complete: function() {
        //             $('.btnok').removeAttr('disable', 'disabled');
        //             $('.btnok').html('<?= lang('app.btnOK') ?>');
        //         },
        //         success: function(response) {
        //             $('#mbarang, #mjumlah, #mcatatan').removeClass('is-invalid');
        //             $('.errmbarang, .errmjumlah, .errmcatatan').html('');
        //             if (response.error) { //dari msg save lampiran
        //                 handleFieldError('mbarang', response.error.mbarang);
        //                 handleFieldError('mjumlah', response.error.mjumlah);
        //                 handleFieldError('mcatatan', response.error.mcatatan);
        //             } else {
        //                 clearElements();
        //                 flashdata('success', response.sukses);
        //                 $('#modal-lampiran').modal('hide');
        //                 dataitembarang();
        //             }

        //             function handleFieldError(field, error) {
        //                 if (error) {
        //                     $('#' + field).addClass('is-invalid');
        //                     $('.err' + field).html(error);
        //                 } else {
        //                     $('#' + field).removeClass('is-invalid');
        //                 }
        //             }

        //             function clearElements() {
        //                 $(".js-example-data-ajax").empty().append(`<option value=""><?= lang('app.pilihsr') ?></option>`);
        //                 $("#mjumlah").val('');
        //                 $("#msatuan").val('');
        //                 $("#mcatatan").val('');
        //             }
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             alert(xhr.status + "\n" + xhr.responseText);
        //             alert(thrownError);
        //         }
        //     });
        // });
    });
</script>