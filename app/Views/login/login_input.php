<?= $this->extend('layout/templatelogin') ?>
<?= $this->section('contentlogin') ?>

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-8"><img src="libraries\assets\images\auth\login-page1.png" alt="logo.png"></div>
            <div class="col-sm-4 mt-5">
                <form class="md-float-material form-material" action="/login/auth" method="post">
                    <div class="text-center"><img src="libraries\assets\images\logo.png" alt="logo.png"></div>

                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-10">
                                <div class="col-md-12">
                                    <h3 class="text-center fontlogin"><?= lang('app.log_info') ?></h3>
                                </div>
                            </div>
                            <!--  -->
                            <?php if (session()->getFlashdata('pesanlogin')) : ?>
                                <div class="alert alert-danger background-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled text-white"></i></button>
                                    <?= session()->getFlashdata('pesanlogin') ?>
                                </div>
                            <?php endif ?>
                            <!--  -->
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="<?= lang('app.username') ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-password" id="password" name="password" placeholder="<?= lang('app.sandi') ?>">
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-inline">
                                        <label>
                                            <input type="checkbox" id="showhide" class="ShowPassword" value="">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse"><?= lang('app.log_tampilpass') ?></span>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right"><a href="/recover" class="text-right f-w-600"><?= lang('app.log_lupa') ?></a></div>
                                </div>
                                <div class="col-12">
                                    <div class="forgot-phone text-right f-right"><a href="/newuser" class="text-right f-w-600"><?= lang('app.buatuser') ?></a></div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn <?= lang('app.btncLogin') ?> btn-block waves-effect waves-light text-center m-b-10"><?= lang('app.btnLogin') ?></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="fontver"><?= lang('app.xversi') ?></div>
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