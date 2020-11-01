  var clBadOEE="#ef5350";
  var clNormOEE="#42A5F5";
  var clGoodOEE="#66BB6A";
  var valBadOee=40;
  var valNormOee=70;

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
  var stanokArr=['станок 1','станок 2'];

  var commonArr=new Array();
 
  // for (var i = 0; i < stanokArr.length; i++) {
  //   commonArr[stanokArr[i]]=[];
  // }
  
 //  var numberItter=50;
   var period=600000;//миллисекунды
 //  for (var j = 0; j < stanokArr.length; j++) {
 //  for (var i = 0; i <= numberItter; i++) {
  
 // var   val=Math.floor(Math.random() * 101);
 //    commonArr[stanokArr[j]].push({x:time,y:val});
 //  }
 //    time=+time+period;
 //  };


function SortingTreeArray(comAr){//в функцию передаются общийй массив

var BadArrOee=new Array();
  var NormArrOee=new Array();
  var GoodArrOee=new Array();
  var FinishArr=new Array();
  for (var i = 0; i < stanokArr.length; i++) {
BadArrOee[stanokArr[i]]=[];
NormArrOee[stanokArr[i]]=[];
GoodArrOee[stanokArr[i]]=[];
FinishArr[stanokArr[i]]=[];
  }
for (var j = 0; j < stanokArr.length; j++) {
  var len=comAr[stanokArr[j]].length;
for (var i = 0; i <len; i++) {
  var CurrVal=comAr[stanokArr[j]][i];
  if (CurrVal.y<=valBadOee){
    BadArrOee[stanokArr[j]].push(CurrVal);
  }
  else if (CurrVal.y>valBadOee && CurrVal.y<=valNormOee){
    NormArrOee[stanokArr[j]].push(CurrVal);
  }
  else{
    GoodArrOee[stanokArr[j]].push(CurrVal);
  }
}

}

for (var j = 0; j < stanokArr.length; j++) {
//создаем итоговый массив который будем подставлять
if (BadArrOee[stanokArr[j]].length!=0){
  FinishArr[stanokArr[j]].push({name:'Низкий уровень',color:clBadOEE,data:BadArrOee[stanokArr[j]]});
};
if (NormArrOee[stanokArr[j]].length!=0){
  FinishArr[stanokArr[j]].push({name:'Средний уровень',color:clNormOEE,data:NormArrOee[stanokArr[j]]});
};
if (GoodArrOee[stanokArr[j]].length!=0){
  FinishArr[stanokArr[j]].push({name:'Высокий уровень',color:clGoodOEE,data:GoodArrOee[stanokArr[j]]});
};
}

return FinishArr;
};

var chPr=[],circle=[],ch=[];

function DrawGraph(){



var arrGraphData=SortingTreeArray(commonArr);

var insertId='otchetTableLost';




for (var i = 0; i < stanokArr.length; i++) {
var NameStanok=stanokArr[i];  
$("#"+insertId).after('<div class="col-12" id="container'+[i]+'"></div>');
var maxznach=0;
     $.each(commonArr[NameStanok],function(a1,b1){
  
      if(maxznach==0){
        maxznach=b1.y;
      }else{
        if(maxznach<b1.y){
          maxznach=b1.y;
        }
      }

     });

 ch[i]=Highcharts.chart('container'+[i]+'', {
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
         
        pointPadding: 0,
        pointRange :  period,
        pointPlacement: 'between',
        }
    },
    // mapNavigation: {
    //             enableMouseWheelZoom: true
    //         },
    //         credits: {
    //     enabled: false
    // },
      series: arrGraphData[stanokArr[i]],

      legend: {
        itemDistance: 50
        },
       boost: {
        useGPUTranslations: true
    },

      tooltip: {
        backgroundColor: 'white',
    borderWidth: 3,
    borderRadius: 4,
        useHTML: true,
        formatter: function () {
            return '<div class="container"><div class="row"><div class="col-12"><h3 class="text-center" style="color:'+this.color+';">ОЕЕ:'+this.y+' %</h3></div><div class="col-12 d-flex justify-content-center align-items-center"><span style="font-size:16px;">C '+moment(this.x).format('lll')+'</span></div><div class="col-12 d-flex justify-content-center align-content-center"><span style="font-size:16px;">по '+moment(this.x+period).format('lll')+'</span></div></div></div>';
        },
      },

      xAxis: {
        
        type: 'datetime',
      },
      yAxis: {
        min:0,
        max:maxznach,
      opposite:false,
        title: {
            text: 'ОЕЕ, %'
        },
        gridLineColor: '#ffffff',
        
    },
      title: {
        text: 'OEE за выбранный период, '+stanokArr[i]+'',
        style: {
                font: '22px Arial, sans-serif'
            }
    },
    });
insertId="container"+[i]+'';
}}

var sw=0;

function DrawProstoi(cat,data,name,i){
  console.log(cat);
 chPr[i] =  Highcharts.chart('prostoidr'+[i], {
    chart: {
        type: 'column'
    },
    title: {
        text: name
    },
    subtitle: {
        text: 'Процент по простоям от общего времени работы'
    },
    xAxis: {
        categories: cat,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ' %'
        }
    },
    credits: {
      enabled: false
  },
  legend: {
        enabled: false,
        borderWidth: 0
    },
    tooltip: {
        
        pointFormat: '{point.y:.1f} %',
      },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        
        data: data

    }]
});
}


function DrowCircle(name,data,i){
 circle[i]= Highcharts.chart('prostoicircle'+[i], {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: name
    },
       subtitle: {
        text: 'Соотношение процентов простоев'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: data
    }]
});
}