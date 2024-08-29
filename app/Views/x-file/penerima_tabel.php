<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col" width="120"><?= lang('app.kategori') ?></th>
            <th scope="col"><?= lang('app.kode') ?></th>
            <th scope="col"><?= lang('app.nama') ?></th>
            <th scope="col" width="70" class="text-center" data-orderable="false"><?= lang('app.pelanggan') ?></th>
            <th scope="col" width="70" class="text-center" data-orderable="false"><?= lang('app.suplier') ?></th>
            <th scope="col" width="70" class="text-center" data-orderable="false"><?= lang('app.subkon') ?></th>
            <th scope="col" width="70" class="text-center" data-orderable="false"><?= lang('app.pegawai') ?></th>
            <th scope="col"><?= lang('app.rating') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($penerima as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td><?= $row->kategori ?></td>
                <td><?= $row->kode ?></td>
                <td><?= $row->nama ?></td>
                <td class="text-center"><?= ($row->st_pel == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                <td class="text-center"><?= ($row->st_sup == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                <td class="text-center"><?= ($row->st_lain == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                <td class="text-center"><?= ($row->st_peg == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                <td>
                    <?php for ($i = 0; $i < $row->rating; $i++) : ?>
                        <i class='fa fa-star' style='color:#01a9ac'></i>
                    <?php endfor; ?>
                </td>
                <td class="text-center"><label class="label <?= $status['class'] ?>"><?= $status['text'] ?></label></td>
                <td>
                    <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                        <div class="dropdown-menu eddm dropdown-menu-right">
                            <a class="dropdown-item eddi" href="/penerima/input/<?= $row->idunik ?>"><?= lang('app.detil') ?></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>