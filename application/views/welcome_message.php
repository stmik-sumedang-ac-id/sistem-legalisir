<div class="wrapper container">
<div class="parallax_b" >
    <h2>Sistem Legalisir</h2>
    <p>Sekarang anda bisa mengajukan legalisir ijazah STMIK Sumedang via web ini. 
Web ini dapat dibuka melalui perangkat mobile.</p>
    
</div>
<!-- Service Section
    ================================================== -->
<div class="services" id="services" >

  <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="service_tiem">
          <div class="sicon"><i class="fa fa-sign-in"></i></div>
          <h2>REGISTRASI / LOGIN</h2>
          <p>Untuk akses Alumni melakukan login menggunakan No ijazah dan password, jika belum memiliki akun silahkan lakukan registrasi.</p>
           </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service_tiem">
          <div class="sicon"><i class="fa fa-paper-plane"></i></div>
          <h2>PENGAJUAN</h2>
          <p>BAA melakukan review pengajuan legalisasi, jika pengajuan diterima BAA memberikan total tagihan pembayaran untuk alumni</p>
           </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service_tiem">
          <div class="sicon"><i class="fa fa-usd"></i></div>
          <h2>PEMBAYARAN</h2>
          <p>Selanjutnya, Alumni melakukan pembayaran melalui ATM sesuai jumlah yang harus dibayarkan dengan membawa bukti pengajuan.</p>
           </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service_tiem">
          <div class="sicon"><i class="fa fa-file"></i></div>
          <h2>AMBIL IJAZAH</h2>
          <p>Metode pengambilan langung di BAA dapat dilakukan setelah setatus pengajuan "SELESAI" dengan membawa bukti pengajuan. Metode pengambilan legalisasi via Ekspedisi Pengiriman, akan dikirimkan setelah legalisasi selesai. Setiap alumni dengan metode ini akan mendapatkan no resi pengiriman legalisasi</p>
           </div>
      </div>
    </div>
  

    <div class="head_section">
        <h2>NIM TERVERIFIKASI</h2>
        <p>NIM BERIKUT SUDAH DAPAT LOGIN DAN MEGAJUKAN LEGALISIR</p>
        
        <div class="col-md-10 col-md-offset-1 ">
        <table class="table table-responsive" id="tabel_verified">
        <thead>
            <tr>
              <th class="text-center">NIM</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Prodi</th>
            </tr>
        </thead>
        <tbody>
        
        <?php foreach($verified->result() as $mhs): ?>
          <tr>
            <td><?= $mhs->nim?></td>
            <td><?= $mhs->nama?></td>
            <td><?= $mhs->prodi?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        </table>

        </div>
    </div>
</div>

<!-- FOOTER Section
    ================================================== -->
<div class="footer">
    <div class="row">
      <div class="col-xs-6">
        <div class="mborder"></div>
      </div>
      <div class="col-xs-6">
        <div class="qborder"></div>
      </div>
    </div>
    
    
</div>
<!-- / contact Close --> 
</div>