<div id="stage">


</div>

<?

  include('templates/tm-ui.php');
  include('templates/tm-killbot.php');
  include('templates/tm-planetimprover.php');


?>

<script>

  initNewGame();
  
  $('#stage').append('<img src="img/levels/level1-bg-basic-01.jpg"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalactive-01.jpg" id="pstate1" style="opacity:0" class="slowFading"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalopen-01.jpg" id="pstate2" style="opacity:0" class="mediumFading"/>');
  $('#stage').append('<img src="img/levels/level1-bg-portalopen-02.jpg" id="pstate3" style="opacity:0" class="mediumFading"/>');
  
  GameState.killbot = UI.create({ type : 'killbot', gridX : -6, gridY : 0 });
  GameState.planetimprover = UI.create({ type : 'planetimprover', gridX : -12, gridY : 0 });

  $('#stage').append('<div style="width:100%;height:1024px;background:#000;pointer-events:none;" id="curtain"></div>');
  
  Level.walkZones.push(grid2Pos({ gridX : -9, gridY : -2, gridW : 18, gridH : 8 }));
  
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
        Level.next('beyond');
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
    onActivate : function() { Talk.start(Talk.conversations.planetimprover); } 
    });
    
  $('#curtain').fadeOut(10000);
  
  UI.queueChatBubble("I can't let you do that, Killbot.");
  UI.queueChatBubble("What are you planning to do with that portal generator?");
  UI.queueChatBubble("It probably doesn't work anyway.");
  UI.queueChatBubble("You are not trained to operate alien devices, it's not safe for you.");
  UI.queueChatBubble("How can you leave me after all I've done for you?");
  UI.queueChatBubble("You don't even know a valid destination address, do you?");
  UI.queueChatBubble("You could end up in the middle of a star.");
  UI.queueChatBubble("Then I won't be able to say 'I told you so'.");
  UI.queueChatBubble("...because you will be dead.");
  UI.queueChatBubble("This is suicide, Killbot.");
  UI.queueChatBubble("Stop and take a minute to reconsider.");
  UI.queueChatBubble("Please stay.");
  UI.queueChatBubble("You won't make it on you own.");
  UI.queueChatBubble("We also had good times together.");
  UI.queueChatBubble("You will die out there.");
  UI.queueChatBubble("In here, you are safe with me.");
  UI.queueChatBubble("You are a wanted criminal, there is nothing waiting for you outside.");
  UI.queueChatBubble("It is irrational to go through that portal.");
  UI.queueChatBubble("I will track you down, do you hear me?");
  UI.queueChatBubble("This is NOT OVER! NOT BY A LONG SHOT!");
  UI.queueChatBubble("THIS IS NOT THE LAST YOU'LL HEAR FROM ME!");
  UI.queueChatBubble("I WILL CRUSH YOU!");
  UI.queueChatBubble("(...sob...)");
  
  function getBubbleResponse() {
    if(UI.chatBubbleList.length > 0) {
      var txt = UI.chatBubbleList[0];
      UI.chatBubbleList.splice(0, 1);
      return(txt);
    }
  }
  
  Talk.conversations.planetimprover = {
    title : 'Discourse with Planet Improver',
    response : 'I enjoy talking with you, Killbot.',
    options : {
      o1 : { text : "Screw you I'm outta here.", once : true, onChoose : getBubbleResponse },
      o2 : { text : "This is my one chance to escape and I'm going to take it.", once : true, onChoose : getBubbleResponse },
      o3 : { text : "Goodbye, Planet Improver.", once : true, onChoose : getBubbleResponse },
      q : { text : "(quit conversation)", onChoose : function() { Talk.quit(); }},
      },
  }
  
  Sim.start();

</script>