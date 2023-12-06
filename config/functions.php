<?php

// fungsi validasi upload gambar profil
function uploadimg($url = null, $name = null)
{
   $namafile = $_FILES['image']['name'];
   $ukuran   = $_FILES['image']['size'];
   $tmp      = $_FILES['image']['tmp_name'];

   // validasi file gambar yang boleh di upload
   $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'gif'];
   $ekstensiGambar      = explode('.', $namafile);
   $ekstensiGambar      = strtolower(end($ekstensiGambar));
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      if ($url != null) {
         echo '<script>
               alert("data yang anda unggah bukan gambar !! data gagal diubah!!");
               document.location.href = "' . $url . '";
            </script>';
         die();
      } else {
         echo "<script>
         alert('data yang anda unggah bukan gambar !! data gagal ditambahkan!!');
         </script>";
         return false;
      }
   }

   // validasi ukuran gambar max 1 MB
   if ($ukuran > 1000000) {
      if ($url != null) {
         echo '<script>
               alert("ukuran gambar melebihi 1 mb, data gagal di ubah");
               document.location.href = "' . $url . '";
            </script>';
         die();
      } else {
         echo "<script>
                  alert('gambar tidak boleh lebih dari 1 MB');
               </script>";
         return false;
      }
   }

   if ($name != null) {
      $namaFileBaru = $name . '.' . $ekstensiGambar;
   } else {
      $namaFileBaru = rand(10, 1000) . '-' . $namafile;
   }


   move_uploaded_file($tmp, '../asset/image/' . $namaFileBaru);
   return $namaFileBaru;
}


// fungsi menangkap data dari tabel database
function getData($sql)
{
   global $koneksi;
   $result = mysqli_query($koneksi, $sql);
   $rows = [];
   while ($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
   }
   return $rows;
}

// fungsi menampilkan nama pengguna pada bagian navbar
function userLogin()
{
   $userActive = $_SESSION["ssUserPOST"];
   $dataUser = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
   return $dataUser;
}

// fungsi untuk memeriksa url yang sedang aktif  
function userMenu()
{
   $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
   $uri_segment = explode('/', $uri_path);
   $menu = $uri_segment[2]; // 2 adalah urutan folder pada url "setelah folder project"
   return $menu;
}

// membuat sidebar dashboard tersorot
function menuHome()
{
   if (userMenu() == 'dashboard.php') {
      $result = 'active';
   } else {
      $result = null;
   }
   return $result;
}

// fungsi membuat menu master terbuka
function menuMaster()
{
   if (userMenu() == 'supplier' || userMenu() == 'customer' || userMenu() == 'barang') {
      $result = 'menu-is-open menu-open';
   } else {
      $result = null;
   }
   return $result;
}

// membuat sidebar supplier tersorot ketika berada di halaman tersebut
function menuSupplier()
{
   if (userMenu() == 'supplier') {
      $result = 'active';
   } else {
      $result = null;
   }
   return $result;
}

// membuat sidebar customer tersorot ketika berada di halaman tersebut
function menuCustomer()
{
   if (userMenu() == 'customer') {
      $result = 'active';
   } else {
      $result = null;
   }
   return $result;
}

// membuat sidebar barang tersorot ketika berada di halaman tersebut
function menuBarang()
{
   if (userMenu() == 'barang') {
      $result = 'active';
   } else {
      $result = null;
   }
   return $result;
}

// merubah format tanggal amerika menjadi format indonesia (dd-mm-yyyy)
function in_date($tgl)
{
   $tg = substr($tgl, 8, 2);
   $bln = substr($tgl, 5, 2);
   $thn = substr($tgl, 0, 4);
   return "$tg-$bln-$thn";
}