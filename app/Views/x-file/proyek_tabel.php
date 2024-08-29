<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col"><?= lang('app.kode') ?></th>
            <th scope="col"><?= lang('app.namapaket') ?></th>
            <th scope="col"><?= lang('app.perusahaan') ?></th>
            <th scope="col"><?= lang('app.tahun') ?></th>
            <th scope="col" class="text-right"><?= lang('app.kontrak') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($proyek as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td><?= $row->kode ?></td>
                <td><?= $row->paket ?></td>
                <td>
                    <div class="d-inline-block align-middle">
                        <h7><?= $row->perusahaan ?></h7>
                        <p class="text-muted m-b-0"><?= $row->wilayah ?></p>
                    </div>
                </td>
                <td><?= $row->periode1 ?></td>
                <td class="text-right"><?= formatkoma($row->ni_kontrak) ?></td>
                <td class="text-center"><label class="label <?= $status['class'] ?>"><?= $status['text'] ?></label></td>
                <td>
                    <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                        <div class="dropdown-menu eddm dropdown-menu-right">
                            <a class="dropdown-item eddi" href="/proyek/input/<?= $row->idunik ?>"><?= lang('app.detil') ?></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>