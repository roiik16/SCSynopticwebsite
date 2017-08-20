<? var_dump ($form); ?>

<div id="profilepic-bar">
     <img src="<?=base_url('images/googleplusprofilephoto.png') ?>">
</div>

<div id="left-sectioninfo">
    <h1>User Information</h1>
    <!-- Request the data of the current user -->


        <h3><?=$userdata['user_name']; ?></h3>
        <h3><?=$userdata['user_surname']; ?></h3>
        <h3><?=$userdata['user_email']; ?></h3>



<?=form_open ('profile/update_users'); ?>
    <!-- <img src="<?=base_url('images/Files-Edit-File-icon.png')?>" width = "20px" height = "20px" > -->


    <br><br><br><br>
    <h3> You can change your personal details down below</h3>
    <br>
    <h5>Change your email to : </h5> <?=form_input ($form['email']); ?>
    <br>
    <h5>Change your surname to : </h5> <?=form_input ($form['surname']); ?>

<br><br>

    <?=form_submit (null, 'Commit account changes');?>


        <?=form_close (); ?>
<br><br><br><br><br><br><br><br><br><br><br><br>
</div>
