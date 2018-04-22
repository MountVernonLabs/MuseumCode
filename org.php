<?php
  include "inc/start.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
          $sql_org = "select * from organizations where user = '".$_GET["name"]."'";
          $org_results = mysqli_query($conn, $sql_org);
          $org = mysqli_fetch_assoc($org_results);

          if ($org["name"] == "") {
            $org["name"] = $org["user"];
          }

        ?>
        <title>MuseumCODE - <?=$org["name"]?></title>
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
          <img src="<?=$org["avatar"]?>" class="avatar-large uk-float-right uk-margin-left">
          <p class="uk-h2 uk-padding-remove uk-margin-remove uk-text-bold">
            <?=$org["name"]?>
          </p>
          <?php if ($org["bio"] != ""){ ?>
            <p class="uk-padding-remove uk-margin-remove-top">
              <?=$org["bio"]?>
          </p>
          <?php } ?>
          <?php if ($org["location"] != ""){ ?>
            <p class="uk-padding-remove uk-margin-remove uk-text-small">
              <span uk-icon="icon: world; ratio: .7" class="uk-margin-small-right"></span><?=$org["location"]?>
            </p>
          <?php } ?>
          <?php if ($org["url"] != ""){ ?>
            <p class="uk-padding-remove uk-margin-remove uk-text-small">
              <span uk-icon="icon: laptop; ratio: .7" class="uk-margin-small-right"></span><a target="_blank" href="<?=$org["url"]?>" class="uk-link-muted"><?=$org["url"]?></a>
            </p>
          <?php } ?>
          <p class="uk-padding-remove uk-margin-remove uk-text-small">
            <span uk-icon="icon: github; ratio: .7" class="uk-margin-small-right"></span><a target="_blank" href="http://github.com/<?=$org["user"]?>" class="uk-link-muted">github.com/<?=$org["user"]?></a>
          </p>
          <?php if ($org["email"] != ""){ ?>
            <p class="uk-padding-remove uk-margin-remove uk-text-small">
              <span uk-icon="icon: mail; ratio: .7" class="uk-margin-small-right"></span><a target="_blank" href="mailto:<?=$org["email"]?>" class="uk-link-muted">Email <?=$org["name"]?></a>
            </p>
          <?php } ?>

        </div>
      </div>

      <div class="uk-section uk-background-muted">
        <div class="uk-container">
          <h3><?=$org["name"]?> Projects</h3>
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
                  $sql = "SELECT o.avatar, r.* FROM repos r JOIN organizations o on r.org = o.id where o.id = ".$org["id"]." ORDER BY updated desc";
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
