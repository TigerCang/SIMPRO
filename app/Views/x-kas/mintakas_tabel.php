<table id="tabelload" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead">
            <th scope="col" width="10">#</th>
            <th scope="col" width="100"><?= lang('app.tanggal') ?></th>
            <th scope="col"><?= lang('app.peminta') . ' : ' . lang('app.user') ?></th>
            <th scope="col"><?= lang('app.nodoc') ?></th>
            <th scope="col"><?= lang('app.perusahaan') ?></th>
            <th scope="col"><?= ($tujuan == 'proyek' ? lang('app.wilayah') : lang('app.divisi')) ?></th>
            <th scope="col"><?= lang('app.' . $tujuan) ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col" width="10"><?= lang('app.setuju') ?></th>
            <th scope="col" width="10"><?= lang('app.status') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        $noalat = '';
        foreach ($kas as $row) :
            $status = statuslabel('biayakas', $row->status);
            switch ($row->tujuan) {
                case 'tool':
                case 'alat':
                    $kodebeban = $row->alat;
                    $deskbeban = $row->namaalat;
                    $noalat = $row->nomoralat;
                    break;
                case 'camp':
                    $kodebeban = $row->camp;
                    $deskbeban = $row->namacamp;
                    break;
                case 'tanah':
                    $kodebeban = $row->tanah;
                    $deskbeban = $row->namatanah;
                    break;
                case 'proyek':
                    $kodebeban = $row->proyek;
                    $deskbeban = $row->paketproyek;
                    break;
            } ?>
            <tr class="<?= ($row->xlog == null ? ' fonbol' : '') ?>">
                <td><?= $nomor++ ?>.</td>
                <td><?= formattanggal($row->tgl_minta) ?></td>
                <td><?= $row->kodepeminta . ' : ' . $row->kodeuser ?></td>
                <td><?= $row->nodoc . ' (' . $row->revisi . ')' ?></td>
                <td><?= $row->perusahaan ?></td>
                <td>
                    <div class="d-inline-block align-middle">
                        <h7><?= ($tujuan == 'proyek' ? $row->wilayah : $row->divisi) ?></h7>
                        <p class="text-muted m-b-0"><?= ($tujuan == 'proyek' ? $row->divisi : $row->wilayah) ?></p>
                    </div>
                </td>
                <td>
                    <div class="d-inline-block align-middle">
                        <h7><?= $kodebeban ?></h7>
                        <p class="text-muted m-b-0"><?= $noalat ?></p>
                    </div>
                </td>
                <td><?= $deskbeban ?></td>
                <td></td>
                <!-- <td class="text-center"><= $row->level_pos . ' | ' ?><= ($row->acc_1 == '1' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>') ?></td> -->
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