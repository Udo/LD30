<?

  include('templates/astro.objects.php');

?>

<div>
  Astro-Nav Display<span id="cursor"></span>
</div>

<div id="navScreen">


</div>

<script>


  var navScreen = $('#navScreen');

  displaySVG(navScreen, { type : 'star' });
  displaySVG(navScreen, { type : 'selector' });

</script>
