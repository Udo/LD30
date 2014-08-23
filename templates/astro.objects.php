<?

include('css/css.func.php');

?>

<script id="astro-star" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100"
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
    viewbox="0 0 100 100"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;">
    <g fill="{{color}}" class="pulseBlink">
      <rect x="0" y="0" width="20" height="2"/>
      <rect x="0" y="0" width="2" height="29"/>
      <rect x="80" y="0" width="20" height="2"/>
      <rect x="98" y="0" width="2" height="20"/>
      <rect x="0" y="98" width="20" height="2"/>
      <rect x="0" y="80" width="2" height="20"/>
      <rect x="80" y="98" width="20" height="2"/>
      <rect x="98" y="80" width="2" height="20"/>
    </g>
    <rect class="dashPath" x="0" y="0" width="100" height="100" fill="none" stroke="{{color}}" stroke-width="1"/>
  </svg>
</div>
</script>

<script>

var astroObjects = { };

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

function displaySVG(toContainer, prop) {
  obj = prop.type;
  if(!toContainer.geo) toContainer.geo = getScreenGeometry(toContainer);
  // call Draw handler if present
  if(astroObjects[obj+'Draw']) astroObjects[obj+'Draw'](prop);
  // fill sensible default values
  if(!prop.w) prop.w = 128;
  if(!prop.h) prop.h = 128;
  if(!prop.hw) prop.hw = prop.w/2;
  if(!prop.hh) prop.hh = prop.h/2;
  if(!prop.x) prop.x = 0;
  if(!prop.y) prop.y = 0;
  // translate to container coordinates
  prop.tx = toContainer.geo.xMid + prop.x;
  prop.ty = toContainer.geo.yMid + prop.y;
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
    if(!p.w) p.w = 250;
    p.h = p.w;
  });

</script>
