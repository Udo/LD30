<script id="ui-boarding" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">BOA</text>
    
  </svg>
</script>

<script id="ui-security" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">SEC</text>
    
  </svg>
</script>

<script id="ui-checkin" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">CHK</text>
    
  </svg>
</script>

<script id="ui-hall" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">HLL</text>
    
  </svg>
</script>

<script id="ui-runway" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">LTO</text>
    
  </svg>
</script>

<script id="ui-commerce" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">COM</text>
    
  </svg>
</script>

<script id="ui-tubestation" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($buildingColor, 0.3) ?>" stroke="<?= color($buildingColor) ?>" stroke-width="4"/>
    <text x="50" y="60" text-anchor="middle" fill="<?= color($background) ?>">PTSD</text>
    
  </svg>
</script>

<script>

var regBuilding = function(e) { if(!isset(GameState.buildingIndex[e.type])) GameState.buildingIndex[e.type] = []; GameState.buildingIndex[e.type].push(e); };
var unregBuilding = function(e) { GameState.buildingIndex[e.type].splice(GameState.buildingIndex[e.type].indexOf(e), 1); };

UI.register('boarding', regBuilding, unregBuilding);
UI.register('security', regBuilding, unregBuilding);
UI.register('checkin', regBuilding, unregBuilding);
UI.register('hall', regBuilding, unregBuilding);
UI.register('runway', regBuilding, unregBuilding);
UI.register('commerce', regBuilding, unregBuilding);
UI.register('tubestation', regBuilding, unregBuilding);

</script>