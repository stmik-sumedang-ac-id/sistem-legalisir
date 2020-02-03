	$(function(){
		$.get('<?= site_url('ongkir/get_provinsi')?>',{},(response)=>{
			let output = '';
			let provinsi  = response.rajaongkir.results
			console.log(response)
		
			provinsi.map((val,i)=>{
				output+=`<option value="${val.province_id}" >${val.province}</option>`
			})
			$('.provinsi').html(output)

		})
	});

	function get_kota(type){
			let id_provinsi_asal = $(`#provinsi_${type}`).val();
			//alert(id_provinsi_asal)
			$.get("<?= site_url('ongkir/get_kota/')?>/"+id_provinsi_asal,{},(response)=>{
			let output = '';
			let kota  = response.rajaongkir.results
			console.log(response)

			kota.map((val,i)=>{
				output+=`<option value="${val.city_id}" >${val.city_name}</option>`
			})
			$(`#kota_${type}`).html(output)
		});
	}

	function get_ongkir(){
		let berat = $('#berat').val();
		let asal = $('#kota_asal').val();
		let tujuan = $('#kota_tujuan').val();
		let kurir = $('#kurir').val();
		let output = '';
		$.get("<?= site_url('ongkir/get_biaya/')?>"+`/${asal}/${tujuan}/${berat}/${kurir}`,{},(response)=>{
			console.log(response)
			let biaya  = response.rajaongkir.results
			console.log(biaya)

			biaya.map((val,i)=>{
				for (var i = 0; i < val.costs.length; i++) {
					let jenis_layanan = val.costs[i].service
					val.costs[i].cost.map((val,i)=>{
						output+=`<option value="${jenis_layanan} -- Rp.${val.value} ${val.etd} Hari">${jenis_layanan} -- Rp.${val.value} ${val.etd} Hari
						</option>`
					})
				}
			})
			$(`#service`).html(output)
		});
	}
