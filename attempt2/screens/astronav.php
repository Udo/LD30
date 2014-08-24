<?

  include('templates/astro.objects.php');

  function generateRandomStarName($starMap)
  {
    $s1 = explode(',', 'Alpha,Beta,Gamma,Delta,Epsilon,Zeta,Eta,Theta,Iota,Kappa,Lambda,Omicron,Sigma,Tau,Omega');
    $s2 = explode(',', 'Aquilae,Ari,Aurigae,Caeli,Carinae,Ceti,Cephei,Corvi,Draconis,Cygni,Hydri,Leonis,Persei,Pegasi,Reticuli,Serpentis,Velae');
    $name = $s1[mt_rand(0, sizeof($s1)-1)].' '.$s2[mt_rand(0, sizeof($s2)-1)];
    do 
    {
      $nameFound = false;
      foreach($starMap as $se)
        if($se['name'] == $name) $nameFound = true;
    } while($nameFound);
    return($name);
  }

  function getNewCoords($starMap)
  {
    do 
    {
      $x = mt_rand(0, 16) - mt_rand(0, 16);
      $y = mt_rand(0, 6) - mt_rand(0, 6);
      $distance = 100000;
      foreach($starMap as $se)
      {
        $dist = sqrt(pow($se['gridX']-$x, 2)+pow($se['gridY']-$y, 2));
        if($dist < $distance) $distance = $dist;
      }
    } while ($distance <= 3);
    return(array('x' => $x, 'y' => $y));
  }

  $starMap = array();
  for($c = 1; $c < 10; $c++) 
  {
    $coord = getNewCoords($starMap);
    $starMap['star'.$c] = array( 
      'type' => 'star',
      'name' => generateRandomStarName($starMap),
      'size' => mt_rand(10, 20)/10,
      'gridX' => $coord['x'],
      'gridY' => $coord['y'],
      );
  }

?>

<div>
  Astro-Nav Display<span id="cursor"></span>
</div>

<div id="navScreen">


</div>

<script>

  var navScreen = $('#navScreen');
  GameState.starMap = <?= json_encode($starMap) ?>;
  GameState.selector = { type : 'selector', id : 'selector', size : 2, gridX : -100 };
  GameState.rotohover = { type : 'rotohover', id : 'rotohover', size : 2, gridX : -100 };
  GameState.starlabel = { type : 'starlabel', id : 'starlabel', size : 2, gridX : 0 };

  $.each(GameState.starMap, function(idx, val) {
    val.id = idx;
    displaySVG(navScreen, val);
  });
  
  displaySVG(navScreen, GameState.selector);
  displaySVG(navScreen, GameState.rotohover);
  displaySVG(navScreen, GameState.starlabel);

</script>
