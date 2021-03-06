<?php
  include "inc/start.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php

          $sql_repo = "select * from repos where id = '".$_GET["id"]."'";
          $repo_results = mysqli_query($conn, $sql_repo);
          $repo = mysqli_fetch_assoc($repo_results);

          $sql_org = "select * from organizations where id = '".$repo["org"]."'";
          $org_results = mysqli_query($conn, $sql_org);
          $org = mysqli_fetch_assoc($org_results);

          if ($org["name"] == "") {
            $org["name"] = $org["user"];
          }

        ?>
        <title>MuseumCODE - <?=$repo["name"]?></title>
        <meta name="description" content="<?=$repo["description"]?>">
        <meta name="author" content="<?=$org["name"]?>">
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
          <h1>
            <?=$repo["name"]?>
            <img src="<?=$org["avatar"]?>" class="avatar uk-float-left">
          </h1>
          <p class="uk-padding-remove"><?=$repo["description"]?></p>
          <?php if ($repo["language"] != ""){ ?>
          <p>
            <span class="uk-label uk-label-success"><a href="/lang/<?=$repo["language"]?>"><?=$repo["language"]?></a></span>
          </p>
        <?php } ?>
          <a class="uk-button uk-button-secondary uk-float-right" target="_blank" href="<?=$repo["url"]?>"><span uk-icon="icon: git-branch; ratio: 1" class="uk-margin-small-right"></span>View Code</a>

          <p class="uk-padding-remove uk-margin-remove uk-text-small"><span uk-icon="icon: cloud-upload; ratio: .7" class="uk-margin-small-right"></span> Created <?=HowLongAgo($repo["created"])?></p>
          <p class="uk-padding-remove uk-margin-remove uk-text-small"><span uk-icon="icon: refresh; ratio: .7" class="uk-margin-small-right"></span> Last updated <?=HowLongAgo($repo["updated"])?></p>
          <p class="uk-padding-remove uk-text-small"><span uk-icon="icon: user; ratio: 1" class="uk-margin-small-right"></span>Contributors:
          <?php
            $get_authors = file_get_contents("https://api.github.com/repos/".$org["user"]."/".$repo["name"]."/contributors", true, $context);
            $authors = json_decode($get_authors);
            foreach ($authors as $author){
              echo '<a target="_blank" href="'.$author->{"html_url"}.'" class="uk-link-muted">@'.$author->{"login"}.'</a> ';
            }
          ?>
          <hr class="uk-margin-large">
          <p>
            <div class="uk-card uk-card-default uk-card-body">
              <?php
                include "inc/Parsedown.php";
                $Parsedown = new Parsedown();

                $handle = curl_init("https://raw.githubusercontent.com/".$org["user"]."/".$repo["name"]."/master/README.md");
                curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

                /* Get the HTML or whatever is linked in $url. */
                $response = curl_exec($handle);

                /* Check for 404 (file not found). */
                $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                if($httpCode == 404) {
                  $get_readme = file_get_contents("https://raw.githubusercontent.com/".$org["user"]."/".$repo["name"]."/master/readme.md", true, $context);
                } else {
                  $get_readme = file_get_contents("https://raw.githubusercontent.com/".$org["user"]."/".$repo["name"]."/master/README.md", true, $context);
                }

                curl_close($handle);

                echo $Parsedown->text($get_readme);
              ?>
            </div>
          </p>


        </div>
      </div>

      <div class="uk-section uk-background-muted">
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
          <a class="uk-button uk-button-secondary uk-align-center uk-width-medium" href="">See All Projects</a>
        </div>
      </div>



      <?php
        include "inc/footer.php";
      ?>

    </body>
</html>
