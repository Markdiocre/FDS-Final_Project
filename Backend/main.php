<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, Authorization");
header("Access-Control-Max-Age: 86400");

date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

$rootPath = $_SERVER["DOCUMENT_ROOT"];
$apiPath = $rootPath . "/Olympus/Backend";

require_once($apiPath . '/configs/Connection.php');

require_once($apiPath . '/model/Global.model.php');
require_once($apiPath . '/model/Admin.model.php');
require_once($apiPath . '/model/Auth.model.php');
require_once($apiPath . '/model/Member.model.php');

$db = new ConnectionFinProj();
$pdo = $db->connect();

$rm = new ResponseMethodsProj();
$adminCon = new adminControls($pdo, $rm);
$auth = new Auth($pdo, $rm);
$member = new member($pdo, $rm);

$data = json_decode(file_get_contents("php://input"));

if (json_last_error() !== JSON_ERROR_NONE) {
    $error_code = json_last_error();
    $error_message = json_last_error_msg();

    // Additional error descriptionsl
    $error_details = [
        JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
        JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
        JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON.',
        JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
        JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
        JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
        JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
        JSON_ERROR_INVALID_PROPERTY_NAME => 'A property name that cannot be encoded was given.',
        JSON_ERROR_UTF16 => 'Malformed UTF-16 characters, possibly incorrectly encoded.'
    ];

    // Prepare the detailed error response
    echo json_encode([
        'status' => 'error',
        'error_code' => $error_code,
        'message' => $error_message,
        'details' => isset($error_details[$error_code]) ? $error_details[$error_code] : 'Unknown error'
    ]);
    return;
}


if (empty($data)) {
    echo json_encode(['status' => 'error', 'message' => 'No data received.']);
    return;
}

$req = [];
if (isset($_REQUEST['request']))
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
else $req = array("errorcatcher");

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($req[0] == 'Get') {
            $tokenRes = $auth->verifyToken('admin');
            if ($tokenRes['is_valid'] !== true) {
                if ($req[1] == 'One') {echo json_encode($adminCon->getOneAcc($data));return;}
                if ($req[1] == 'All') {echo json_encode($adminCon->getAllAcc());return;}
            }
        }

        if ($req[0] == 'Member') {
            $tokenResMem = $auth->verifyToken('member');
            if ($tokenResMem['is_valid'] !== true) {
                if ($req[1] == 'ViewInfo') {echo json_encode($member->viewInfo());return;}
            }
        }

        if ($req[0] == 'VerifyToken') {
            $tokenRes = $auth->verifyToken(); 
            echo json_encode($tokenRes);
            return;
        }

        $rm->notFound();
        break;

    case 'POST':
        if ($req[0] == 'Create') {echo json_encode($adminCon->createAcc($data));return;}
        if ($req[0] == 'Create' && $req[1] == 'Coach') {echo json_encode($adminCon->coachCreate($data));return;}
        if ($req[0] == 'Create' && $req[1] == 'Admin') {echo json_encode($auth->adminReg($data));return;}

        if ($req[0] == 'Login') {
            if ($req[1] == 'Admin'){echo json_encode($auth->adminLogin($data));return;}
            if ($req[1] == 'Member'){echo json_encode($auth->memLogin($data));return;}
            if ($req[1] == 'coach'){echo json_encode($auth->coachLogin($data));return;}
        }
        
        if ($req[0] == 'logout') {echo json_encode($auth->logout());return;}

        $rm->notFound();
        break;

    case 'PUT':
        if ($req[0] == 'UpdateStat') {
            echo json_encode($adminCon->archStat($data));
            return;
        }

        if ($req[0] == 'Member') {
            $tokenResMem = $auth->verifyToken('member');
            if ($tokenResMem['is_valid'] !== true) {
                if ($req[1] == 'UpdateInfo') {echo json_encode($member->editInfo($data));return;}
            }
        }
        break;

    case 'DELETE':
        if ($req[0] == 'Delete') {echo json_encode($adminCon->delAcc($data));return;}
        break;

    default:
        $rm->notFound();
        break;
}
