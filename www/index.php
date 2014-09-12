<!DOCTYPE html>
<?php
  define('BASE_DIR', dirname(__FILE__));
  require_once(BASE_DIR.'/config.php');
?>
<html>
  <head>
    <title><?php echo htmlspecialchars(CAM_STRING); ?></title>
    <link rel="stylesheet"           type="text/css" href="./theme/default_right_scroll.css" title="default_right_scroll">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_right.css" title="default_right">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_left_scroll.css" title="default_left_scroll">
    <link rel="alternate stylesheet" type="text/css" href="./theme/default_left.css" title="default_left">
    <script type="text/javascript" src="./styleswitcher.js"></script>
    <script type="text/javascript" src="./script.js"></script>
  </head>
  <body onload="setTimeout('init();', 100);">
    <div id="id_main">
      <div id="id_title"><h1><?php echo htmlspecialchars(CAM_STRING); ?></h1></div>
      <div id="id_cam_preview"><img id="mjpeg_dest"></div>
      <div id="id_cam_ctrls">
        <input class="btn_main" id="video_button" type="button">
        <input class="btn_main" id="image_button" type="button">
        <input class="btn_main" id="timelapse_button" type="button">
        <input class="btn_main" id="md_button" type="button">
        <input class="btn_main" id="halt_button" type="button">
      </div>
      <div id="id_download"><a href="./download_preview.php">Download Videos and Images</a></div>
      <div id="id_sys_ctrls">
        <input class="btn_main" id="shutdown_button" type="button" value="shutdown system" onclick="sys_shutdown();">
        <input class="btn_main" id="reboot_button" type="button" value="reboot system" onclick="sys_reboot();">
      </div>
    </div>
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
    <div id="id_settings">
      <h2 class="normal">Settings</h2>
      <div id="id_settings_elem">
        <h3 class="normal">Resolution Preset:</h3>
        <select onclick="set_preset(this.value)">
          <option value="1920 1080 25 25 2592 1944">Select option...</option>
          <option value="1920 1080 25 25 2592 1944">Std FOV</option>
          <option value="1296 0730 25 25 2592 1944">16:9 wide FOV</option>
          <option value="1296 0976 25 25 2592 1944">4:3 full FOV</option>
          <option value="1920 1080 01 30 2592 1944">Std FOV, x30 Timelapse</option>
        </select>
      </div>
      <div id="id_settings_elem">
        <h3 class="normal">Resolution Custom Values:</h3>
        <div id="id_width_small"><h4 class="normal">Video res:</h4></div>
        <div id="id_width_big"><input type="text" size=4 id="video_width">x<input type="text" size=4 id="video_height">px</div>
        <div id="id_width_small"><h4 class="normal">Video fps:</h4></div>
        <div id="id_width_big"><input type="text" size=2 id="video_fps">recording, <input type="text" size=2 id="MP4Box_fps">boxing</div>
        <div id="id_width_small"><h4 class="normal">Image res:</h4></div>
        <div id="id_width_big"><input type="text" size=4 id="image_width">x<input type="text" size=4 id="image_height">px</div>
        <div id="id_width_small">&nbsp;</div>
        <div id="id_width_big"><input class="btn_settings" type="button" value="OK" onclick="set_res();"></div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Timelapse-Interval (0.1...3200):</h4></div>
        <div id="id_width_small"><input type="text" size=4 id="tl_interval" value="3">s</div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Sharpness (-100...100), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="sharpness">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('sh ' + document.getElementById('sharpness').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Contrast (-100...100), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="contrast">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('co ' + document.getElementById('contrast').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Brightness (0...100), default 50:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="brightness">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('br ' + document.getElementById('brightness').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Saturation (-100...100), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="saturation">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('sa ' + document.getElementById('saturation').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">ISO (100...800), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="iso">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('is ' + document.getElementById('iso').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Metering Mode, default 'average':</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('mm ' + this.value)">
            <option value="average">Select option...</option>
            <option value="average">Average</option>
            <option value="spot">Spot</option>
            <option value="backlit">Backlit</option>
            <option value="matrix">Matrix</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Video Stabilisation, default: 'off'</h4></div>
        <div id="id_width_small">
          <input class="btn_settings" type="button" value="ON" onclick="send_cmd('vs 1')">
          <input class="btn_settings" type="button" value="OFF" onclick="send_cmd('vs 0')">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Exposure Compensation (-10...10), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="comp">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('ec ' + document.getElementById('comp').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Exposure Mode, default 'auto':</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('em ' + this.value)">
            <option value="auto">Select option...</option>
            <option value="off">Off</option>
            <option value="auto">Auto</option>
            <option value="night">Night</option>
            <option value="nightpreview">Nightpreview</option>
            <option value="backlight">Backlight</option>
            <option value="spotlight">Spotlight</option>
            <option value="sports">Sports</option>
            <option value="snow">Snow</option>
            <option value="beach">Beach</option>
            <option value="verylong">Verylong</option>
            <option value="fixedfps">Fixedfps</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">White Balance, default 'auto':</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('wb ' + this.value)">
            <option value="auto">Select option...</option>
            <option value="off">Off</option>
            <option value="auto">Auto</option>
            <option value="sun">Sun</option>
            <option value="cloudy">Cloudy</option>
            <option value="shade">Shade</option>
            <option value="tungsten">Tungsten</option>
            <option value="fluorescent">Fluorescent</option>
            <option value="incandescent">Incandescent</option>
            <option value="flash">Flash</option>
            <option value="horizon">Horizon</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Image Effect, default 'none':</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('ie ' + this.value)">
            <option value="none">Select option...</option>
            <option value="none">None</option>
            <option value="negative">Negative</option>
            <option value="solarise">Solarise</option>
            <option value="sketch">Sketch</option>
            <option value="denoise">Denoise</option>
            <option value="emboss">Emboss</option>
            <option value="oilpaint">Oilpaint</option>
            <option value="hatch">Hatch</option>
            <option value="gpen">Gpen</option>
            <option value="pastel">Pastel</option>
            <option value="watercolour">Watercolour</option>
            <option value="film">Film</option>
            <option value="blur">Blur</option>
            <option value="saturation">Saturation</option>
            <option value="colourswap">Colourswap</option>
            <option value="washedout">Washedout</option>
            <option value="posterise">Posterise</option>
            <option value="colourpoint">Colourpoint</option>
            <option value="colourbalance">Colourbalance</option>
            <option value="cartoon">Cartoon</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Colour Effect, default 'disabled':</h4></div>
        <div id="id_width_small">
          <select id="ce_en">
            <option value="0">Disabled</option>
            <option value="1">Enabled</option>
          </select>
        </div>
        <div id="id_width_big">
          <h4 class="normal">u:v :</h4>
          <input type="text" size=3 id="ce_u">:<input type="text" size=3 id="ce_v">
        </div>
        <div id="id_width_small"><input class="btn_settings" type="button" value="OK" onclick="set_ce();"></div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Rotation, default 0:</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('ro ' + this.value)">
            <option value="0">Select option...</option>
            <option value="0">0</option>
            <option value="90">90</option>
            <option value="180">180</option>
            <option value="270">270</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Flip, default 'none':</h4></div>
        <div id="id_width_small">
          <select onclick="send_cmd('fl ' + this.value)">
            <option value="0">Select option...</option>
            <option value="0">None</option>
            <option value="1">Horizonal</option>
            <option value="2">Vertical</option>
            <option value="3">Both</option>
          </select>
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_small"><h4 class="normal">Sensor Region, default 0/0/65536/65536:</h4></div>
        <div id="id_width_big">
          x<input type="text" size=5 id="roi_x">
          y<input type="text" size=5 id="roi_y">
          <br>
          w<input type="text" size=5 id="roi_w">
          h<input type="text" size=5 id="roi_h">
        </div>
        <div id="id_width_big">
          <input class="btn_settings" type="button" value="OK" onclick="set_roi();">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Shutter speed (0...330000), default 0:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="shutter_speed">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('ss ' + document.getElementById('shutter_speed').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Image quality (0...100), default 85:</h4></div>
        <div id="id_width_small">
          <input type="text" size=4 id="quality">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('qu ' + document.getElementById('quality').value)">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Raw Layer, default: 'off':</h4></div>
        <div id="id_width_small">
          <input class="btn_settings" type="button" value="ON" onclick="send_cmd('rl 1')">
          <input class="btn_settings" type="button" value="OFF" onclick="send_cmd('rl 0')">
        </div>
      </div>
      <div id="id_settings_elem">
        <div id="id_width_big"><h4 class="normal">Video bitrate (0...25000000), default 17000000:</h4></div>
        <div id="id_width_small">
          <input type="text" size=10 id="bitrate">
          <input class="btn_settings" type="button" value="OK" onclick="send_cmd('bi ' + document.getElementById('bitrate').value)">
        </div>
      </div>
    </div>
  </body>
</html>
