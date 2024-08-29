<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?php echo (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : ''); ?>
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
                    <div class="dt-responsive table-responsive">
                        <table id="tabelawal" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr class="bghead">
                                    <th scope="col" width="10">#</th>
                                    <th scope="col" width="120" <?= $shid ?>><?= lang('app.pilihan') ?></th>
                                    <th scope="col" width="120" <?= $khid ?>><?= lang('app.kelompok') ?></th>
                                    <th scope="col"><?= lang('app.deskripsi') ?></th>
                                    <th scope="col" <?= $phid ?>><?= lang('app.perusahaan') ?></th>
                                    <th scope="col" width='10' <?= $nhid ?>><?= lang('app.nilai') ?></th>
                                    <th scope="col"><?= lang('app.noakun') ?></th>
                                    <th scope="col" width="10"><?= lang('app.status') ?></th>
                                    <th scope="col" width="10" data-orderable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($defakun as $row) :
                                    $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
                                    <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                                        <td><?= ($nomor++) ?>.</td>
                                        <td <?= $shid ?>><?= lang('app.' . $row->submenu) ?></td>
                                        <td <?= $khid ?>><?= lang('app.' . $row->kelompok) ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td <?= $phid ?>>
                                            <div class="d-inline-block align-middle">
                                                <h7><?= $row->perusahaan ?></h7>
                                                <p class="text-muted m-b-0"><?= $row->divisi ?></p>
                                            </div>
                                        </td>
                                        <td class="text-center" <?= $nhid ?>><?= $row->nilai ?></td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h7><?= $row->noakun ?></h7>
                                                <p class="text-muted m-b-0"><?= $row->namaakun ?></p>
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