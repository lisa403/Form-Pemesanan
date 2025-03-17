<?php
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nomor = $alamat = $jenis_kendaraan = $model_kendaraan = $tanggal_sewa = $tanggal_kembali = $catatan_tambahan = "";
$namaErr = $emailErr = $nomorErr = $alamatErr = $jenisKendaraanErr = $modelKendaraanErr = $tanggalSewaErr = $tanggalKembaliErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Nama
    $nama = $_POST["nama"];
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    }

    // Validasi Email
    $email = $_POST["email"];
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    }

    // Validasi Nomor Telepon
    $nomor = $_POST["nomor"];
    if (empty($nomor)) {
        $nomorErr = "Nomor Telepon wajib diisi";
    } elseif (!ctype_digit($nomor)) {
        $nomorErr = "Nomor Telepon harus berupa angka";
    }

    // Validasi Alamat
    $alamat = $_POST["alamat"];
    if (empty($alamat)) {
        $alamatErr = "Alamat wajib diisi";
    }

    // Validasi Jenis Kendaraan
    $jenis_kendaraan = $_POST["jenis_kendaraan"];
    if (empty($jenis_kendaraan)) {
        $jenisKendaraanErr = "Jenis Kendaraan wajib dipilih";
    }

    // Validasi Model Kendaraan
    $model_kendaraan = $_POST["model_kendaraan"];
    if (empty($model_kendaraan)) {
        $modelKendaraanErr = "Model Kendaraan wajib diisi";
    }

    // Validasi Tanggal Sewa
    $tanggal_sewa = $_POST["tanggal_sewa"];
    if (empty($tanggal_sewa)) {
        $tanggalSewaErr = "Tanggal Sewa wajib diisi";
    }

    // Validasi Tanggal Kembali
    $tanggal_kembali = $_POST["tanggal_kembali"];
    if (empty($tanggal_kembali)) {
        $tanggalKembaliErr = "Tanggal Kembali wajib diisi";
    }

    // Menyimpan catatan tambahan
    $catatan_tambahan = $_POST["catatan_tambahan"];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Kendaraan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Form Pemesanan Kendaraan 🚗</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Telepon:</label>
                <input type="text" id="nomor" name="nomor" value="<?php echo $nomor; ?>">
                <span class="error"><?php echo $nomorErr ? "* $nomorErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat"><?php echo $alamat; ?></textarea>
                <span class="error"><?php echo $alamatErr ? "* $alamatErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                <select id="jenis_kendaraan" name="jenis_kendaraan">
                    <option value="" <?php echo ($jenis_kendaraan == "") ? "selected" : ""; ?>>Pilih Jenis Kendaraan</option>
                    <option value="mobil" <?php echo ($jenis_kendaraan == "mobil") ? "selected" : ""; ?>>Mobil</option>
                    <option value="motor" <?php echo ($jenis_kendaraan == "motor") ? "selected" : ""; ?>>Motor</option>
                </select>
                <span class="error"><?php echo $jenisKendaraanErr ? "* $jenisKendaraanErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="model_kendaraan">Model Kendaraan:</label>
                <input type="text" id="model_kendaraan" name="model_kendaraan" value="<?php echo $model_kendaraan; ?>">
                <span class="error"><?php echo $modelKendaraanErr ? "* $modelKendaraanErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="tanggal_sewa">Tanggal Sewa:</label>
                <input type="date" id="tanggal_sewa" name="tanggal_sewa" value="<?php echo $tanggal_sewa; ?>">
                <span class="error"><?php echo $tanggalSewaErr ? "* $tanggalSewaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="<?php echo $tanggal_kembali; ?>">
                <span class="error"><?php echo $tanggalKembaliErr ? "* $tanggalKembaliErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="catatan_tambahan">Catatan Tambahan:</label>
                <textarea id="catatan_tambahan" name="catatan_tambahan" placeholder="Keterangan tambahan (opsional)"><?php echo $catatan_tambahan; ?></textarea>
            </div>

            <div class="button-container">
                <button type="submit">Pesan Kendaraan</button>
            </div>
        </form>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$alamatErr && !$jenisKendaraanErr && !$modelKendaraanErr && !$tanggalSewaErr && !$tanggalKembaliErr) { ?>
    <div class="container">
        <h3>Data Pemesanan:</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="20%">Nama</th>
                        <th width="20%">Email</th>
                        <th width="15%">Nomor Telepon</th>
                        <th width="30%">Alamat Pengiriman</th>
                        <th width="20%">Jenis Kendaraan</th>
                        <th width="20%">Model Kendaraan</th>
                        <th width="15%">Tanggal Sewa</th>
                        <th width="15%">Tanggal Kembali</th>
                        <th width="30%">Catatan Tambahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td><?php echo $jenis_kendaraan; ?></td>
                        <td><?php echo $model_kendaraan; ?></td>
                        <td><?php echo $tanggal_sewa; ?></td>
                        <td><?php echo $tanggal_kembali; ?></td>
                        <td><?php echo $catatan_tambahan; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</body>

</html>