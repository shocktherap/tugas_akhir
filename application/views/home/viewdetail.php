<?php
$id = $this->uri->segment(3).$this->uri->segment(4);
$data_keuangan = $this->getdata->getdatakeuangan($id);

$data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }

              $data5 = $data_keuangan->jml_bp;
              $data6 = $data_keuangan->jml_bb;
              $data7 = $data_keuangan->jml_bpr;
              $data8 = $data_keuangan->jml_bll;
              $data9 = $data_keuangan->jml_total;

              $percent_bp = ($data5/$data9)*100;
              $percent_bb = ($data6/$data9)*100;
              $percent_bpr = ($data7/$data9)*100;
              $percent_bll = ($data8/$data9)*100;

              // $data_bpr1 = $row->bpr1;
              // $data_bpr2 = $row->bpr2;
              // $total_bpr = $data_bpr1+$data_bpr2;
              // $percent_bpr1 = ($data_bpr1 / $total_bpr) * $percent_bpr;
              // $percent_bpr2 = ($data_bpr2 / $total_bpr) * $percent_bpr;
echo "Catatan: ".$data_keuangan->catatan;
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
                text: 'Pengeluaran bulan <?php $this->general->bulan($this->uri->segment(3));?> tahun <?=$this->uri->segment(4);?>'
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
                  <th>#</th>
                  <th>Category</th>
                  <th>Pengeluaran</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.1</td>
                  <td>Honorarium Guru dan Tenaga Kependidikan Honorer</td>
                  <td>Rp  <?=$value[0] = number_format($value[0],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.1</td>
                  <td>Alat Tulis Kantor</td>
                  <td>Rp  <?=$value[1] = number_format($value[1],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.1.1</td>
                  <td>Papan Data</td>
                  <td>Rp  <?=$value[2] = number_format($value[2],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.1.2</td>
                  <td>Printer</td>
                  <td>Rp  <?=$value[3] = number_format($value[3],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.1.3</td>
                  <td>Perangkat Komputer</td>
                  <td>Rp  <?=$value[4] = number_format($value[4],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.2.1</td>
                  <td>Buku Tulis, pensil, bahan praktikum</td>
                  <td>Rp  <?=$value[5] = number_format($value[5],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.2.2</td>
                  <td>Foto Kopi</td>
                  <td>Rp  <?=$value[6] = number_format($value[6],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.3.1</td>
                  <td>Langganan Listrik</td>
                  <td>Rp  <?=$value[7] = number_format($value[7],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.3.2</td>
                  <td>Langganan Telepon</td>
                  <td>Rp  <?=$value[8] = number_format($value[8],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.1</td>
                  <td>Tes Semester</td>
                  <td>Rp  <?=$value[9] = number_format($value[9],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.1.1</td>
                  <td>Pengawas</td>
                  <td>Rp  <?=$value[10] = number_format($value[10],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.1.2</td>
                  <td>Pembuat Soal</td>
                  <td>Rp  <?=$value[11] = number_format($value[11],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.1.3</td>
                  <td>Percetakan Dokumen</td>
                  <td>Rp  <?=$value[12] = number_format($value[12],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.1.4</td>
                  <td>Cetak brosur dan spanduk</td>
                  <td>Rp  <?=$value[13] = number_format($value[13],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.2</td>
                  <td>Ujian AKhir Sekolah</td>
                  <td>Rp  <?=$value[14] = number_format($value[14],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.3</td>
                  <td>Ulangan Umum Harian</td>
                  <td>Rp  <?=$value[15] = number_format($value[15],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.4.4</td>
                  <td>Pengadaan Bahan teori /praktek</td>
                  <td>Rp  <?=$value[16] = number_format($value[16],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.5.1</td>
                  <td>Kegiatan Osis</td>
                  <td>Rp  <?=$value[17] = number_format($value[17],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.5.2</td>
                  <td>Penyelenggaraan Lomba</td>
                  <td>Rp  <?=$value[18] = number_format($value[18],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.5.3</td>
                  <td>Kegiatan Pramuka</td>
                  <td>Rp  <?=$value[19] = number_format($value[19],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.5.4</td>
                  <td>Pembinaan Keagamaan</td>
                  <td>Rp  <?=$value[20] = number_format($value[20],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.5.5</td>
                  <td>Kegiatan Sanggar Belajar</td>
                  <td>Rp  <?=$value[21] = number_format($value[21],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.6.1</td>
                  <td>Buku Pelajaran Pokok</td>
                  <td>Rp  <?=$value[22] = number_format($value[22],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.6.2</td>
                  <td>Buku Penunjang</td>
                  <td>Rp  <?=$value[23] = number_format($value[23],2,",",".");?></td>
                </tr>
                <tr>
                  <td>2.7.1</td>
                  <td>Bantuan Untuk Siswa</td>
                  <td>Rp  <?=$value[24] = number_format($value[24],2,",",".");?></td>
                </tr>
                <tr>
                  <td>3.1</td>
                  <td>Biaya Perawatan ringan</td>
                  <td>Rp  <?=$value[25] = number_format($value[25],2,",",".");?></td>
                </tr>
                <tr>
                  <td>3.1.1</td>
                  <td>Biaya Pembuatan Taman</td>
                  <td>Rp  <?=$value[26] = number_format($value[26],2,",",".");?></td>
                </tr>
                <tr>
                  <td>4.1</td>
                  <td>Upah Tukang</td>
                  <td>Rp  <?=$value[27] = number_format($value[27],2,",",".");?></td>
                </tr>
                <tr>
                  <td>*</td>
                  <td>Jumlah Belanja Pegawai</td>
                  <td>Rp  <?=$data5 = number_format($data5,2,",",".");?></td>
                </tr>
                <tr>
                  <td>*</td>
                  <td>Jumlah Belanja Barang</td>
                  <td>Rp  <?=$data6 = number_format($data6,2,",",".");?></td>
                </tr>
                <tr>
                  <td>*</td>
                  <td>Jumlah Belanja Pemeliharaan</td>
                  <td>Rp  <?=$data7 = number_format($data7,2,",",".");?></td>
                </tr>
                <tr>
                  <td>*</td>
                  <td>Jumlah Belanja Lain-lain</td>
                  <td>Rp  <?=$data8 = number_format($data8,2,",",".");?></td>
                </tr>
                <tr>
                  <td>**</td>
                  <td>Jumlah Total Pengeluaran</td>
                  <td>Rp  <?=$data9 = number_format($data9,2,",",".");?></td>
                </tr>
              </tbody>
            </table>
            <a class="btn btn-primary" href="<?=base_url('home/printdetail/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">Cetak Data »</a>
            </br>Terakhir diubah <?=$data_keuangan->last_update_at;?>
            oleh <?php $nama = $this->getdata->getnamauser($data_keuangan->last_update_by); echo $nama->nama?>