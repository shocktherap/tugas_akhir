          <?php
          $bulan = $bulan;
          $data1 = array();
          $data2 = array();
          $data3 = array();
          $data4 = array();
          $datanyadb = $this->getdata->getJml($bulan);
          // untuk mendapatkan data array berdasarkan bulan
          
          foreach ($datanyadb as $key){
            $data1[] = (int) $key['jml_bp'];
            $data2[] = (int) $key['jml_bb'];
            $data3[] = (int) $key['jml_bpr'];
            $data4[] = (int) $key['jml_bll'];
          }
          // memasukan data kedalam array
          
          ?>

          <script type="text/javascript">
$(function () {
        $('#container1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pengeluaran Bulan <?php $this->general->bulan($this->uri->segment(3));?>'
            },
            subtitle: {
                text: 'MTS. Al Hidayah'
            },
            xAxis: {
                categories: [
                    '2012',
                    '2013',
                    '2014',
                    '2015',
                    '2016',
                    '2017'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rupiah (Rp)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp.{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Belanja Pegawai',
                data: <?=json_encode($data1);?>
    
            }, {
                name: 'Belanja Barang',
                data: <?=json_encode($data2);?>
    
            }, {
                name: 'Belaja Pemeliharaan',
                data: <?=json_encode($data3);?>
    
            }, {
                name: 'Biaya Lain-Lain',
                data: <?=json_encode($data4);?>
    
            }]
        });
    });
    

    </script>
          <div class="row-fluid">
            <?php 
            $session_data = $this->session->userdata('login');
            for ($i=2012; $i < 2018; $i++){ 
              ?>
              <div class="span3">
                <h2><?=$i;?></h2>
                <p>Catatan : <?php $catatan = $this->getdata->getCatatan($bulan.$i);
                if ($catatan->catatan == null) {
                  echo "Tidak ada Catatan";
                } else {
                  echo $catatan->catatan;
                }
                ?></p>
                <?php
                $status = $this->getdata->getStatus($bulan.$i);
                $rencana = $this->getdata->getstatusrencana($bulan.$i);
                if ($session_data['level'] == 'user2' && $status->status == 0) {

                  $setuju2 = $this->getdata->getpersetujuan2($bulan.$i);
                  if($rencana->status_rencana == 1){
                    ?>
                    <p><a class="btn" href="<?=base_url('home/lihatrencana/'.$bulan.'/'.$i);?>">Lihat rencana Anggaran</a></p>
                    <?php
                  }elseif ($setuju2->status_setuju == 0 && $rencana->status_rencana == 0) {
                    ?>
                      <p><a class="btn btn-primary" href="<?=base_url('home/sistem/'.$bulan.'/'.$i);?>">Lihat Perkiraan Anggaran »</a></p>  
                    <?php
                  }
                ?>

                  

                <?php
                } elseif ($session_data['level'] != 'user2' && $status->status == 0) {
                ?>
                <p><a href="<?=base_url('home/entrydata/'.$bulan.'/'.$i);?>">Entry Data</i></a></p>
                <p><a class="btn btn-primary" href="<?=base_url('home/sistem/'.$bulan.'/'.$i);?>">Perkiraan Anggaran(AHP)</a></p>
                <?php 
                $bulan = $this->uri->segment(3);
                
                if ($rencana->status_rencana == 1) {
                  ?>
                    <p><a class="btn" href="<?=base_url('home/lihatrencana/'.$bulan.'/'.$i);?>">Lihat rencana Anggaran</a></p>
                  <?php
                }
                ?>
                <?php
                } elseif ($status->status == 1 && $session_data['level'] != 'user2') { ?>
                  <p><a href="<?=base_url('home/updatedata/'.$bulan.'/'.$i);?>">Update Data</a></p>
                  <p><a data-toggle="modal" href="#myModal<?=$bulan.$i;?>" >Hapus data</a></p>
                  <div id="myModal<?=$bulan.$i;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Hapus data</h3>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Anda Setuju untuk menghapus data ini?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="<?=base_url('home/cleardata/'.$bulan.'/'.$i);?>" class="btn btn-danger">Ya</a>
                    <button class="btn" data-dismiss="modal">Tidak</button>
                  </div>
                  </div>
                  <!-- <p><a href="<?=base_url('home/cleardata/'.$bulan.$i);?>">Hapus data »</a></p> -->
                  <p><a class="btn" href="<?=base_url('home/viewdetail/'.$bulan.'/'.$i);?>">Lihat rincian »</a></p>
                <?php
                } elseif ($status->status == 1 && $session_data['level'] == 'user2') {
                  ?>
                  <p><a class="btn" href="<?=base_url('home/viewdetail/'.$bulan.'/'.$i);?>">Lihat rincian »</a></p>
                  <?php
                }
                ?>
              </br>
              </div><!--/span-->
            <?php
              }
            ?>
</br>
        <div id="container1"></div>
        </div>
        