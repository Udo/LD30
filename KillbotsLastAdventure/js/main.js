GameState = {}; // state of play
SessionState = {}; // ephemeral session data
StageObjects = {}; // current stage objects
StageTemplates = {}; // templates for stage objects
Stage = null; // stage element

Config = {
  gridSize : 64,
  
  }
  
function isset(v) {
  return(typeof v != 'undefined');
}

function getRandomItem(fromArray) {
  return(fromArray[Math.floor(Math.random()*fromArray.length)]);
}

function rollDice(percentage) {
  return(Math.random()*100 <= percentage);
}

function initNewGame() {
  GameState = {
    passengers : [],
    spaceplanes : [],
    buildingIndex : {},
    newPassengerChance : 100,
  }
}