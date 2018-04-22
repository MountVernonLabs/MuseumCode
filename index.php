<?php
  include "inc/start.php";

  $sql_count_org = "select count(id) as total from organizations";
  $org_count_org_results = mysqli_query($conn, $sql_count_org);
  $count_org = mysqli_fetch_assoc($org_count_org_results);

  $sql_count_repo = "select count(id) as total from repos";
  $org_count_repo_results = mysqli_query($conn, $sql_count_repo);
  $count_repo = mysqli_fetch_assoc($org_count_repo_results);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>MuseumCODE</title>
        <?php
          include "inc/scripts.php";
        ?>
        <meta name="description" content="Museum Code features projects submitted to GitHub from official museum accounts.
The goal of this project is to establish a central location for digital sharing among this community.">
    </head>
    <body>
      <!-- Nav -->
      <div class="uk-section-secondary uk-preserve-color">

        <?php
          include "inc/nav.php";
        ?>

          <div class="uk-section uk-light uk-padding-remove-top">
              <div class="uk-container uk-text-center uk-padding-remove-top">
                  <h3 class="uk-padding-remove-top"><?=$count_org["total"]?> Institutions, <?=$count_repo["total"]?> Projects</h3>
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
              while($row = $result->fetch_assoc()) {
                if ($row["name"] == "") {
                  $row["name"] = $row["user"];
                }
            ?>
                <a href="/org/<?=$row["user"]?>">
                  <img src="<?=$row["avatar"]?>" class="avatar" alt="<?=$row["name"]?>">
                </a>
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
          <a href="/projects" class="uk-button uk-button-default uk-align-center uk-width-medium">More Projects</a>
        </div>
      </div>

      <div class="uk-section uk-background-muted">
        <div class="uk-container">
          <h3 class="uk-text-center">Languages</h3>
          <div class="uk-width-2-3 uk-align-center">
            <center>
              <?php
                $sql = "select distinct language from repos where language != ''";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                  ?>
                    <span class="uk-label uk-label-success uk-margin-right-small uk-margin-bottom-small"><a href="/lang/<?=$row["language"]?>"><?=$row["language"]?></a></span>
              <?php    }}
            ?>
            </center>
          </div>
        </div>
      </div>

      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
