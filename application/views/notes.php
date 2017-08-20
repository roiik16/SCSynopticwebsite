<div id="notes-takingpage">
<!-- Note taking show/hide bar -->
<input type="checkbox" id="toggle-app-sidebar" class="site-control">
<header id="app-header" >
    <label for="toggle-app-sidebar" class="fa fa-arrow-circle-right"></label>
</header>
<aside id="app-sidebar">
    <header id="app-sidebar-header">
        <div class="flex-space"></div>
        <label for="toggle-app-sidebar" class="fa fa-close"></label>
    </header>


    <?php foreach($notes->result_array() as $note) : ?>
        <a href="<?=site_url("notes/view_note/{$note['note_content']}")?>"><?=$note['note_title']?></a>
        <h3><?=$note['note_content'] ?> </h3>
        <br>
        <br>
    <?php endforeach; ?>

</aside>
<main id="app-content"></main>
<script type="text/javascript" src="js/app.js"></script>
    <!-- note taking area -->
<div id="notes-bottomcontainer">

<?=form_open ('notes/do_add_notes'); ?>

        <div id="titleoptions">
            <label>Title : </label>
            <?=form_input ($form['n_title']); ?>
        <br>
        </div>

        <div id="content">
            <?=form_input ($form['n_content']); ?>
        </div>

        <!-- <textarea  rows="10" cols="50" name="content"> </textarea> -->
        <br>
        <div id ="btnsave">
            <?=form_submit (null, 'Submit');?>
        </div>
        <?=form_close (); ?>
    </div>
    </div>
