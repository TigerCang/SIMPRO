<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php
$prop = ($propinsi1[0]->propinsi ?? '');
$kab = ($propinsi1[0]->id ?? ''); ?>
<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($proyek ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($proyek ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($proyek && $proyek[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="idperusahaan" name="idperusahaan" value="<?= ($proyek[0]->perusahaan_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idwilayah" name="idwilayah" value="<?= ($proyek[0]->wilayah_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="iddivisi" name="iddivisi" value="<?= ($proyek[0]->divisi_id ?? '') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($proyek && $proyek[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="10" placeholder="<?= lang('app.min10kar') ?>" value="<?= ($proyek[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.namaproyek') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($proyek[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paket" class="col-sm-1 col-form-label"><?= lang('app.namapaket') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="paket" name="paket" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($proyek[0]->paket ?? '') ?>">
                            <div id="error" class="invalid-feedback errpaket"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perusahaan" class="col-sm-1 col-form-label"><?= lang('app.perusahaan') ?></label>
                        <div class="col-sm-11">
                            <select id="perusahaan" class="js-example-basic-single" name="perusahaan" <?= (($proyek && $proyek[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($perusahaan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($proyek && $proyek[0]->perusahaan_id == $db->id) ? 'selected' : '') . ($tuser['act_perusahaan'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['perusahaan']) ? '' : 'disabled') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errperusahaan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wilayah" class="col-sm-1 col-form-label"><?= lang('app.wilayah') ?></label>
                        <div class="col-sm-4">
                            <select id="wilayah" class="js-example-basic-single" name="wilayah" <?= (($proyek && $proyek[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($wilayah as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($proyek && $proyek[0]->wilayah_id == $db->id) ? 'selected' : '') . ($tuser['act_wilayah'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['wilayah']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errwilayah"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="divisi" class="col-sm-1 col-form-label"><?= lang('app.divisi') ?></label>
                        <div class="col-sm-4">
                            <select id="divisi" class="js-example-basic-single" name="divisi" <?= (($proyek && $proyek[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($divisi as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($proyek && $proyek[0]->divisi_id == $db->id) ? 'selected' : '') . ($tuser['act_divisi'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['divisi']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errdivisi"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kbli" class="col-sm-1 col-form-label"><?= lang('app.kbli') ?></label>
                        <div class="col-sm-11">
                            <select id="kbli" class="js-example-data-ajax" name="kbli">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($kbli1) : ?> <option value="<?= $kbli1[0]->id ?>" selected><?= "{$kbli1[0]->kode} => {$kbli1[0]->nama}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkbli"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="an" class="col-sm-1 col-form-label"><?= lang('app.an') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="an" name="an" value="<?= ($proyek[0]->atasnama ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-1 col-form-label"><?= lang('app.lokasi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= ($proyek[0]->lokasi ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="propinsi" class="col-sm-1 col-form-label"><?= lang('app.propinsi') ?></label>
                        <div class="col-sm-4">
                            <select id="propinsi" class="js-example-basic-single" name="propinsi" onchange="loadkabupaten()">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($propinsi as $db) : ?>
                                    <option value="<?= $db->propinsi ?>" <?= (($prop == $db->propinsi)  ? 'selected' : '') ?>><?= $db->propinsi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="kabupaten" class="col-sm-1 col-form-label"><?= lang('app.kabupaten') ?></label>
                        <div class="col-sm-4">
                            <select id="kabupaten" class="js-example-basic-single" name="kabupaten">
                                <option value=""><?= lang('app.pilih-') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pemilik" class="col-sm-1 col-form-label"><?= lang('app.pemilik') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="pemilik" name="pemilik" value="<?= ($proyek[0]->pemilik ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cakupan" class="col-sm-1 col-form-label"><?= lang('app.cakupan') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="cakupan" name="cakupan" value="<?= ($proyek[0]->scope ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="carabayar" class="col-sm-1 col-form-label"><?= lang('app.carabayar') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="carabayar" name="carabayar" value="<?= ($proyek[0]->carabayar ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis" class="col-sm-1 col-form-label"><?= lang('app.jeniskerja') ?></label>
                        <div class="col-sm-8">
                            <select id="jenis" class="js-example-basic-single" name="jenis">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($katproyek as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($proyek && $proyek[0]->tipe_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errjenis"></div>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="xpajak" class="col-sm-1 col-form-label text-right"><?= lang('app.pajak') ?>&emsp;</label>
                        <div class="col-sm-1 text-right">
                            <input type="checkbox" id="pajak" name="pajak" data-toggle="toggle" <?= (($proyek && $proyek[0]->is_pajak == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light">
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">

            <div class="card">
                <div class="card-header <?= ($proyek ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.keuangan') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="nikontrak" class="col-sm-2 col-form-label"><?= lang('app.nikontrak') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nikontrak" name="nikontrak" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($proyek[0]->ni_kontrak ?? '') ?>" onchange="hitungppn()" />
                            <div id="error" class="invalid-feedback errnikontrak"></div>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="ppnps" class="col-sm-1 col-form-label"><?= lang('app.ppn') ?></label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="ppnps" name="ppnps" value="<?= ($proyek[0]->ppn ?? '') ?>" onchange="hitungppn()">
                        </div>
                        <label for="pphps" class="col-sm-2 col-form-label">&emsp;<?= lang('app.pph') ?></label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="pphps" name="pphps" value="<?= ($proyek[0]->pph ?? '') ?>" onchange="hitungppn()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nitbhkur" class="col-sm-2 col-form-label"><?= lang('app.nilai+-') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nitbhkur" name="nitbhkur" value="<?= ($proyek[0]->ni_tambah ?? '') ?>" onchange="hitungppn()" />
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="nilain" class="col-sm-1 col-form-label"><?= lang('app.lain+-') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nilain" name="nilain" value="<?= ($proyek[0]->ni_lain ?? '') ?>" onchange="hitungppn()" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nibruto" class="col-sm-2 col-form-label"><?= lang('app.nibruto') ?></label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nibruto" name="nibruto" value="<?= ($proyek[0]->ni_bruto ?? '') ?>">
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="nippn" class="col-sm-1 col-form-label"><?= lang('app.nippn') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nippn" name="nippn" value="<?= ($proyek[0]->ni_ppn ?? '') ?>" onchange="hitungppn2()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nipph" class="col-sm-2 col-form-label"><?= lang('app.nipph') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nipph" name="nipph" value="<?= ($proyek[0]->ni_pph ?? '') ?>" onchange="hitungppn2()">
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="ninetto" class="col-sm-1 col-form-label"><?= lang('app.ninetto') ?></label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="ninetto" name="ninetto" value="<?= ($proyek[0]->ni_netto ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir card -->

        </div>
        <div class="col-sm-3">

            <div class="card">
                <div class="card-header <?= ($proyek ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.tanggal') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="tglkontrak" class="col-sm-3 col-form-label"><?= lang('app.kontrak') ?></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tglkontrak" name="tglkontrak" value="<?= ($proyek[0]->tgl_kontrak ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglpho" class="col-sm-3 col-form-label">PHO</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tglpho" name="tglpho" value="<?= ($proyek[0]->tgl_pho ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglfho" class="col-sm-3 col-form-label">FHO</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tglfho" name="tglfho" value="<?= ($proyek[0]->tgl_fho ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="periode1" class="col-sm-3 col-form-label"><?= lang('app.periode') ?></label>
                        <div class="col-sm-4">
                            <input type="number" harusisi class="form-control" id="periode1" name="periode1" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($proyek[0]->periode1 ?? '') ?>" min="2025" max="2100">
                            <div id="error" class="invalid-feedback errperiode1"></div>
                        </div>
                        <label for="periode2" class="col-sm-1 col-form-label text-center">-</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="periode2" name="periode2" value="<?= ($proyek[0]->periode2 ?? '') ?>" min="2025" max="2100">
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($proyek ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.data+') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="konsultan" class="col-sm-1 col-form-label"><?= lang('app.konsultan') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="konsultan" name="konsultan"><?= ($proyek[0]->konsultan ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asuransi" class="col-sm-1 col-form-label"><?= lang('app.asuransi') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="asuransi" name="asuransi"><?= ($proyek[0]->asuransi ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keuangan" class="col-sm-1 col-form-label"><?= lang('app.keuangan') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="keuangan" name="keuangan"><?= ($proyek[0]->keuangan ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pelaksanaan" class="col-sm-1 col-form-label"><?= lang('app.pelaksanaan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="pelaksanaan" name="pelaksanaan" placeholder="<?= lang('app.harusisi') ?>"><?= ($proyek[0]->pelaksanaan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errpelaksanaan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($proyek[0]->catatan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errcatatan"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn <?= lang('app.btncLampir') . $actcreate ?> tambahlampiran" <?= $btnlam ?>><?= lang('app.btnLampir') ?></button>
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
                                    <span><?= lang("app.upby") . ' : ' . ($proyek[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($proyek[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($proyek[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
    <div class="row" <?= ($proyek ? '' : 'hidden') ?>>
        <div class="col-sm-12">
            <div class="dt-responsive table-responsive tabellampiran"></div>
        </div>
    </div>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    $("#perusahaan").on("change", () => $("#idperusahaan").val($("#perusahaan").val()));
    $("#wilayah").on("change", () => $("#idwilayah").val($("#wilayah").val()));
    $("#divisi").on("change", () => $("#iddivisi").val($("#divisi").val()));

    function datalampiran() {
        var getIDU = "<?= $idunik ?>";
        $.ajax({
            url: "/proyek/tablampir",
            data: {
                idunik: getIDU,
                xpilih: 'proyek',
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

    function hitungppn() {
        if (document.getElementById('nikontrak').value === '') document.getElementById('nikontrak').value = '0,00';
        if (document.getElementById('ppnps').value === '') document.getElementById('ppnps').value = '0,00';
        if (document.getElementById('pphps').value === '') document.getElementById('pphps').value = '0,00';
        if (document.getElementById('nitbhkur').value === '') document.getElementById('nitbhkur').value = '0,00';
        if (document.getElementById('nilain').value === '') document.getElementById('nilain').value = '0,00';

        var kontrak = formatAngka(document.getElementById('nikontrak').value, 'nol');
        var persenppn = formatAngka(document.getElementById('ppnps').value, 'nol');
        var persenpph = formatAngka(document.getElementById('pphps').value, 'nol');
        var tbhkur = formatAngka(document.getElementById('nitbhkur').value, 'nol');
        var lain = formatAngka(document.getElementById('nilain').value, 'nol');
        var bruto = parseFloat(kontrak) + parseFloat(tbhkur) + parseFloat(lain);
        var ppn = (parseFloat(bruto) * parseFloat(persenppn)) / (100 + parseFloat(persenppn));
        var netto = parseFloat(bruto) - parseFloat(ppn)
        var pph = parseFloat(persenpph) / 100 * parseFloat(netto)
        $('#nibruto').val(formatAngka(bruto, 'rp'));
        $('#nippn').val(formatAngka(ppn, 'rp'));
        $('#ninetto').val(formatAngka(netto, 'rp'));
        $('#nipph').val(formatAngka(pph, 'rp'));
    }

    function hitungppn2() {
        if (document.getElementById('nippn').value === '') document.getElementById('nippn').value = '0,00';
        if (document.getElementById('nipph').value === '') document.getElementById('nipph').value = '0,00';
        var bruto = formatAngka(document.getElementById('nibruto').value, 'nol');
        var ppn = formatAngka(document.getElementById('nippn').value, 'nol');
        var netto = parseFloat(bruto) - parseFloat(ppn)
        $('#ninetto').val(formatAngka(netto, 'rp'));
    }

    function loadkabupaten() {
        var getPropinsi = $("#propinsi").val();
        var getKabupaten = "<?= $kab ?>";
        $.ajax({
            type: "post",
            url: "/proyek/kabupaten",
            data: {
                propinsi: getPropinsi,
                kabupaten: getKabupaten
            },
            dataType: "json",
            success: function(response) { // Ketika proses pengiriman berhasil
                if (response.kabupaten) {
                    $("#kabupaten").html(response.kabupaten);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    $(document).ready(function() {
        datalampiran();
        loadkabupaten();

        $('.tambahlampiran').click(function(e) {
            e.preventDefault();
            var getIDU = "<?= $idunik ?>";
            $.ajax({
                url: "/proyek/modallampir",
                data: {
                    idunik: getIDU,
                    xpilih: 'proyek',
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

        $("#kbli").select2({
            ajax: {
                url: "/proyek/kbli",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        pilihan: 'kbli',
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
            var url = '/proyek/save';
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
                    $('#kode, #nama, #paket, #perusahaan, #wilayah, #divisi, #kbli, #jenis, #nikontrak, #periode1, #pelaksanaan, #catatan').removeClass('is-invalid');
                    $('.errkode, .errnama, .errpaket, .errperusahaan, .errwilayah, .errdivisi, .errkbli, .errjenis, .errnikontrak, .errperiode1, .errpelaksanaan, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('paket', response.error.paket);
                        handleFieldError('perusahaan', response.error.perusahaan);
                        handleFieldError('wilayah', response.error.wilayah);
                        handleFieldError('divisi', response.error.divisi);
                        handleFieldError('kbli', response.error.kbli);
                        handleFieldError('jenis', response.error.jenis);
                        handleFieldError('nikontrak', response.error.nikontrak);
                        handleFieldError('periode1', response.error.periode1);
                        handleFieldError('pelaksanaan', response.error.pelaksanaan);
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