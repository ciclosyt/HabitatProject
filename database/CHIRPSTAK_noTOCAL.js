function Decode(fPort, bytes, variables) {
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

    var humedaD = hum1 + hum2;
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

    var datos = { "temperatura": temp, "humedad": v_humedad, "voltaje": volt };
    return datos;
}