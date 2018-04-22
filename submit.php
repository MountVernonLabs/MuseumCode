<?php
  include "inc/start.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MuseumCODE - Add a GitHub Account</title>
        <?php
          include "inc/scripts.php";
        ?>
        <meta name="description" content="Are we missing something?  Let us know.">
    </head>
    <body>
      <!-- Nav -->
      <div class="uk-section-secondary uk-preserve-color">

        <?php
          include "inc/nav.php";
        ?>

      </div>

      <div class="uk-section">
        <div class="uk-container">
          <div id="wufoo-m1sxls4i0b40w07">
          Fill out my <a href="https://gwmountvernon.wufoo.com/forms/m1sxls4i0b40w07">online form</a>.
          </div>
          <script type="text/javascript">var m1sxls4i0b40w07;(function(d, t) {
          var s = d.createElement(t), options = {
          'userName':'gwmountvernon',
          'formHash':'m1sxls4i0b40w07',
          'autoResize':true,
          'height':'460',
          'async':true,
          'host':'wufoo.com',
          'header':'show',
          'ssl':true};
          s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'www.wufoo.com/scripts/embed/form.js';
          s.onload = s.onreadystatechange = function() {
          var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
          try { m1sxls4i0b40w07 = new WufooForm();m1sxls4i0b40w07.initialize(options);m1sxls4i0b40w07.display(); } catch (e) {}};
          var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
          })(document, 'script');</script>

        </div>
      </div>


      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
