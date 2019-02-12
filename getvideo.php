<?php
require_once dirname(__FILE__) .'/driveparser.php';

//function validating all the paramters are available
//we will pass the required parameters to this function
function isTheseParametersAvailable($params){
//assuming all parameters are available
$available = true;
$missingparams = "";

foreach($params as $param){
if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
$available = false;
$missingparams = $missingparams . ", " . $param;
}
}

//if parameters are missing
if(!$available){
$response = array();
$response['error'] = true;
$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';

//displaying error
echo json_encode($response);

//stopping further execution
die();
}
}

//an array to display response
$response = array();

//if it is an api call
//that means a get parameter named api call is set in the URL
//and with this parameter we are concluding that it is an api call
if(isset($_GET['apicall'])){

switch($_GET['apicall']){
  case 'getVideo':
  if(isset($_GET['url'])){
    $dp = new driveparser();
    if($dp->getjs($_GET['url'])){
      $response['error'] = false;
      $response['message'] = 'Successfully';
      $response['image'] = $dp->getjs($_GET['url']);
    }
    else {
      $response['error'] = true;
      $response['message'] = 'url not found';
    }
  }else{
  $response['error'] = true;
  $response['message'] = 'Nothing to Read, provide an url please';
  }
  break;




}

}
else{
//if it is not api call
//pushing appropriate values to response array
$response['error'] = true;
$response['message'] = 'Invalid API Call';
}

//displaying the response in json structure
$a2json = json_encode($response);
//echo json_encode($response);
echo $a2json;

 ?>
