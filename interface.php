
<?php

// 1. Interface MetodePembayaran
interface MetodePembayaran
{
    public function prosesBayar(float $jumlah, string $keterangan): bool;

    public function getNamaMetode(): string;
}

// 2. Fungsi format uang Rupiah
function formatRupiah(float $jumlah): string
{
    return "Rp " . number_format($jumlah, 0, ',', '.');
}

// 3. Class TransferBank
class TransferBank implements MetodePembayaran
{
    private string $nomorRekening;

    public function __construct(string $nomorRekening)
    {
        $this->nomorRekening = $nomorRekening;
    }

    public function getNamaMetode(): string
    {
        return "Transfer Bank";
    }

    public function prosesBayar(
        float $jumlah,
        string $keterangan
    ): bool {
        $admin = 0;
        $total = $jumlah + $admin;

        echo "\n=== TRANSFER BANK ===\n";
        echo "Metode: " . $this->getNamaMetode() . "\n";
        echo "Nomor Rekening: " . $this->nomorRekening . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: " . formatRupiah($jumlah) . "\n";
        echo "Biaya Admin (0%): " . formatRupiah($admin) . "\n";
        echo "Total Bayar: " . formatRupiah($total) . "\n";
        echo "Status: Pembayaran berhasil\n";

        return true;
    }
}

// 4. Class QRIS
class QRIS implements MetodePembayaran
{
    public function getNamaMetode(): string
    {
        return "QRIS";
    }

    public function prosesBayar(
        float $jumlah,
        string $keterangan
    ): bool {
        $admin = $jumlah * 0.007;
        $total = $jumlah + $admin;

        echo "\n=== PEMBAYARAN QRIS ===\n";
        echo "Metode: " . $this->getNamaMetode() . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: " . formatRupiah($jumlah) . "\n";
        echo "Biaya Admin (0,7%): " . formatRupiah($admin) . "\n";
        echo "Total Bayar: " . formatRupiah($total) . "\n";
        echo "Status: Pembayaran berhasil\n";

        return true;
    }
}

// 5. Class KartuKredit
class KartuKredit implements MetodePembayaran
{
    private string $nomorKartu;

    public function __construct(string $nomorKartu)
    {
        $this->nomorKartu = $nomorKartu;
    }

    public function getNamaMetode(): string
    {
        return "Kartu Kredit";
    }

    public function prosesBayar(
        float $jumlah,
        string $keterangan
    ): bool {
        $admin = $jumlah * 0.025;
        $total = $jumlah + $admin;

        $empatDigit = substr($this->nomorKartu, -4);

        echo "\n=== PEMBAYARAN KARTU KREDIT ===\n";
        echo "Metode: " . $this->getNamaMetode() . "\n";
        echo "Nomor Kartu: **** **** **** " . $empatDigit . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: " . formatRupiah($jumlah) . "\n";
        echo "Biaya Admin (2,5%): " . formatRupiah($admin) . "\n";
        echo "Total Bayar: " . formatRupiah($total) . "\n";
        echo "Status: Pembayaran berhasil\n";

        return true;
    }
}

// 6. Menjalankan semua metode pembayaran
echo "================================\n";
echo "   SISTEM METODE PEMBAYARAN\n";
echo "================================\n";

$jumlah = 500000;
$keterangan = "Pembelian barang";

// Objek Transfer Bank
$transfer = new TransferBank("1234567890");
$transfer->prosesBayar($jumlah, $keterangan);

// Objek QRIS
$qris = new QRIS();
$qris->prosesBayar($jumlah, $keterangan);

// Objek Kartu Kredit
$kartu = new KartuKredit("1234567812345678");
$kartu->prosesBayar($jumlah, $keterangan);

?>
