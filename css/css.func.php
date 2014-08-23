<?

function color($clr, $opacity = 1)
{
  if(sizeof($clr) == 0) #default to black
    $clr[0] = 0;
  if(sizeof($clr) < 3) #gray scale
  {
    $clr[1] = $clr[0];
    $clr[2] = $clr[0];
  }
  if(sizeof($clr) < 4) #opacity
    $clr[4] = $opacity;
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