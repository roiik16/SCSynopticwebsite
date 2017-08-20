<div id="contact-page">
    <div id="border-bar">
        <div id="header-bar">
        </div>
        <div id="sendto">
            <p>Send to</p>
                <?=form_dropdown('input-recipient', $userlist); ?>

        <div id="contact-text-box">

            <?=form_open('contact/do_add_messages'); ?>
            <?=form_input ($form['content']); ?>
                    <!-- <textarea  rows="10" cols="50" name="content"> </textarea> -->
                    <br>
            <?=form_submit (null, 'Send');?>
            <?=form_close (); ?>
        </div>
    </div>
    <div id="right-side">
        <div id="top-bar">
        </div>
    <h1>Messages</h1>
    <div id="message">

        <?php foreach($messages->result_array() as $post) : ?>
          <h3><?php echo $post['msg_content'];?></h3>
        <br/>
        <?php endforeach; ?>
        
    </div>
        <i class="fa fa-reply" aria-hidden="true"></i>
        <i class="fa fa-trash" aria-hidden="true"></i>
    </div>
</div>
