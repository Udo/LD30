<?

include('css/css.func.php');

?>

<script id="astro-star" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    onclick="starClick('{{id}}');"
    onmouseover="starMouseOver('{{id}}');"
    onmouseout="starMouseOut('{{id}}');"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;">
    <filter id="blur1">
      <feGaussianBlur stdDeviation="15" />
    </filter> 
    <filter id="blur2">
      <feGaussianBlur stdDeviation="3" />
    </filter> 
    <g filter="url(#blur1)">
      <rect x="0" y="0" width="100" height="100" fill="transparent"/>
      <circle cx="50" cy="50" r="20" stroke="{{corona}}" stroke-width="10" fill="{{color}}"/>
    </g>
    <g filter="url(#blur2)">
      <rect x="0" y="0" width="100" height="100" fill="transparent"/>
      <circle cx="50" cy="50" r="20" fill="{{color}}"/>
    </g>
  </svg>
</div>
</script>

<script id="astro-selector" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    <g fill="{{color}}" class="pulseBlink">
      <rect x="0" y="0" width="20" height="6"/>
      <rect x="0" y="0" width="6" height="20"/>
      <rect x="80" y="0" width="20" height="6"/>
      <rect x="94" y="0" width="6" height="20"/>
      <rect x="0" y="94" width="20" height="6"/>
      <rect x="0" y="80" width="6" height="20"/>
      <rect x="80" y="94" width="20" height="6"/>
      <rect x="94" y="80" width="6" height="20"/>
    </g>
    <rect class="dashPath" x="0" y="0" width="100" height="100" fill="none" stroke="{{color}}" stroke-width="3"/>
  </svg>
</script>

<script id="astro-rotohover" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    <rect class="dashLeft" x="20" y="20" width="60" height="60" fill="none" stroke="{{color}}" stroke-width="3"/>
  </svg>
</script>

<script id="astro-starlabel" type="text/x-handlebars-template">
<div id="{{id}}" style="position:absolute;left:{{tx}}px;top:{{ty}}px;margin-left:8px; margin-top:-12px;font-size:80%;pointer-events:none;">
  
</div>
</script>

<script>

var astroObjects = { };
var gridSize = 32;
var idCounter = 10000;

var starClick = function(id) {
  var star = GameState.starMap[id];
  console.log(star);
  GameState.selector.gridX = star.gridX;
  GameState.selector.gridY = star.gridY;
  updatePosition(GameState.selector);
  GameState.starlabel.gridX = star.gridX+1;
  GameState.starlabel.gridY = star.gridY;
  updatePosition(GameState.starlabel);
  $('#starlabel').text(star.name);
}

var starMouseOver = function(id) {
  var star = GameState.starMap[id];
  GameState.rotohover.gridX = star.gridX;
  GameState.rotohover.gridY = star.gridY;
  updatePosition(GameState.rotohover);
}

var starMouseOut = function(id) {
  $('#rotohover').css('left', '-10000px');
}

function registerObject(oType, drawHandler) {
  astroObjects[oType] = Handlebars.compile($('#astro-'+oType).html());
  astroObjects[oType+'Draw'] = drawHandler;
}

function getScreenGeometry(elem) {
  var w = elem.width();
  var h = elem.height();
  return({
    width : w,
    height : h,
    xMid : Math.round(w/2),
    yMid : Math.round(h/2),
    });
}

function grid2Pos(prop) {
  prop.x = prop.gridX*gridSize;
  prop.y = prop.gridY*gridSize;
}

function coordTranslate(geo, prop) {
  prop.tx = geo.xMid + prop.x;
  prop.ty = geo.yMid + prop.y;
}

function updatePosition(prop) {
  grid2Pos(prop);
  coordTranslate(GameState.geo, prop);
  $('#'+prop.id).css('top', prop.ty+'px').css('left', prop.tx+'px');
}

function displaySVG(toContainer, prop) {
  obj = prop.type;
  if(!prop.id) prop.id = 'obj_'+(idCounter++);
  if(!toContainer.geo) {
    toContainer.geo = getScreenGeometry(toContainer);
    GameState.geo = toContainer.geo;
  }
  // call Draw handler if present
  if(astroObjects[obj+'Draw']) astroObjects[obj+'Draw'](prop);
  // fill sensible default values
  if(prop.size) {
    prop.w = prop.size*gridSize;
    prop.h = prop.size*gridSize;
  }
  if(!prop.w) prop.w = 128;
  if(!prop.h) prop.h = 128;
  if(!prop.hw) prop.hw = prop.w/2;
  if(!prop.hh) prop.hh = prop.h/2;
  if(prop.gridX) grid2Pos(prop);
  if(!prop.x) prop.x = 0;
  if(!prop.y) prop.y = 0;
  // translate to container coordinates
  coordTranslate(toContainer.geo, prop);
  // actually render the object
  toContainer.append(astroObjects[obj](prop));
}

registerObject('star', function(p) {
    if(!p.color) p.color = '#ff9';
    if(!p.corona) p.corona = '#f00';
    if(!p.w) p.w = 250;
    p.h = p.w;
  });
registerObject('selector', function(p) {
    if(!p.color) p.color = '<?= color($textColor, 0.5) ?>';
  });
registerObject('rotohover', function(p) {
    if(!p.color) p.color = '<?= color($textColor, 0.5) ?>';
  });
registerObject('starlabel', function(p) {
    if(!p.color) p.color = '<?= color($textColor, 0.5) ?>';
  });

</script>
