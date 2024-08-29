{/* <script> */}
$(document).ready(function() {
    $('#tabelawal').DataTable({
        "ordering": true,
        "searching": true,
        "autoWidth": false,
        "lengthMenu": [
            [10, 25, 50,100, -1],
            [10, 25, 50, 100,'All'],
        ],
        "iDisplayLength": 25,
        "buttons": ['excel', 'pdf', 'print'],
        dom: 'lBfrtpi', //length Button filter process table info paging
    });

    //show password
    $('.ShowPassword').click(function(){
        if($(this).is(':checked')){
            $('.form-password').attr('type','text');
        }else{
            $('.form-password').attr('type','password');
        }
    });

    //fungsi klik
    $('.klikini').trigger('click');

    //select all focus input text
    let focusedElement;
    $(document).on('focus', 'input', function() {
        if(focusedElement == this) return; // already focused, return so the user can place the cursor at a specific entry point
        focusedElement = this;
        
        setTimeout(function() {
            focusedElement.select();
        }, 100); //Select all text in any field in focus for easy re-entry. The delay is a bit to allow the focus to “stick” to the selection.
    });

    //No ctrl C dan ctrl V (copy paste)
    var ctrlDown = false,
        ctrlKey = 17,
        cmdKey = 91,
        vKey = 86,
        cKey = 67;

    $(document).keydown(function(e) {
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
    }).keyup(function(e) {
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
    });

    $(".no-copy-paste").keydown(function(e) {
        if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
    });

    //select all text area
    $('textarea').on('mouseup', function() { $(this)[0].select(); });

    //fungsi btn submit
    // $(".btnSubmit").click(function () {
    //     $(".btnSubmit").attr("disabled", true);
    //     $('#myForm').submit();  
    //     return true;
    // });
});    

document.addEventListener("DOMContentLoaded", function() {
    var textInputs = document.querySelectorAll("input[type='text']");

    textInputs.forEach(function(input) {
        input.setAttribute("autocomplete", "off");
    });
});

$('.mobile-menu').click(function() {
    //load side bar
    var path = location.pathname.split('/')
    var url = '/' + path[1];   // var url = location.origin + '/' + path[1]; 
    url = (url === '/') ? '/home' : url;
    
    if (window.location.href.indexOf('login') !== -1) {
        return;
    }
    
    $('ul.pcoded-submenu li a').each(function() {
        if ($(this).attr('href').indexOf(url) !== -1){
            $(this).parent().addClass('active').parent().parent('li').addClass('pcoded-trigger').parent().parent('li').addClass('pcoded-trigger')
        }
    })
});

// Checkbox on off
// function prosesCheckbox(checkbox, inputTextId) {
//     var isChecked = checkbox.checked;
//     var inputText = document.getElementById(inputTextId);
//     inputText.value = isChecked ? "1" : "0";
// }

function previewImage() {
    const gambar = document.querySelector('#gambar');    // deklarasi variabel untuk preview Image
    const imgPreview = document.querySelector('.img-preview');    // const gambarLabel = document.querySelector('.custom-file-label');
    const fileGambar = new FileReader();    // gambarLabel.textContent = gambar.files[0].name; //ganti url di label

    fileGambar.readAsDataURL(gambar.files[0]); //ambil alamat penyimpanan
    fileGambar.onload = function(e) { //ganti preview image
        imgPreview.src = e.target.result;
    }
}

//Show Password mata
// $(document).ready(function() {
//     $("#show_hide_password a").on('click', function(event) {
//         event.preventDefault();

//         if($('#show_hide_password input').attr("type") == "text"){
//             $('#show_hide_password input').attr('type', 'password');
//             $('#show_hide_password i').addClass( "fa-eye-slash" );
//             $('#show_hide_password i').removeClass( "fa-eye" );
//         }else if($('#show_hide_password input').attr("type") == "password"){
//             $('#show_hide_password input').attr('type', 'text');
//             $('#show_hide_password i').removeClass( "fa-eye-slash" );
//             $('#show_hide_password i').addClass( "fa-eye" );
//         }
//     });
// });


//flash data
$(function() {
    $('div[onload]').trigger('onload');
});

function flashdata(icon,judul) {
    Swal.fire({
        position: 'top-end',
        icon: icon,
        title: judul,
        showConfirmButton: false,
        // confirmButtonColor: '#3085d6',
        // confirmButtonText: 'OK',
        timer: 3000,
    })
}

//format angka
var bilangan = document.getElementsByClassName("angka");
for (let i = 0; i < bilangan.length; i++) {
    bilangan[i].addEventListener("keyup", function(e) {
    bilangan[i].value = formatInputAngka(this.value);
    });    
}
function formatInputAngka(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

//format . dan ,
function formatAngka(nilai, model) {
    if (model === 'nol') {
        return nilai.split(".").join("").split(",").join(".");
    } else if (model === 'rp') {
        return nilai.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&*').split(".").join(",").split("*").join(".");
    } else if (model === 'koma') {
        // var angkaString = nilai.toString();
        // var angkaSplit = angkaString.split('.');
        // Menambahkan pemisah ribuan pada bagian ribuan
        // var angkaRibuan = angkaSplit[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        // Menggabungkan kembali dengan bagian desimal yang diinginkan
        // var hasilFormat = angkaRibuan + ',' + angkaSplit[1];
        // return hasilFormat;
        return nilai.toString().split('.')[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + nilai.toString().split('.')[1];
    }
}

function openFullscreen() {
    var elem = document.documentElement;
    
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}

function closeFullscreen() {
    var elem = document.documentElement;

    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
    }
}

