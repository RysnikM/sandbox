$(function () {
$('.material-tooltip-main').tooltip({template: '<div class="tooltip md-tooltip"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner"></div></div>'});
});

$(function() {
 var windowWidth = $(window).width();
  var qw;

  
  if (windowWidth<745){
    $(".material-tooltip-main").each(function () {
         $(this).tooltip('enable');});
      
    }else{
     $(".material-tooltip-main").each(function () {
         $(this).tooltip('disable');      
  })};  
  
  
  
  if (windowWidth<1183){
    qw = (windowWidth-9)/7;      
  }else{
  qw=(windowWidth-9)/14;
    };
      
  console.log(windowWidth,' ',qw)
  
  $(".q").css("min-width",qw+"px");
   
});



$(window).on('resize', function(event){
    var windowWidth = $(window).width();
  var qw;

  
  if (windowWidth<745){
    $(".material-tooltip-main").each(function () {
         $(this).tooltip('enable');});
      
    }else{
     $(".material-tooltip-main").each(function () {
         $(this).tooltip('disable');      
  })};  
  
  
  
  if (windowWidth<1183){
    qw = (windowWidth-9)/7;      
  }else{
  qw=(windowWidth-9)/14;
    };
      
  console.log(windowWidth,' ',qw)
  
  $(".q").css("min-width",qw+"px");
});