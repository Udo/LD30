<div id="stage">


</div>

<?

  include('templates/tm-ui.php');
  include('templates/tm-killbot.php');
  include('templates/tm-planetimprover.php');


?>

<script>

  initNewGame();
  UI.init();
  
  $('#stage').append('<img src="img/levels/level1-bg-basic-01.jpg"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalactive-01.jpg" id="pstate1" style="opacity:0" class="slowFading"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalopen-01.jpg" id="pstate2" style="opacity:0" class="mediumFading"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalopen-02.jpg" id="pstate3" style="opacity:0" class="mediumFading"/>');

  GameState.killbot = UI.create({ type : 'killbot', gridX : -6, gridY : 0 });
  GameState.planetimprover = UI.create({ type : 'planetimprover', gridX : -12, gridY : 0 });
  
  Level.walkZones.push(grid2Pos({ gridX : -9, gridY : -2, gridW : 21, gridH : 8 }));
  
  Level.activatePortal = function() {
    if(!Level.portalState) {
      Level.portalState = 'dialling';
      $('#pstate1').css('opacity', 1.0);
      $('#gate_control_label .lHint').text('Connecting, stand by...');
      setTimeout(function() {
        Level.portalState = 'open';
        $('#pstate2').css('opacity', 1.0);
        $('#gate_control_label .lHint').text('Connection established :)');
        $('#gate_label .lHint').text('online');
        var bgState = true;
        setInterval(function() {
          if(bgState == true) 
            $('#pstate3').css('opacity', 1.0);
          else
            $('#pstate3').css('opacity', 0);
          bgState = !bgState;
          }, 1300);
        }, 5000);
    }
  }
  
  Level.newItem({ id : 'gate', name : 'Portal Generator', hint : 'offline',
    gridX : 6, gridY : -5, gridW : 6, gridH : 10, proxHL : true, tolerance : -Config.gridSize*2,
    onSelect : function() {
      if(Level.portalState == 'open')
        Level.next('level2');
    }
    });

  Level.newItem({ id : 'gate_control', name : 'Gate Control', hint : 'press [Enter] to activate',
    gridX : 1, gridY : 0, gridW : 4, gridH : 4, usable : true, proxHL : true, tolerance : -Config.gridSize,
    onActivate : function() {
      Level.activatePortal();
      } 
    });

  Level.newItem({ name : 'Planet Improver', hint : 'press [Enter] to chat',
    gridX : -12, gridY : 0, gridW : 4, gridH : 4, usable : true, proxHL : true, tolerance : 0, 
    onActivate : function() {} 
    });
  
  Sim.start();

</script>