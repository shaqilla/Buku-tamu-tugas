<?php
require_once('function.php');
include_once('template/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku Tamu</h1>

    <?php
    // jika ada tombol simpan
    if (isset($_POST['simpan'])) {
      if (tambah_tamu($_POST) > 0) {

    ?>
       <div class="alert alert-success" role="alert">
        Data berhasil disimpan!
       </div>
      <?php
      } else {
      ?>
        <div class="alert alert-danger" role="alert">
          Data gagal disimpan!
        </div>
    
    <?php
      }
    }
    ?>
    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Data Tamu</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Tamu</th>
                                            <th>Alamat</th>
                                            <th>No. Telp/HP</th>
                                            <th>Bertemu Dengan</th>
                                            <th>Kepentingan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // penomoran auto-increment
                                        $no = 1;
                                        // Query untuk memanggil semua data dari tabel buku_tamu
                                        $buku_tamu = query("SELECT * FROM buku_tamu");
                                        foreach($buku_tamu as $tamu) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $tamu['tanggal'] ?></td>
                                            <td><?= $tamu['nama_tamu'] ?></td>
                                            <td><?= $tamu['alamat'] ?></td>
                                            <td><?= $tamu['no_hp'] ?></td>
                                            <td><?= $tamu['bertemu'] ?></td>
                                            <td><?= $tamu['kepentingan'] ?></td>
                                            <td><button class="btn btn-succes" type="button">Ubah</button></td>
                                            <td><button class="btn btn-danger" type="button">Hapus</button></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

<?php
// mengambil data barang dari tabel dengan kode terbesar
$query = mysqli_query($koneksi, "SELECT max(id_tamu) as kodeTerbesar FROM buku_tamu");
$data = mysqli_fetch_array($query);
$kodeTamu = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan di ubah ke integer dengan (int)
$urutan = (int) substr($kodeTamu, 2, 3);

// noor yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membuat kode barang baru
// string sprintif("%03s", $urutan); berfungsi untuk membuat string menjadi 3 karakter

// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya zt
$huruf = 'zt';
$kodeTamu = $huruf . sprintf('%03s', $urutan);
?>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <input type="hidden" name="id_tamu" id="id_tamu" value="<?= $kodeTamu ?>">
          <div class="form-group row">
            <label for="nama tamu" class="col-sm-3 col-form-label">Nama Tamu</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama_tamu" name="nama_tamu">
            </div>
          </div>
          <div class="form-group row">
            <label for="nama tamu" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
          </div>
          <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="no_hp" name="no_hp">
            </div>
          </div>
          <div class="form-group row">
            <label for="bertemu" class="col-sm-3 col-form-label">Bertemu dg.</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="bertemu" name="bertemu">
            </div>
          </div>
          <div class="form-group row">
            <label for="kepentingan" class="col-sm-3 col-form-label">Kepentingan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="kepentingan" name="kepentingan">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php
include_once('template/footer.php');
?>