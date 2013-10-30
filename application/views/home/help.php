<section id="Help">
          <div class="page-header">
            <h1>Bantuan</h1>
          </div>

          <h4>Tampilan Login</h4>
          <p>Berisikan form untuk masuk kedalam sistem</p>
          <p>- tombol sign in untuk memproses username dan password</p>
          <p>Sebelum masuk kedalam sistem anda diharuskan memasukan username dan password yang telah diberikan, anda tidak akan diizinkan masuk kedalam sistem sampai username dan password yang benar. Jika anda Lupa terhadap username atau password yang telah diberikan silahkan menghubungi kepala sekolah</p>
          <img src="<?=base_url('assets/img/1.png');?>">
          <p>Gambar 1. Tampilan Menu Login</p>
      </br>
      	  <h4>Tampilan Home</h4>
          <p>Berisikan Tampilan home sistem</p>
          <p>- Menu help untuk melihat petunjuk penggunaan sistem</p>
          <p>- Menu Log Out untuk keluar dari sistem</p>
          <p>- Submenu bagian kiri untuk memilih data pengeluaran berdaasarkan bulan</p>
          <p>- Submenu Ganti Password Untuk mengubah password pengguna</p>
          <img src="<?=base_url('assets/img/4.png');?>">
          <?php $session_data = $this->session->userdata('login');
          if ($session_data['level'] == "user2") {
            ?>
            <p>- submenu reset password user untuk mereset password semua pengguna</p>
            <img src="<?=base_url('assets/img/11.png');?>">
            <p>- Link reset password untuk mereset password berdasarkan pengguna yang diinginkan</p>
            <?php
          }
          ?>
          <p>Gambar 2. Tampilan Home</p>
      </br>
      <h4>Tampilan bulan</h4>
          <p>Berisikan tahun dan grafik data berdasarkan pengeluaran maupun perkiraan pengeluaran yang telah disimpan didalam sistem</p>
          <p>- link entry data untuk Mengisi data pengeluaran</p>
          <p>- link update data untuk mengubah data pengeluaran</p>
          <p>- tombol lihat rincian untuk melihat rincian data pengeluaran </p>
          <p>- link hapus data untuk menghapus data pengeluaran</p>
          <p>- tombol perkiraan pengeluaran (AHP)untuk memperkirakan pengeluaran dengan metode AHP</p>
          <img src="<?=base_url('assets/img/5.png');?>">
          <p>Gambar 2. Tampilan bulan</p>
      </br>
          <h4>Tampilan Entry Data</h4>
          <p>Berisikan Form untuk memasukan data pengeluaran sekolah sesuai dengan kriteria yang telah ditentukan</p>
          <p>- tombol save changes untuk menyimpan data</p>
          <img src="<?=base_url('assets/img/2.png');?>">
          <p>Gambar 2. Tampilan Entry Data</p>
      </br>
          <h4>Tampilan Update Data</h4>
          <p>Berisikan Form untuk memasukan data pengeluaran sekolah sesuai dengan kriteria yang telah ditentukan</p>
          <p>- tombol save changes untuk menyimpan data</p>
          <img src="<?=base_url('assets/img/3.png');?>">
          <p>Gambar 3. Tampilan Update Data</p>
      </br>
          <h4>Tampilan lihat rincian</h4>
          <p>Setelah data pengeluaran telah selesai diinput maka anda dapat melihat rincian data seperti gambar dibawah ini</p>
          <p>- tombol cetak data untuk Mencetak data kedalam bentuk PDF</p>
          <img src="<?=base_url('assets/img/6.png');?>">
          <p>Gambar 3. Tampilan lihat rincian</p>
      </br>
          <h4>Tampilan Pengeluaran Berdasarkan AHP</h4>
          <p>Setelah Mengisi jumlah siswa dan besar biaya kemudian mengklik proses maka akan ditampilkan perkiraan pengeluaran seperti pada gambar dibawah</p>
          <p>- tombol proses untuk memproses rencana anggaran berdasarkan AHP</p>
          <p>- tombol cetak rencana anggaran untuk Mencetak data kedalam bentuk PDF</p>
          <p>- tombol ubah rencana anggaran untuk mengubah rencana anggaran</p>
          <img src="<?=base_url('assets/img/7.png');?>">
          <p>Gambar 3. Tampilan lihat rincian</p>
      </br>
          <h4>Tampilan Lihat rencana anggaran</h4>
          <p>Anda dapat mengubah rencana anggaran dengan mengisi form berdasarkan kriteria yang telah ditentukan</p>
          <p>- tombol update rencana anggaran untuk mengubah rencana anggaran</p>
          <p>- tombol cetak data untuk mencetak rencana anggaran dalam bentuk PDF</p>
          <img src="<?=base_url('assets/img/9.png');?>">
          <p>Gambar 3. Tampilan lihat rincian</p>
          <?php $session_data1 = $this->session->userdata('login');
          if ($session_data1['level'] == "administrator") {
            ?>
            <p>anda dapat menyetujui atau membatalkan rencana anggarana dengan mengklik tombol setujui rencana anggaran atau batalkan rencana anggaran</p>
            <img src="<?=base_url('assets/img/12.png');?>">
            <img src="<?=base_url('assets/img/13.png');?>">
            <?php
          }
          ?>
      </br>
          <h4>Tampilan Ubah Rencana Anggaran</h4>
          <p>Anda dapat mengubah rencana anggaran dengan mengisi form berdasarkan kriteria yang telah ditentukan</p>
          <p>- tombol save changes untuk menyimpan rencana anggaran yang baru</p>
          <img src="<?=base_url('assets/img/8.png');?>">
          <p>Gambar 3. Tampilan lihat rincian</p>
      </br>
          <h4>Tampilan Ubah Password</h4>
          <p>Anda dapat mengubah password dengan mengisi form dibawah ini</p>
          <p>- tombol ubah password untuk memproses pengubahan password</p>
          <img src="<?=base_url('assets/img/10.png');?>">
          <p>Gambar 3. Tampilan lihat rincian</p>
        </section>