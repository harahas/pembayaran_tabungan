<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style2.css">
    <link rel="stylesheet" href="/fontawesome" />
    <title>Rekening</title>
</head>

<body>
    <div class="container">
        <!-- <div class="pencarian">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text">
        </div> -->
        <div class="saldo">
            <div class="jumlah">
                <p>Saldo</p>
                <p>{{ rupiah($saldo) }}</p>
            </div>
            <div class="menu">
                <h2 style="margin-left:27px; color: white;">{{ $nama }}</h2>
                <div class="img">
                    <img src="/img2/dompet.png" alt="">
                    <img src="/img2/payment.png" alt="">
                    <img src="/img2/histori.png" alt="">
                </div>
                <div class="text">
                    <p>Dompet</p>
                    <p>Bayar</p>
                    <p>Tagihan</p>
                </div>
            </div>
        </div>
        <div class="histori">
            <div class="pemasukan">
                <p><i class="fas fa-long-arrow-alt-down" style="color:green"></i>&nbsp; Pemasukan</p>
                <p>{{ rupiah($masuk) }}</p>
            </div>
            <div class="pengeluaran">
                <p><i class="fas fa-long-arrow-alt-up" style="color:red"></i>&nbsp;Pengeluaran</p>
                <p>{{ rupiah($keluar) }}</p>
            </div>
            <div class="selisih">Selisih&nbsp; <span style="color:green">{{ rupiah($saldo) }}</span></div>
        </div>
        <h3 style="text-align: center;">Riwayat</h3>
        <div class="histori-payment">
            @foreach ($transaksi as $item)
            @if($item->masuk > 0)
            <div class="card">
                <div class="info">
                    <p style="font-size: 1.1em;;"><b>Menabung</b></p>
                    <p>{{ tanggal_hari($item->tanggal) }}</p>
                </div>
                <div class="amount">
                    <p style="font-size: 1.1em;color:green"><b>{{ rupiah($item->masuk) }}</b></p>

                </div>
            </div>
            @endif
            @if($item->keluar > 0)
            <div class="card">
                <div class="info">
                    <p style="font-size: 1.1em;;"><b>Pembayaran</b></p>
                    <p>{{ tanggal_hari($item->tanggal) }}</p>
                </div>
                <div class="amount">
                    <p style="font-size: 1.1em;color:red"><b>{{ rupiah($item->keluar) }}</b></p>

                </div>
            </div>
            @endif
            @endforeach

        </div>
        <div class="bot-bar">
            <img src="/img2/logo.png" alt="" height="75vh">
        </div>
    </div>

</body>

</html>
