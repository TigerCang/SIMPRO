<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php echo (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : '') ?>
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
                    <div class="form-group row rownol" <?= $ket ?>>
                        <label for="pilihan" class="col-sm-1 col-form-label"><?= lang('app.pilihan') ?> : </label>
                        <div class="col-sm-4" <?= $chid ?>>
                            <select id="camp" class="js-example-basic-single" name="camp">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($camp as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (session()->getFlashdata('camp') == $db->id ? 'selected' : '') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-4" <?= $phid ?>>
                            <select id="proyek" class="js-example-data-ajax" name="proyek">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($proyek1) : ?> <option value="<?= $proyek1['0']->id ?>" selected><?= "{$proyek1['0']->kode} => {$proyek1['0']->paket}" ?></option><?php endif; ?>
                            </select>
                        </div>
                        <span class="input-group-addon"><i class="icofont icofont-search-alt-2" aria-hidden="true" onclick="datasubruas()"></i></span>
                    </div>
                    <div class="dt-responsive table-responsive viewdata mt-2"></div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
</div><!-- body end -->

<script>
    function datasubruas() {
        var getCamp = $("#camp").val();
        var getProyek = $("#proyek").val();
        $.ajax({
            url: "/<?= $menu ?>/tabdata",
            data: {
                camp: getCamp,
                proyek: getProyek,
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
        datasubruas();

        $("#proyek").select2({
            ajax: {
                url: "/<?= $menu ?>/loadproyek",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
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
    });
</script>

<?= $this->endSection() ?>