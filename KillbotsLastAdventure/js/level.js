Level = {
  
  walkZones : [],
  
  items : [],
  selectedItem : false,
  
  newItem : function(itm) {
    Level.items.push(grid2Pos(itm));
    itm.type = 'hintzone';
    UI.create(itm);    
  },
  
  selectItem : function(itm) {
    Level.selectedItem = itm;
    if(itm.onSelect) itm.onSelect();
  },
  
  activateItem : function(itm) {
    if(itm && itm.onActivate) {
      itm.onActivate();
    }
  },
  
  next : function(nextLevel) {
    setTimeout(function() {
      document.location.href = '?p='+nextLevel;
      }, 5000);
    $('#stage').fadeOut(5000);
  },
  
}

UI.keyboardHooks.Enter_pressed = function() {
  
  if(Level.selectedItem)
    Level.activateItem(Level.selectedItem);
  
}