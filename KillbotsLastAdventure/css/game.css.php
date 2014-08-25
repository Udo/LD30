<?

header('content-type: text/css');
include('css.func.php');

?>

@font-face {
  font-family: console;
  src: url('../fonts/glass_tty_vt220.ttf');
}

* {
  box-sizing: border-box;
  line-height: 150%;
}
body {
  background: <?= color($background) ?>;
  color: <?= color($textColor) ?>;
  font-family: console;
  font-size: 20px;
}

<? ob_start(); ?>
@keyframes cursorBlinkKey {
  0%   { opacity: 0; }
  5%   { opacity: 1; }
  70%   { opacity: 1; }
  100% { opacity: 0; }
}
<?= prefixize(ob_get_clean())?>

<? ob_start(); ?>
@keyframes pulseBlinkKey {
  0%   { opacity: 0.5; }
  50%   { opacity: 1; }
  100% { opacity: 0.5; }
}
<?= prefixize(ob_get_clean())?>

.cursor, #cursor {
  display: inline-block;
  width: 12px;
  height: 22px;
  vertical-align: middle;
  background: <?= color($textColor) ?>;
  border-bottom: 2px solid #000;
  <?= prefixize('animation: cursorBlinkKey 2s infinite;') ?>
}

#stage {
  width: 1600px;
  height: 900px;
  background: <?= color($background) ?>;
  border-top: <?= color($textColor, 0.2) ?>;
  border-bottom: <?= color($textColor, 0.2) ?>;
  position: relative;
  overflow: hidden;
  margin-left: auto;
  margin-right: auto;
}

#stage > * {
  position: absolute;
  left: 0; top: 0;
}

svg {
  position: absolute;
  pointer: cursor;
}

<?= prefixize('@keyframes dash { 
  0% { stroke-dashoffset: 0; }
  100% { stroke-dashoffset: 1000; }
  }') ?>
.dashPath {
  stroke-dasharray: 50;
  <?= prefixize('animation: dash 5s linear infinite;') ?>
}
<?= prefixize('@keyframes dashLeftKey { 
  0% { stroke-dashoffset: 0; }
  100% { stroke-dashoffset: -1000; }
  }') ?>
.dashLeft {
  stroke-dasharray: 50;
  <?= prefixize('animation: dashLeftKey 5s linear infinite;') ?>
}

.pulseBlink {
  <?= prefixize('animation: pulseBlinkKey 2s linear infinite;') ?>
}

header, .bordered {
  background: <?= color($textColor, 0.2) ?>;
  border: 1px solid <?= color($textColor, 0.2) ?>;
  padding: 4px;
}

header {
  position: absolute;
  top:0;left:0;right:0;
}

#content {
  margin-top: 48px;
}

#content > p {
  padding: 4px;
}

#actionPalette {
  position: absolute;
  left:0; top:40px; width: <?= $iconWidth ?>px; 
  min-height: 48px;
  text-align: center;
}

.toolicon {
  cursor: pointer;
  color: <?= color($textColor, 0.5) ?>;  
  <?= prefixize('transition: color 0.5s;') ?>
}

.toolicon:hover {
  color: <?= color($textColor, 1) ?>;  
}

.divider {
  border-top: 1px solid <?= color($textColor, 0.5) ?>;
  width: 100%; height:1px; margin-top: 4px; padding-top: 4px;
}

svg text {
  font-size: 30px;
}

#killbot {

}

.mob {
  position: absolute;
}

.mobsize3 {
  width: 320px;
  height: 320px;
}

.hintzone {
  transition: opacity 1s;
  opacity: 0;
  cursor: pointer;
}

.hintzone:hover, .hintHL {
  opacity: 1;
}

.hintNoHL {
  opacity: 0;
}

.itemLabel {
  margin-left: 6px;
  margin-top: -26px;
  font-size: 80%;
  position: absolute;
  opacity: 0;
  line-height: 180%;
  transition: opacity 3s;
}

.slowFading {
  transition: opacity 5s, color 5s;
}

.mediumFading {
  transition: opacity 1.5s linear, color 1.5s linear;
}

#chatBubble {
  transition: opacity 2s;
  opacity: 0;
  left: 200px;
  top: 250px;
  right: 200px;
  text-align: center;
  color: #fff;
  background-color: rgba(0,0,0,0.75);
  padding: 16px;
  border-radius: 16px;
}

#talkWindow {
  font-size: 80%;
  max-height: 400px; overflow: scroll;
  transition: opacity 1s, height 2s;
  opacity: 0;
  left: 0;
  top: 250px;
  right: 0;
  width: 500px;
  margin-left: auto; margin-right: auto;
  background-color: rgba(0,0,0,0.75);
  padding: 16px;
  border-radius: 16px;
  border: 1px solid <?= color($textColor, 0.5) ?>;
  padding: 8px;
}

.talkOpt {
  transition: color 0.5s;
  color: <?= color($textColor) ?>;
  cursor: pointer;
}
.talkOpt:hover {
  color: white;
}
