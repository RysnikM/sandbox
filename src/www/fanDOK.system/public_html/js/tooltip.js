$(function () {
$('.material-tooltip-main').tooltip({template: '<div class="tooltip md-tooltip"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner"></div></div>'});
});
$(function() {
 changeToolt(); 
});



$(window).on('resize', function(event){
    changeToolt();
});


function changeToolt(){
  var windowWidth = $(window).width();
  var qw;

  if ((windowWidth<570)) {
    $("#astImg").width(113);
  } else if ((windowWidth<768)&&(windowWidth>570)){
    $("#astImg").width(184);
  } else if (windowWidth>768){
    $("#astImg").width(200);
  };
  

  if ((windowWidth<983)&&(windowWidth>405)) {
    $("#tableID").height(80);
  } else if ((windowWidth<405)&&(windowWidth>0)){
    $("#tableID").height(70);
  } else if (windowWidth>983){
    $("#tableID").height(136);
  };


  
  if (windowWidth<745){
    $(".material-tooltip-main").each(function () {
         $(this).tooltip('enable');});
      
    }else{
     $(".material-tooltip-main").each(function () {
         $(this).tooltip('disable');      
  })};  
  
  if (windowWidth<365){
  qw = (windowWidth-9)/7;
  } else {
    qw = (windowWidth-9)/14;
  };      
        
  // console.log(windowWidth,' ',qw)
  
  $(".q").css("min-width",qw+"px");
  
  var maxH=0;
    
  $(".txtTl").each(function () {
         if (maxH<$(this).height()){
       maxH=$(this).height();
     }
  });
  $(".txtTl").each(function () {
         $(this).height(maxH);
  });
  if (windowWidth<1183){
    $("#StatusNetwork1").height((maxH+24));
  // console.log(maxH+24,' ',maxH)    
  };
  if (windowWidth<746){
  $("#StatusNetwork1").height(24+4);
    }; 
  
  if  (windowWidth>1183) {
    $("#StatusNetwork1").height(maxH+24);
    
  };
    
    
    if (windowWidth<=370){
        $(".sizeImg").each(function () {
         $(this).height(70);
  });
    } else if (windowWidth<=580 && windowWidth>370){
        $(".sizeImg").each(function () {
         $(this).height(160);
  });
    } else if (windowWidth<=780 && windowWidth>580){
        $(".sizeImg").each(function () {
         $(this).height(170);
  });
    } else if (windowWidth<=1000 && windowWidth>780){
        $(".sizeImg").each(function () {
         $(this).height(220);
  });
    } else if (windowWidth>1200){
        $(".sizeImg").each(function () {
         $(this).height(260);
  });
    }
}