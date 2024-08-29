<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <!-- phone -->
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#"><i class="feather icon-toggle-right klikini"></i></a>
            <a><img class="img-fluid" src="\libraries\assets\images\logo.png" alt="Theme-Logo"></a>
            <a class="mobile-options"><i class="feather icon-layers"></i></a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li><a href="/" data-toggle="tooltip" title="<?= lang('app.home') ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="#" data-toggle="tooltip" title="<?= lang('app.layar') ?>" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize-2 full-screen"></i></a></li>
                <li><a class="modalcari" href="#" data-toggle="tooltip" title="<?= lang('app.cari+') ?>"><i class="fa fa-search"></i></a></li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i></div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li><a class="dropdown-item" href="<?= site_url('lang/id') ?>"><span class="flag-icon flag-icon-IDR"></span>&emsp;<?= lang('app.bahasaindo') ?></a></li>
                            <li><a class="dropdown-item" href="<?= site_url('lang/en') ?>"><span class="flag-icon flag-icon-USD"></span>&emsp;<?= lang('app.bahasaingg') ?></a></li>
                        </ul>
                    </div>
                </li><!-- End Bahasa -->
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icofont icofont-notification"></i>
                            <span class="badge bg-c-blue">4</span>
                        </div>
                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <h6><?= lang('app.notifikasi') ?></h6>
                                <label class="label label-danger"><?= lang('app.baru') ?></label>
                            </li>
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="notification-user">Perbaikan Alat</h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li><!-- End Notifikasi -->
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url('assets/fileimg/pegawai/' . session()->avatar) ?>" class="img-radius" alt="Avatar">
                            <!-- <span><= session('username') ?></span> -->
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li><a href="/profile"><i class="icofont icofont-business-man"></i>&emsp;<?= lang('app.profil') ?></a></li>
                            <li><a href="#"><i class="icofont icofont-settings"></i>&emsp;<?= lang('app.atur') ?></a></li>
                            <li><a href="/sandi"><i class="fa fa-unlock-alt"></i>&emsp;<?= lang('app.sandi') ?></a></li>
                            <li><a href="/logdata"><i class="icofont icofont-list"></i>&emsp;<?= lang('app.aktifitas') ?></a></li>
                            <li><a href="/logout"><i class="icofont icofont-logout"></i>&emsp;<?= lang('app.logout') ?></a></li>
                        </ul>
                    </div>
                </li><!-- End Profile -->
            </ul>
        </div>

    </div>
</nav>
<div class="modallampiran" style="display: none;"></div>

<!-- Di bagian bawah halaman HTML Anda -->
<script>
    $(document).ready(function() {
        $('.modalcari').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/modalnav",
                // data: {
                //     idunik: getIDU,
                //     xpilih: 'alat',
                // },
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
        });
    });
</script>