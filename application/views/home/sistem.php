<?php
$bulan = $this->uri->segment(3);
$tahun = $this->uri->segment(4); 
$id = $bulan.$tahun;
$data_awal = $id-1;
$status = $this->getdata->getStatus($data_awal);
$status = $status->status;
if ($status == 1) {
    $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'entry');
    echo form_open('home/sistem/'.$bulan.'/'.$tahun, $attributes);
    ?>
    <?php
                if(!form_error('siswa')){
                $message = "";
                } else {
                    $message = "error";
                }
            ?>
             <?php
                if(!form_error('biaya')){
                $message2 = "";
                } else {
                    $message2 = "error";
                }
            ?>
    <div class="control-group <?=$message;?>">
	    <label class="control-label" for="inputEmail">Jumlah Siswa</label>
	    <div class="controls">
		    <input type="text" id="input1" name="siswa" value="<?php echo set_value('siswa');?>" placeholder="banyak siswa"></input>
		    <span class="help-inline"><?php echo form_error('siswa');?></span>
	    </div>
	</div>
	<div class="control-group <?=$message2;?>">
	    <label class="control-label" for="inputPassword">Besar Biaya Satuan BOS Perbulan</label>
	    <div class="controls">
	        <input type="text" id="input2" name="biaya" value="<?php echo set_value('biaya');?>" placeholder="besar biaya satuan BOS"></input></br>
	        <span class="help-inline"><?php echo form_error('biaya');?></span>
	    </div>
	</div>
	<div class="control-group">
	    <div class="controls">
	    <button type="submit" class="btn">Proses</button>
	    </div>
	</div>
<?php echo form_close();
		if ($hasil != null) {
		?>
		<h4 class="well">Total Pengeluaran : Rp <?php echo $jumlah = number_format($hasil['jumlah'],2,",",".");?></h4>
		<?php
		$data = $hasil['data'];
		?>
            <h3>Pengeluaran Kriteria Utama</h3>
			     <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="span1">Peringkat</th>
                  <th class="span6">Kategori Pengeluaran</th>
                  <th class="span2">Prioritas</th>
                  <th class="span3">Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
                <?php $dataahp1 = $this->getdata->getahp1($id);
                $a = 0;
                    foreach ($dataahp1 as $key1) {
                      $namapengeluaran = $this->getdata->getnamapengeluaran($key1['id_pengeluaran']);
                      if ($key1['pengeluaran'] > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td><?php echo $a = $a+1;?></td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$key1['prioritas'];?></td>
                        <td><?php echo "Rp. ".$key1['pengeluaran'] = number_format($key1['pengeluaran'],2,",",".");?></td>
                      </tr>
                      <?php
                    }
                    ?>
              </tbody>
            </table>
            <h3>Pengeluaran subkriteria Belanja Pegawai</h3>
            
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="span1">Peringkat</th>
                  <th class="span6">Kategori Pengeluaran</th>
                  <th class="span2">Prioritas</th>
                  <th class="span3">Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
                <?php $dataahp4 = $this->getdata->getahp4($id);
                $namapengeluaran = $this->getdata->getnamapengeluaran($dataahp4->id_pengeluaran);
                if ($dataahp4->pengeluaran > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td>1</td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$dataahp4->prioritas;?></td>
                        <td><?php echo "Rp. ".$dataahp4->pengeluaran = number_format($dataahp4->pengeluaran,2,",",".");?></td>
                      </tr>
              </tbody>
            </table>

            <h3>Pengeluaran subkriteria Belanja Barang</h3>
            <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="span1">Peringkat</th>
                        <th class="span6">Kategori Pengeluaran</th>
                        <th class="span2">Prioritas</th>
                        <th class="span3">Pengeluaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $dataahp2 = $this->getdata->getahp2($id);
                    $b=0;
                    foreach ($dataahp2 as $key3) {
                      $namapengeluaran = $this->getdata->getnamapengeluaran($key3['id_pengeluaran']);
                      if ($key3['pengeluaran'] > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td><?php echo $b = $b+1;?></td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$key3['prioritas'];?></td>
                        <td><?php echo "Rp. ".$key3['pengeluaran'] = number_format($key3['pengeluaran'],2,",",".");?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
          </table>

            <h3>Pengeluaran subkriteria Belanja Pemeliharaan</h3>
            <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="span1">Peringkat</th>
                        <th class="span6">Kategori Pengeluaran</th>
                        <th class="span2">Prioritas</th>
                        <th class="span3">Pengeluaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $dataahp3 = $this->getdata->getahp3($id);
                    $c=0;

                    foreach ($dataahp3 as $key2) {
                      $namapengeluaran = $this->getdata->getnamapengeluaran($key2['id_pengeluaran']);
                      if ($key2['pengeluaran'] > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td><?php echo $c=$c+1;?></td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$key2['prioritas'];?></td>
                        <td><?php echo "Rp. ".$key2['pengeluaran'] = number_format($key2['pengeluaran'],2,",",".");?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
          </table>          
          <h3>Pengeluaran subkriteria Biaya Lain-Lain</h3>
          <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="span1">Peringkat</th>
                  <th class="span6">Kategori Pengeluaran</th>
                  <th class="span2">Prioritas</th>
                  <th class="span3">Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
                <?php $dataahp5 = $this->getdata->getahp5($id);
                $namapengeluaran = $this->getdata->getnamapengeluaran($dataahp5->id_pengeluaran);
                if ($dataahp5->pengeluaran > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td>1</td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$dataahp5->prioritas;?></td>
                        <td><?php echo "Rp. ".$dataahp5->pengeluaran = number_format($dataahp5->pengeluaran,2,",",".");?></td>
                      </tr>
              </tbody>
            </table>

            <h3>Pengeluaran Lengkap Kriteria Belanja Barang</h3>
            <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="span1">Peringkat</th>
                        <th class="span6">Kategori Pengeluaran</th>
                        <th class="span2">Prioritas</th>
                        <th class="span3">Pengeluaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $dataahp6 = $this->getdata->getahp6($id);
                    $c=0;
                    foreach ($dataahp6 as $key3) {
                      $namapengeluaran = $this->getdata->getnamapengeluaran($key3['id_pengeluaran']);
                      if ($key3['pengeluaran'] > 0 ) {
                        $ket = "success";
                      } else {
                        $ket = "warning";
                      }
                      ?>
                      <tr class="<?=$ket;?>">
                        <td><?php echo $c=$c+1;?></td>
                        <td><?php echo $namapengeluaran->nama;?></td>
                        <td><?=$key3['prioritas'];?></td>
                        <td><?php echo "Rp. ".$key3['pengeluaran'] = number_format($key3['pengeluaran'],2,",",".");?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
          </table>          
          <a class="btn btn-primary" href="<?=base_url('home/printoutput/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">Cetak Rencana Anggaran »</a>
          <?php
          $session_data = $this->session->userdata('login');
          if ($session_data['username'] != "user2") {
          ?>
          <a class="btn" href="<?=base_url('home/buatrencana/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$hasil['jumlah']);?>">Buat Rencana Anggaran »</a>
          <?php  
          }
          ?>
          
<?php
}
	} else {
		?>
		<div class="well">
	    Silahkan Masukan data tahun lalu terlebih dahulu
	    </div>
		<?php
	}
?>