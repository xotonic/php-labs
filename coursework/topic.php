<?php

if (!isset($_GET['id'])) {
    die('<h1>404</h1>');
}
include 'util.php';
init_sql();
enable_debug();
session_start();
$user = get_user_info();
$sql = send_and_check("SELECT id, title, content, creator, created, rating, closed from ctopics where id = $_GET[id]");
if (mysql_num_rows($sql) == 0) {
    die('<h1>Такой темы не существует</h1>');
}
$topic = mysql_fetch_assoc($sql);

//$user_query = send_and_check("SELECT login as name from cusers where id = $topic[creator]");
$creator = login_by_id($topic['creator']);// mysql_fetch_assoc($user_query);

$creator_on_page = false;
//echo "$topic[creator] == $user[id]";
if ($topic['creator'] == $user['id']) $creator_on_page = true;

$status = $topic['closed'] ? 'Закрыта' : 'Открыта';

if (isset($_POST['submit'])) {
    if (!is_logged()) killme('Вы не авторизированы');
    if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']) {
        $user = get_user_info();

        if (($_POST['text'] != '')
           and ($_POST['text'] != '<p>'.test_input($_POST['text']).'</p>')) {
            send_and_check("INSERT into creplies(content, id_topic, creator, created) values ('$_POST[text]',$topic[id], $user[id], NOW());");
            header("location: topic.php?id=$topic[id]&status=replied");
        } else {
            die("Cообщения пустое. <a href='topic.php?id=$topic[id]'>Назад</a>");
        }
    } else {
        die("Неправильная капча. <a href='topic.php?id=$topic[id]'>Назад</a>");
    }
}
if (isset($_POST['submit_comment'])) {
    $comment = test_input($_POST['comment']) or die("Cообщения пустое. <a href='topic.php?id=$topic[id]'>Назад</a>");
    send_and_check("INSERT into ccomments(content, creator, created, id_topic, id_reply)
  values ('$comment', $user[id], NOW(), $topic[id], $_POST[reply_id])");
    header("location: topic.php?id=$topic[id]&status=commented");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $topic['title'] ?></title>
    <script src="ckeditor/ckeditor.js"></script>
    <script>

    function rate(table,id,neg) {
      var r = new XMLHttpRequest();
      r.onreadystatechange = function() {
        if (r.readyState == 4 && r.status == 200) {
          var btn = document.getElementById("rate"+table+id);
          btn.innerHTML = r.responseText == 'fail' ? btn.innerHTML : r.responseText;
          if (r.responseText == 'fail' ) alert("Неудача");
        }
      };
      r.open("GET", "rate.php?table="+table+"&id=" + id + (neg==true ? "&neg=1": "&neg=0"));
      r.send();
    }
    </script>

    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="main">
    <h2 class='bottom'>segmentation<b>fault</b>.com</h2>
    <u><a href="index.php">На главную</a></u>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'replied') {
            echo '<div>Отвечено</div>';
        } elseif ($_GET['status'] == 'commented') {
            echo '<div>Прокомментировано</div>';
        }
    }
    $rating_topic = rating_block('topic', $topic['id'], get_rate('topic',$topic['id']));
    echo <<< TAG
    <div>
    <h1>$topic[title] <span>$rating_topic</span></h1>
    <div>$topic[content]</div><br>
    <div class='gray'>
    <span>Автор: $creator</span> |
    <span>Создано: $topic[created]</span> |

    <span>Статус: $status</span>
    </div>
    </div>
TAG;
    $sql_comments = send_and_check("SELECT id, content, creator, rating from ccomments where id_topic=$topic[id] and id_reply is NULL");
    if (mysql_num_rows($sql_comments) == 0) {
        echo 'no comments';
    } else {
        echo 'comments: <br>';
        while ($comment = mysql_fetch_assoc($sql_comments)) {
            $login = login_by_id($comment['creator']);
            $rating_block = rating_block('comment', $comment['id'], get_rate('comment',$comment['id'])) ;
            $delete = "";
            if (is_logged() and $user['access_level'] > 1) $delete = "<span>[<a href='delcomment.php?id=$comment[id]'><u>удалить</u></a>]</span>";
            echo "<div class='gray'>$rating_block | <span>$login</span>: <span>$comment[content]</span>$delete</div>";
        }
    }

    if (is_logged())
    echo  <<< TAG
    <div align=right>
    <p><form action='topic.php?id=$topic[id]' method='post'>
    <input type=text name='comment'>
    <input type=hidden name='reply_id' value='NULL'>
    <input type=submit name='submit_comment' value=Comment>
    </form></p>
    </div>
