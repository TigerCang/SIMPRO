<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<?= (session()->getFlashdata('judul') ? "<div onload=\"flashdata('success','" . session()->getFlashdata('judul') . "')\"></div>" : '') ?>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgList') ?>">
                    <h5><?= lang('app.daftardata') ?></h5>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="dt-responsive table-responsive">
                        <table id="tabelawal" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr class="bghead">
                                    <th scope="col" width="10">#</th>
                                    <th scope="col"><?= lang('app.username') ?></th>
                                    <th scope="col"><?= lang('app.pegawai') ?></th>
                                    <th scope="col"><?= lang('app.role') ?></th>
                                    <th scope="col" width="50" data-orderable="false" class="text-center"><?= lang('app.create') ?></th>
                                    <th scope="col" width="50" data-orderable="false" class="text-center"><?= lang('app.update') ?></th>
                                    <th scope="col" width="50" data-orderable="false" class="text-center"><?= lang('app.pasti') ?></th>
                                    <th scope="col" width="50" data-orderable="false" class="text-center"><?= lang('app.aktif') ?></th>
                                    <th scope="col" width="50" data-orderable="false" class="text-center"><?= lang('app.atasan') ?></th>
                                    <th scope="col" width="50" class="text-center"><?= lang('app.setuju') ?></th>
                                    <th scope="col" class="text-right"><?= lang('app.batas') ?></th>
                                    <th scope="col" width="10"><?= lang('app.status') ?></th>
                                    <th scope="col" width="10" data-orderable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($user as $row) :
                                    $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
                                    <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                                        <td><?= ($nomor++) ?>.</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h7><?= $row->kode ?></h7>
                                                <p class="text-muted m-b-0"><?= $row->peminta ?></p>
                                            </div>
                                        </td>
                                        <td><?= $row->namauser ?></td>
                                        <td><?= $row->role ?></td>
                                        <td class="text-center"><?= ($row->act_create == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                                        <td class="text-center"><?= ($row->act_edit == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                                        <td class="text-center"><?= ($row->act_confirm == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                                        <td class="text-center"><?= ($row->act_aktif == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                                        <td class="text-center"><?= ($row->act_super == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                                        <td class="text-center"><?= ($row->acc_setuju == '' ?  $row->acc_setuju : lang('app.' . substr($row->acc_setuju, 0, 8)) . ' ' . substr($row->acc_setuju, -1)) ?></td>
                                        <td class="text-right"><?= formatkoma($row->batasacc) ?></td>
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