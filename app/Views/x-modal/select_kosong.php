<div class="modal fade" id="modal-lampiran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header <?= lang('app.bgMselect') ?>">
                <h4 class="modal-title"><?= lang('app.titlepilih') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  -->
            <div class="card-block mt-2 mb-2">
                <div class="dt-responsive table-responsive">
                    <table id="tabelmodal" class="table table-striped table-hover nowrap">
                        <thead>
                            <?= "
                            <tr class='bghead'>
                                <th scope='col' width='10'>#</th>
                                <th scope='col'>" . lang('app.deskripsi') . "</th>
                                <th scope='col' width='10' data-orderable='false'></th>
                            </tr>"; ?>
                        </thead>
                        <tbody>
                            <?php
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td class='text-center'>" . lang('app.errnodatatabel') . "</td>";
                            echo "<td></td>";
                            echo "</tr>"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/modal.js"></script>