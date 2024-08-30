<?php
$xml= new DOMDocument('1.0','utf8');
$xml->formatOutput=true;

$xml_fac = $xml->createElement('factura');
$cabecera = $xml->createAttribute('id');
$cabecera->value='comprobante';
$cabecerav = $xml->createAttribute('version');
$cabecerav->value='1.00';
$xml_inf = $xml->createElement('infoTributaria');
$xml_amb = $xml->createElement('ambiente','1');
$xml_tip = $xml->createElement('tipoEmision','1');
$xml_raz = $xml->createElement('razonSocial','Peluqueria S.A');
$xml_nom = $xml->createElement('nombreComercial','Peluqueria S.A');
$xml_ruc = $xml->createElement('ruc','1234567891001');

$xml_cla = $xml->createElement('claveAcceso','1122334455667788990123456789100111112345678909865');
$xml_doc = $xml->createElement('codDoc','01');
$xml_est = $xml->createElement('estab','001');
$xml_emi = $xml->createElement('ptoEmi','001');
$xml_sec = $xml->createElement('secuencial','000001234');
$xml_dir = $xml->createElement('dirMatriz','DIRECCION EMPRESA');

$xml_def = $xml->createElement('infoFactura');
$xml_fec = $xml->createElement('fechaEmision','29/08/24');
$xml_des = $xml->createElement('dirEstablecimiento','DIRECCION ESTABLECIMIENTO');
$xml_obl = $xml->createElement('obligadoContabilidad','SI');
$xml_ide = $xml->createElement('tipoIdentificacionComprador','05');
$xml_rco = $xml->createElement('razonSocialComprador','NOMBRE DEL COMPRADOR');
$xml_idc = $xml->createElement('identificacionComprador','1234567891');
$xml_tsi = $xml->createElement('totalSinImpuesto','1.00');
$xml_tds = $xml->createElement('totalDescuento','0.00');


$xml_imp = $xml->createElement('totalConImpuesto');
$xml_tim = $xml->createElement('totalImpuesto');
$xml_tco = $xml->createElement('codigo','2');
$xml_cpr = $xml->createElement('codigoPorcentaje','0');
$xml_bas = $xml->createElement('baseImponible','0');
$xml_val = $xml->createElement('valor','0');

$xml_pro = $xml->createElement('propina','0.00');
$xml_imt = $xml->createElement('importeTotal','1.00');
$xml_mon = $xml->createElement('moneda','DOLAR');

$xml_pgs = $xml->createElement('pagos');
$xml_pag = $xml->createElement('pago');
$xml_fpa = $xml->createElement('formaPagos','01');
$xml_tot = $xml->createElement('total','1.00');
$xml_pla = $xml->createElement('plazo','30');
$xml_uti = $xml->createElement('unidadTiempo','dias');


$xml_dts = $xml->createElement('detalles');
$xml_det = $xml->createElement('detalle');
$xml_cop = $xml->createElement('codigoPrincipal','PROD008');
$xml_dcr = $xml->createElement('descripcion','descripcion del producto');
$xml_can = $xml->createElement('cantidad','1');
$xml_pru = $xml->createElement('precioUnitario','1.00');
$xml_dsc = $xml->createElement('descuento','0.00');
$xml_tsm = $xml->createElement('precioTotalSinImpuesto','1.00');


$xml_ips = $xml->createElement('impuestos');
$xml_ipt = $xml->createElement('impuesto');
$xml_cdg = $xml->createElement('codigo','2');
$xml_cpt = $xml->createElement('codigoPorcentaje','2');
$xml_trf = $xml->createElement('tarifa','0.00');
$xml_bsi = $xml->createElement('baseImponible','1.00');
$xml_vlr = $xml->createElement('valor','0.00');

$xml_ifa = $xml->createElement('infoAdicional');
$xml_cp1 = $xml->createElement('campoAdicional','tucorreo@dominio.com');
$atributo = $xml->createAttribute('nombre');
$atributo->value='email';

$xml_inf->appendChild($xml_amb);
$xml_inf->appendChild($xml_tip);
$xml_inf->appendChild($xml_raz);
$xml_inf->appendChild($xml_nom);
$xml_inf->appendChild($xml_ruc);
$xml_inf->appendChild($xml_cla);
$xml_inf->appendChild($xml_doc);
$xml_inf->appendChild($xml_est);
$xml_inf->appendChild($xml_emi);
$xml_inf->appendChild($xml_sec);
$xml_inf->appendChild($xml_dir);
$xml_fac->appendChild($xml_inf);

$xml_def->appendChild($xml_fec);
$xml_def->appendChild($xml_des);
$xml_def->appendChild($xml_obl);
$xml_def->appendChild($xml_ide);
$xml_def->appendChild($xml_rco);
$xml_def->appendChild($xml_idc);
$xml_def->appendChild($xml_tsi);
$xml_def->appendChild($xml_tds);
$xml_def->appendChild($xml_imp);
$xml_def->appendChild($xml_tim);
$xml_def->appendChild($xml_tco);
$xml_def->appendChild($xml_bas);
$xml_def->appendChild($xml_val);
$xml_fac->appendChild($xml_def);


$xml_def->appendChild($xml_pro);
$xml_def->appendChild($xml_imt);
$xml_def->appendChild($xml_mon);

$xml_def->appendChild($xml_pgs);
$xml_pgs->appendChild($xml_pag);
$xml_pgs->appendChild($xml_tot);
$xml_pgs->appendChild($xml_pla);
$xml_pgs->appendChild($xml_uti);

$xml_fac->appendChild($xml_dts);
$xml_dts->appendChild($xml_det);
$xml_det->appendChild($xml_cop);
$xml_det->appendChild($xml_dcr);
$xml_det->appendChild($xml_can);
$xml_det->appendChild($xml_pru);
$xml_det->appendChild($xml_tsm);
$xml_det->appendChild($xml_ips);
$xml_ips->appendChild($xml_ipt);
$xml_ipt->appendChild($xml_cdg);
$xml_ipt->appendChild($xml_cpt);
$xml_ipt->appendChild($xml_trf);
$xml_ipt->appendChild($xml_bsi);
$xml_ipt->appendChild($xml_vlr);

$xml_fac->appendChild($xml_ifa);
$xml_ifa->appendChild($xml_cp1);
$xml_cp1->appendChild($atributo);

$xml_fac->appendChild($cabecera);
$xml_fac->appendChild($cabecerav);
$xml->appendChild($xml_fac);

echo 'CREADO: '. $xml->save('C:\AppServ\www\SistemaSRI\xml\ejemploxml.xml'). 'bytes';
?>