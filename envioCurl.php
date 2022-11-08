<?php
//https://programacion.net/articulo/como_enviar_y_recibir_datos_json_mediante_php_curl_1885
//API URL
$nombre=$_POST['nom'];
$cred= (double)filter_var($_POST['cred'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$numcuenta=$_POST['numcuenta'];
$accion=$_POST['action']; 

//solo probando la info 
//echo $nombre."___".$cred."___".$numcuenta."___".$accion;

$url = 'http://apitransaccional-env.eba-2bgdcy6u.us-east-1.elasticbeanstalk.com/api/byId/1';

switch ($accion) {
    case '1': //credito
        $data = array(
            'accion' =>$nombre,
            'valor' => $cred,
            'numeroCuenta'=>intval($numcuenta),
            'usuarioLog' =>'carlos',
            'passLog'=>'carlos123'
        );
        break;
    case '2': //debito
        $data = array(
            'accion' =>$nombre,
            'valor' => abs($cred),
            'numeroCuenta'=>intval($numcuenta),
            'usuarioLog' =>'carlos',
            'passLog'=>'carlos123'
        );
        break;
    case '3': //historico
            $data = array( 'accion' =>'0',
            'valor' => '',
            'numeroCuenta'=>intval($numcuenta),
            'usuarioLog' =>'',
            'passLog'=>''
            );
            break;
    default:
    $data = array(
        'accion' =>$accio,// catalog/operaciones
        'monto' => $cred,
        'numeroCuenta'=>intval($numcuenta)
    );
        break;
}

//$valor="Credito,150|Debito,130|Credito,180|Debito,700";

$valor=[array(
    'tipo'=>'CREDITO',
    'cantidad'=>'1000.00',
    'numcuenta'=>$numcuenta
),
array(
    'tipo'=>'DEBITO',
    'cantidad'=>'100.00',
    'numcuenta'=>$numcuenta
)
];

print_r (json_encode( $valor));

/*

//create a new cURL resource
$ch = curl_init($url);


//$payload = json_encode(array("user" => $data));
$payload = json_encode($data);

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);

//echo "<pre>";
print_r($payload);
//echo "<br>";
var_dump($result);
//echo "</pre>";
//close cURL resource
curl_close($ch);

*/
 