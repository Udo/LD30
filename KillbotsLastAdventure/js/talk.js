Talk = {
  
  conversations : {},
  lastConversation : false,
  window : false,
  
  optIdx2Key : {},
  makeOptList : function(conv) {
    Talk.optIdx2Key = {};
    var optList = [];
    var optNr = 0;
    $.each(conv.options, function(idx, opt) {
      optNr++; opt.nr = optNr;
      optList.push('<div class="talkOpt" onclick="Talk.chooseOpt(\''+idx+'\');">'+optNr+': '+opt.text+'</div>');
      Talk.optIdx2Key[optNr] = idx;      
    });
    conv.optList = optList;
    return(optList);
  },
  
  chooseOpt : function(optKey) {
    var conv = Talk.lastConversation;
    var opt = conv.options[optKey];
    var response = conv.response;
    if(opt.onChoose)
      response = opt.onChoose(conv, opt, optKey);
    if(response)
      conv.response = response;
    if(opt.once)
      delete conv.options[optKey];
    Talk.display(conv);
  },
  
  chooseByIdx : function(idx) {
    Talk.chooseOpt(Talk.optIdx2Key[idx]);
  },
  
  keyboardHooks : {
    q_pressed : function() { Talk.quit(); },
    Esc_pressed : function() { Talk.quit(); },
  },
  
  display : function(conv) {
    Talk.window.html(conv.title+':<br/>"<span class="slowFading" id="talkResponse" style="color:#fff;">'+
      conv.response+'</span>"<br/>--------------------------------------------<br/>'+
      Talk.makeOptList(conv).join(''))
    setTimeout(function() {
      $('#talkResponse').css('color', Config.textColor); }, 1000);
  },
   
  start : function(conv) {
    Sim.pause();
    Talk.inactiveKeyboardHooks = UI.keyboardHooks;
    UI.keyboardHooks = Talk.keyboardHooks;
    Talk.lastConversation = conv;
    Talk.window = $('#talkWindow');
    if(!conv.title) conv.title = 'Conversation';
    Talk.window.css('opacity', 1);
    Talk.display(conv);
  },
  
  quit : function() {
    Sim.start();
    Talk.window.css('opacity', 0);
    UI.keyboardHooks = Talk.inactiveKeyboardHooks;
  },
  
}

for(var i = 0; i < 10; i++)
  Talk.keyboardHooks[i+'_pressed'] = (function(ix) { return(function() { Talk.chooseByIdx(ix); }); })(i);
  
