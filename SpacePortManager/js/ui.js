var idCounter = 10000;

function grid2Pos(prop) {
  prop.x = prop.gridX*Config.gridSize;
  prop.y = prop.gridY*Config.gridSize;
}

function coordTranslate(geo, prop) {
  prop.tx = geo.xMid + prop.x;
  prop.ty = geo.yMid + prop.y;
}

function fuzzGridCoord(prop) {
  prop.gridX = Math.round(prop.gridX) - 0.4 + (Math.random()*0.8); 
  prop.gridY = Math.round(prop.gridY) - 0.4 + (Math.random()*0.8); 
  return(prop);
}

UI = {
  
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
    coordTranslate(SessionState.geo, prop);
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
    coordTranslate(SessionState.geo, prop);
    // actually render the object
    Stage.append(StageTemplates[obj](prop));
    prop.element = $('#'+prop.id);
    StageObjects[prop.id] = prop;
    return(prop);
    }
    
}



