<?

header('content-type: text/css');
include('css.func.php');

?>

@font-face {
  font-family: console;
  src: url('glass_tty_vt220.ttf');
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

#navScreen {
  width: 100%;
  height: 640px;
  background: <?= color($textColor, 0.2) ?>;
  border-top: <?= color($textColor, 0.4) ?>;
  border-bottom: <?= color($textColor, 0.4) ?>;
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
