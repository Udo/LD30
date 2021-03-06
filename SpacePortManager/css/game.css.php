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

#cursor {
  display: inline-block;
  width: 12px;
  height: 22px;
  vertical-align: middle;
  background: <?= color($textColor) ?>;
  border-bottom: 2px solid #000;
  <?= prefixize('animation: cursorBlinkKey 2s infinite;') ?>
}

#stage {
  width: 100%;
  height: 640px;
  background: <?= color($background) ?>;
  border-top: <?= color($textColor, 0.2) ?>;
  border-bottom: <?= color($textColor, 0.2) ?>;
  position: relative;
  overflow: hidden;
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
