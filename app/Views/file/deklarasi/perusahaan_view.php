<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php echo (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : ''); ?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                    <div class="job-badge" <?= ($menu == 'tautp' ? 'hidden' : '') ?>><?= "<a href='/perusahaan/input' class='btn $btnclascr' $actcreate>$btntextcr</a>"; ?></div>
                </div>
                <!-- <div class="card-header-right"><ul class="list-unstyled card-option"><li><i class="feather icon-chevrons-down minimize-card"></i></li>
                    <li><i class="feather icon-maximize full-card"></i></li><li><i class="feather icon-x close-card"></i></li></ul>
                    </div> -->
                <!--  -->
                <div class="card-block mt-2">
                    <div class="dt-responsive table-responsive">
                        <table id="tabelawal" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr class='bghead'>
                                    <th scope="col" width="10">#</th>
                                    <th scope="col" width="120"><?= lang('app.kode') ?></th>
                                    <th scope="col"><?= lang('app.deskripsi') ?></th>
                                    <th scope="col" <?= $ahid ?>><?= lang('app.alamat') ?></th>
                                    <th scope="col"><?= lang('app.kota') ?></th>
                                    <th scope="col" <?= $phid ?>><?= lang('app.penerima') ?></th>
                                    <th scope="col" width="10"><?= lang('app.status') ?></th>
                                    <th scope="col" width="10" data-orderable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($perusahaan as $row) :
                                    $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
                                    <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                                        <td><?= $nomor++ ?>.</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h7><?= $row->kode ?></h7>
                                                <p class="text-muted m-b-0"><?= $row->kui ?></p>
                                            </div>
                                        </td>
                                        <td><?= $row->nama ?></td>
                                        <td <?= $ahid ?>><?= $row->alamat ?></td>
                                        <td><?= $row->kota ?></td>
                                        <td <?= $phid ?>>
                                            <div class="d-inline-block align-middle">
                                                <h7><?= $row->kodepenerima ?></h7>
                                                <p class="text-muted m-b-0"><?= $row->namapenerima ?></p>
                                            </div>
                                        </td>
                                        <td class="text-center"><label class="label <?= $status['class'] ?>"><?= $status['text'] ?></label></td>
                                        <td>
                                            <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                                                <div class="dropdown-menu eddm dropdown-menu-right">
                                                    <a class="dropdown-item eddi" href="/<?= $menu ?>/input/<?= $row->idunik ?>"><?= lang('app.detil') ?></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
</div><!-- body end -->

<?= $this->endSection() ?>