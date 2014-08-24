<div id="stage">


</div>

<div id="actionPalette" class="bordered">
  
  <i class="fa fa-2x toolicon fa-eye" data-title="Manage"></i>
  <i class="fa fa-2x toolicon fa-cubes" data-title="Build"></i>
  <div class="divider"></div>
  <i class="fa fa-2x toolicon fa-money" data-title="Financial Report"></i>
  
</div>

<?

  include('templates/tm-ui.php');
  include('templates/tm-buildings.php');
  include('templates/tm-mobs.php');

?>

<script>

  initNewGame();

  UI.create({ type : 'selector' });
  
  for(var i = -2; i < 3; i++)
    UI.newElementAt('runway', i, -3);
    
  UI.newElementAt('boarding', 0, -2);

  UI.newElementAt('checkin', 0, -1);

  UI.newElementAt('tubestation', 1, -1);
  
  Sim.start();
  
</script>