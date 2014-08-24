
<script id="ui-killbot" type="text/x-handlebars-template">
  <div id="killbot" class="mob" style="
    left:{{tx}}px;top:{{ty}}px;width:{{w}}px;height:{{h}}px;
    background:url('img/mobs/killbot.png') left center;">
  
  </div>
</script>

<script>

UI.register('killbot', function(p) {
  p.id = 'killbot';
  p.imgSize = 320;
  p.w = p.imgSize;
  p.h = p.imgSize;
  p.speed = 0;
  p.rotation = 0;
  p.fullSpeed = 3;
  
  p.rotate = function(deg) {
    if(isset(deg)) p.rotation += deg;
    while(p.rotation >= 360) p.rotation -= 360;
    while(p.rotation < 0) p.rotation += 360;
    if(isset(p.element)) {
      var rotState = Math.round(p.rotation / 15);
      p.element.css('background-position', '0px -'+(p.imgSize*rotState)+'px');
    }
  }
  
  p.onDisplay = function() { 
    // show the right side at the beginning
    p.rotate(); 
  };
  
  p.onMove = function() {
    // see if we should trigger any item events due to proximity
    $.each(Level.items, function(idx, itm) {
      if(rectCollision(p, itm, -itm.tolerance)) {
        if(itm.proxHL && itm.element && itm.element.attr('class') != 'hintzone hintHL') {
          itm.element.attr('class', 'hintzone hintHL');
          $('#'+itm.id+'_label').css('opacity', 1.0);
          Level.selectItem(itm);
        }
      } else {
        if(itm.proxHL && itm.element && itm.element.attr('class') == 'hintzone hintHL') {
          itm.element.attr('class', 'hintzone hintNoHL');
          $('#'+itm.id+'_label').css('opacity', 0);
        }
      }
    });    
  }
  
  Sim.entities.push(p);
  });
  
UI.keyboardHooks.a_down = function() {
  if(GameState.killbot) {
    if(GameState.killbot.rotation != 90) GameState.killbot.rotate(15);
    else GameState.killbot.targetSpeed = -GameState.killbot.fullSpeed;
  }
}
UI.keyboardHooks.a_up = function() {
  GameState.killbot.targetSpeed = 0;
}

UI.keyboardHooks.d_down = function() {
  if(GameState.killbot) {
    if(GameState.killbot.rotation != 270) GameState.killbot.rotate(-15);
    else GameState.killbot.targetSpeed = GameState.killbot.fullSpeed;
  }
}
UI.keyboardHooks.d_up = UI.keyboardHooks.a_up;

</script>

