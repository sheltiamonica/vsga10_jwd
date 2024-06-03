<?php
// mengambil data dari method POST
$nama = $_POST['nama'];
$berat = $_POST['berat'];
$tinggi = $_POST['tinggi'];

$example1 = "Nilai BMI Anda Adalah : ";
$example2 = "Status BMI : ";
$bmi = $berat / ($tinggi * $tinggi);

echo $nama . "<br>";
echo $example1 . $bmi . "<br>";
getGrade($bmi, $example2);

function getGrade($x, $y)
{
  if ($x > 30.0) {
    echo $y . "Maaf, Anda Obesitas <br>";
  } else if ($x > 25.0) {
    echo $y . "Kurangi, Anda Kegemukan <br>";
  } else if ($x > 18.5) {
    echo $y . "Normal";
  } else {
    echo $y . "Anda Kurus, Perbanyak Makan";
  }
}