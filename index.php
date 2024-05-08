<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 2rem;
        }
        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        label {
            text-align: right;
        }
        input[type="text"],
        input[type="date"] {
            grid-column: 2;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        select {
            grid-column: 2;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        button {
            grid-column: 1 / 3;
            padding: 0.5rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form method="get">
        <label for="ogr_ad">Öğrenci Ad:</label>
        <input type="text" id="ogr_ad" name="name" value="" required>

        <label for="ogr_soyad">Öğrenci Soyad:</label>
        <input type="text" id="ogr_soyad" name="surname" value="" required>

        <label for="ogr_no">Öğrenci No:</label>
        <input type="text" id="ogr_no" name="student_number" value="" required>

        <label for="ogr_sinif">Öğrenci Sınıf:</label>
        <input type="text" id="ogr_sinif" name="class" value="" required>

        <label for="cinsiyet">Cinsiyet:</label>
        <select id="cinsiyet" name="gender" required>
            <option value="" selected>Select Gender</option>
            <option value="erkek">Erkek</option>
            <option value="kadin">Kadın</option>
        </select>

        <label for="ogr_alan">Öğrenci Alan:</label>
        <input type="text" id="ogr_alan" name="alan" value="" required>

        <label for="ogr_dTarih">Doğum Tarihi:</label>
        <input type="date" id="ogr_dTarih" name="date_of_birth" value="" required>

        <button type="submit">Kaydet</button>
    </form>
</body>
<?php
$baglanti = mysqli_connect("localhost", "root", "", "okul");
if($baglanti === false){
 die("Bağlantı Hatası:" . mysqli_connect_error());
}
$sorgu = "INSERT INTO ogrenci (id, ogr_ad, ogr_soyad, ogr_no, ogr_sinif, cinsiyet, ogr_alan, ogr_dTarih) VALUES(null, ?, ?, ?, ?, ?, ?, ?)";
if($stmt = mysqli_prepare($baglanti, $sorgu)){
    $ogr_ad = $_GET['name'];
    $ogr_soyad = $_GET['surname'];
    $ogr_no = $_GET['student_number'];
    $ogr_sinif = $_GET['class'];
    $cinsiyet = $_GET['gender'];
    $ogr_alan = $_GET['alan'];
    $ogr_dTarih = $_GET['date_of_birth'];
    mysqli_stmt_bind_param($stmt, "sssssss", $ogr_ad, $ogr_soyad, $ogr_no, $ogr_sinif, $cinsiyet, $ogr_alan, $ogr_dTarih);
    mysqli_stmt_execute($stmt);
} else{
 echo "Hata:" . mysqli_error($baglanti);
}
mysqli_stmt_close($stmt);
mysqli_close($baglanti);
?>
</html>