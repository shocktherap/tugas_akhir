<?php
$data = $this->getdata->getuser();
?>
<table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Jabatan</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $a = 0;
                foreach ($data as $key) {
                ?>
                  <tr>
                    <td><?=$a = $a+1;?></td>
                    <td><?php echo $key['username'];?></td>
                    <td><?php echo $key['nama'];?></td>
                    <td><a href="<?=base_url('home/reset/'.$key['id']);?>">Reset Password</a></td>
                  </tr>
                  <?php 
                }
                  ?>
              </tbody>
            </table>