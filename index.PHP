
<?php
require_once 'ceklogin.php'; // Memastikan file function.php sudah di-include dan berfungsi


//hitung jumlah pesanan
$h1 = mysqli_query($c, "select * from pesanan");
$h2 = mysqli_num_rows($h1); //jumlah pesanan

$ambilnamausername = mysqli_query($c,"select username from user ");
$nu = mysqli_fetch_array($ambilnamausername);
    $namausn = $nu['username'];



?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />   
        <title>Data Pesanan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.">
                <i class="fas fa-cash-register"></i></div>
                Kasir Warung Ayip
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-shopping-cart"></i></div>
                                Kasir
                            </a>
                            <a class="nav-link" href="barang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang  
                            </a>
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class='fas fa-table'></i></div>
                                Laporan
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-users'></i></i></div>
                                Kelola Pelanggan
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class='fas fa-power-off'></i></i></div>
                                Log out
                            </a>
                       
    
                           
                        
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?=$namausn   ;?></div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pesanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Halo</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pesanan : <?=$h2;?></div>
                                  
                                </div>
                            </div>
                           
                        </div>
 
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Pesanan Baru
                        </button>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah Barang</th>
                                            <th>Aksi</th>
                                        
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    <?php
                                        // Pastikan koneksi database berfungsi
                                        $get = mysqli_query($c, "select * from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan");
                                        
                                        //ambildata dari db
                                        while($b=mysqli_fetch_array($get)){
                                            $idorder = $b['idorder'];
                                            $tanggalpesanan = $b['tanggalpesanan'];
                                            $namapelanggan = $b['namapelanggan'];
                                            $alamat = $b['alamat'];  
                                            $notelp = $b['notelp'];  

                                            //hitung jumlah
                                            $hitungjumlah = mysqli_query($c, "select * from detailpesanan where idpesanan = '$idorder'");
                                            $jumlah = mysqli_num_rows($hitungjumlah);
                                          
                                        ?>
                                            <tr>
                                            
                                                <td><?=$idorder;?></td>
                                                <td><?=$tanggalpesanan;?></td>
                                                <td><?=$namapelanggan;?> -  <?=$alamat;?> - <?=$notelp;?></td>
                                                <td><?=$jumlah;?></td>           
                                                <td><a href ="view.php?idp=<?=$idorder;?>"
                                                 class="btn btn-primary" target="blank">Tampilkan<a> Delete</td>
                                                
                                            </tr>
                                        <?php
                                        } // end of while
                                        ?>
                                        
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
               
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

     <!-- The Modal -->
     <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <!-- Modal body -->
                    <div class="modal-body">
                        Pilih Pelanggan
                        <select name="idpelanggan" class="form-control">

                         <?php 
                         $getpelanggan = mysqli_query($c,"select * from pelanggan");
                         
                         while($pl=mysqli_fetch_array($getpelanggan)){
                            $namapelanggan = $pl['namapelanggan'];
                            $idpelanggan = $pl['idpelanggan'];
                            $alamat = $pl['alamat'];
                         ?>          
                         
                         <option value="<?=$idpelanggan;?>"><?=$namapelanggan;?> - <?=$alamat;?></option>       

                         <?php 
                         
                        }

                         ?>






                        </select>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahpesanan">Tambah Pesanan Baru</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>                                        

</html>
