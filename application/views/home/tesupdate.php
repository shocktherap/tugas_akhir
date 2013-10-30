          <?php $this->load->view('updatescript');?>
          <?php 
          $data = $this->getdata->getahpupdate1($id);
          $databpr = $this->getdata->getahpupdate3($id);
          $databb = $this->getdata->getahpupdate2($id);
          $dataldj = $this->getdata->getahpupdateldj($id);
          $databhp = $this->getdata->getahpupdatebhp($id);
          $dataatk = $this->getdata->getahpupdateatk($id);
          $datakbm = $this->getdata->getahpupdatekbm($id);
          $dataks = $this->getdata->getahpupdateks($id);
          $datapp = $this->getdata->getahpupdatepp($id);
          ?>
          <h5>Silahkan Isi Formulir dibawah ini</h5>
          <?php 
          $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'entry');
          echo form_open('home/entryupdate1/'.$this->uri->segment(3).$this->uri->segment(4).'/'.$total, $attributes);
          ?>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" onClick="startTotal();" onBlur="stopTotal();">
                      Kriteria Utama Pengeluaran
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>Total Biaya Pengeluaran</label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="total" value="<?=$total;?>" placeholder="something…" ></input><span class="add-on">,00</span></td>
                        </tr>
                        <?php
                        $a= 0;
                        foreach ($data as $key) {
                        	$data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                        ?>
                        <tr>
                        	<?php $a = $a +1;
                          if ($a == 1) {
                            ?>
                            <td><label><a href="#" rel="popover" data-content="Honorarium Guru dan Tenaga Kependidikan Honorer"><?=$data_nama->nama;?></a></label></td>
                            <?php  
                          } elseif($a == 4){
                            ?>
                            <td><label><a href="#" rel="popover" data-content="Upah Tukang"><?=$data_nama->nama;?></a></label></td>
                            <?php  
                          } else {
                            ?>
                            <td><label><?=$data_nama->nama;?></label></td>
                            <?php
                          }
                          ?>
                          <td><span class="add-on"></span><input type=text class="input-mini" name="hitung<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalc<?=$a;?>();"></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text name="hasil<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                        </tr>
                        	<?php
                        }?>
                        <tr class="well">                        
                          <td><label>Total Persentase</label></td>
                          <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasetotal" value="" placeholder=""></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hitungjumlahtotal" value=""></input><span class="add-on">,00</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsefour" onClick="startTotalBB();" onBlur="stopTotalBB();">
                      subKriteria Utama Belanja Barang
                    </a>
                  </div>
                  <div id="collapsefour" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>Total Biaya Pengeluaran</label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="totalbb" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                        </tr>
                        <?php
                        $a= 7;
                        foreach ($databb as $key) {
                        	$data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                        ?>
                        <tr>
                        	<?php $a = $a +1;?>
                          <td><label><?=$data_nama->nama;?></label></td>
                          <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalbb<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalc<?=$a;?>();"></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hasilhitungtotalbb<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>"></input><span class="add-on">,00</td>
                        </tr>
                        	<?php
                        }?>
                        <tr class="well">                        
                          <td><label>Total Persentase</label></td>
                          <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasebb" value="" placeholder="" onBlur="stopCalcBB();"></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hitungjumlahbb" value="" ></input><span class="add-on">,00</td>
                        </tr>
                        </table>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsenine" onClick="startTotalATK();" onBlur="stopTotalATK();">
                                subKriteria Utama Belanja Barang (Alat Tulis Kantor)
                              </a>
                            </div>
                            <div id="collapsenine" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalatk" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($dataatk as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalatk<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onClickon="startCalcATKPersen();" onBlur="stopCalcatk<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input class=" uneditable-input" type=text name="hasilhitungtotalatk<?=$a;?>" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentaseatk" value="" placeholder="" onBlur="stopCalcatk();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hitungjumlahatk" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseeight" onClick="startTotalBHP();" onBlur="stopTotalBHP();">
                                subKriteria Utama Belanja Barang (Bahan Habis Pakai)
                              </a>
                            </div>
                            <div id="collapseeight" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalbhp" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($databhp as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalbhp<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalcbhp<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hasilhitungtotalbhp<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasebhp" value="" placeholder="" onBlur="stopCalcbhp();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hitungjumlahbhp" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>

                          <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseseven" onClick="startTotalLDJ();">
                                subKriteria Utama Belanja Barang (Langganan Daya dan Jasa)
                              </a>
                            </div>
                            <div id="collapseseven" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalldj" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($dataldj as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalldj<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalcldj<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hasilhitungtotalldj<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentaseldj" value="" placeholder="" onBlur="stopCalcldj();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hitungjumlahldj" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsekbm" onClick="startCalckbm1();">
                                subKriteria Utama Belanja Barang (Kegiatan Belajar Mengajar)
                              </a>
                            </div>
                            <div id="collapsekbm" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalkbm" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($datakbm as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalkbm<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalckbm<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hasilhitungtotalkbm<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasekbm" value="" placeholder="" onBlur="stopCalckbm();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hitungjumlahkbm" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseks" onClick="startCalcks1();">
                                subKriteria Utama Belanja Barang (Kegiatan Kesiswaan)
                              </a>
                            </div>
                            <div id="collapseks" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalks" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($dataks as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalks<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalcks<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hasilhitungtotalks<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentaseks" value="" placeholder="" onBlur="stopCalcks();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input class="uneditable-input" type=text name="hitungjumlahks" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>                                    
                        <div class="accordion-group">
                            <div class="accordion-heading">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsepp" onClick="startTotalPP();">
                                subKriteria Utama Belanja Barang (Penyelenggaraan Perpustakaan)
                              </a>
                            </div>
                            <div id="collapsepp" class="accordion-body collapse">
                              <div class="accordion-inner">
                                <table class="table">
                                  <tr>
                                    <td><label>Total Biaya Pengeluaran</label></td>
                                    <td><span class="add-on">Rp. </span><input type=text name="totalpp" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                                  </tr>
                                  <?php
                                  $a= 0;
                                  foreach ($datapp as $key) {
                                    $data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                                  ?>
                                  <tr>
                                    <?php $a = $a +1;?>
                                    <td><label><?=$data_nama->nama;?></label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalpp<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalcpp<?=$a;?>();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hasilhitungtotalpp<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                                  </tr>
                                    <?php
                                  }?>
                                  <tr class="well">                        
                                    <td><label>Total Persentase</label></td>
                                    <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasepp" value="" placeholder="" onBlur="stopCalcpp();"></input><span class="add-on"> %</span></td>
                                    <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hitungjumlahpp" value="" ></input><span class="add-on">,00</td>
                                  </tr>
                                  </table>
                              </div>
                          </div>
                        </div>                                    
