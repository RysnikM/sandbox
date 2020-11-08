    var clAlarmLvl="#ef5350";
  var clStopLvl="#FF7043";
  var clWarningLvl="#FFCA28";
  var clGoodLvl="#66BB6A";

 
 var valLevelArr=[[[1500,3000,4566],[1500,3000,4566],[1500,3000,4566]],[[1500,3000,4566],[1500,3000,4566]]];
  
  moment.locale("ru");
  Highcharts.setOptions({
            lang: {
                loading: 'Загрузка...',
                months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
                shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек']
            }
          });
	

  var time=+ new Date();
  var commonArr=new Array();
  var commonArr1=new Array();
  var commonArr2=new Array();//симмулируем 3 узла одного станка
  var commonArr3=new Array();
  var commonArr4=new Array();
  var commonArr5=new Array();
  var stanokArr=['станок 1','станок 2'];
  var nameArr= [["узел 1","узел 2","узел3"],["узел 1","узел 2"]];
  var levelArr=["норма","предупреждение","авария"];
  var colorArr=[clGoodLvl,clWarningLvl,clAlarmLvl];
  var numberItter=50;
  var period=60000*60;//миллисекунды
  
  for (var i = 0; i <= numberItter; i++) {
    val=Math.floor(Math.random() * 10000);
    commonArr1.push({x:time,y:val});
    val=Math.floor(Math.random() * 10000);
    commonArr2.push({x:time,y:val});
    val=Math.floor(Math.random() * 10000);
    commonArr3.push({x:time,y:val});
    val=Math.floor(Math.random() * 10000);
    commonArr4.push({x:time,y:val});
    val=Math.floor(Math.random() * 10000);
    commonArr5.push({x:time,y:val});
    time=+time+period;
  };

function SortingTreeArray(comAr){//в функцию передаются общийй массив
  
  // var comAr={};
  // comAr[stanokArr[0]]=[comAr1,comAr2,comAr3];
  // comAr[stanokArr[1]]=[comAr4,comAr5];


  var finishArr=[];
  var PrNormArr=[];
  var PrWarnArr=[];
  var PrStopArr=[];
  var PrAlarmArr=[];

  for (var i = 0; i < stanokArr.length; i++) {
    PrNormArr[stanokArr[i]]=[];
    PrWarnArr[stanokArr[i]]=[];
    PrStopArr[stanokArr[i]]=[];
    PrAlarmArr[stanokArr[i]]=[];
    finishArr[stanokArr[i]]=[];
    for (var j = 0; j < nameArr[i].length; j++) {
      finishArr[stanokArr[i]][nameArr[i][j]]=[];
    }
  }

  

  
//делаем выборку по станку
    for (var k = 0; k < stanokArr.length; k++) {
 

//делаем выборку по узлу
for (var i = 0; i <comAr[stanokArr[k]].length; i++) {
   var nmStanok=comAr[stanokArr[k]];//текущий массив с данными конкретного станка
   var vlPoint=valLevelArr[k];//текущий массив узлов для конкртного станка
var nAR=[];
var wAr=[];
var alAr=[];
var stAr=[]; 
//ссортируем данные одного узла
    for (var j = 0; j < nmStanok[i].length ; j++) {




      if (nmStanok[i][j].y<=vlPoint[i][0]){//сравнение с нормой
    nAR.push(nmStanok[i][j]);
  }
  else if (nmStanok[i][j].y>vlPoint[i][0] && nmStanok[i][j].y<=vlPoint[i][1]){//сравнение с предупреждением
    wAr.push(nmStanok[i][j]);
  }
else if (nmStanok[i][j].y>vlPoint[i][1] && nmStanok[i][j].y<=vlPoint[i][2]){//сравнение с остановом
    stAr.push(nmStanok[i][j]);
  }
  else{
    alAr.push(nmStanok[i][j]);//остальное авария
  }
    }

    if (nAR.length!=0) {
       PrNormArr[stanokArr[k]].push(nAR);
     } else {PrNormArr[stanokArr[k]].push(0);}

 if (wAr.length!=0) {
       PrWarnArr[stanokArr[k]].push(wAr);
     } else {PrWarnArr[stanokArr[k]].push(0);}

  if (alAr.length!=0) {
        PrStopArr[stanokArr[k]].push(alAr);
     } else {PrStopArr[stanokArr[k]].push(0);}

if (stAr.length!=0) {
         PrAlarmArr[stanokArr[k]].push(stAr);
     } else {PrAlarmArr[stanokArr[k]].push(0);}

}
}

//создаем итоговый массив который будем подставлять
for (var h = 0; h < stanokArr.length; h++) {

 var ArrNormalPoint = PrNormArr[stanokArr[h]];
 var ArrWarningPoint = PrWarnArr[stanokArr[h]];
var ArrStopPoint = PrStopArr[stanokArr[h]];
var ArrAlarmPoint = PrAlarmArr[stanokArr[h]];

for (var i = 0; i < nameArr[h].length; i++) {
    
      if (ArrNormalPoint[h]!=0){
      finishArr[stanokArr[h]][nameArr[h][i]].push({name:nameArr[h][i]+' '+levelArr[0],color:colorArr[0],data:ArrNormalPoint[i]});
    } 
 
      if (ArrWarningPoint[h]!=0){
      finishArr[stanokArr[h]][nameArr[h][i]].push({name:nameArr[h][i]+' '+levelArr[1],color:colorArr[1],data:ArrWarningPoint[i]});
      } 
      if (ArrStopPoint[h]!=0){
      finishArr[stanokArr[h]][nameArr[h][i]].push({name:nameArr[h][i]+' '+levelArr[2],color:colorArr[2],data:ArrStopPoint[i]});
      } 
      if (ArrAlarmPoint[h]!=0){
      finishArr[stanokArr[h]][nameArr[h][i]].push({name:nameArr[h][i]+' '+levelArr[3],color:colorArr[3],data:ArrAlarmPoint[i]});
      } 



    }

}


return finishArr;
};



