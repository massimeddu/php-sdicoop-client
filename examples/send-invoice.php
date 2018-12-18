<?php

ini_set("soap.wsdl_cache_enabled", 0);
ini_set('soap.wsdl_cache_ttl', 0);

use \Taocomp\Einvoicing\Sdicoop\TestSdiRiceviFile;
use \Taocomp\Einvoicing\Sdicoop\FileSdIBase;
use \Taocomp\Einvoicing\Sdicoop\RispostaSdIRiceviFile;

try
{
    require_once(__DIR__ . '/../autoload.php');

    $client = new TestSdiRiceviFile(array(
        'key'     => __DIR__ . '/../assets/key/client.key',
        'cert'    => __DIR__ . '/../assets/certs/client.pem',
        'ca_cert' => __DIR__ . '/../assets/certs/ca.pem'
    ));
    
    $fileSdI = new FileSdIBase();
    $fileSdI->load(__DIR__ . '/invoice.xml');
    $response = new RispostaSdIRiceviFile($client->RiceviFile($fileSdI));

    // Process response:
    // -----------------------------------------
    // $id       = $response->IdentificativoSdI;
    // $datetime = $response->DataOraRicezione;
    // $error    = $response->Errore;
    // -----------------------------------------
}
catch (\Exception $e)
{
    TestSdiRiceviFile::log($e->getMessage(), LOG_ERR);
}
