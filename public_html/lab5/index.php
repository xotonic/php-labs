<php? include '../util.php'; enable_debug(); ?>


  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <title>PHP graphics</title>
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>

  <body>
    <?php include '../util.php'; youtube("mQc2KUau2O4"); ?>
    <div class="btn">Лабораторная работа 5</div><br>
    <div align="right">
      Link : graph.php
      <br>
      <img src=graph.php>
    </div><br>
    <div  align="right">
      Link : graph.php?size_x=600&size_y=400
      <br>
      <img src=graph.php?size_x=600&size_y=400>
    </div><br>
    <div  align="right">
      Link : graph.php?size_x=800&size_y=400&table=categories
      <br>
      <img src=graph.php?size_x=800&size_y=400&table=categories>
    </div><br>
    <div  align="right">
      Link : graph.php?axis_x=200&axis_y=200
      <br>
      <img src=graph.php?axis_x=200&axis_y=200>
    </div>
  </body>

  </html>
