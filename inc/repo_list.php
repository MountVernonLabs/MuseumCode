<tr>
    <td class="avatar"><img src="<?=$row["avatar"]?>" class="avatar"></td>
    <td>
      <?=$row["name"]?><br>
      <span class="uk-text-small"><?=$row["description"]?></span>
    </td>
    <td class="uk-text-small"><?=$row["language"]?></td>
    <td class="uk-text-small"><?=HowLongAgo($row["updated"])?></td>
</tr>
