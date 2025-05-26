<?php
// payu_redirect.php

// Credenciales PayU (usa las de tu cuenta, aquí son de ejemplo sandbox)
$merchantId = "500238";
$apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
$accountId = "500538";
$apiLogin = "6u5e2t4d1d8lj3fdn7k7g7tl7q";
$payuUrl = "https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/";

// Datos recibidos (puedes obtenerlos por POST desde pagar.html)
$referenceCode = "ORDER-" . rand(1000, 9999); // referencia única
$amount = $_POST['amount']; // total a pagar, ej: 100.00
$currency = "COP"; // moneda

// Datos comprador
$buyerName = $_POST['nombre'];
$buyerEmail = $_POST['email']; // agrega campo email en el formulario si quieres

// Calcula la firma (signature)
$signatureString = "$apiKey~$merchantId~$referenceCode~$amount~$currency";
$signature = md5($signatureString);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Redireccionando a PayU...</title>
</head>
<body>
    <form id="payu_form" method="post" action="<?php echo $payuUrl; ?>">
        <input name="merchantId" type="hidden" value="<?php echo $merchantId; ?>" />
        <input name="accountId" type="hidden" value="<?php echo $accountId; ?>" />
        <input name="description" type="hidden" value="Compra en DronExpress" />
        <input name="referenceCode" type="hidden" value="<?php echo $referenceCode; ?>" />
        <input name="amount" type="hidden" value="<?php echo $amount; ?>" />
        <input name="tax" type="hidden" value="0" />
        <input name="taxReturnBase" type="hidden" value="0" />
        <input name="currency" type="hidden" value="<?php echo $currency; ?>" />
        <input name="signature" type="hidden" value="<?php echo $signature; ?>" />
        <input name="buyerFullName" type="hidden" value="<?php echo htmlspecialchars($buyerName); ?>" />
        <input name="buyerEmail" type="hidden" value="<?php echo htmlspecialchars($buyerEmail); ?>" />
        <input name="responseUrl" type="hidden" value="http://tu-sitio.com/respuesta.php" />
        <input name="confirmationUrl" type="hidden" value="http://tu-sitio.com/confirmacion.php" />
        <input type="submit" value="Pagar ahora" />
    </form>
    <script>document.getElementById('payu_form').submit();</script>
</body>
</html>
