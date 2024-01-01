<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('barang_masuk/store')?>" method="post">
            <div>
                <label for="">Nama Barang</label>
                <input type="text" name="id_barang" list="barang" class="form-control" required autofocus aut autocomplete="off">
                <datalist id="barang">
                    <?php
                        foreach($d_barang as $b){
                            ?>
                                <option value="<?php
                                    if($b['id'] < 10){
                                        echo "000".$b['id'];
                                    }else if($b['id'] < 100){
                                        echo "00".$b['id'];
                                    }
                                    else if($b['id'] < 1000){
                                        echo "0".$b['id'];
                                    }else if($b['id'] < 1000){
                                        echo $b['id'];
                                    }
                                ?>, <?= $b['nm_barang']?>"></option>
                            <?php
                        }
                    ?>
                </datalist>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input type="date" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Jumlah</label>
                <input type="text" name="total" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Harga</label>
                <input type="text" name="harga" class="form-control" id="rupiah" required autofocus>
            </div>
            <div>
                <label for="">Status</label>
                <select name="status" class="form-control" id="" required>
                    <option value="">--Pilih</option>
                    <option value="Pemerintah">Pemerintah</option>
                    <option value="Pembelian">Pembelian</option>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button onclick="goBack()" class="btn btn-warning">Kembali</button>
            </div>
        </form>
    </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>

<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>
<?= $this->endSection() ?>