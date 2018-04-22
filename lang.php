<?php
  include "inc/start.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MuseumCODE - <?=$_GET["lang"]?></title>
        <?php
          include "inc/scripts.php";
        ?>
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
          <h3><?=$_GET["lang"]?> Projects</h3>
          <table class="uk-table uk-table-divider">
              <thead>
                  <tr>
                      <th></th>
                      <th>Project</th>
                      <th>Language</th>
                      <th>Last Updated</th>
                  </tr>
              </thead>
              <tbody>
                <?php

                  // Retrieve latest page items
                  $sql = "SELECT o.avatar, r.* FROM repos r JOIN organizations o on r.org = o.id WHERE r.Language = '".$_GET["lang"]."' ORDER BY updated desc";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      include "inc/repo_list.php";
                    }}
                ?>
              </tbody>
          </table>

        </div>
      </div>

      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
