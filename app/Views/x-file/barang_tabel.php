<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col"><?= lang('app.kategori') ?></th>
            <th scope="col"><?= lang('app.kode') ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col" <?= $ihid ?>><?= lang('app.merk') ?></th>
            <th scope="col" class="text-right" <?= $bhid ?>><?= lang('app.harga') ?></th>
            <th scope="col" class="text-center"><?= lang('app.satuan') ?></th>
            <th scope="col" width="10" class="text-center" <?= $ihid ?>>S.N.</th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($barang as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td><?= $row->kategori ?></td>
                <td><?= $row->kode ?></td>
                <td><?= $row->nama ?></td>
                <td <?= $ihid ?>><?= $row->merk ?></td>
                <td class="text-right" <?= $bhid ?>><?= formatkoma($row->harga) ?></td>
                <td class="text-center"><?= $row->satuan ?></td>
                <td align="center" <?= $ihid ?>><?= ($row->use_serial == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
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

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>