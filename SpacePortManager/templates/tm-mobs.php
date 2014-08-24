<script id="ui-passenger" type="text/x-handlebars-template">
  <svg width="{{w}}" height="{{h}}"  
    viewbox="0 0 100 100" id="{{id}}"
    style="left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;width:{{w}}px;height:{{h}}px;pointer-events:none;">
    
    <rect x="0" y="0" width="100" height="100" fill="<?= color($passengerColor, 0.5) ?>" stroke="<?= color($passengerColor) ?>" stroke-width="4"/>
    
  </svg>
</script>



<script>

UI.register('passenger', function(p) { p.size = 0.1; });

</script>