<!-- baatas -->

                    </div>
                </div>
            </div>
            <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsefive" onClick="startTotalBPR();">
                      subKriteria Utama Belanja Pemeliharaan
                    </a>
                  </div>
                  <div id="collapsefive" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>Total Biaya Pengeluaran</label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="totalbpr" value="" placeholder="something…" ></input><span class="add-on">,00</span></td>
                        </tr>
                        <?php
                        $a= 5;
                        foreach ($databpr as $key) {
                        	$data_nama =  $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
                        ?>
                        <tr>
                        	<?php $a = $a +1;?>
                          <td><label><?=$data_nama->nama;?></label></td>
                          <td><span class="add-on"></span><input type=text class="input-mini" name="hitungtotalbpr<?=$a;?>" value="<?=$key['persentase'];?>" placeholder="" onBlur="stopCalc<?=$a;?>();"></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text class=" uneditable-input" name="hasilhitungtotalbpr<?=$a;?>" value="<?php echo set_value('hasil'.$a);?>" ></input><span class="add-on">,00</td>
                        </tr>
                        	<?php
                        }?>
                        <tr class="well">                        
                          <td><label>Total Persentase</label></td>
                          <td><span class="add-on"></span><input type=text class="input-mini uneditable-input" name="hitungpersentasebpr" value="" placeholder="" onBlur="stopCalcBPR();"></input><span class="add-on"> %</span></td>
                          <td><span class="add-on">Rp. </span><input type=text class="uneditable-input" name="hitungjumlahbpr" value="" ></input><span class="add-on">,00</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          <?=form_close();?>