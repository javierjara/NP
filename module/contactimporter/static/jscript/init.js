$(document).ready(function(){
$('#sort').localScroll({
   target:'#div_list_view',
    axis:'xy',
   queue:true, //one axis at a time
   duration:300
});
});