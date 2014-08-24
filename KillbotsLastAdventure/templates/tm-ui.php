<script id="ui-selector" type="text/x-handlebars-template">
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

<script id="ui-rotohover" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    <rect class="dashLeft" x="20" y="20" width="60" height="60" fill="none" stroke="{{color}}" stroke-width="3"/>
  </svg>
</script>

<script id="ui-hintzone" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}" class="hintzone"
    viewbox="0 0 {{w}} {{h}}" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;width:{{w}}px;height:{{h}}px;">
    <rect class="dashLeft" x="0" y="0" width="{{w}}" height="{{h}}" fill="<?= color($textColor, 0.2) ?>" stroke="<?= color($textColor, 0.2) ?>" stroke-width="4"/>
  </svg>
  <div id="{{id}}_label" 
    class="itemLabel"
    style="left:{{tx}}px;top:{{ty}}px;"><span class="lHint" style="opacity: 0.6">{{hint}}</span><br/><span class="lName">{{name}}</span><span class="cursor"></span></div>
</script>

<script>

UI.register('selector', function(p) {
    if(!p.color) p.color = '<?= color($textColor, 0.5) ?>';
    p.id = 'selector';
  });
UI.register('rotohover', function(p) {
    if(!p.color) p.color = '<?= color($textColor, 0.5) ?>';
    p.id = 'rotohover';
  });
UI.register('hintzone', function(p) {
  });

</script>

