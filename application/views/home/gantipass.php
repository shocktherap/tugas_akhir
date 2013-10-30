<?=form_open('home/gantipass');?>
	            <?php
		            if(!form_error('password')){
		            $message = "";
		            } else {
		                $message = "error";
		            }
		        ?>
		         <?php
		            if(!form_error('confpassword')){
		            $message2 = "";
		            } else {
		                $message2 = "error";
		            }
		        ?>
		        <?php
		            if(!form_error('oldpassword')){
		            $message3 = "";
		            } else {
		                $message3 = "error";
		            }
		        ?>
<div class="control-group <?=$message3;?>">
    <label class="control-label" for="inputPassword">Masukan Password Lama</label>
        <div class="controls">
	        <input type="password" id="inputOldPassword" name="oldpassword" value="" placeholder="Password Lama"></input></br>
	        <span class="help-inline"><?php echo form_error('oldpassword');?></span>
		</div>
</div>
<div class="control-group <?=$message;?>">
    <label class="control-label" for="inputPassword">Masukan Password Baru</label>
        <div class="controls">
	        <input type="password" id="inputPassword" name="password" value="" placeholder="Password"></input></br>
	        <span class="help-inline"><?php echo form_error('password');?></span>
		</div>
</div>
<div class="control-group <?=$message2;?>">
    <label class="control-label" for="inputPassword">Confirm Password Baru</label>
        <div class="controls">
	        <input type="password" id="inputPassword2" name="confpassword" value="" placeholder="Confirm Password"></input></br>
	        <span class="help-inline"><?php echo form_error('confpassword');?></span>
		</div>
</div>
	<div class="control-group">
	    <div class="controls">
	        <button type="submit" class="btn">Ubah Password</button>
	    </div>
	</div>
<?=form_close();?>