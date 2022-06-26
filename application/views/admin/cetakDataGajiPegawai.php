<?php
    $gajiPokok = ($gaji->gaji_pokok_personal ?? $gaji->gaji_pokok) * $gaji->hadir;
    $transport = $gaji->tj_transport * $gaji->hadir;
    $uangMakan = $gaji->uang_makan * $gaji->hadir;
    $totalPenghasilan = $gajiPokok + $transport + $uangMakan;

    if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;
    }else{
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan.$tahun;
    }

    $monthName = "default";

    switch ($bulan){ 
        case 1 : $monthName = "Januari"; break;
        case 2 : $monthName = "Februari"; break;
        case 3 : $monthName = "Maret"; break;
        case 4 : $monthName = "April"; break;
        case 5 : $monthName = "Mei"; break;
        case 6 : $monthName = "Juni"; break;
        case 7 : $monthName = "Juli"; break;
        case 8 : $monthName = "Agustus"; break;
        case 9 : $monthName = "September"; break;
        case 10 : $monthName = "Oktober"; break;
        case 11 : $monthName = "November"; break;
        case 12 : $monthName = "Desember"; break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
		body{
			font-family:Arial;
			color: black;
            padding: 2rem;
            font-size: large;
		}
	</style>
</head>
<body>
    <div>
        <h2 class="text-center">CV. GIRISA TEKNOLOGI</h2>
        <p class="text-center">JL. Puncak Borobudur, No. 1, Kavling 33, Ruko Taman Borobudur Indah,, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142</p>
        <hr style="border-color: #000; border-width: 5px;" />
    </div>
    <div>
        <h4 class="text-center" style="font-weight:800; text-decoration: underline;">SLIP GAJI KARYAWAN</h4>
        <h4 class="text-center">Periode 1 <?= $monthName . ' ' . $tahun . ' - ' . date("t", strtotime($tahun.'-'.$bulan)) . ' ' . $monthName . ' ' . $tahun ?></h4>
    </div>

    <table>
        <tbody>
            <tr>
                <td style="width:8rem;">NIK</td>
                <td><?= $gaji->nik ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= $gaji->nama_pegawai ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><?= $gaji->nama_jabatan ?></td>
            </tr>
        </tbody>
    </table>

    <div class="container mt-4">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td colspan="3" width="49%" style="font-weight:600;"><u>PENGHASILAN</u></td>
                    <td style="width:2rem;"></td>
                    <td colspan="3" style="font-weight:600;"><u>POTONGAN</u></td>
                </tr>
                <tr>
                    <td style="width:auto">Gaji Pokok</td>
                    <td>=</td>
                    <td style="width:8rem;" class="text-right">
                        Rp.<?php echo number_format($gajiPokok,0,',','.') ?>
                    </td>
                    <td></td>
                    <td>Ketidakhadiran</td>
                    <td>=</td>
                    <td style="width:8rem;" class="text-right">
                        Rp.<?php echo number_format($potongan,0,',','.') ?>
                    </td>
                </tr>
                <tr>
                    <td>Tunjangan Transportasi</td>
                    <td>=</td>
                    <td class="text-right">
                    Rp.<?php echo number_format($transport,0,',','.') ?>
                    </td>
                </tr>
                <tr>
                    <td>Uang Makan</td>
                    <td>=</td>
                    <td class="text-right">
                        Rp.<?php echo number_format($uangMakan,0,',','.') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right font-weight-bold pr-4">TOTAL (A)</td>
                    <td class="border-top border-5 border-dark text-right font-weight-bold">
                        Rp.<?php echo number_format($totalPenghasilan,0,',','.') ?>
                    </td>
                    <td></td>
                    <td colspan="2" class="text-right font-weight-bold pr-4">POTONGAN (B)</td>
                    <td class="border-top border-5 border-dark text-right font-weight-bold">
                        Rp.<?php echo number_format($potongan,0,',','.') ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container mt-4 mr-0">
        <table>
            <tbody>
                <tr>
                    <td>PENERIMAAN BERSIH (A-B)</td>
                    <td style="width:2rem;" class="text-center">=</td>
                    <td class="font-weight-bold">Rp.<?php echo number_format($totalPenghasilan - $potongan,0,',','.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        <div style="width:14rem;">
            <span>Malang, <?= date("t", strtotime($tahun.'-'.$bulan)) . ' ' . $monthName . ' ' . $tahun ?></span>
            <p>Finance</p>
            <div style="height:4rem;">
                <!-- tempat ttd -->
            </div>
            <p>_________________</p>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>