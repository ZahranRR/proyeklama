
<?php

require 'ceklogin.php'; // Memastikan file function.php sudah di-include dan berfungsi


if(isset($_GET['idp'])) {
    $idp = $_GET['idp'];

    $ambilnamapelanggan = mysqli_query($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan AND p.idorder='$idp'");
    if(mysqli_num_rows($ambilnamapelanggan) > 0) {
        $np = mysqli_fetch_array($ambilnamapelanggan);
        $namapel = $np['namapelanggan'];
    } 
} 



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Pesanan : <?=$idp;?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.">Kasir Warung Ayip</a>
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
                        <div class="small">Logged in as:</div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                          <h1 class="mt-4">Data Pesanan : <?=$idp;?></h1>
                        <h4 class="mt-4">Nama Pelanggan : <?=$namapel;?></h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Halo</li>
                        </ol>
                     
 
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Barang
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
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Sub-total</th>
                                            <th>Aksi</th>
                                        
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    <?php
                                        // Pastikan koneksi database berfungsi
                                        $get = mysqli_query($c, "select * from detailpesanan p, barang br where p.kodebarang=br.kodebarang and idpesanan='$idp'");
                                        $i= 1;
                                        $totalsemua = 0; // Perubahan: Inisialisasi variabel total
                                        
                                        //ambildata dari db
                                        while($b=mysqli_fetch_array($get)){
                                            $idbr = $b['kodebarang'];
                                            $iddp = $b['iddetailpesanan'];
                                            $qty = $b['qty'];
                                            $hargabarang = $b['hargabarang'];
                                            $namabarang = $b['namabarang'];
                                            $subtotal = $qty*$hargabarang;
                                            $totalsemua += $subtotal; // Tambahkan subtotal ke total

                                            
                                        ?>
                                            <tr>
                                            
                                                <td><?=$i++;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td>Rp<?=number_format($hargabarang);?></td>
                                                <td><?=number_format($qty);?></td>           
                                                <td>Rp<?=number_format($subtotal);?></td>           
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idbr;?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                                
                                            </tr>
                                           
                                                <!-- The Modal -->
                                                <div class="modal fade" id="delete<?=$idbr;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Barang Pesanan  </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form method="post"> <!-- Add the form element and specify the action -->
                                                                <div class="modal-body">
                                                      
                                                                     Apakah anda yakin ingin menghapus barang ini? 
                                                                    <input type="hidden" name="idp" value="<?=$iddp;?>"> <!-- Make sure to include the idp value here -->
                                                                    <input type="hidden" name="idbr" value="<?=$idbr;?>"> <!-- Make sure to include the idp value here -->
                                                                    <input type="hidden" name="idorder" value="<?=$idp;?>"> <!-- Make sure to include the idp value here -->
                                                                    
                                                                    
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" name="hapusbarangpesanan">Ya</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form> <!-- Close the form element -->

                                                        </div>
                                                    </div>
                                                </div> 
                                            
                                    


                                        <?php
                                        } // end of while
                                        ?>
                                        
                                            
                                    </tbody>
                                </table>
                                
                                
                                <h4 class="total-harga lm-4 text-end me-5">Total Belanja : Rp<?=number_format($totalsemua);?></h4>
                              
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
                    <h4 class="modal-title">Pilih   </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="view.php"> <!-- Add the form element and specify the action -->
                    <div class="modal-body">
                        Pilih Barang
                        <select name="kodebarang" class="form-control">

                            <?php 
                            $getbarang = mysqli_query($c,"select * from barang where kodebarang not in (select kodebarang from detailpesanan where idpesanan='$idp')");   
                            
                            while($pl=mysqli_fetch_array($getbarang)){
                                $namabarang = $pl['namabarang'];
                                $stokbarang = $pl['stokbarang'];
                                $tipebarang = $pl['tipebarang'];
                                $kodebarang = $pl['kodebarang'];
                            ?>          
                            
                            <option value="<?=$kodebarang;?>"><?=$namabarang;?> - <?=$tipebarang;?> - <?=$stokbarang;?> </option>       

                            <?php 
                            }

                            ?>

                        </select>

                        <input type="number" name="qty" class="form-control mt-4" placeholder="jumlah" min="1" required> 
                        <input type="hidden" name="idp" value="<?=$idp;?>"> <!-- Make sure to include the idp value here -->

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addproduk">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form> <!-- Close the form element -->

            </div>
        </div>
    </div>                                        

</html>
