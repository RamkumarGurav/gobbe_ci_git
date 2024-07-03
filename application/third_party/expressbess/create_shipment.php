<?
require 'auth2.php';


$jsonData = '{
    "order_number": "#001",
    "shipping_charges": 40,
    "discount": 100,
    "cod_charges": 30,
    "payment_type": "cod",
    "order_amount": 1000,
    "package_weight": 300,
    "package_length": 10,
    "package_breadth": 10,
    "package_height": 10,
    "request_auto_pickup": "yes",
    "consignee": {
        "name": "Customer Name",
        "address": "190, ABC Road",
        "address_2": "Near Bus Stand",
        "city": "Mumbai",
        "state": "Maharashtra",
        "pincode": "400001",
        "phone": "9999999999"
    },
    "pickup": {
        "warehouse_name": "warehouse 1",
        "name": "Nitish Kumar",
        "address": "140, MG Road",
        "address_2": "Near metro station",
        "city": "Gurgaon",
        "state": "Haryana",
        "pincode": "122001",
        "phone": "9999999999"
    },
    "order_items": [{
        "name": "product 1",
        "qty": "18",
        "price": "100",
        "sku": "sku001"
    }],
    "courier_id": "1",
    "collectable_amount": "100"
}';

$arrayData =  $post_json_data = json_encode($jsonData, true);

$url = 'https://shipment.xpressbees.com/api/shipments2';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    "Authorization: Bearer $token"
  )
);

$result = curl_exec($ch);
$result = json_decode($result);
print_r($result);
die;
?>
