<?php  

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/basic/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$berat&courier=$courier",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
		"key:fbd791dbdaa5ed2f93cd83f0f68887ef"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data = json_decode($response, true);
}
?>
<?php echo $provinsi = $data['rajaongkir']['origin_details']['province_id'];?><br>
<?php echo $provinsi = $data['rajaongkir']['origin_details']['city_id'];?><br>
<?php echo $provinsi = $data['rajaongkir']['destination_details']['province'];?><br>
<?php echo $postal_code = $data['rajaongkir']['destination_details']['postal_code'];?><br>
<?php echo "&nbsp;&nbsp;&nbsp;From ".$data['rajaongkir']['origin_details']['city_name'];?> To <?php echo $kota = $data['rajaongkir']['destination_details']['city_name'];?> @<?php echo $berat;?> gram Courier : <?php echo strtoupper($courier); ?>
<?php for ($k=0; $k < count($data['rajaongkir']['results']); $k++) : ?>
<div title="<?php echo strtoupper($data['rajaongkir']['results'][$k]['name']);?>" style="padding:10px">
	<table class="table table-striped table-border table-hover">
		<tr class="table-primary">
			<th>No.</th>
			<th>Service Type</th>
			<th>ETD</th>
			<th>Harga</th>
		</tr>
		<?php for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++): ?>
		<tr>
			<td><?php echo $l+1;?></td>
			<td>
				<div style="font:bold 16px Arial"><?php echo $layanan = $data['rajaongkir']['results'][$k]['costs'][$l]['service'];?></div>
				<div style="font:normal 11px Arial"><?php echo $data['rajaongkir']['results'][$k]['costs'][$l]['description'];?></div>
			</td>
			<td align="left">&nbsp;<?php echo  $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd'];?> days</td>
			<td align="left"><?php echo number_format($data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']);?></td>
			<?php if($layanan == 'REG'){
				$layanans = $data['rajaongkir']['results'][$k]['costs'][$l]['service'];
				$deskripsi_layanan = $data['rajaongkir']['results'][$k]['costs'][$l]['description'];
				$estimasi = $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['etd'];
				$ongkos_kirim = $data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];
				} ?>
		</tr>
	<?php endfor; ?>
	</table>
</div>
<?php endfor; ?>
			<a href="<?php echo base_url('legalisir/tambahOngkosKirim/'.$ongkos_kirim); ?>">Lanjut Ke Pembayaran</a>
			<form action="">

			<input type="text" value="<?= $ongkos_kirim ?>">
			<input type="text" value="<?= $postal_code ?>">
			<input type="text" value="<?= $provinsi ?>">
			<input type="text" value="<?= $kota ?>">
			<input type="text" value="<?= $layanans ?>">
			<input type="text" value="<?= $deskripsi_layanan ?>">
			<input type="text" value="<?= $estimasi ?>">
			</form>