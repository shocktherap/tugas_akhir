<html lang="en">
<head>
  <?php $this->load->view('head');?>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <i class="icon-user icon-white"></i> Logged in as <?php
              $session_data = $this->session->userdata('login');
              echo $session_data['nama'];
              ?>
            </p>
              <ul class="nav">
              <?php if ($this->uri->segment(2)==null || $this->uri->segment(2)=="admin" || $this->uri->segment(2)=="user2") {
                  $status = "active";
                } else{
                  $status = "";
                };?>
              <li class="<?=$status;?>"><a href="<?=base_url('home');?>"><i class="icon-home icon-white"></i> Home</a></li>
              <?php if ($this->uri->segment(2)=="help") {
                  $status = "active";
                } else{
                  $status = "";
                };?>
              <li class="<?=$status;?>"><a href="<?=base_url('home/help');?>"><i class="icon-question-sign icon-white"></i> Help</a></li>
              <li class=""><a href="<?=base_url('home/logout');?>"><i class="icon-off icon-white"></i> Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Bulan</li>
              <?php
                $data = $this->getdata->getBulan();
                foreach ($data as $row) {
                  if ($row->id == $this->uri->segment(3)) {
                    $status = "active";
                  } else {
                    $status = "";
                  }
                  ?>
                  <li class="<?=$status;?>"><a href="<?=base_url('home/bulan/'.$row->id);?>"><i class="icon-arrow-right icon-white"></i><?=$row->nama_bulan;?></a></li>
                  <?php
                }
              ?>
              <?php if ($session_data['level'] == 'user' || $session_data['level'] == 'administrator') {
              ?>
              <li class="nav-header">Menu</li>
              <?php
                if ($this->uri->segment(2) == "gantipass") {
                  $status = "active";
                } else {
                  $status = "";
                }
              ?>
              <li class="<?=$status;?>"><a href="<?=base_url('home/gantipass');?>"><i class="icon-plus"></i> Ganti Password</a></li>
              <?php  
              } elseif ($session_data['level'] == 'user2') {
                ?>
              <li class="nav-header">Menu</li>
              <?php
                if ($this->uri->segment(2) == "resetpass") {
                  $status = "active";
                } else {
                  $status = "";
                }
              ?>         
              <li class="<?=$status;?>"><a href="<?=base_url('home/resetpass');?>"><i class="icon-plus"></i> Reset Password User</a></li>
              <?php
                if ($this->uri->segment(2) == "gantipass") {
                  $status = "active";
                } else {
                  $status = "";
                }
              ?>
              <li class="<?=$status;?>"><a href="<?=base_url('home/gantipass');?>"><i class="icon-plus"></i> Ganti Password</a></li>
              <?php }?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
              <?php for ($i=0; $i < 6; $i++) { 
                if ($this->uri->segment($i)!= null) {
                  ?>
                    <li><?=$this->uri->segment($i);?><span class="divider">/</span></li>
                <?php
                } else {
                  echo "";
                }
              }?>
          </ul>
          <?php
              if ($this->session->flashdata('message')) {
              echo $this->session->flashdata('message');
            }
          ?>
          <?php $this->load->view($content);?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>Madrasah Tsanawiyah Al-Hidayah Basmol. Copyright 2013</p>
      </footer>
      
    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?=$this->load->view('script');?>
</body>
</html>