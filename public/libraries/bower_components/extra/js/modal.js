{/* <script> */}
$(document).ready(function() {
    $('#tabelmodal').DataTable({
        "ordering": true,
        "searching": true,
        "autoWidth": false,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
        "iDisplayLength": 10,
    });
});