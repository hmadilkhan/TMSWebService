<?php
require 'lib/nusoap.php';

require 'function.php';

$server = new nusoap_server();

$server->configureWSDL('server', 'urn:server');


  // get login
  $server->register('login',
         array('username' => 'xsd:string','password' => 'xsd:string','serial' => 'xsd:string','terminal' => 'xsd:int'),   // parameter
         array('return' => 'xsd:string'),     // output
         'urn:server',                        // namespace
         'urn:server#loginServer');                   // description

    

// Use the request to invoke the service
$server->service(file_get_contents("php://input"));
