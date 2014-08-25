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
  }
  Stage = $('#stage');
  Stage.append('<div id="chatBubble" style="z-index: 1000">test</div>');
  Stage.append('<div id="talkWindow" style="z-index: 1001">test</div>');
  UI.init();
}