TAG;

    $sql_replies = send_and_check("SELECT id, content, creator, created, is_solution, rating from creplies
    where id_topic = $topic[id] order by rating desc");
    if (mysql_num_rows($sql_replies) == 0) {
        echo '<h2>Нет ответов</h2>';
    } else {
        echo '<h2>Ответы</h2>';

        while ($reply = mysql_fetch_assoc($sql_replies)) {
            $replier = login_by_id($reply['creator']);
            $solution_block = $reply['is_solution'] ? "<span class='green'>Помечено как решение</span>" : '';
            if ($reply['is_solution'] and $creator_on_page == true) $solution_block .= "<a href='solution.php?id=$reply[id]&rem=1'> [X]</a>";
            $solution_report = ($creator_on_page == true and $topic['closed'] == false )? "<div align=right><u><a href='solution.php?id=$reply[id]'>Это решение</a></u></div>" : '';
            $rating_block = rating_block('reply', $reply['id'], get_rate('reply',$reply['id'])) ;
            $delete = "";
            if (is_logged() and $user['access_level'] > 1) $delete = "<span>[<a href='delreply.php?id=$reply[id]'><u>удалить</u></a>]</span>";
            echo <<< TAG
            <div class='reply_main'><p>
              $solution_report
              <h2 align=right>$rating_block</h2>
              $solution_block
              <div>
                <p>$reply[content]</p>
              </div>
              <div class='gray'>Автор: $replier | Создано: $reply[created] $delete</div>
TAG;
            $reply_comments = send_and_check("SELECT id, content, creator, rating from ccomments where id_topic=$topic[id] and id_reply=$reply[id]");
            if (mysql_num_rows($reply_comments) == 0) {
                echo 'no comments';
            } else {
                echo 'comments: <br>';
                while ($rcomment = mysql_fetch_assoc($reply_comments)) {
                    $login = login_by_id($rcomment['creator']);
                    $rating_comment = rating_block('comment', $rcomment['id'], get_rate('comment',$rcomment['id']));
                    $delete = "";
                    if (is_logged() and $user['access_level'] > 1) $delete = "<span>[<a href='delcomment.php?id=$rcomment[id]'><u>удалить</u></a>]</span>";
                    echo "<table>
                          <tr>
                            <td> $rating_comment </td>
                            <td> <span class='gray'>$login</span>: <span>$rcomment[content]</span>$delete</td>
                          </tr>
                          </table>";
                }

                echo '</p>';
            }
            if (is_logged())
            echo  <<< TAG
            <div align=right>
            <p><form action='topic.php?id=$topic[id]' method='post'>
            <input type=text name='comment'>
            <input type=hidden name='reply_id' value='$reply[id]'>
            <input type=submit name='submit_comment' value=Comment>
            </form></p>
            </div>
TAG;
            echo '</div>';
        }
    }
if ($topic['closed'] == false) {
    ?>

    <p>
      <form action=<?php echo "topic.php?id=$topic[id]";?> method="post">
        Написать ответ<br>
      <textarea class='control' name="text" id="editor1" rows="10" cols="80">
        Решение проблемы
      </textarea>
      <script>
        CKEDITOR.replace('editor1');
      </script>
      <p><img class='captcha' src="kcaptcha/index.php?<?php echo session_name() ?>=<?php echo session_id() ?>"></p>
      <p>
        <input class='control' type="text" name="keystring" size="34">
      </p>
      <input class='control' type="submit" value="SEND" name="submit" />
      </form>
    </p>
  <?php } ?>
  </div>
  </body>
</html>
