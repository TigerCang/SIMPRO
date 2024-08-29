<?php
[$rhid, $ahid, $nhid, $thid, $khid, $phid, $shid] = array_map(function ($hid) {
    return $hid == '1' ? '' : 'hidden';
}, str_split($rantkps)); ?>
<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col" <?= $rhid ?>><?= lang('app.rekan') ?></th>
            <th scope="col" <?= $thid ?>><?= lang('app.kode') ?></th>
            <th scope="col" <?= $ahid ?>><?= lang('app.kode') ?></th>
            <th scope="col" <?= $nhid ?>><?= lang('app.nomor') ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col" <?= $khid ?>><?= lang('app.kategori') ?></th>
            <th scope="col" <?= $phid ?>><?= lang('app.perusahaan') ?></th>
            <th scope="col" <?= $phid ?>><?= lang('app.divisi') ?></th>
            <th scope="col" class="text-right" <?= $shid ?>><?= lang('app.sewa') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($alat as $row) :
            $status = statuslabel('master', ($row->is_aktif == '1' ? $row->is_confirm : 'a')) ?>
            <tr <?= ($row->xlog == null ? "class='fonbol'" : "") ?>>
                <td><?= $nomor++ ?>.</td>
                <td <?= $rhid ?>><?= $row->namarekan ?></td>
                <td <?= $thid ?>><?= $row->kode ?></td>
                <td <?= $ahid ?>>
                    <div class="d-inline-block align-middle">
                        <h7><?= $row->kode ?></h7>
                        <p class="text-muted m-b-0"><?= $row->nomor ?></p>
                    </div>
                </td>
                <td <?= $nhid ?>><?= $row->nomor ?></td>
                <td><?= $row->nama ?></td>
                <td <?= $khid ?>><?= $row->kategorialat ?></td>
                <td <?= $phid ?>><?= $row->perusahaan ?></td>
                <td <?= $phid ?>>
                    <div class="d-inline-block align-middle">
                        <h7><?= $row->divisi ?></h7>
                        <p class="text-muted m-b-0"><?= $row->wilayah ?></p>
                    </div>
                </td>
                <td <?= $shid ?> class="text-right"><?= formatkoma($row->ni_sewa) ?></td>
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