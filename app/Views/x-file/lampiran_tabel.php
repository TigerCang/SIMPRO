<table id="tabelload2" class="table table-striped table-hover nowrap">
    <thead>
        <tr class="bghead2">
            <th scope="col" width="10">#</th>
            <th scope="col"><?= lang('app.judul') ?></th>
            <th scope="col"><?= lang('app.deskripsi') ?></th>
            <th scope="col" width="100"><?= lang('app.tanggal') ?></th>
            <th scope="col" width="150"><?= lang('app.upby') ?></th>
            <th scope="col" width="10" data-orderable="false"></th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($lampiran as $row) : ?>
            <tr>
                <td><?= $nomor++ ?>.</td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= formattanggal($row['tanggal']) ?></td>
                <td><?= $row['user'] ?></td>
                <td>
                    <div class="dropdown-primary dropdown"><?= lang('app.btnDropdown') ?>
                        <div class="dropdown-menu eddm dropdown-menu-right">
                            <!-- <a class="dropdown-item eddi" href='" . base_url('assets/berkas') . '/' . $xpilih . '/' . $row['lampiran'] . "'>" . lang('app.unduh') . "</a>
                                <a class='dropdown-item eddi' onclick=\"hapus('" . $row['id'] . "','" . $xpilih . "','" . $row['lampiran'] . "','" . $row['judul'] . "')\">" . lang('app.hapus') . "</a> -->
                            <a class="dropdown-item eddi" href="<?= base_url('assets/berkas/' . $xpilih . '/' . $row['lampiran']) ?>"><?= lang('app.unduh') ?></a>
                            <a class="dropdown-item eddi" onclick="hapus('<?= $row['id'] ?>', '<?= $xpilih ?>', '<?= $row['lampiran'] ?>', '<?= $row['judul'] ?>')"><?= lang('app.hapus') ?></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>
<script>
    function hapus(id, pilih, lampiran, judul) {
        var url = '/<?= $xpilih ?>/dellampir';
        Swal.fire({
            title: '<?= lang('app.tanyadel2') ?>',
            text: "<?= lang('app.infodel') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.confirmdel') ?>',
            cancelButtonText: '<?= lang('app.batal') ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        id: id,
                        xpilih: pilih,
                        lampiran: lampiran,
                        judul: judul,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) { //dari msg save lampiran
                            flashdata('success', response.sukses);
                            datalampiran();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText);
                        alert(thrownError);
                    }
                });
            }
        })
    }
</script>