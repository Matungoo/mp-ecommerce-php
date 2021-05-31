<?php
require_once 'vendor/autoload.php'; 

// Dominio Base
$dominio = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null ;
$dominio = "http://".$dominio;

// Credenciales
// Public Key: TEST-667354d7-fc8d-47c6-82b0-b315e448b6d6
// Access Token: TEST-1206668190429489-112115-bcb9f9fcb87c419c6fbe5a6e0144bcc4__LD_LB__-53342228
MercadoPago\SDK::setAccessToken("TEST-1206668190429489-112115-bcb9f9fcb87c419c6fbe5a6e0144bcc4__LD_LB__-53342228"); // Either Production or SandBox AccessToken

// Crea un objeto de pago
$payment = new MercadoPago\Payment();

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();


// Crea un objeto Item con la información enviada desde detail.php
$item = new MercadoPago\Item();

$item->id = "1234";
$item->title = $_POST['title'];
$item->description = "Dispositivo móvil de Tienda e-commerce";
$item->category_id = "Celulares";
$item->quantity = 1;
$item->currency_id = "ARS";
$item->unit_price = $_POST['price'];


$preference->items = array($item);
$preference->save();


// Datos del pagador:
// a) Nombre y Apellido: Lalo Landa
// b) DNI (Número de Identificación): 22334445
// c) Email: El email del test-user pagador entregado en este documento.
// d) Código de área: 52
// e) Teléfono: 5549737300
// Datos de la dirección del pagador:
// a) Nombre de la calle: Insurgentes Sur
// b) Número de la casa: 1602
// c) Código postal: 03940
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_46542185@testuser.com";
$payer->date_created = "2018-06-02T12:58:41.425-04:00";
$payer->phone = array(
    "area_code" => "",
    "number" => "52 5549737300"
);
$payer->identification = array(
    "type" => "DNI",
    "number" => "12345678"
);
$payer->address = array(
    "street_name" => "Insurgentes Sur",
    "street_number" => 1602,
    "zip_code" => "03940"
);



// Url de notificación
$preference->notification_url = $dominio."/notification.php";

// Páginas de retorno (back_url)
$preference->back_urls = array(
    "success" => $dominio . "/success",
    "failure" => $dominio . "/failure",
    "pending" => $dominio . "/pending"
);
$preference->auto_return = "approved";



$payment->save();
echo $payment->status;

?>

<!-- botón de pago que realizaste en la integración básica  -->
<a href="<?php echo $preference->init_point; ?>">Pagar con Mercado Pago</a>

