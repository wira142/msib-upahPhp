<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Upah Pegawai</title>
  <link rel="stylesheet" href="app.css">
</head>

<body>
  <div class="container">
    <div class="card-form">
      <h1>Masukan Data Anda</h1>
      <form action="" method="post">
        <div class="box-input">
          <label for="nama">Nama</label>
          <input class="input-item" type="text" id="nama" name="nama">
        </div>
        <div class="box-input">
          <label for="jabatan">Jabatan</label>
          <select class="input-item" name="jabatan" id="jabatan">
            <option value="manager">Manager</option>
            <option value="asisten">Asisten</option>
            <option value="kabag">Kabag</option>
            <option value="staff">Staff</option>
          </select>
        </div>
        <div class="box-input">
          <label for="agama">Agama</label>
          <select name="agama" class="input-item" id="agama">
            <option value="kristen">Kristen</option>
            <option value="islam">Islam</option>
            <option value="hindu">Hindu</option>
            <option value="buddha">Buddha</option>
            <option value="katolik">Katolik</option>
          </select>
        </div>
        <div class="box-input">
          <label for="status">Status</label>
          <div class="radio-option">
            <label for="menikah"><input type="radio" onchange="cekStatus()" name="status" id="menikah" value="menikah">Menikah</label>
            <label for="lajang"><input type="radio" onchange="cekStatus()" value="lajang" name="status" id="lajang">Lajang</label>
          </div>
        </div>
        <div class="box-input">
          <label for="jum_anak">Jumlah Anak</label>
          <input class="input-item" type="number" disabled min="0" name="jum_anak" max="5" id="jum_anak">
        </div>
        <br>
        <button id="btn_cek" name="cek" type="submit">Cek</button>
      </form>
    </div>
    <?php
    if (isset($_POST['cek'])) {
      if ($_POST['nama'] == "" || $_POST['status'] == "") {
        echo '<script>alert("Anda harus melengkapi data yang diperlukan!")? "" : window.location = document.URL;</script>';
        return 0;
        // return header('Location: ' . $_SERVER['HTTP_REFERER']);
      }

      $nama = $_POST['nama'];
      $jabatan = $_POST['jabatan'];
      $agama = $_POST['agama'];
      $status = $_POST['status'];
      $jum_anak = $_POST['jum_anak'] ? $_POST['jum_anak'] : 0;
      switch ($jabatan) {
        case 'manager':
          $gPokok = 20000000;
          break;
        case 'asisten':
          $gPokok = 15000000;
          break;
        case 'kabag':
          $gPokok = 10000000;
          break;
        case 'staff':
          $gPokok = 4000000;
          break;

        default:
          $gPokok = 0;
          break;
      }
      $tunjanganJabatan = 0.2 * $gPokok;
      if ($status == "menikah") {
        if ($jum_anak >= 0 && $jum_anak <= 2) {
          $tunjanganKeluarga = 0.05 * $gPokok;
        } elseif ($jum_anak > 2 && $jum_anak < 6) {
          $tunjanganKeluarga = 0.1 * $gPokok;
        } else {
          $tunjanganKeluarga = 0;
        }
      } else {
        $tunjanganKeluarga = 0;
      }
      $gKotor = $gPokok + $tunjanganJabatan + $tunjanganKeluarga;
      $zakat = $agama == "islam" && $gKotor >= 6000000 ? $gKotor * 0.025 : 0;
    ?>
      <div class="card-form">
        <h1>Perhitungan yang didapatkan</h1>
        <br>
        <table class="data-table" width="100%">
          <tr>
            <td>
              <h4>Nama</h4>
            </td>
            <td>
              <h4><?= ": " . $nama ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Jabatan</h4>
            </td>
            <td>
              <h4><?= ": " . $jabatan ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Agama</h4>
            </td>
            <td>
              <h4><?= ": " . $agama ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Status</h4>
            </td>
            <td>
              <h4><?= ": " . $status ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Jumlah Anak</h4>
            </td>
            <td>
              <h4><?= ": " . $jum_anak ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Gaji Pokok</h4>
            </td>
            <td>
              <h4><?= ": " . $gPokok ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Tunjangan Jabatan</h4>
            </td>
            <td>
              <h4><?= ": " . $tunjanganJabatan ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Tunjangan Keluarga</h4>
            </td>
            <td>
              <h4><?= ": " . $tunjanganKeluarga ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Gaji Kotor</h4>
            </td>
            <td>
              <h4><?= ": " . $gKotor ?></h4>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Zakat</h4>
            </td>
            <td>
              <h4><?= ": " . $zakat ?></h4>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <hr>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Gaji bersih</h4>
            </td>
            <td>
              <h4><?= ": " . $gKotor - $zakat ?></h4>
            </td>
          </tr>
        </table>
      </div>
    <?php
    } ?>
  </div>
</body>
<script>
  let status = document.getElementsByName("status");
  let btn = document.getElementById("btn_cek");

  function cekStatus() {
    if (document.getElementById("menikah").checked) {
      document.getElementById("jum_anak").removeAttribute("disabled");
    } else {
      document.getElementById("jum_anak").value = "";
      document.getElementById("jum_anak").setAttribute("disabled", "true");
    };
  }
</script>

</html>