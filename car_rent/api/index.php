<?php
header("Content-type: application/json; charset=utf-8");
require_once('../lib/config.php');
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        get_handler();
        break;
    case 'POST':
        post_handler();
        break;
    case 'PUT':
        put_handler();
        break;
    case 'DELETE':
        delete_handler();
        break;
    default:
        error(400, "Unknown request method");
        break;
}

function get_handler()
{
    $sql = new SQL();
    $table = 'cars';
    if (isset($_GET['table']))
        $table = $_GET['table'];
    if ($table == 'cars') {
        if (isset($_GET['license_plate'])) {
            $q = 'SELECT 
                    `car`.`license_plate` AS "LicensePlate",
                    `car`.`make` AS "Make",
                    `car`.`model` AS "Model", 
                    `car`.`kw` AS "KW", 
                    `car`.`ccm` AS "CCM", 
                    `car`.`km` AS "KM", 
                    `car`.`transmission` AS "Transmission", 
                    `car`.`category` AS "Category",
                    `car`.`type` AS "Type",
                    `car`.`status` AS "Status",
                    `car`.`price_per_hour` AS "PricePerHour", 
                    `car`.`price_per_km` AS "PricePerKm"
                FROM `car` 
                WHERE `car`.`license_plate`=?';
            out($sql->execute($q, $_GET['license_plate']));
        } else {
            $q = 'SELECT 
                `car`.`license_plate` AS "LicensePlate",
                `car`.`make` AS "Make",
                `car`.`model` AS "Model", 
                `car`.`kw` AS "KW", 
                `car`.`ccm` AS "CCM", 
                `car`.`km` AS "KM", 
                `car`.`transmission` AS "Transmission", 
                `car`.`category` AS "Category",
                `car`.`type` AS "Type",
                `car`.`status` AS "Status",
                `car`.`price_per_hour` AS "PricePerHour", 
                `car`.`price_per_km` AS "PricePerKm"
             FROM `car` 
             WHERE 1
            ORDER BY `car`.`license_plate` ASC LIMIT ?, ?';
            $f = 0;
            $l = 25;
            if (isset($_GET['f'])) {
                $f = $_GET['f'];
            }
            if (isset($_GET['l'])) {
                $l = $_GET['l'];
            }
    
            out($sql->execute($q, $f, $l));
        }
    } else if ($table == 'categories') {
        $q = 'SELECT * FROM `category`';
        $result = $sql->execute($q);
        out($result);
    } else if ($table == 'type') {
        $q = 'SELECT * FROM `type`';
        $result = $sql->execute($q);
        out($result);
    } else {
        error(400, "Table name unrecognised");
    }
}

function post_handler()
{
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $sql = new SQL();
    if (!isset(getallheaders()['car_rent_token'])) {
        error(400, 'Request does not contains token');
        return false;
    } else {
        $result = $sql->execute('SELECT * FROM `user` WHERE `token`=?', getallheaders()['car_rent_token']);
        $u_id = $result[0]['id'];
        if ($sql->count == 0) {
            error(403, 'API-Token not found');
            return false;
        }
        if ($result[0]['auth'] < 2) {
            error(403, 'This user does not have permission to add cars.');
            return false;
        }
        var_dump($data);
        var_dump($_POST);
        $sql->execute('INSERT INTO `car` (`license_plate`, `make`, `model`, `kw`, `ccm`, `km`, `transmission`, `price_per_hour`, `price_per_km`, `category`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data['LicensePlate'], $data['Make'], $data['Model'], $data['KW'], $data['CCM'], $data['KM'], $data['Transmission'] ? 1 : 0, $data['PricePerHour'], $data['PricePerKm'], $data['Category'], $data['Type']);
        if (($sql->stmtError == 'Zero rows') && empty($sql->conError))
            out(['status' => 'OK']);
        else {
            error(500, 'SQL Error');
            out(['status' => 'SQL_ERROR', 'stmt' => $sql->stmtError, 'con' => $sql->conError]);
            return false;
        }
    }
}

function put_handler()
{
    $data = json_decode(file_get_contents('php://input'), TRUE);
    var_dump($data);
    $sql = new SQL();
    if (!isset(getallheaders()['car_rent_token'])) {
        error(400, 'Request does not contains token');
        return false;
    }
    $result = $sql->execute('SELECT * FROM `user` WHERE `token`=?', getallheaders()['car_rent_token']);
    $u_id = $result[0]['id'];
    if ($sql->count == 0) {
        error(403, 'API-Token not found');
        return false;
    }
    if ($result[0]['auth'] < 2) {
        error(403, 'This user does not have permission to modify cars.');
        return false;
    }
    $check = check_rq_body($data, ['LicensePlate', 'Make', 'Model', 'KW', 'CCM', 'KM', 'Transmission', 'PricePerHour', 'PricePerKm', 'Category', 'Type', 'Status']);
    if ($check === true) {
        $q = 'UPDATE `car` SET `license_plate`=?,`make`=?,`model`=?,`kw`=?,`ccm`=?,`km`=?,`transmission`=?,`price_per_hour`=?,`price_per_km`=?,`category`=?,`type`=?,`status`=? WHERE `license_plate`=?';
        $result = $sql->execute($q, $data['LicensePlate'], $data['Make'], $data['Model'], $data['KW'], $data['CCM'], $data['KM'], $data['Transmission'] === true ? '1' : '0', $data['PricePerHour'], $data['PricePerKm'], $data['Category'], $data['Type'], $data['Status'], getallheaders()['old_license']);
        if (($sql->stmtError == 'Zero rows') && empty($sql->conError))
            out(['status' => 'OK']);
        else {
            error(500, 'SQL Error');
            out(['status' => 'SQL_ERROR', 'stmt' => $sql->stmtError, 'con' => $sql->conError]);
            return false;
        }
    }else{
        error(400, "$check field not found");
    }
}

function delete_handler()
{
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $sql = new SQL();
    if (!isset(getallheaders()['car_rent_token'])) {
        error(400, 'Request does not contains token');
        return false;
    }
    $result = $sql->execute('SELECT * FROM `user` WHERE `token`=?', getallheaders()['car_rent_token']);
    $u_id = $result[0]['id'];
    if ($sql->count == 0) {
        error(403, 'API-Token not found');
        return false;
    }
    if ($result[0]['auth'] < 2) {
        error(403, 'This user does not have permission to delete cars.');
        return false;
    } else {
        $sql->execute('DELETE FROM `car` WHERE `license_plate`=?', getallheaders()['license_plate']);
    }
}

function error(int $code, string $message)
{
    header("HTTP/1.0 $code $message");
}

function out($var)
{
    print(json_encode($var));
}

function check_rq_body(array $data, array $array)
{
    foreach ($array as $item)
        if (!isset($data[$item]))
            return $item;
    return true;
}
