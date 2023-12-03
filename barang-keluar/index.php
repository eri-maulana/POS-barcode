<?php

// menjalankan session, agar harus login terlebih dahulu ketika di mengakses halaman ini
session_start();

if (!isset($_SESSION['ssLoginPOST'])) {
    header("location: ../auth/login.php");
    exit();
}

// memanggil halaman lain
require "../config/config.php";
require "../config/functions.php";
require "../module/mode-jual.php";
$title = "Barang Keluar - POS barcode";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";



$nojual = generateNo();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang Keluar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Barang Keluar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section>
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-outline card-secondary p-4">
                            <div class="form-group row mb-2">
                                <label for="noNota" class="col-sm-2 col-form-label">No Nota</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nojual" class="form-control" id="noNota" value="<?= $nojual ?>" readonly>
                                </div>
                                <label for="tglNota" class="col-sm-2 col-form-label">Tanggal Nota</label>
                                <div class="col-sm-4">
                                    <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= @$_GET['tgl'] ? $_GET['tgl'] : date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2 mt-2">
                                <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                                <div class="col-sm-10 input-group">
                                    <input type="text" name="barcode" id="barcode" value="<?= @$_GET['barcode'] ? $_GET['barcode'] : '' ?>" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="icon-barcode">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-outline card-secondary p-3">
                            <h3 class="font-weight-bold text-right">Total Penjualan</h3>
                            <h1 class="font-weight-bold text-right text-green" style="font-size: 40pt;">
                                <input type="hidden" name="total" value="<?= 0 ?>">
                                0
                            </h1>
                        </div>
                    </div>

                </div>
                <div class="card p-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="hidden" name="barcode" value="<?= @$_GET['barcode'] ? $selectbrg['id_barang'] : ''; ?>">
                                <label for="namaBrg">Nama Barang</label>
                                <input type="text" name="namaBrg" id="namaBrg" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? $selectbrg['nama_barang'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? $selectbrg['stock'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? $selectbrg['satuan'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? $selectbrg['harga_jual'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" id="qty" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? 1 : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="jmlHarga">Jumlah Harga</label>
                                <input type="number" name="jmlHarga" id="jmlHarga" class="form-control form-control-sm" value="<?= @$_GET['barcode'] ? $selectbrg['harga_jual'] : ''; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="addBrg" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus fa-sm mr-3"></i> Tambah Barang
                    </button>
                </div>
                <div class="card card-outline card-primary table-responsive px-3">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Jumlah Harga</th>
                                <th class="text-right" widht="10%">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $brgDetail = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nojual'");
                            foreach ($brgDetail as $detail) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $detail['barcode']; ?></td>
                                    <td><?= $detail['nama_brg']; ?></td>
                                    <td class="text-right"><?= number_format($detail['harga_jual'], 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= $detail['qty'] ?></td>
                                    <td class="text-right"><?= number_format($detail['jml_harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <a href="?idbrg=<?= $detail['barcode'] ?>&idbeli=<?= $detail['no_jual'] ?>&qty=<?= $detail['qty'] ?>&tgl=<?= $detail['tgl_jual'] ?>&msg=deleted" class="btn btn-sm btn-danger" title="Hapus Barang" onclick="return confirm('Anda Yakin Ingin Menghapus ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-5 p-3">
                        <div class="form-group row mb-2">
                            <label for="suplier" class="col-sm-3 col-form-label col-form-label-sm">Nama Customer</label>
                            <div class="col-sm-9">
                                <select name="suplier" id="suplier" class="form-control form-control-sm">
                                    <option value="">-- Pilih Customer --</option>
                                    <?php
                                    $customers = getData("SELECT * FROM tbl_customer");
                                    foreach ($customers as $customer) {
                                    ?>
                                        <option value="<?= $customer['nama'] ?>">
                                            <?= $customer['nama'] ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="ktr" class="col-sm-3 col-form-label col-form-label-sm">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea name="ktr" id="ktr" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 p-3">
                        <div class="form-group row mb-2">
                            <label for="bayar" class="col-sm-3 col-form-label">Bayar</label>
                            <div class="col-sm-9">
                                <input type="number" name="bayar" class="form-control form-control-sm text-right" id="bayar">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                            <div class="col-sm-9">
                                <input type="number" name="kembalian" class="form-control form-control-sm text-right" id="kembalian" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 pt-3 ">
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-sm btn-block"><i class="fas fa-save mr-3"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php
    require "../template/footer.php";
    ?>