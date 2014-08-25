var idCounter = 10000;

function grid2Pos(prop) {
  prop.x = prop.gridX*Config.gridSize;
  prop.y = prop.gridY*Config.gridSize;
  if(isset(prop.gridW)) {
    prop.w = prop.gridW*Config.gridSize;
    prop.h = prop.gridH*Config.gridSize;
  }
  return(prop);
}

function coordTranslate(prop) {
  prop.tx = SessionState.geo.xMid + prop.x;
  prop.ty = SessionState.geo.yMid + prop.y;
  return(prop);
}

function fuzzGridCoord(prop) {
  prop.gridX = Math.round(prop.gridX) - 0.4 + (Math.random()*0.8); 
  prop.gridY = Math.round(prop.gridY) - 0.4 + (Math.random()*0.8); 
  return(prop);
}

function pointIsWithinRect(p, rect) {
  return(
    (p.x >= rect.x) &&
    (p.x + p.w <= rect.x + rect.w) &&
    (p.y >= rect.y) &&
    (p.y + p.h <= rect.y + rect.h)
    );
}

function rectCollision(r1, r2, tolerance) {
  if(tolerance == null) tolerance = 0; 
  return(
    r1.x + tolerance < r2.x + r2.w &&
    r1.x + r1.w - tolerance > r2.x &&
    r1.y + tolerance < r2.y + r2.h &&
    r1.y + r1.h - tolerance > r2.y 
    );
}

UI = {

  keyboardHooks : {},
  keyStateList : [],
  
  addKeyState : function(evtName, evt) {
    if(UI.keyStateList.indexOf(evtName) == -1) UI.keyStateList.push(evtName);
    if(isset(UI.keyboardHooks[evt.key+'_pressed'])) UI.keyboardHooks[evt.key+'_pressed'](evt.key, evt.keyCode);
  },

  removeKeyState : function(evtName, evt) {
    if(UI.keyStateList.indexOf(evtName) != -1) UI.keyStateList.splice(UI.keyStateList.indexOf(evtName), 1);
    if(isset(UI.keyboardHooks[evt.key+'_up'])) UI.keyboardHooks[evt.key+'_up'](evt.key, evt.keyCode);
  },
  
  execCurrentKeyHooks : function() {
    $.each(UI.keyStateList, function(idx, val) {
      if(isset(UI.keyboardHooks[val])) UI.keyboardHooks[val]();
    });
  },

  init : function() {
    $(window).keydown(function(evt) { 
      UI.addKeyState(evt.key+'_down', evt);
      });
    $(window).keyup(function(evt) { 
      UI.removeKeyState(evt.key+'_down', evt);
      });
  },
  
  chatBubbleList : [],
  queueChatBubble : function(text) {
    UI.chatBubbleList.push(text);
  },
  
  displayChatBubble : function(text) {
    if(UI.chatBubbleTO) clearTimeout(UI.chatBubbleTO);
    $('#chatBubble').text(text).css('opacity', 1);
    UI.chatBubbleTO = setTimeout(function() {
      UI.chatBubbleTO = false;
      $('#chatBubble').css('opacity', 0);
      }, 7000);
  },
  
  register :  function(oType, onRegister, onRemove) {
    StageTemplates[oType] = Handlebars.compile($('#ui-'+oType).html());
    StageTemplates[oType+'Register'] = onRegister;
    StageTemplates[oType+'Remove'] = onRemove;
    },
  
  getScreenGeometry: function(elem) {
    var w = elem.width();
    var h = elem.height();
    return({
      width : w,
      height : h,
      xMid : Math.round(w/2),
      yMid : Math.round(h/2),
      });
    },
  
  updatePosition : function(prop) {
    grid2Pos(prop);
    coordTranslate(prop);
    $('#'+prop.id).css('top', prop.ty+'px').css('left', prop.tx+'px');
    },
    
  reset : function() {
    StageObjects = {};
    },
    
  newElementAt : function(tpe, x, y) {
    return(UI.create({ type : tpe, gridX : x, gridY : y }));
    },
    
  create : function(prop) {
    obj = prop.type;
    if(!Stage) Stage = $('#stage');
    if(!prop.id) prop.id = 'obj_'+(idCounter++);
    if(!SessionState.geo) SessionState.geo = UI.getScreenGeometry(Stage);
    // call Draw handler if present
    if(StageTemplates[obj+'Register']) StageTemplates[obj+'Register'](prop);
    // fill sensible default values
    if(prop.size) {
      prop.w = prop.size*Config.gridSize;
      prop.h = prop.size*Config.gridSize;
    }
    if(isset(prop.gridX)) grid2Pos(prop);
    if(!isset(prop.w)) { prop.w = Config.gridSize; prop.h = Config.gridSize; }
    if(!isset(prop.hw)) { prop.hw = prop.w/2; prop.hh = prop.h/2; }
    if(!isset(prop.x)) { prop.x = 0; prop.y = 0; }
    // translate to container coordinates
    coordTranslate(prop);
    // actually render the object
    Stage.append(StageTemplates[obj](prop));
    prop.element = $('#'+prop.id);
    StageObjects[prop.id] = prop;
    if(isset(prop.onDisplay)) prop.onDisplay(prop);
    return(prop);
    }
    
}



