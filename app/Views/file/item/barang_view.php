<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?= (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : '') ?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                    <div class="job-badge"><a href="/<?= $menu ?>/input" class="btn <?= $btnclascr ?>" <?= $actcreate ?>><?= $btntextcr ?></a></div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row rownol">
                        <label for="pilihan" class="col-sm-1 col-form-label"><?= lang('app.pilihan') ?> : </label>
                        <div class="col-sm-4">
                            <select id="kategori" class="js-example-basic-single" name="kategori">
                                <option value="all"><?= lang('app.semua-') ?></option>
                                <?php foreach ($katbarang as $db) : ?>
                                    <option value="<?= $db->kategori ?>" <?= (session()->getFlashdata('kate') == $db->kategori ? 'selected' : ($katbarang[0]->kategori == $db->kategori ? 'selected' : '')) ?>><?= $db->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
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
        var getKategori = $("#kategori").val();
        var getMenu = '<?= $menu ?>';
        var getIhid = '<?= $ihid ?>';
        var getBhid = '<?= $bhid ?>';
        $.ajax({
            url: "/<?= $menu ?>/tabdata",
            data: {
                kategori: getKategori,
                menu: getMenu,
                ihid: getIhid,
                bhid: getBhid,
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
        caridata();
    });
</script>

<?= $this->endSection() ?>