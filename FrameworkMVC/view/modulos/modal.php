<!DOCTYPE html>
<html lang="en">
<head>
<style>
#cargando{
top: 0px;
left: 0px;
position: absolute;
width: 100%;
height: 100%;
text-align: center;
background-image: url("view/images/loading.gif");
background-position: center center;
background-repeat: no-repeat;
opacity: 0.6;

}
</style>
<script>
$(document).ready(function(){
   // alert("document0 listo");
   
});
</script>
<script>
$(window).load(function(){
//alert("document0 listo");
$("#cargando").hide();
});
</script>
</head>
<body>
<div id="cargando" >
</div>
  
</body>
</html>



   