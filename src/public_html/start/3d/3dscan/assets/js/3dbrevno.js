var chart;
var insertArr=[{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},{data:[1,1,1]},];

$("#delete").click(function(){
for (var i=chart.series.length-1; i>=0;i--){
    chart.series[i].remove(false);}
    chart.redraw();
   })

var en=en1=false;

function drawWood(){
    var z=0;
var lk=0;
var cl=0;



          //  oneSech.push(oneSech[0]);
           for(var g=0; g<len; g++){

            	data[cl].push(data[cl][0]);
	var intSech=data[cl];
z +=1;
for (var i = 0; i <intSech.length; i++) {
	intSech[i].unshift(z);
}
cl++;
insertArr=intSech;
	//добавление одного коляца сечения
chart.addSeries({
				color:'brown',
				marker:{enabled:false},
				lineWidth: 1,
				type:'scatter3d',
				data:insertArr
				},true,true);
}
}

	$(function () {



    // Set up the chart
   chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
           
            type: 'scatter3d',
            options3d: {
                enabled: true,
                alpha: 5,
                beta: 20,
                depth: 600,
                viewDistance: 5,

                frame: {
                    bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
                    back: { size: 1, color: 'rgba(0,0,0,0.04)' },
                    side: { size: 1, color: 'rgba(0,0,0,0.06)' }
                }
            },
            
        },
        
            credits: {
        enabled: false
    },
        title: {
            text: '3D сканер'
        },
        subtitle: {
            text: 'в окне отображается последнее отсканированное бревно'
        },
        plotOptions: {
            scatter3d: {
            	grouping:false,
                width: 400,
                height: 400,
                depth: 400
            }
        },
        yAxis: {
        	gridLineWidth: 0,
        	labels:{ enabled:false},
            // tickInterval: 5,
        	alignTicks:false,
             // min: 0,
            // max: 300,
            title: null,
            visible:false,
        },
        xAxis: {
        	gridLineWidth: 0,
        	alignTicks:false,
            // tickInterval: 5,
        	labels:{ enabled:false},
             // min: 0,
             // max: 40,
            
        },
        zAxis: {
        	gridLineWidth: 0,
        	labels:{ enabled:false},
            // tickInterval: 5,
        	alignTicks:false,
             // min: 0,
            // max: 50
        },
        legend: {
            enabled: false
        },
    });


		
		
    // Add mouse events for rotation
    $(chart.container).bind('mousedown.hc touchstart.hc', function (e) {
        e = chart.pointer.normalize(e);

        var posX = e.pageX,
            posY = e.pageY,
            alpha = chart.options.chart.options3d.alpha,
            beta = chart.options.chart.options3d.beta,
            newAlpha,
            newBeta,
            sensitivity = 30; // lower is more sensitive

        $(document).bind({
            'mousemove.hc touchdrag.hc': function (e) {
                // Run beta
                newBeta = beta + (posX - e.pageX) / sensitivity;
                newBeta = Math.min(100, Math.max(-100, newBeta));
                chart.options.chart.options3d.beta = newBeta;

                // Run alpha
                newAlpha = alpha + (e.pageY - posY) / sensitivity;
                newAlpha = Math.min(100, Math.max(-100, newAlpha));
                chart.options.chart.options3d.alpha = newAlpha;

                chart.redraw(false);
            },
            'mouseup touchend': function () {
                $(document).unbind('.hc');
            }
        });
    });

});
var z1=0;
function DrawBrevno(R,Ax,By){
    
    
    var insertArr=[];   
    z1+=5;
    for (var i=0; i<2*Math.PI;i=i+Math.PI/32){
        
        insertArr.push([z1,(R*Math.cos(i))+parseFloat(Ax),(R*Math.sin(i))+parseFloat(By)]);
    }

     // console.log(insertArr);
     chart.addSeries({
                color:'brown',
                marker:{enabled:false},
                lineWidth: 1,
                type:'scatter3d',
                data:insertArr
                },true,true);
}   
    