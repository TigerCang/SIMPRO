<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?= (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : ''); ?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                    <div class="job-badge"><a href="/proyek/input" class="btn <?= $btnclascr ?>" <?= $actcreate ?>><?= $btntextcr ?></a></div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row rownol">
                        <label for="pilihan" class="col-sm-1 col-form-label"><?= lang('app.pilihan') ?> : </label>
                        <div class="col-sm-3">
                            <select id="perusahaan" class="js-example-basic-single" name="perusahaan">
                                <option value="all" <?= ($tuser['act_perusahaan'] == '1' ? '' : 'disabled') ?>><?= lang('app.semua-') ?></option>
                                <?php foreach ($perusahaan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (session()->getFlashdata('perus') == $db->id ? 'selected' : '') . ($tuser['act_perusahaan'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['perusahaan']) ? '' : 'disabled') ?>><?= $db->kode ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select id="wilayah" class="js-example-basic-single" name="wilayah">
                                <option value="all" <?= ($tuser['act_divisi'] == '1' ? '' : 'disabled') ?>><?= lang('app.semua-') ?></option>
                                <?php foreach ($wilayah as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (session()->getFlashdata('wil') == $db->id ? 'selected' : '') . ($tuser['act_wilayah'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['wilayah']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" id="tahun" name="tahun" value="<?= (session()->getFlashdata('thn') ?? date("Y")) ?>" min="2000" max="2100">
                        </div>
                        <span class="input-group-addon"><i class="icofont icofont-search-alt-2" aria-hidden="true" onclick="caridata()"></i></span>
                    </div>
                    <div class="dt-responsive table-responsive viewdata mt-2"></div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
</div><!-- body end -->

<script>
    function caridata() {
        var getPerusahaan = $("#perusahaan").val();
        var getWilayah = $("#wilayah").val();
        var getTahun = $("#tahun").val();
        $.ajax({
            url: "/proyek/tabdata",
            data: {
                perusahaan: getPerusahaan,
                wilayah: getWilayah,
                tahun: getTahun,
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    $(document).ready(function() {
        var selectPerusahaan = $('#perusahaan');
        var selectedPerusahaan = selectPerusahaan.val();
        var selectWilayah = $('#wilayah');
        var selectedWilayah = selectWilayah.val();

        if (selectedPerusahaan && selectedPerusahaan !== 'all' && selectedWilayah && selectedWilayah !== 'all') {
            caridata()
            return;
        } else {
            selectPerusahaan.find('option').each(function() {
                if (!$(this).is(':disabled') && $(this).val() !== 'all') {
                    $(this).prop('selected', true);
                    return false;
                }
            });
            selectWilayah.find('option').each(function() {
                if (!$(this).is(':disabled') && $(this).val() !== 'all') {
                    $(this).prop('selected', true);
                    return false;
                }
            });
        }
        caridata();
    });
</script>

<?= $this->endSection() ?>