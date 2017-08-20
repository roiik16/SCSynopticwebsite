<div id="allbody">
    <div id="askaquestionarea">
      <p>Ask a question</p>
          <!-- <form id="questionform" action="newsfeed.php" method="get"> -->
              <?=form_open ('newsfeed/do_add_posts'); ?>
              <?=form_input ($form['body']); ?>

              <?=form_submit (null, 'Submit');?>
              <?=form_close (); ?>
              <!-- <input type="Name" placeholder = "Write your question here" id="input-question" class="flex-space">
              <button type="submit" id="button-post">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              </button
        </form> -->
      <hr id="question-line">
  </div>
<!-- END OF ASK QUESTION -->

<!-- comments start from below -->
<!-- SORT BY -->
        <div id="comments-page">
            <div id="commentsarea">
                <!-- COMMENT 1 -->
                <!-- <div class="post">
                    <a href="index.php">
                        <img class="user-image" src="<?=base_url('images/user-image.png')?>"alt="logo">
                    </a> -->

                    <div id="user-comment1">
                      <br><br><br><br>
                        <?php foreach($comments as $post) : ?>
                            <div id="postsection">
                        </h3> Posted by <?php echo $post['user_email']; ?></h3>
                          <small class="post-date"> Posted on: <?=date('d M Y,H:i', $post['c_date']);?></small>
                          <br/>
                          <?php echo $post['c_content']; ?>
                          <br><br><br>

                          </div>
                           <br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
