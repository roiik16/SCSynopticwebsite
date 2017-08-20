<div id="sidebar">
  <nav>
      <ul>
          <li>
              <a href="Home" <?php if ($this->router->fetch_class () == 'Home') echo ' class="active"'?>> <i id="homeicon" class="fa fa-home fa-3x" style="color:white" aria-hidden="true"></i></a>
          </li>
          <li>
              <a href="newsfeed" <?php if ($this->router->fetch_class () == 'Newsfeed') echo ' class="active"'?>> <i id="newspapericon" class="fa fa-newspaper-o fa-3x" style="color:white"  aria-hidden="true"></i></a>
          </li>
          <li>
               <a href="notes" <?php if ($this->router->fetch_class () == 'Notes') echo ' class="active"' ?>> <i id="newfile" class="fa fa-file-text fa-3x" style="color:white" aria-hidden="true"></i></a>
          </li>
          <li>
                <a  href="newcalendar" <?php if ($this->router->fetch_class () == 'Calendar') echo ' class="active"' ?>> <i id="calendaricon" class="fa fa-calendar fa-3x" style="color:white" aria-hidden="true"></i></a>
          </li>
          <li>
              <a href="<?=site_url('Contact')?>" <?php if ($this->router->fetch_class () == 'Contact') echo ' class="active"' ?>> <i id="envelopeicon" class="fa fa-envelope fa-3x " style="color:white" aria-hidden="true"></i></a>
          </li>
      </ul>
  </nav>
</div>
