<?php include 'util.php'; ?>
  <!DOCTYPE HTML>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="title" content="КЕК" />
    <meta name="description" content="WOW SUCH LABS" />
    <title>THUG LIFE SITE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
      .block {
        background: #eee;
        border: solid 3px black;
      }
    </style>
    <script type="text/javascript">
      var switchTo5x = true;
    </script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">
      stLight.options({
        publisher: "f9528fa3-d73c-4c7c-81d6-6a99ad7663c6",
        doNotHash: false,
        doNotCopy: false,
        hashAddressBar: false
      });
    </script>

    <?php if (is_vip()) echo <<< TAG
      <link href="tubular/css/screen.css" rel="stylesheet" type="text/css" />
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript" charset="utf-8" src="tubular/js/jquery.tubular.1.0.js"></script>
      <script type="text/javascript" charset="utf-8" src="tubular/js/index.js"></script>
TAG;
     ?>

  </head>

  <body>
    <?php if(is_vip()) echo "<div id='wrapper' class='clearfix'>"; ?>
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>



      <br>
      <br>
      <br>
      <br>
      <div><img src="thug-life.png" /></div>
      <br>
      <br>
      <div class="wrap rounded">
        <h1> Welcome to official <b>Xotonic</b>`s site <br> aka Дмитрий Кузьмин АВТ-318 <br> Вариант #8</h1></div>
      <div class="wrap rounded">
        <div style="align: center;">
          <a class="btn sweep-left" href="lab1/index.php">Лаба 1</a>
          <a class="btn sweep" href="lab2/index.php">Лаба 2</a>
          <a class="btn sweep-left" href="lab3/index.php">Лаба 3</a>
          <a class="btn sweep" href="lab4/index.php">Лаба 4</a>
          <a class="btn sweep-left" href="lab5/index.php">Лаба 5</a>
          <a class="btn sweep" href="lab6/index.php">Лаба 6</a>
          <a class="btn sweep-left" href="lab7/index.html">Лаба 7</a>
          <a class="btn sweep" href="lab8/index.html">Лаба 8</a>
          <a class="btn out" href="coursework/board.php">Курсовая работа</a>
        </div>
      </div>
      <br>
      <div class="wrap rounded">
      <details>
        <summary>ПОДЕЛИТЬСЯ</summary>
        <pre>

        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_vkontakte_large' displayText='Vkontakte'></span>
        <span class='st_email_large' displayText='Email'></span>
        <br>
        <br>
        <div class="fb-like" data-href="http://217.71.139.74/~user108/" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>


    </pre>
      </details>

        <details>
          <summary>ВЫСКАЗАТЬСЯ</summary>
          <pre>
<div id="disqus_thread"></div>
<script>

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//gunweb.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</pre>
        </details>
      </div>

      <div class="wrap rounded">
        <form method="post" action="vip.php">
          VIP <input  type="checkbox"  name="vip" value="on" <?php echo $vip; ?> />
          <!--input type="text" name="code" /-->
          <input class="sweep" type="submit" value="GO!" />
        </form>
      </div>
  <?php if (is_vip()) echo "</div>"; ?>
  </body>

  </html>
