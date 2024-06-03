<?php
// Fungsi untuk menghitung tarif parkir
function tarifParkir($lamaParkir, $tarifPerJam)
{
  return $lamaParkir * $tarifPerJam;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tarif Parkir</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    form input[type="submit"] {
      margin-top: 20px;
      height: 40px;
      width: 200px;
    }

    form input[type="reset"] {
      margin-top: 20px;
      height: 40px;
      width: 200px;
    }
  </style>
</head>

<body>
  <form action="#" method="get">
    <h2 align="center">Program Hitung Tarif Parkir</h2>
    <table>
      <tr>
        <td><label for="no_polisi">No Polisi</label></td>
        <td>:</td>
        <td><input type="text" id="no_polisi" name="no_polisi" required></td>
      </tr>
      <tr>
        <td><label for="lama_parkir">Lama Parkir (jam)</label></td>
        <td>:</td>
        <td><input type="number" id="lama_parkir" name="lama_parkir" min="1" required></td>
      </tr>
      <tr>
        <td><label for="tarif_per_jam">Tarif Parkir per Jam (Rp)</label></td>
        <td>:</td>
        <td> <input type="number" id="tarif_per_jam" name="tarif_per_jam" min="1" required></td>
      </tr>
    </table>
    <input type="submit" name="btnHitung" value="Hitung Tarif Parkir">
    <input type="reset" value="Reset" onclick="window.location='?';" style="font-size: 20px;">


    <?php
    if (isset($_GET['btnHitung'])) {
      $noPolisi = $_GET['no_polisi'];
      $lamaParkir = $_GET['lama_parkir'];
      $tarifPerJam = $_GET['tarif_per_jam'];

      // Memanggil fungsi tarifParkir
      $totalTarif = tarifParkir($lamaParkir, $tarifPerJam);
      echo "<div style='margin-top: 20px; text-align: center;'>";
      echo "<h3>Hasil Perhitungan Tarif Parkir:</h3>";
      echo "<p>Total Tarif: Rp $totalTarif</p>";
      echo "</div>";
    }
    ?>
  </form>

</body>

</html>