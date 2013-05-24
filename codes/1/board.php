<?php

$mysqli = new mysqli('localhost', 'root', '', 'board');

function h($s){ return htmlspecialchars($s); }
function e($s){ global $mysqli; return $mysqli->real_escape_string($s); }

if(isset($_POST["name"])){
  $mysqli->query("INSERT INTO datas (name, text) VALUES ('" . e($_POST["name"]) . "', '" . e($_POST["text"]) . "')");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>簡易掲示板</title>
  </head>
  <body>
    <h1>簡易掲示板</h1>
    <form method="POST" action="board.php">
      名前：<input name="name" />
      内容：<input name="text" />
      <input type="submit" value="投稿" />
    </form>
    <hr />
    <?php
      $result = $mysqli->query("SELECT * FROM datas ORDER BY date DESC");
      while($row = $result->fetch_object()){
        print("<b>" . h($row->name) . "</b> " . h($row->text) . " (" . h($row->date) . ")<hr />");
      }
    ?>
  </body>
</html>