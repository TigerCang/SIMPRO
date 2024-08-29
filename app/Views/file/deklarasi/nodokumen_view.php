<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?= (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : '') ?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                    <div class="job-badge"><a href="/nodokumen/input" class="btn <?= $btnclascr ?>" <?= $actcreate ?>><?= $btntextcr ?></a></div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="dt-responsive table-responsive">
                        <table id="tabelawal" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr class="bghead">
                                    <th scope="col" width="10">#</th>
                                    <th scope="col" width="120"><?= lang('app.kelompok') ?></th>
                                    <th scope="col"><?= lang('app.form') ?></th>
                                    <th scope="col"><?= lang('app.nodokumen') ?></th>
                                    <th scope="col" width="10"><?= lang('app.status') ?></th>
                                    <th scope="col" width="10" data-orderable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($iso as $row) :
                                    $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
                                    <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                                        <td><?= $nomor++ ?>.</td>
                                        <td><?= lang('app.' . $row->kelompok) ?></td>
                                        <td><?= lang('app.' . $row->param) ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td class="text-center"><label class="label <?= $status['class'] ?>"><?= $status['text'] ?></label></td>
                                        <td>
                                            <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                                                <div class="dropdown-menu eddm dropdown-menu-right">
                                                    <a class="dropdown-item eddi" href="/nodokumen/input/<?= $row->idunik ?>"><?= lang('app.detil') ?></a>
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