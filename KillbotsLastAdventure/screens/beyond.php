<div id="stage">


</div>

<?

  include('templates/tm-ui.php');
  include('templates/tm-killbot.php');

?>

<script>

  initNewGame();
  UI.init();
  
  $('#stage').css('background', '#fff');

  GameState.killbot = UI.create({ type : 'killbot', scheme : 'bright', gridX : -6, gridY : -3 });
  
  Level.walkZones.push(grid2Pos({ gridX : -12, gridY : -5, gridW : 24, gridH : 8 }));
  
  Sim.start();

</script>