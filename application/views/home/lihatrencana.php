<?php
$row = $this->getdata->getrencanapengeluaran($id);
$persetujuan = $this->getdata->getpersetujuan($id);
$persentase = $this->getdata->getpersentasekriteriautama($id);
$datapersen = array();
foreach ($persentase as $key) {
  $datapersen[] = $key['persentase2'];
}
              $percent_bp = $datapersen[0];
              $percent_bb = $datapersen[1];
              $percent_bpr = $datapersen[2];
              $percent_bll = $datapersen[3];
?>
<?php
  if ($persetujuan->status_setuju == 0) {
    ?>
    <span class="label label-warning span6"><h4> Rencana Perancangan Anggaran Belum Disetujui</h4></span>
    <?php
  } else {?>
  <span class="label label-success span6"><h4> Rencana Perancangan Anggaran Telah Disetujui</h4></span>
<?php
  }
?>
<script type="text/javascript">
$(function () {
    
        var colors = Highcharts.getOptions().colors,
            categories = ['Belanja Pegawai', 'Belanja Barang', 'Belanja Pemeliharaan', 'Belanja Lain-lain'],
            name = 'Pengeluaran',
            data = [{
                    y: <?=$percent_bp;?>,
                    color: colors[0],
                    drilldown: {
                        name: 'Belanja Pegawai',
                        categories: ['Belanja Pegawai'],
                        data: [<?=$percent_bp;?>],
                        color: colors[0]
                    }
                }, {
                    y: <?=$percent_bb;?>,
                    color: colors[1],
                    drilldown: {
                        name: 'Belanja Barang',
                        categories: ['Belanja Barang'],
                        data: [<?=$percent_bb;?>],
                        color: colors[1]
                    }
                }, {
                    y: <?=$percent_bpr;?>,
                    color: colors[2],
                    drilldown: {
                        name: 'Belanja Pemeliharaan',
                        categories: ['Belanja Pemeliharaan'],
                        data: [<?=$percent_bpr;?>],
                        color: colors[2]
                    }
                }, {
                    y: <?=$percent_bll;?>,
                    color: colors[3],
                    drilldown: {
                        name: 'Biaya Lain-lain',
                        categories: ['Biaya Lain-Lain'],
                        data: [<?=$percent_bll;?>],
                        color: colors[3]
                    }
                }];
    
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        $('#container').highcharts({
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Rencana Anggaran bulan <?php $this->general->bulan($this->uri->segment(3));?> tahun <?=$this->uri->segment(4);?>'
            },
            yAxis: {
                title: {
                    text: 'Total percent'
                }
            },
            plotOptions: {
                pie: {
                    shadow: true,
                    center: ['50%', '50%']
                }
            },
            tooltip: {
              valueSuffix: '%'
            },
            series: [{
                name: 'Browsers',
                data: browserData,
                size: '60%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -30
                }
            }, {
                name: 'Versions',
                data: versionsData,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                    }
                }
            }]
        });
    });
    

    </script>
    <div id="container"></div>
<table class="table table-hover">
              <thead>
                <tr>
                  <th>no</th>
                  <th>Tipe Prioritas</th>
                  <th>Category</th>
                  <th>Persentase</th>
                  <th>Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $a = 0;
                foreach ($row as $key) {
                  ?>
                  <tr>
                  <td><?php echo $a = $a+1;?></td>
                  <td><?php $prioritas = $this->getdata->getnamaprioritas($key['tipe_prioritas']);
                  echo $prioritas->nama_prioritas;
                  ?></td>
                  <td><?php $prioritas = $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                  echo $prioritas->nama;
                  ?></td>
                  <td><?=$key['persentase2'];?> %</td>
                  <td>Rp  <?=$key['pengeluaran2'] = number_format($key['pengeluaran2'],2,",",".");?></td>
                </tr>                
                <?php
                  }
                ?>                
              </tbody>
            </table>
            <?php 
            $session_data = $this->session->userdata('login');
            if ($session_data['username'] == "admin") {
              if ($persetujuan->status_setuju == 0) {?>
                <p><a class="btn btn-success" href="<?=base_url('home/persetujuan/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/1');?>">Setujui Rencana Anggaran</a></p>  
              <?php  
              } elseif ($persetujuan->status_setuju == 1) {
                ?>
                <p><a class="btn btn-warning" href="<?=base_url('home/persetujuan/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/0');?>">Batalkan Rencana Anggaran</a></p>  
                <?php
              }
            }
            ?>
            <?php
            if ($session_data['username'] != "user2") {
              ?>
                <p><a class="btn" href="<?=base_url('home/updaterencana2/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">Update Rencana Anggaran</a></p>
            <p><a class="btn btn-primary" href="<?=base_url('home/printoutput2/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">Cetak Data »</a></p>

              <?php }
              else
              {
                ?>
                <p><a class="btn btn-primary" href="<?=base_url('home/printoutput2/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">Cetak Data »</a></p>
                <?php
              }
            ?>
            </br>Terakhir diubah <?=$persetujuan->rencana_last_update_at;?>
            oleh <?=$persetujuan->rencana_last_update_by;?>