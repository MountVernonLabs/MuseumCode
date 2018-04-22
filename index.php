<?php
  include "inc/start.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MuseumCODE</title>
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

          <div class="uk-section uk-light">
              <div class="uk-container uk-text-center">

                  <p>Museum Code features projects submitted to GitHub from official museum accounts. <br>The goal of this project is to establish a central location for digital sharing among this community.</p>

              </div>
          </div>

      </div>

      <div class="uk-section">
        <div class="uk-container">
          <h3>Institutions</h3>
          <?php
            $sql = "SELECT * FROM organizations where avatar !='' order by repos desc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) { ?>
                <img src="<?=$row["avatar"]?>" class="avatar">
          <?php }} ?>
        </div>
      </div>

      <div class="uk-section">
        <div class="uk-container">
          <h3>Latest Updated Projects</h3>
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
                  $sql = "SELECT o.avatar, r.* FROM repos r JOIN organizations o on r.org = o.id ORDER BY updated desc limit 10";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      include "inc/repo_list.php";
                    }}
                ?>
              </tbody>
          </table>
          <a src="/projects/" class="uk-button uk-button-default uk-align-center uk-width-medium">More Projects</a>
        </div>
      </div>

      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
