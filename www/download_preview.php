<!DOCTYPE html>
<?php
  define('BASE_DIR', dirname(__FILE__));
  require_once(BASE_DIR.'/config.php');
?>
<html>
  <head>
    <title><?php echo htmlspecialchars(CAM_STRING); ?> - Download</title>
    <link rel="stylesheet"           type="text/css" href="./theme/default_right_scroll.css" title="default_right_scroll">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_right.css" title="default_right">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_left_scroll.css" title="default_left_scroll">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_left.css" title="default_left">
    <script type="text/javascript" src="./styleswitcher.js"></script>
    <script type="text/javascript" src="./script.js"></script>
  </head>
  <body>

    <div id="id_style_app_name">
      <div id="id_app_name">
        <h1><?php echo htmlspecialchars(APP_NAME_LONG); ?></h1>
      </div>
      <div id="id_style">
        <h2>Style</h2>
        <a class="style" href="#" onclick="setActiveStyleSheet('default_right_scroll');return false;">right scroll</a> |
        <a class="style" href="#" onclick="setActiveStyleSheet('default_right');return false;">right</a> |
        <a class="style" href="#" onclick="setActiveStyleSheet('default_left_scroll');return false;">left scroll</a> |
        <a class="style" href="#" onclick="setActiveStyleSheet('default_left');return false;">left</a>        
      </div>
    </div>
    <div id="id_dl_main">
      <div id="id_title">
        <h1><?php echo htmlspecialchars(CAM_STRING); ?> - Download</h1>
      </div>
      <div id="id_dl_file">
        <?php
          if(isset($_GET["delete"])) {
            unlink("media/" . $_GET["delete"]);
          }
          if(isset($_GET["delete_all"])) {
            $files = scandir("media");
            foreach($files as $file) unlink("media/$file");
          }
          else if(isset($_GET["file"])) {
            echo "<h1>Preview</h1>";
            if(substr($_GET["file"], -3) == "jpg") echo "<img id='id_dl_img_prev' src='media/" . $_GET["file"] . "' width='640'>";
            else echo "<video width='640' controls><source src='media/" . $_GET["file"] . "' type='video/mp4'>Your browser does not support the video tag.</video>";
            echo "<div id='id_dl_ctrls'><input class='btn_main' type='button' value='Download' onclick='window.open(\"./download.php?file=" . $_GET["file"] . "\", \"_blank\");'> ";
            echo "<input class='btn_main' type='button' value='Delete' onclick='window.location=\"./download_preview.php?delete=" . $_GET["file"] . "\";'></div>";
          }
        ?>
        <h1>Files</h1>
        <?php
          $files = scandir("media");
          if(count($files) == 2) echo "<div>No videos/images saved</div>";
          else {
            foreach($files as $file) {
              if(($file != '.') && ($file != '..')) {
                $fsz = round ((filesize("media/" . $file)) / (1024 * 1024));
                echo "<div id='id_dl_file_link'><a href='./download_preview.php?file=$file'>$file</a> ($fsz MB)</div>";
              }
            }
            echo "<div id='id_dl_ctrls'><input class='btn_main' type='button' value='Delete all' onclick='if(confirm(\"Delete all?\")) {window.location=\"./download_preview.php?delete_all\";}'></div>";
          }
        ?>
      </div>
    </div>
    <div id="id_dl_settings">
      <a href="./index.php">Back</a>
    </div>
  </body>
</html>
