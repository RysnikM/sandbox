const node_modbus = require('node-modbus')
 const fs = require("fs");

  

global.user;
global.id;

global.Register;
global.coilsDI;
global.coilsDO;
global.coils;
global.coils2;
global.errorfs;


/// MODBUS TCP
global.paramTCP;
// global.opros = function(){
// fs.readFile("modbustcp.json", "utf8", 
//             function(error,data){
//                 console.log("Асинхронное чтение файла");
//                 if(error) {global.errorfs = error;} // если возникла ошибка
//                  global.paramTCP = JSON.parse(data);
//                  global.time_interval = global.paramTCP.delta;

// global.client = node_modbus.client.tcp.complete({
//     'host': global.paramTCP.host, /* IP or name of server host */
//     'port': global.paramTCP.port, /* well known Modbus port */
//     'unitId': global.paramTCP.id, 
//     'timeout': global.paramTCP.timeout, /* 2 sec */
//     'autoReconnect': true,  reconnect on connection is lost 
//     'reconnectTimeout': 15000, /* wait 15 sec if auto reconnect fails to often */
//     'logLabel' : 'ModbusClientTCP', /* label to identify in log files */
//     'logLevel': 'debug', /* for less log use: info, warn or error */
//     'logEnabled': true
// })

// global.client.connect();
//  global.modbusRequests3 =  setInterval( function () {
//   global.client.readHoldingRegisters(51, 0).then((response) => global.Register = response)
//     }, 1000);
// // global.client2.connect();
// //global.readRegister(global.client,50,2,global.paramTCP.delta); 
//  //global.readCoils(global.client,0,16,global.paramTCP.delta); 
// // global.readCoils2(global.client2,0,16,global.paramTCP.delta2);     
// });
// }

//global.opros();
								 /* reading coils every second */
global.readRegister = function(client,start,sdvig,time_interval){
	client.on('connect', function () {
 global.modbusRequests3 =  setInterval( function () {
	client.readHoldingRegisters(start, sdvig).then((response) => global.Register = response)
	  }, time_interval);
})
}


global.readCoils = function(client,start,sdvig,time_interval){
	client.on('connect', function () {
 global.modbusRequests1 =  setInterval( function () {
	client.readCoils(start, sdvig).then(function(response) { global.coilsDI =  response})
	  }, time_interval);
})
}
global.readCoils2 = function(client,start,sdvig,time_interval){
	client.on('connect', function () {
 global.modbusRequests2 =  setInterval( function () {
	client.readCoils(start, sdvig).then(function(response) { global.coilsDO =  response.coils})
	  }, time_interval);
})
}


 global.writeRegister= function (reg,val){
   global.client.writeSingleRegister(reg, val).then(function (resp) {
    console.log(resp);
  }).catch(function (err) {
    console.log(err);
  })
}

global.writeCoil = function(coil,val){
  global.client.writeSingleCoil(coil, val).then(function (resp) {
    console.log(resp)
  }).catch(function (err) {
    console.log(err)
  })
}

global.WriteMultiCoil = function(start,arr=[]){
  global.client.writeMultipleCoils(start, arr).then(function (resp) {
    console.log(resp)
  }).catch(function (err) {
    console.log(err)
  })
}




// function readerr(err){
// var json = JSON. stringify(err);
// document.getElementById('res').innerHTML=json;
// }




  nw.Window.open('index.html', {}, function(win) {
	//win.showDevTools();
	//win.maximize();

});



