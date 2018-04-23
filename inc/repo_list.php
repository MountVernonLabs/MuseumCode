<tr onclick="window.location='/project/<?=$row["id"]?>'" class="repo_row">
    <td class="avatar"><a href="/project/<?=$row["id"]?>"><img src="<?=$row["avatar"]?>" class="avatar"></a></td>
    <td>
      <?=$row["name"]?><br>
      <span class="uk-text-small"><?=$row["description"]?></span>
    </td>
    <td class="uk-text-small"><?=$row["language"]?></td>
    <td class="uk-text-small"><?=HowLongAgo($row["updated"])?></td>
</tr>
