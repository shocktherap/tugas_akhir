<?php $this->load->view('entryscript');?>
          <h5>Silahkan Isi Formulir dibawah ini</h5>
          <?php 
          $data = $this->getdata->getDataBy($this->uri->segment(3).$this->uri->segment(4));
          $value = array();
          foreach ($data as $key) {
             $value[] = $key['nominal'];
          }
          $attributes = array('class' => 'form_inline', 'id' => 'myform', 'name' => 'entry');
          echo form_open('home/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4), $attributes);
          ?>
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" onClick="startAll();">
                      1. Belanja Pegawai
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>1.1 Honorarium Guru dan Tenaga Kependidikan Honorer</label></td>
                          <td><span class="add-on">Rp. </span><input name="bp" type="text" value="<?php echo $value[0];?>"  placeholder="something…"></input><span class="add-on">,00</span></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" onClick="startAll();">
                      2. Belanja Barang
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td>
                            <h6>2.1 ATK</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="atk" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.1 Alat Tulis Kantor</label></td>
                          <td><span class="add-on">Rp. </span><input name="atk1" type="text" value="<?php echo $value[1];?>" placeholder="something…" onFocus="startCalcAtk();"  onBlur="stopCalcAtk();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.1.1 Papan Data</label></td>
                          <td><span class="add-on">Rp. </span><input name="atk2" type="text" value="<?php echo $value[2];?>" placeholder="something…" onFocus="startCalcAtk();" onBlur="stopCalcAtk();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.1.2 Printer</label></td>
                          <td><span class="add-on">Rp. </span><input name="atk3" type="text" value="<?php echo $value[3];?>" placeholder="something…" onFocus="startCalcAtk();" onBlur="stopCalcAtk();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.1.3 Perangkat Komputer</label></td>
                          <td><span class="add-on">Rp. </span><input name="atk4" type="text" value="<?php echo $value[4];?>" placeholder="something…" onFocus="startCalcAtk();" onBlur="stopCalcAtk();"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.2 Bahan Habis Pakai</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="bhp" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.2.1 Buku Tulis, pensil, bahan praktikum</label></td>
                          <td><span class="add-on">Rp. </span><input name="bhp1" type="text" value="<?php echo $value[5];?>" placeholder="something…" onFocus="startCalcBhp();" onBlur="stopCalcBhp();"></input><span class="add-on"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.2.2 Foto Kopi</label></td>
                          <td><span class="add-on">Rp. </span><input name="bhp2" type="text" value="<?php echo $value[6];?>" placeholder="something…" onFocus="startCalcBhp();" onBlur="stopCalcBhp();"></input><span class="add-on"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.3 Langganan Daya dan Jasa</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="ldj" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.3.1 Langganan Listrik</label></td>
                          <td><span class="add-on">Rp. </span><input name="ldj1" type="text" value="<?php echo $value[7];?>" placeholder="something…" onFocus="startCalcLdj();" onBlur="stopCalcLdj();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.3.2 Langganan Telepon</label></td>
                          <td><span class="add-on">Rp. </span><input name="ldj2" type="text" value="<?php echo $value[8];?>" placeholder="something…" onFocus="startCalcLdj();" onBlur="stopCalcLdj();"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.4 Kegiatan Belajar Mengajar</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="kbm" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.4.1 Tes Semester</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm1" type="text" value="<?php echo $value[9];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.1.1 Pengawas</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm2" type="text" value="<?php echo $value[10];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.1.2 Pembuat Soal</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm3" type="text" value="<?php echo $value[11];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.1.3 Percetakan Dokumen</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm4" type="text" value="<?php echo $value[12];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.1.4 Cetak brosur dan spanduk</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm5" type="text" value="<?php echo $value[13];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.2 Ujian AKhir Sekolah</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm6" type="text" value="<?php echo $value[14];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.3 Ulangan Umum Harian</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm7" type="text" value="<?php echo $value[15];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.4.4 Pengadaan Bahan teori /praktek</label></td>
                          <td><span class="add-on">Rp. </span><input name="kbm8" type="text" value="<?php echo $value[16];?>" placeholder="something…" onFocus="startCalcKbm();" onBlur="stopCalcKbm();"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.5 Kegiatan Kesiswaan</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="ks" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.5.1 Kegiatan Osis</label></td>
                          <td><span class="add-on">Rp. </span><input name="ks1" type="text" value="<?php echo $value[17];?>" placeholder="something…" onFocus="startCalcKs();" onBlur="stopCalcKs();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.5.2 Penyelenggaraan Lomba</label></td>
                          <td><span class="add-on">Rp. </span><input name="ks2" type="text" value="<?php echo $value[18];?>" placeholder="something…" onFocus="startCalcKs();" onBlur="stopCalcKs();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.5.3 Kegiatan Pramuka</label></td>
                          <td><span class="add-on">Rp. </span><input name="ks3" type="text" value="<?php echo $value[19];?>" placeholder="something…" onFocus="startCalcKs();" onBlur="stopCalcKs();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.5.4 Pembinaan Keagamaan</label></td>
                          <td><span class="add-on">Rp. </span><input name="ks4" type="text" value="<?php echo $value[20];?>" placeholder="something…" onFocus="startCalcKs();" onBlur="stopCalcKs();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.5.5 Kegiatan Sanggar Belajar</label></td>
                          <td><span class="add-on">Rp. </span><input name="ks5" type="text" value="<?php echo $value[21];?>" placeholder="something…" onFocus="startCalcKs();" onBlur="stopCalcKs();"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.6 Penyelenggaraan Perpustakaan</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input type=text name="pp" value="" disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.6.1 Buku Pelajaran Pokok</label></td>
                          <td><span class="add-on">Rp. </span><input name="pp1" type="text" value="<?php echo $value[22];?>" placeholder="something…" onFocus="startCalcPp();" onBlur="stopCalcPp();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>2.6.2 Buku Penunjang</label></td>
                          <td><span class="add-on">Rp. </span><input name="pp2" type="text" value="<?php echo $value[23];?>" placeholder="something…" onFocus="startCalcPp();" onBlur="stopCalcPp();"></input><span class="add-on">,00</span></td>
                        </tr>
                         <tr>
                          <td>
                            <h6>2.7 Subsidi</h6>
                          </td>
                          <td><span class="add-on">Rp. </span><input name="sbsd" type="text" value="" placeholder="something…"disabled></input><span class="add-on">,00</td>
                        </tr>
                        <tr>
                          <td><label>2.7.1 Bantuan Untuk Siswa</label></td>
                          <td><span class="add-on">Rp. </span><input name="sbsd1" type="text" value="<?php echo $value[24];?>" placeholder="something…" onFocus="startCalcSbsd();" onBlur="stopCalcSbsd();"><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label><h5>Total »</h5></label></td>
                          <td><span class="add-on">Rp. </span><input name="BB" type="text" value="" placeholder="something…"  disabled></input><span class="add-on">,00</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                      3. Belanja Pemeliharaan
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>3.1 Biaya Perawatan ringan</label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="bpr1" value="<?php echo $value[25];?>" placeholder="something…" onFocus="startCalc3();" onBlur="stopCalc3();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label>3.1.1 Biaya Pembuatan Taman</label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="bpr2" value="<?php echo $value[26];?>" placeholder="something…" onFocus="startCalc3();" onBlur="stopCalc3();"></input><span class="add-on">,00</span></td>
                        </tr>
                        <tr>
                          <td><label><h5>Total</h5></label></td>
                          <td><span class="add-on">Rp. </span><input type=text name="bpr" disabled></input><span class="add-on">,00</td>
                        </tr>
                        
                      </table>
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                      4. Biaya Lain-lain
                    </a>
                  </div>
                  <div id="collapseFour" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table">
                        <tr>
                          <td><label>4.1 Upah Tukang</label></td>
                          <td><span class="add-on">Rp. </span><input name="bll1" value="<?php echo $value[27];?>"type="text" placeholder="something…"></input><span class="add-on">,00</span></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              <h4><p>Total Semua Pembiayaan  adalah : <span class="add-on">Rp. </span><input type=text name="total" disabled></input><span class="add-on">,00</p></h4>
              <div class="form">Catatan : <textarea rows="2" name="catatan" ></textarea></div>
            </table>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          <?=form_close();?>