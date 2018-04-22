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

      </div>

      <div class="uk-section">
        <div class="uk-container">
          <h3>Projects</h3>
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
                  // Get total number of repos for pagination
                  $sql_number_repos = "SELECT * FROM repos";
                  $get_number_repos = $conn->query($sql_number_repos);
                  $number_repos = $get_number_repos->num_rows;

                  // Get current page, if not specified set to first page
                  $page = $_GET["page"];
                  if ($page == ""){
                    $page = 1;
                  }
                  $offset = ($page - 1) * 25;

                  // Retrieve latest page items
                  $sql = "SELECT o.avatar, r.* FROM repos r JOIN organizations o on r.org = o.id ORDER BY updated desc limit 25 OFFSET ".$offset;
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      include "inc/repo_list.php";
                    }}
                ?>
              </tbody>
          </table>
          <ul class="uk-pagination uk-flex-center" uk-margin>
              <?php
                if ($page != 1){
              ?>
              <li><a href="/projects?page=<?=$page-1?>"><span uk-pagination-previous></span></a></li>
              <?php } ?>
              <?php
                $total_pages = $number_repos / 25;
                $count = 1;
                for ($k = 0 ; $k < $total_pages; $k++){
              ?>
                  <li><a href="/projects?page=<?=$count?>"><?=$count?></a></li>
              <?php
                $count = $count + 1;
                }
              ?>
              <?php
                if ($page != $total_pages){
              ?>
              <li><a href="/projects?page=<?=$page+1?>"><span uk-pagination-next></span></a></li>
              <?php } ?>
          </ul>

        </div>
      </div>

      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
