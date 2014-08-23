<?

header('content-type: text/css');

function color($clr)
{
  if(sizeof($clr) == 0) #default to black
    $clr[0] = 0;
  if(sizeof($clr) < 3) #gray scale
  {
    $clr[1] = $clr[0];
    $clr[2] = $clr[0];
  }
  if(sizeof($clr) < 4) #opacity
    $clr[4] = 1.0;
  return('rgba('.implode(', ', $clr).')');
}

function prefixize($lines, $prefixes = array('', '-moz-', '-webkit-'))
{
  if(!is_array($lines)) $lines = array($lines);
  foreach($prefixes as $pfx)
    foreach($lines as $line)
    {
      $line = trim($line);
      if(substr($line, 0, 1) == '@')
      {
        $line = substr($line, 1);
        $pfx = '@'.$pfx;
      }
      print($pfx.trim($line).chr(10));
    }
}

$background = array(0,0,0);
$textColor = array(0, 100, 200);

?>

@font-face {
  font-family: console;
  src: url('glass_tty_vt220.ttf');
}

body {
  background: <?= color($background) ?>;
  color: <?= color($textColor) ?>;
  font-family: console;
  font-size: 20px;
}

<? ob_start(); ?>
@keyframes cursorBlink {
  0%   { opacity: 0; }
  5%   { opacity: 1; }
  70%   { opacity: 1; }
  100% { opacity: 0; }
}
<?= prefixize(ob_get_clean())?>

#cursor {
  display: inline-block;
  width: 12px;
  height: 20px;
  background: <?= color($textColor) ?>;
  <?= prefixize('animation: cursorBlink 2s infinite;') ?>
}

