<?php
// Fungsi untuk mendapatkan Nilai Huruf dan Keterangan berdasarkan nilai
function getGradeAndStatus($nilai)
{
    if ($nilai >= 91) {
        return ['NH' => 'A', 'KET' => 'Lulus'];
    } elseif ($nilai >= 81) {
        return ['NH' => 'B', 'KET' => 'Lulus'];
    } elseif ($nilai >= 71) {
        return ['NH' => 'C', 'KET' => 'Lulus'];
    } elseif ($nilai >= 61) {
        return ['NH' => 'D', 'KET' => 'Tidak Lulus'];
    } else {
        return ['NH' => 'E', 'KET' => 'Tidak Lulus'];
    }
}

// Memuat data yang sudah ada
$mahasiswa = [];
if (file_exists('data/data_mahasiswa.json')) {
    $json_data = file_get_contents('data/data_mahasiswa.json');
    $mahasiswa = json_decode($json_data, true);
    if (!is_array($mahasiswa)) {
        $mahasiswa = [];
    }
}

// Menangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete']) && $_POST['delete'] === 'true') {
        // Menghapus data berdasarkan NIM
        $mahasiswa = array_filter($mahasiswa, function ($m) {
            return $m['NIM'] !== $_POST['nim'];
        });
    } else {
        $data_baru = [
            'NIM' => $_POST['nim'],
            'Nama' => $_POST['nama'],
            'Jenis_Kelamin' => $_POST['jenis_kelamin'],
            'Tempat_Lahir' => $_POST['tempat_lahir'],
            'Tanggal_Lahir' => $_POST['tanggal_lahir'],
            'Agama' => $_POST['agama'],
            'Alamat' => $_POST['alamat'],
            'No_Telpn' => $_POST['no_telpn'],
            'Email' => $_POST['email'],
            'Jurusan' => $_POST['jurusan'],
            'Matakuliah' => $_POST['matakuliah'],
            'Nilai' => $_POST['nilai'],
        ];

        // Cek duplikasi NIM
        $index = array_search($_POST['nim'], array_column($mahasiswa, 'NIM'));
        if ($index === false) {
            // Tidak ada duplikasi, tambahkan data baru
            $hasil = getGradeAndStatus($data_baru['Nilai']);
            $data_baru['NH'] = $hasil['NH'];
            $data_baru['KET'] = $hasil['KET'];
            $mahasiswa[] = $data_baru;
        } else {
            // Data sudah ada, update data
            $mahasiswa[$index] = $data_baru;
        }
    }

    // Menyimpan ke file JSON
    file_put_contents('data/data_mahasiswa.json', json_encode($mahasiswa, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Mahasiswa</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <style>
        .form-group {
            margin-bottom: 20px;
            /* Atur jarak antar field */
        }

        .header-title {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2>Form Mahasiswa</h2>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nim">
                            <b>NIM</b>
                        </label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label for="nama"><b> Nama</b></label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin"><b>Jenis Kelamin </b></label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir"><b>Tempat Lahir </b></label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir"><b>Tanggal Lahir </b></label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="agama"><b>Agama </b></label>
                        <select class="form-control" id="agama" name="agama" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alamat"><b>Alamat </b></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telpn"><b>No Telpn </b></label>
                        <input type="text" class="form-control" id="no_telpn" name="no_telpn" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>E-mail </b></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan"><b>Jurusan </b></label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="matakuliah"><b>Matakuliah</b></label>
                        <select class="form-control" id="matakuliah" name="matakuliah" required>
                            <option value="Pendidikan Pancasila">Pendidikan Pancasila</option>
                            <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="Pemrograman">Pemrograman</option>
                            <option value="Basis Data">Basis Data</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Personal Development">Personal Development</option>
                            <option value="Pendidikan Anti Korupsi">Pendidikan Anti Korupsi</option>
                            <option value="Arsitektur TI/SI">Arsitektur TI/SI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai"><b>Nilai</b></label>
                        <input type="number" class="form-control" id="nilai" name="nilai" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </form>

        <h2 style="margin-top: 30px;">Daftar Mahasiswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Matakuliah</th>
                    <th>Nilai</th>
                    <th>NH</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= $mhs['NIM'] ?></td>
                        <td><?= $mhs['Nama'] ?></td>
                        <td><?= $mhs['Jenis_Kelamin'] ?></td>
                        <td><?= $mhs['Jurusan'] ?></td>
                        <td><?= $mhs['Matakuliah'] ?></td>
                        <td><?= $mhs['Nilai'] ?></td>
                        <td><?= isset($mhs['NH']) ? $mhs['NH'] : 'Tidak ada data' ?></td>
                        <td><?= isset($mhs['KET']) ? $mhs['KET'] : 'Tidak ada data' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>