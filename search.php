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
        <div class="uk-container search-results">
          <h1>Search</h1>
          <script>
            (function() {
              var cx = '013570628192988851190:9khxsizm474';
              var gcse = document.createElement('script');
              gcse.type = 'text/javascript';
              gcse.async = true;
              gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(gcse, s);
            })();
          </script>
          <gcse:search></gcse:search>

      </div>


      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
