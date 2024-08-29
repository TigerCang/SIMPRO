<table id="tabelload3" class="table table-striped table-hover nowrap">
    <thead>
        <?= "
        <tr class=$ada>
            <th scope='col' width='10'>#</th>
            <th scope='col'>" . ($tujuan == 'proyek' ? lang('app.itembiaya') : lang('app.noakun')) . "</th>
            <th scope='col'>" . lang('app.deskripsi') . "</th>
            <th scope='col' class='text-right'>" . ucfirst(lang('app.bulan')) . "</th>
            <th scope='col' class='text-right'>" . lang('app.jumlah') . "</th>
            <th scope='col' class='text-right'>" . lang('app.harga') . "</th>
            <th scope='col' class='text-right'>" . lang('app.total') . "</th>
            <th scope='col'>" . lang('app.catatan') . "</th>
            <th scope='col' width='10' data-orderable='false'></th>
        </tr>"; ?>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($anggaran as $row) :
            $spasi = str_repeat("&emsp;", $row->level - 1);
            $status = statuslabel('warnaang', $row->level);
            echo "<tr class='" . $status['class'] . "'>
                    <td>" . ($nomor++) . ".</td>
                    <td>" . $spasi . $row->kode . "</td>
                    <td>$row->deskripsi</td>
                    <td class='text-right'>" . ($row->level == '4' ? formatkoma($row->bulan) : '') . "</td>
                    <td class='text-right'>" . ($row->level == '4' ? formatkoma($row->jumlah) : '') . "</td>
                    <td class='text-right'>" . ($row->level == '4' ? formatkoma($row->harga) : '') . "</td>
                    <td class='text-right'>" . formatkoma($row->total) . "</td>
                    <td>$row->catatan</td>
                    <td>" . ($row->level == '4' ? "
                            <div class='dropdown-primary dropdown'>" . lang('app.btnDropdown') . "
                                <div class='dropdown-menu eddm dropdown-menu-right'>
                                    <a class='dropdown-item eddi ubahdata' data-id='" . $row->id . "'>" . lang('app.ubah') . "</a>
                                    <a class='dropdown-item eddi' onclick=\"hapus('" . $row->id . "','" . $row->kode . "')\">" . lang('app.hapus') . "</a>
                                </div>
                            </div>
                        " : '') . "</td>
                </tr>";
        endforeach ?>
    </tbody>
</table>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/load.js"></script>
<script>
    $('.ubahdata').click(function(e) {
        e.preventDefault();
        var getID = $(this).data('id');
        $.ajax({
            url: "/anggaran/modalkoreksi",
            data: {
                id: getID,
            },
            dataType: "json",
            success: function(response) {
                $('.modallampiran').html(response.data).show();
                $('#modal-lampiran').modal('show')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    })

    function hapus(id, kode) {
        var url = '/anggaran/delitem';
        Swal.fire({
            title: '<?= lang('app.tanyadel'); ?>',
            text: "<?= lang('app.infodel'); ?>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.confirmdel'); ?>',
            cancelButtonText: '<?= lang('app.batal'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        id: id,
                        kode: kode,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) { //dari msg save lampiran
                            flashdata('success', response.sukses);
                            databudget();
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