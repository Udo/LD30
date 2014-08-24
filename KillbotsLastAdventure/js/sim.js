SimRules = {
  
  barrierCollision : function(p) {
    var result = false;
    $.each(Level.walkZones, function(idx, walkZ) {
      if(result == false && !pointIsWithinRect(p, walkZ)) {
        result = walkZ;
      }
    });
    return(result);
  },

  move : function(p, xdist, ydist) {
    p.x += xdist;
    p.y += ydist;
    if(SimRules.barrierCollision(p)) {
      p.speed = 0;
      p.targetSpeed = 0;
      p.x -= xdist;
      p.y -= ydist;
    } 
    else {
      coordTranslate(p);
      p.element.css('left', p.tx+'px');
      p.element.css('top', p.ty+'px');
    }
  },
  
}

SimEvents = {

  moveAll : function(eList) {
    $.each(eList, function(idx, entry) {
      // linear speed ease
      if(isset(entry.targetSpeed)) {
        if(entry.targetSpeed > (entry.speed + 0.1)) entry.speed += 0.1;
        else if(entry.targetSpeed < (entry.speed - 0.1)) entry.speed -= 0.1;
        else entry.speed = entry.targetSpeed;
      } 
      // move the entity
      if(entry.speed != 0) {
        SimRules.move(entry, entry.speed, 0);
        if(entry.onMove) entry.onMove();
      }
    });
  }
  
}

SimUI = {
  
  
  
}

Sim = {

  entities : [],

  onFrame : function() {
    UI.execCurrentKeyHooks();
    SimEvents.moveAll(Sim.entities);
    requestAnimationFrame(Sim.onFrame);
  },
  
  start : function() {
    Sim.paused = false;
    requestAnimationFrame(Sim.onFrame);
  },
  
  pause : function() {
    Sim.paused = true;
  },
  
}