<?php
function formatkoma($angka, $jumlah = 2)
{
    $angka = number_format($angka, $jumlah, ',', '.');
    return $angka;
}
function formattanggal($angka, $model = 1)
{
    if ($model == '1')
        $tanggal = date('d/m/Y', strtotime($angka));
    else if ($model == '2')
        $tanggal = date('d/m/Y H:i:s', strtotime($angka));
    else if ($model == '3')
        $tanggal = date('d/m', strtotime($angka));
    else if ($model == '4')
        $tanggal = date('j F Y', strtotime($angka));
    else if ($model == '5')
        $tanggal = date('d/m/Y H:i', strtotime($angka));
    return $tanggal;
}

function ubahseparator($angka, $tanda = 'koma')
{
    if ($tanda == 'koma')
        $separator = str_replace(array('.', ','), array('', '.'), $angka);
    elseif ($tanda == 'titik')
        $separator = str_replace('.', ',', $angka);
    return $separator;
}
function hurufromawi($angka)
{
    $array_angka = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
    $huruf = $array_angka[$angka];
    return $huruf;
}

function tanggalmundur($angka, $jumlah = 1, $format = 'months')
{
    $tglnow = $angka;
    $temp = date('Y-m-d', strtotime($jumlah . ' ' . $format, strtotime($tglnow)));
    return date('Y-m-d', strtotime('1' . ' ' . 'days', strtotime($temp)));
}

// Fungsi nodokumen AGG/SMS/SMB.KST/XI-230001
function nodokumen($awal, $tanggal, $nomor)
{
    $thn = date('y', strtotime($tanggal));
    $bln = date('n', strtotime($tanggal));
    $nomor = sprintf("%04d", $nomor);
    $nodoc = $awal . hurufromawi($bln) . "-" . $thn . $nomor;
    return $nodoc;
}

//Fungsi membuat idunik tampil di url
function buatid($length = 32)
{
    $idunik = bin2hex(random_bytes($length / 2));
    return $idunik;
}

//Fungsi cetak status
function statuslabel($asal, $nostat)
{
    if ($asal == 'barangpo')
        $statlabel = [
            '0' => ['class' => 'label-inverse-info-border', 'text' => lang('app.baru')],
            '1' => ['class' => 'label-warning', 'text' => lang('app.tunda')],
            '2' => ['class' => 'label-info', 'text' => lang('app.proses')],
            '3' => ['class' => 'label-inverse-danger', 'text' => lang('app.revisi')],
            '4' => ['class' => 'label-inverse', 'text' => lang('app.tolak')],
            '5' => ['class' => 'label-inverse', 'text' => lang('app.batal')],
            '6' => ['class' => 'label-inverse-warning', 'text' => lang('app.gudang')],
            '7' => ['class' => 'label-success', 'text' => lang('app.mintaok')],
            '8' => ['class' => 'label-success', 'text' => lang('app.pembelian')],
            // '9' => ['class' => 'label-primary', 'text' => lang('app.selesai')],
            'c' => ['class' => 'label-inverse-info-border', 'text' => lang('app.blmacc')]
        ];
    else if ($asal == 'master')
        $statlabel = [
            '0' => ['class' => 'label-warning', 'text' => lang('app.tunda')],
            '1' => ['class' => 'label-primary', 'text' => lang('app.pasti')],
            '2' => ['class' => 'label-warning', 'text' => lang('app.tunda')],
            '3' => ['class' => 'label-inverse-info-border', 'text' => lang('app.baru')],
            'a' => ['class' => 'label-inverse', 'text' => lang('app.noaktif')]
        ];
    else if ($asal == 'warnaang')
        $statlabel = [
            '1' => ['class' => 'bgtr1'],
            '2' => ['class' => 'bgtr2'],
            '3' => ['class' => 'bgtr3']
        ];
    else if ($asal == 'biayaang')
        $statlabel = [
            '0' => ['class' => 'label-inverse-info-border', 'text' => lang('app.baru')],
            '1' => ['class' => 'label-warning', 'text' => lang('app.tunda')],
            '2' => ['class' => 'label-info', 'text' => lang('app.proses')],
            '3' => ['class' => 'label-inverse-danger', 'text' => lang('app.revisi')],
            '4' => ['class' => 'label-inverse', 'text' => lang('app.tolak')],
            '5' => ['class' => 'label-inverse', 'text' => lang('app.batal')],
            '6' => ['class' => 'label-inverse-warning', 'text' => lang('app.gudang')],
            '7' => ['class' => 'label-success', 'text' => lang('app.mintaok')],
            '8' => ['class' => 'label-success', 'text' => lang('app.pembelian')],
            // '9' => ['class' => 'label-primary', 'text' => lang('app.selesai')],
            'c' => ['class' => 'label-inverse-info-border', 'text' => lang('app.blmacc')]
        ];
    else if ($asal == 'biayakas')
        $statlabel = [
            '0' => ['class' => 'label-inverse-info-border', 'text' => lang('app.baru')],
            '1' => ['class' => 'label-warning', 'text' => lang('app.tunda')],
            '2' => ['class' => 'label-info', 'text' => lang('app.proses')],
            '3' => ['class' => 'label-inverse-danger', 'text' => lang('app.revisi')],
            '4' => ['class' => 'label-inverse', 'text' => lang('app.tolak')],
            '5' => ['class' => 'label-inverse', 'text' => lang('app.batal')],
            // '6' => ['class' => 'label-inverse-warning', 'text' => lang('app.gudang')],
            // '7' => ['class' => 'label-success', 'text' => lang('app.mintaok')],
            // '8' => ['class' => 'label-success', 'text' => lang('app.pembelian')],
            // '9' => ['class' => 'label-primary', 'text' => lang('app.selesai')],
            'c' => ['class' => 'label-inverse-info-border', 'text' => lang('app.blmacc')]
        ];
    $status = $statlabel[$nostat] ?? ['class' => '', 'text' => ''];
    return $status;
}

//Fungsi angka ke huruf
function terbilang($angka)
{
    $angka = abs($angka);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($angka < 12)
        $temp = " " . $huruf[$angka];
    else if ($angka < 20)
        $temp = terbilang($angka - 10) . " belas";
    else if ($angka < 100)
        $temp = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    else if ($angka < 200)
        $temp = " seratus" . terbilang($angka - 100);
    else if ($angka < 1000)
        $temp = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    else if ($angka < 2000)
        $temp = " seribu" . terbilang($angka - 1000);
    else if ($angka < 1000000)
        $temp = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    else if ($angka < 1000000000)
        $temp = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    else if ($angka < 1000000000000)
        $temp = terbilang($angka / 1000000000) . " milyar" . terbilang(fmod($angka, 1000000000));
    else if ($angka < 1000000000000000)
        $temp = terbilang($angka / 1000000000000) . " trilyun" . terbilang(fmod($angka, 1000000000000));
    return $temp;
}

function get_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
