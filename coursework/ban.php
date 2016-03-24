<?php
include 'util.php';

enable_debug();
init_sql();
if (is_logged())
{
  $user = get_user_info();
  if ($user['access_level'] > 1)
  {
    if (isset($_GET['id']))
    {
      $banning = get_user_info($_GET['id']);
      //echo "$banning[login] : ban = $banning[ban]";
      if ($banning['ban'])
      {
      send_and_check("UPDATE cusers SET ban=false WHERE id=$_GET[id]");
      killme('Пользователь разбанен');
      }
      else
      {
        send_and_check("UPDATE cusers SET ban=true WHERE id=$_GET[id]");
        killme('Пользователь забанен');
      }
    }
    else killme("Кого банить-то??");
  }
  else killme("У вас нет доступа");
}
else killme("Нет доступа");
