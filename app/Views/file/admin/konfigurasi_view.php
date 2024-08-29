<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="dt-responsive table-responsive viewdata mt-2"></div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    function caridata() {
        $.ajax({
            url: "/konfigurasi/tabdata",
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

        $('.ubahdata').click(function(e) {
            e.preventDefault();
            var getIDU = $(this).data('idunik');
            $.ajax({
                url: "/konfigurasi/updatedata",
                data: {
                    idunik: getIDU,
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
    });
</script>

<?= $this->endSection() ?>