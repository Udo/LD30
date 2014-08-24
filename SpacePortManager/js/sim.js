SimRules = {
  
  findBuilding : function(type) {
    if(!isset(GameState.buildingIndex[type])) return(false);
    if(GameState.buildingIndex[type].length == 1) return(GameState.buildingIndex[type][0]);
    return(getRandomItem(GameState.buildingIndex[type]));
  },
  
}

SimEvents = {

  newPassengers : function() {
    if(rollDice(GameState.newPassengerChance)) {
      var ptsd = SimRules.findBuilding('tubestation');
      if(ptsd) UI.create(fuzzGridCoord({ type : 'passenger', gridX : ptsd.gridX, gridY : ptsd.gridY }));
      }
  },
  
}

SimUI = {
  
  updatePassengers : function() {
    
  },
  
}

Sim = {

  tick : function() {
    SimEvents.newPassengers();
    SimUI.updatePassengers();
    setTimeout(Sim.tick, 500);
  },
  
  start : function() {
    Sim.paused = false;
    setTimeout(Sim.tick, 500);
  },
  
  pause : function() {
    Sim.paused = true;
  },
  
}