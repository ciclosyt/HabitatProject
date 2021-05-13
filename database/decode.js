function Decod() {
    var bytes = ['083ee132-4c90-4c46-b4cd-5a64b67494dd'];
    var a = parseInt(bytes[0]);
    var b = parseInt(bytes[1]);
    var d, e, f, w;

    w = f = parseInt(bytes[4]);
    f = parseInt(bytes[4]);
    d = parseInt(bytes[2]);
    e = parseInt(bytes[3], 16);

    a = a.toString(16);
    b = b.toString(16);
    d = d.toString(16);
    e = e.toString(16);

    if (b.length == 1) b = "0" + b;
    if (e.length == 1) e = "0" + e;

    var tem = a + b;
    tem = parseInt(tem, 16);
    tem = tem / 100;

    var hum = d + e / 2;
    hum = parseInt(hum, 16);

    hum = hum / 100;
    if (hum >= 100) hum = 100;


    var volt = w / 10;

    var datos = { "temperatura": tem, "humedad": hum, "voltaje": volt };
    return datos;
}





function Decod2() {
    var bytes = ['083ee132-4c90-4c46-b4cd-5a64b67494dd'];
    var a = parseInt(bytes[0]);
    var b = parseInt(bytes[1]);
    var d, e, f, w;

    w = parseInt(bytes[4]);
    f = parseInt(bytes[5]);
    d = parseInt(bytes[6]);
    e = parseInt(bytes[3], 16);

    var hum1 = parseInt(bytes[8]);
    var hum2 = parseInt(bytes[9]);

    hum1 = hum1.toString(16);
    hum2 = hum2.toString(16);

    a = a.toString(16);
    b = b.toString(16);

    d = d.toString(16);
    e = e.toString(16);

    if (hum1.length == 1) hum1 = "0" + hum1;
    if (hum2.length == 1) hum2 = "0" + hum2;

    var humedaD = hum1 + hum2 / 2;
    humedaD = parseInt(humedaD, 16);
    var v_humedad = humedaD / 100;


    if (b.length == 1) b = "0" + b;
    if (e.length == 1) e = "0" + e;

    var tem = a + b;
    tem = parseInt(tem, 16);
    var temp = tem / 10;

    var hum = d + e / 2;
    hum = parseInt(hum, 16);

    hum = hum / 100;
    if (hum >= 100) hum = 100;


    var volt = w / 10;
    // AQAAAAEDAAHvAWc=
    var datos = { "temperatura": temp, "humedad": v_humedad, "voltaje": volt };
    var b = new Buffer('AQAAAAEDAAHvAWc=', 'base64')
    var s = b.toString();

    alert("Hola chip");
    return datos;
}


function decodAntigua(bytes) {
    var dismantle = bytes[0];
    var temperature = bytes[1];
    var humidity = (bytes[8] << 8) | (bytes[9]);
    // Intento de sacar el nivel de bateria 
    var unalectura = (bytes[1] << 8) | (bytes[0]);

    var index5 = bytes[5];
    var index6 = bytes[6];

    var index8 = bytes[8];
    var index9 = bytes[9];

    unalectura = unalectura * 0.00203125;
    unalectura = +unalectura.toFixed(2);
    var appData = { 'dismantle': dismantle, 'temperature': temperature, 'humidity': humidity, 'Bateria_V': unalectura, 'index5': index5, 'index6': index6, 'index9': index9, 'index8': index8 };
    return appData;

}



function Decode_VERDADERO(fPort, bytes, variables) {

    // DATOS DE VOLTIS DE LA BATERIA
    var w = parseInt(bytes[4]);
    // https://laopinion.com/2019/07/12/cual-es-el-voltaje-normal-de-la-bateria-de-un-auto/
    // if (w.length == 1) {
    //     w = "0." + w;
    // }
    var volt = w / 10;

    // ========== DATOS DE TEMPERATURA =================
    var tem1 = parseInt(bytes[5]);
    var tem2 = parseInt(bytes[6]);

    var tem = tem1 + tem2;
    tem = parseInt(tem, 16);
    tem = tem / 100;

    //============ DATOS DE HUMEDAD =================
    var hum1 = parseInt(bytes[8]);
    var hum2 = parseInt(bytes[9]);

    hum1 = hum1.toString(16);
    hum2 = hum2.toString(16);

    // comproba la longitud de los caracter en caso de que la logitut 
    //sea de 1 le añade el 0 delante 

    if (hum1.length == 1) {
        hum1 = "0" + hum1;
    }
    if (hum2.length == 1) {
        hum2 = "0" + hum2;
    }

    var humedaD = hum1 + hum2 / 2;
    humedaD = parseInt(humedaD, 16);
    humedaD = humedaD / 100;

    if (humedaD >= 100) {
        humedaD = 100;
    }

    var datos = { "temperatura": temp, "humedad": humedaD, "voltaje": volt };
    return datos;
}