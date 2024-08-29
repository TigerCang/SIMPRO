<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col"><?= lang('app.noakun') ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col"><?= lang('app.kategori') ?></th>
            <th scope="col"><?= lang('app.subakun') ?></th>
            <th scope="col" class="text-center"><?= lang('app.dk') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($akun as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td><?= str_repeat("&emsp;", $row->level - 1) . $row->noakun ?></td>
                <td><?= $row->nama ?></td>
                <td><?= lang('app.' . $row->kategori) ?></td>
                <td><?= $row->namasub ?></td>
                <td align="<?= ($row->posisi == '1' ? '' : 'right') ?>"><?= ($row->posisi == '1' ? lang("app.debit") : lang("app.kredit")) ?></td>
                <td class="text-center"><label class="label <?= $status['class'] ?>"><?= $status['text'] ?></label></td>
                <td>
                    <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                        <div class="dropdown-menu eddm dropdown-menu-right">
                            <a class="dropdown-item eddi" href="/akuntansi/input/<?= $row->idunik ?>"><?= lang('app.detil') ?></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>