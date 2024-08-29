<?php
[$lhid, $thid, $shid] = array_map(function ($hid) {
    return $hid == '1' ? '' : 'hidden';
}, str_split($lts)); ?>
<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col" width="120" <?= $lhid ?>><?= lang('app.katproyek') ?></th>
            <th scope="col"><?= lang('app.kode') ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col" class="text-center"><?= lang('app.satuan') ?></th>
            <th scope="col" width="70" class="text-center" <?= $shid ?>><?= lang('app.volum') ?></th>
            <th scope="col" <?= $thid ?>><?= lang('app.noakun') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($biaya as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td <?= $lhid ?>><?= $row->katproyek ?></td>
                <td>
                    <div class="d-inline-block align-middle">
                        <h7><?= str_repeat('&emsp;', $row->level - 1) . $row->kode ?></h7>
                        <p class="text-muted m-b-0" <?= $lhid ?>><?= str_repeat('&emsp;', $row->level - 1) . $row->matabayar ?></p>
                    </div>
                </td>
                <td><?= $row->nama ?></a></td>
                <td class="text-center"><?= $row->satuan ?></a></td>
                <td class="text-center" <?= $shid ?>><?= ($row->is_jumlah == '1' ? '<i class="fa fa-plus-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td>
                <td <?= $thid ?>>
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

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>