    <?php

    session_start();

    //koneksi
    $c = mysqli_connect('localhost','root','','db_kasir');


    //loginpage
    if(isset($_POST['login'])){
        //initiate variable
        $username = $_POST['username'];
        $password = $_POST['password'];

        $check = mysqli_query($c, "SELECT * FROM user WHERE username='$username' and password='$password'");
        $hitung = mysqli_num_rows($check);

        if($hitung>0){
            //jika data berhasil di temukan (lbh dari 0)
            //maka dapat login

            $_SESSION['login'] = 'True';
            header('location:index.php'); 
        } else {
            //jika data tidak ditemukan (kurang dari 0)
            //gagal login
            echo '
            <script>alert("Username atau Password salah");
            window.location.href="loginpage.php"
            </script>
            ';
        }
    }

    //barang.php
    if(isset($_POST['tambahbarang'])){
        $namabarang = $_POST['namabarang'];
        $tipebarang = $_POST['tipebarang'];
        $stokbarang = $_POST['stokbarang'];
        $hargabarang = $_POST['hargabarang'];
        $tanggalinput = $_POST['tanggalinput'];

        $insert = mysqli_query($c,"insert into barang (namabarang, tipebarang, stokbarang, hargabarang, tanggalinput) values ('$namabarang', '$tipebarang', '$stokbarang', '$hargabarang', '$tanggalinput')");  

        if($insert){
            header('location:barang.php');
        }else{
            echo '
            <script>alert("Gagal Menambah Barang Baru");
            window.location.href="barang.php"
            </script>
            ';
        }

    }

    //pelanggan.php
    if(isset($_POST['tambahpelanggan'])){
        $namapelanggan = $_POST['namapelanggan'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];
    

        $insert = mysqli_query($c,"insert into pelanggan (namapelanggan, notelp, alamat) values ('$namapelanggan', '$notelp', '$alamat')");  

        if($insert){
            header('location:pelanggan.php');
        }else{
            echo '
            <script>alert("Gagal Menambah Pelanggan Baru");
            window.location.href="pelanggan.php"
            </script>
            ';
        }



    }

    //index.php
    if(isset($_POST['tambahpesanan'])){
        $idpelanggan = $_POST['idpelanggan'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];
    

        $insert = mysqli_query($c,"insert into pesanan (idpelanggan) values ('$idpelanggan')");  

        if($insert){
            header('location:index.php');
        }else{
            echo '
            <script>alert("Gagal Menambah Pesanan Baru");
            window.location.href="index.php"
            </script>
            ';
        }



    }

    //produk yang dipilih di pesanan
    if(isset($_POST['addproduk'])){
        $kodebarang = $_POST['kodebarang'];
        $idp = $_POST['idp'];
        $qty = $_POST['qty']; //jumlah yang barang yang ingin dikeluarkan
    
        //hitung stok sekarang ada berapa 
        $hitung1 = mysqli_query($c, "select * from barang where kodebarang='$kodebarang'");
        $hitung2 = mysqli_fetch_array($hitung1);
        $stoksekarang = $hitung2['stokbarang']; //stok barang saat ini
        
        if($stoksekarang>=$qty){
           
           //kurangi stoknya dengan jumlah yang akan di keluarkan
           $selisih = $stoksekarang-$qty;
           
           
           
           
            //stok cukup^
            // Debugging
        echo "Kode Barang: " . $kodebarang . "<br>";
        echo "ID Pesanan: " . $idp . "<br>";
        echo "Quantity: " . $qty . "<br>";
    
        // Insert data into database
        $insert = mysqli_query($c, "INSERT INTO detailpesanan (idpesanan, kodebarang, qty) VALUES ('$idp', '$kodebarang', '$qty')");
        $update = mysqli_query($c, "update barang set stokbarang='$selisih' where kodebarang='$kodebarang'");

        if($insert&&$update){
            header('location:view.php?idp='.$idp);
        }else{
            echo '
            <script>alert("Gagal Menambah Pesanan Baru");
            window.location.href="view.php'.$idp.'"
            </script>
            ';
        }



        }else { 
            //stok tidak cukup
            echo '
            <script>alert("Stok Barang Tidak Cukup");
            window.location.href="view.php '.$idp.'"
            </script>
            ';
        }

        
    }


    //laporanbarangmasuk
    if(isset($_POST['barangmasuk'])){
        $kodebarang = $_POST['kodebarang'];
        $qty = $_POST['qty'];

        $insertbarangmasuk = mysqli_query($c,"insert into masuk (kodebarang, qty) values('$kodebarang','$qty')");

        if($insertbarangmasuk){
            
        }else {
            echo '
            <script>alert("Stok Barang Tidak Cukup");
            window.location.href="laporan.php"
            </script>
            ';
        }
        
    }


    //hapusbarangpesanan
    if(isset($_POST['hapusbarangpesanan'])){
        $idp = $_POST['idp'];
        $idbr = $_POST['idbr'];
        $idorder = $_POST['idorder'];

        //cek qty sekarang
        $cek1 = mysqli_query ($c, "select * from detailpesanan where iddetailpesanan='$idp' ");
        $cek2 = mysqli_fetch_array($cek1);
        $qtysekarang = $cek2['qty'];

        //cek stok sekarang
        $cek3 = mysqli_query ($c,"select * from barang where kodebarang='$idbr'");
        $cek4 = mysqli_fetch_array($cek3);
        $stoksekarang = $cek4['stokbarang'];

        $hitung = $stoksekarang+$qtysekarang;

        $update = mysqli_query($c,"update barang set stokbarang='$hitung' where kodebarang='$idbr'"); //update stok
        $hapus = mysqli_query($c,"delete from detailpesanan where kodebarang='$idbr' and iddetailpesanan='$idp'");

        if($update&&$hapus){
            header('location:view.php?idp='.$idorder); //harusnya seperti ini '('location:view.php?idp='.$idpelanggan);" ,tapi karena error jadi dibuat seperti ini dlu
        }else{
            echo '
            <script>alert("Gagal menghapus barang baru");
            window.location.href="view.php?idp='.$idorder.'"
            </script>
            ';
        }
    }


    ?>