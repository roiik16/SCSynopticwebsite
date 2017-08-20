<!-- Below the header code -->
<div id="registerpage">
    <header>
        <h1>Register</h1>
    </header>
  <div id="registerform">
          <?=form_open ('users/do_register'); ?>
            <div class="input-pair">
                <label>Name </label>
                <?=form_input ($form['full_name']); ?>
            </div>
            <div class="input-pair">
                <label>Surname </label>
                <?=form_input ($form['full_surname']); ?>
            </div>
            <div class="input-pair">
                <label>Username</label>
                <?=form_input ($form['username']); ?>
            </div>

            <div class="input-pair">
                <label>Password</label>
                <?=form_input ($form['password']); ?>
            </div>
            <div class="input-pair">
                <label>Email (Used for sign-in)</label>
                <?=form_input ($form['email']); ?>
            </div>

            <div class="input-pair">
                <label>Profile picture</label>
                <!--<?=form_open_multipart($form['profilepicture']);?> -->
                <input type="file" name="userfile" size="20" />
            </div>



          <?=form_submit (null, 'Register');?>
      </div>
</div>
