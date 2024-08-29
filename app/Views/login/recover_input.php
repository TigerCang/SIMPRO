<?= $this->extend('layout/templatelogin') ?>
<?= $this->section('contentlogin') ?>

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-8"><img src="libraries\assets\images\auth\login-page1.png" alt="logo.png"></div>
            <div class="col-sm-4 mt-5">
                <form class="md-float-material form-material" action="/login/reset" method="post">
                    <div class="text-center"><img src="libraries\assets\images\logo.png" alt="logo.png"></div>

                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-10">
                                <div class="col-md-12">
                                    <h3 class="text-center fontlogin"><?= lang('app.log_pulih') ?></h3>
                                </div>
                            </div>
                            <!--  -->
                            <?php if (session()->getFlashdata('pesanlogin')) :
                                $class = session()->getFlashdata('pesanlogin') == lang("app.mintaresetsukses") ? 'success' : 'danger'; ?>
                                <div class="alert alert-<?= $class ?> background-<?= $class ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i></button>
                                    <?= session()->getFlashdata('pesanlogin') ?>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="<?= lang('app.username') ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="<?= lang('app.kodepeg') ?>">
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn <?= lang('app.btncLogin') ?> btn-block waves-effect waves-light text-center m-b-10"><?= lang('app.btnRecover') ?></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-left f-left fontver">
                                        <?= lang('app.xversi') ?>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        <a href="/login" class="text-right f-w-600"><?= lang('app.log_kembali') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Akhir card -->

                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>