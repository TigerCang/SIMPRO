<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- A14 155 -->
<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($role ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($role ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($role && $role[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <div class="form-group row">
                        <label for="pilihan" class="col-sm-1 col-form-label"><?= lang('app.kategori') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly id="pilihan" name="pilihan" value="<?= lang('app.role') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.deskripsi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi <?= (($role && $role[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($role[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
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
                                    <span><?= lang("app.upby") . ' : ' . ($role[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($role[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($role[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">

            <div class="card">
                <div class="card-header <?= ($role ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= strtoupper(lang('app.berkas')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="card-block tree-view">
                        <?php $menu1 = ($role[0]->menu_1 ?? '') ?>
                        <div id="checkTree1">
                            <ul>
                                <li id="A01" data-jstree='{<?= (preg_match("/A01/i", $menu1) ? ',"selected":"true"' : '') ?>}'><?= lang('app.admin') ?>
                                    <ul>
                                        <li id="101" data-jstree='{"type":"file" <?= (preg_match("/101/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.db') ?></li>
                                        <li id="102" data-jstree='{"type":"file" <?= (preg_match("/102/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.config') ?></li>
                                        <li id="103" data-jstree='{"type":"file" <?= (preg_match("/103/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.role') ?></li>
                                        <li id="104" data-jstree='{"type":"file" <?= (preg_match("/104/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.user') ?></li>
                                        <li id="105" data-jstree='{"type":"file" <?= (preg_match("/105/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.loguser') ?></li>
                                        <li id="106" data-jstree='{"type":"file" <?= (preg_match("/106/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.resetpass') ?></li>
                                    </ul>
                                </li>
                                <li id="A02" data-jstree='{<?= (preg_match("/A02/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.deklar') ?>
                                    <ul>
                                        <li id="107" data-jstree='{"type":"file" <?= (preg_match("/107/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.perusahaan') ?></li>
                                        <li id="108" data-jstree='{"type":"file" <?= (preg_match("/108/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.wilayah') ?></li>
                                        <li id="109" data-jstree='{"type":"file" <?= (preg_match("/109/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.divisi') ?></li>
                                        <li id="140" data-jstree='{"type":"file" <?= (preg_match("/140/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.user') ?></li>
                                        <li id="xA02" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="110" data-jstree='{"type":"file" <?= (preg_match("/110/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.satuan') ?></li>
                                        <li id="111" data-jstree='{"type":"file" <?= (preg_match("/111/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.gudang') ?></li>
                                        <li id="112" data-jstree='{"type":"file" <?= (preg_match("/112/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.nodokumen') ?></li>
                                        <li id="113" data-jstree='{"type":"file" <?= (preg_match("/113/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.noform') ?></li>
                                        <li id="114" data-jstree='{"type":"file" <?= (preg_match("/114/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.propkabu') ?></li>
                                        <li id="xA02" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="A03" data-jstree='{<?= (preg_match("/A03/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.biayaproyek') ?>
                                            <ul>
                                                <li id="115" data-jstree='{"type":"file" <?= (preg_match("/115/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.katproyek') ?></li>
                                                <li id="116" data-jstree='{"type":"file" <?= (preg_match("/116/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.biayal') ?></li>
                                                <li id="117" data-jstree='{"type":"file" <?= (preg_match("/117/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.biayatl') ?></li>
                                                <li id="118" data-jstree='{"type":"file" <?= (preg_match("/118/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.sumberdaya') ?></li>
                                            </ul>
                                        </li>
                                        <li id="A04" data-jstree='{<?= (preg_match("/A04/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.jarak') ?>
                                            <ul>
                                                <li id="119" data-jstree='{"type":"file" <?= (preg_match("/119/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.subruas') ?></li>
                                                <li id="120" data-jstree='{"type":"file" <?= (preg_match("/120/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.lokasi') ?></li>
                                            </ul>
                                        </li>
                                        <li id="A05" data-jstree='{<?= (preg_match("/A05/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.param') ?>
                                            <ul>
                                                <li id="121" data-jstree='{"type":"file" <?= (preg_match("/121/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.tarif') ?></li>
                                            </ul>
                                        </li>
                                        <li id="xA02" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="153" data-jstree='{"type":"file" <?= (preg_match("/153/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.anggaranbawaan') ?></li>
                                    </ul>
                                </li>
                                <li id="A06" data-jstree='{<?= (preg_match("/A06/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.cabangaset') ?>
                                    <ul>
                                        <li id="122" data-jstree='{"type":"file" <?= (preg_match("/122/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.camp') ?></li>
                                        <li id="A07" data-jstree='{<?= (preg_match("/A07/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.proyek') ?>
                                            <ul>
                                                <li id="123" data-jstree='{"type":"file" <?= (preg_match("/123/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.proyek') ?></li>
                                                <li id="124" data-jstree='{"type":"file" <?= (preg_match("/124/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.ruas') ?></li>
                                            </ul>
                                        </li>
                                        <li id="xA06" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="A08" data-jstree='{<?= (preg_match("/A08/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.alat') ?>
                                            <ul>
                                                <li id="125" data-jstree='{"type":"file" <?= (preg_match("/125/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.katalat') ?></li>
                                                <li id="126" data-jstree='{"type":"file" <?= (preg_match("/126/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.alat') ?></li>
                                            </ul>
                                        </li>
                                        <li id="127" data-jstree='{"type":"file" <?= (preg_match("/127/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.tanah') ?></li>
                                        <li id="xA06" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="154" data-jstree='{"type":"file" <?= (preg_match("/154/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.tool') ?></li>
                                        <li id="128" data-jstree='{"type":"file" <?= (preg_match("/128/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.inventaris') ?></li>
                                    </ul>
                                </li>
                                <li id="A09" data-jstree='{<?= (preg_match("/A09/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.akuntansi') ?>
                                    <ul>
                                        <li id="129" data-jstree='{"type":"file" <?= (preg_match("/129/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.coa') ?></li>
                                        <li id="130" data-jstree='{"type":"file" <?= (preg_match("/130/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.akungrup') ?></li>
                                        <li id="131" data-jstree='{"type":"file" <?= (preg_match("/131/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.akunbawaan') ?></li>
                                        <li id="132" data-jstree='{"type":"file" <?= (preg_match("/132/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.kasbank') ?></li>
                                        <li id="133" data-jstree='{"type":"file" <?= (preg_match("/133/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.pajak') ?></li>
                                        <li id="xA09" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="134" data-jstree='{"type":"file" <?= (preg_match("/134/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.dokumenpajak') ?></li>
                                    </ul>
                                </li>
                                <li id="A10" data-jstree='{<?= (preg_match("/A10/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.item') ?>
                                    <ul>
                                        <li id="135" data-jstree='{"type":"file" <?= (preg_match("/135/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.sparepart') ?></li>
                                        <li id="137" data-jstree='{"type":"file" <?= (preg_match("/137/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.bahan') ?></li>
                                        <li id="138" data-jstree='{"type":"file" <?= (preg_match("/138/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.bekas') ?></li>
                                        <li id="139" data-jstree='{"type":"file" <?= (preg_match("/139/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.nonstok') ?></li>
                                        <li id="xA10" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="136" data-jstree='{"type":"file" <?= (preg_match("/136/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.sn') ?></li>
                                    </ul>
                                </li>
                                <li id="A11" data-jstree='{<?= (preg_match("/A11/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.penerima') ?>
                                    <ul>
                                        <li id="141" data-jstree='{"type":"file" <?= (preg_match("/141/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.penerima') ?></li>
                                        <li id="142" data-jstree='{"type":"file" <?= (preg_match("/142/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.tautperusahaan') ?></li>
                                        <li id="xA11" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="143" data-jstree='{"type":"file" <?= (preg_match("/143/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.mobilrekan') ?></li>
                                    </ul>
                                </li>
                                <li id="A12" data-jstree='{<?= (preg_match("/A12/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.sdm') ?>
                                    <ul>
                                        <li id="144" data-jstree='{"type":"file" <?= (preg_match("/144/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.jabatan') ?></li>
                                        <li id="145" data-jstree='{"type":"file" <?= (preg_match("/145/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.golongan') ?></li>
                                        <li id="146" data-jstree='{"type":"file" <?= (preg_match("/146/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.cuti') ?></li>
                                        <li id="147" data-jstree='{"type":"file" <?= (preg_match("/147/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.katrating') ?></li>
                                        <li id="xA12" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="148" data-jstree='{"type":"file" <?= (preg_match("/148/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.kalender') ?></li>
                                        <li id="149" data-jstree='{"type":"file" <?= (preg_match("/149/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.pengumuman') ?></li>
                                        <li id="xA12" data-jstree='{"icon":"xx","disabled" : "true"}'><?= lang('app.spgaris') ?></li>
                                        <li id="150" data-jstree='{"type":"file" <?= (preg_match("/150/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.pegawai') ?></li>
                                        <li id="A13" data-jstree='{<?= (preg_match("/A13/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.gaji') ?>
                                            <ul>
                                                <li id="151" data-jstree='{"type":"file" <?= (preg_match("/151/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.atribut') ?></li>
                                                <li id="152" data-jstree='{"type":"file" <?= (preg_match("/152/i", $menu1)) ? ',"selected":"true"' : '' ?>}'><?= lang('app.gaji') ?></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" readonly class="form-control" id="menu1" name="menu1" value="<?= ($role[0]->menu_1 ?? '') ?>">
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
        <div class="col-sm-12 col-lg-6">



        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">



        </div>
        <div class="col-sm-12 col-lg-6">



        </div>
    </div>
    <?= form_close() ?>
</div><!-- body end -->

<script>
    $('#checkTree1').on("changed.jstree", function(e, data) {
        var selected = [];
        for (i = 0; i < data.selected.length; i++) {
            selected = selected.concat($('#checkTree1').jstree(true).get_path(data.selected[i], false, true));
            //first false=I want an array; second true=I want only IDs
        }
        tree1 = selected.unique();
        document.getElementById('menu1').value = tree1;
    });

    $('#checkTree2').on("changed.jstree", function(e, data) {
        var selected = [];
        for (i = 0; i < data.selected.length; i++) {
            selected = selected.concat($('#checkTree2').jstree(true).get_path(data.selected[i], false, true));
        }
        tree2 = selected.unique();
        document.getElementById('menu2').value = tree2;
    });

    Array.prototype.unique = function() {
        return Array.from(new Set(this));
    }

    $(document).ready(function() {
        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/role/save';
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
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errnama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errnama').html('');
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