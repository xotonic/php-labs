<?php
include 'util.php';
init_sql();
$user = get_user_info();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форум</title>
    <!--style type="text/css">body * { border: 1px solid gray;}</style-->
        <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class='main'>
    <h2 class='bottom'>segmentation<b>fault</b>.com</h2>
    <?php
      if (isset($_GET['status']))
      if ($_GET['status'] == 'created')
      echo "<p>Тема успешно создана</p>";
     ?>
     <p><?php if (is_logged()) {
    echo "Добро пожаловать, ". login_by_id($user['id']) ."<br>"
    ."<a href='create.php'> Создать тему </a><br><a href='logout.php'>Выйти</a>";
} else {
    echo "<u><a href='autorization.php'>Зарегистрируйтесь или войдите</a></u>, чтобы создавать темы, оценивать и комментировать записи";
}  ?> </p>
    <p><h1>Темы</h1>
<?php
      $sql = send_and_check("SELECT id, title, creator, created, rating, closed from ctopics order by created desc");

      while ($row = mysql_fetch_assoc($sql))
      {
        //$user_query = send_and_check("SELECT login as name from cusers where id = $row[creator]");
        $creator = login_by_id_no_link($row['creator']); //mysql_fetch_assoc($user_query);
        $status = $row["closed"] ? "Закрыта" : "Открыта";
        $rating = get_rate('topic', $row['id']);
        $delete = '';
        if (is_logged() and $user['access_level'] > 1) $delete = "<span>[<a href='deltopic.php?id=$row[id]'><u>удалить</u></a>]</span>";
        echo <<< TAG
        <a href='topic.php?id=$row[id]'>
          <div class='topic_link'>
            <span>$row[title]</span><br>
            <div class='gray'>
              <span class='gray'>Автор: </span>$creator |
              <span>Создано: $row[created]</span> |
              <span>Рейтинг: $rating</span> |
              <span>Статус: $status</span>
              $delete
            </div>
          </div>
        </a>
TAG;
      }
?>
    </p>
    <div>
  </body>
</html>
