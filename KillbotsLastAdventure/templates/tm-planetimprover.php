
<script id="ui-planetimprover" type="text/x-handlebars-template">
  <div id="killbot" class="mob" z-index="100" style="
    left:{{tx}}px;top:{{ty}}px;margin-left:-{{hw}}px;margin-top:-{{hh}}px;
    width:320px;height:311px;
    background:url('img/mobs/planetimprover.png') left center;">
  
  </div>
</script>

<script>

UI.register('planetimprover', function(p) {
  p.id = 'planetimprover';
  Sim.entities.push(p);
  });
  
</script>