function DrawGraph(){

var arrGraphData=SortingTreeArray(commonArr);

var insertId='otchetTableLost';

for (var i = 0; i < stanokArr.length; i++) {
var NameStanok=stanokArr[i];   
for (var j = 0; j <nameArr[i].length; j++) {
var NamePoint=nameArr[i][j]; 

$("#"+insertId).after('<div class="col-12" id="container'+[i]+[j]+'"></div>');

var ch=Highcharts.chart('container'+[i]+[j]+'', {
      chart: {      
        type: 'column',
        panning: true,
        animation: false,
        resetZoomButton: {
        theme: {
            display: 'none'
        },
       },
      },
    plotOptions: {
        column: {
          grouping:false,
            groupPadding: 0,
         // stacking: 'normal',
        pointPadding: 0,
        pointRange :  period,
        pointPlacement: 'between',
        }
    },
    mapNavigation: {
                enableMouseWheelZoom: true
            },
            credits: {
        enabled: false
    },
      series: arrGraphData[NameStanok][NamePoint],

      legend: {
        itemDistance: 50
        },
       boost: {
        useGPUTranslations: true
    },

      tooltip: {
        shared: true,
        backgroundColor: 'white',
    borderWidth: 3,
    borderRadius: 4,
        useHTML: true,
        
      },

      xAxis: {
        
        type: 'datetime',
      },
      yAxis: {
        min:0,
        opposite:false,
        title: {
            text: 'вибрации, Гц'
        },
        gridLineColor: '#ffffff',
        
    },
      title: {
        text: 'Средний уровень вибрации за выбранный период, '+NameStanok+' '+NamePoint,
        style: {
                font: '22px Arial, sans-serif'
            }
    },
    });




insertId="container"+[i]+[j]+'';
 } 
}



}


