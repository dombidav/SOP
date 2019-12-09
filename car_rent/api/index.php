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
                    `car`.`price_per_km` AS "PricePerKM"
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
                `car`.`price_per_km` AS "PricePerKM"
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
    } /*elseif ($table == 'rents') {
        if (!isset(getallheaders()['car_rent_token'])) {
            error(400, 'Request does not contains token');
        } else {
            $result = $sql->execute('SELECT * FROM `user` WHERE `token`=?', getallheaders()['car_rent_token']);
            if ($sql->count == 0)
                error(403, 'API-Token not found');
            else {
                $f = 0;
                $l = 10;
                if (isset($_GET['f'])) {
                    $f = $_GET['f'];
                }
                if (isset($_GET['l'])) {
                    $l = $_GET['l'];
                }
                $result = $sql->execute(
                    'SELECT 
                    `rent`.`id` AS "rent_id",
                    `rent`.`order_date` AS "order_date",
                    `car_status`.`name_en` AS "car_status_en",
                    `car_status`.`name_hu` AS "car_status_hu",
                    `car`.`license_plate` AS "license_plate",
                    `car`.`kw` AS "kw",
                    `car`.`ccm` AS "ccm",
                    `car`.`km` AS "km",
                    `car`.`transmission` AS "automatic",
                    `rent_status`.`name_en` AS "rent_status_en",
                    `rent_status`.`name_en` AS "rent_status_hu",
                    `car`.`make` AS "make",
                    `car`.`model` AS "model",
                    `category`.`name_en` AS "category_en",
                    `category`.`name_hu` AS "category_hu",
                    `type`.`name_en` AS "type_en",
                    `type`.`name_en` AS "type_hu"
                    FROM `rent`, `car`, `type`, `category`, `user`, `rent_status`, `car_status` WHERE 
                        `rent`.`car_id` = `car`.`id` AND 
                        `rent`.`status` = `rent_status`.`id` AND
                        `car`.`category` = `category`.`id` AND
                        `car`.`type` = `type`.`id` AND
                        `car`.`status` = `car_status`.`id` AND
                        `user`.`id` = `rent`.`user_id` AND
                        `user`.`token` = ?  ORDER BY `rent`.`start_date` DESC LIMIT ?, ?',
                    getallheaders()['car_rent_token'],
                    $f,
                    $l
                );
                out($result);
            }
        }
    } elseif ($table == 'rentable') {
        if (!isset(getallheaders()['car_rent_token'])) {
            error(400, 'Request does not contains token');
            return false;
        }
        $result = $sql->execute('SELECT * FROM `user` WHERE `token`=?', getallheaders()['car_rent_token']);
        if ($sql->count == 0)
            error(403, 'API-Token not found');
        $f = 0;
        $l = 25;
        if (isset($_GET['f']))
            $f = $_GET['f'];
        if (isset($_GET['l']))
            $l = $_GET['l'];
        $q = 'SELECT
                `car`.`license_plate` AS "license_plate",
                `car`.`kw` AS "kw",
                `car`.`ccm` AS "ccm",
                `car`.`km` AS "km",
                `car`.`transmission` AS "transmission",
                `car`.`price_per_hour` AS "price_per_hour",
                `car`.`price_per_km` AS "price_per_km",
                `type`.`name_en` AS "type_en",
                `type`.`name_hu` AS "type_hu",
                `category`.`name_en` AS "category_en",
                `category`.`name_hu` AS "category_hu",
                `car`.`make` AS "make",
                `car`.`model` AS "model"
            FROM `car`, `make`, `model`, `rent`, `category`, `type`
            WHERE
                `car`.`id` = `rent`.`car_id` AND
                `car`.`make` = `make`.`id` AND
                `car`.`model` = `model`.`id` AND
                `car`.`category` = `category`.`id` AND
                `car`.`type` = `type`.`id` AND
                `car`.`status` = 1
            LIMIT ?, ?';
        $sql = new SQL();
        $result = $sql->execute($q, $f, $l);
        out($result);
    }*/ else if ($table == 'categories') {
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
        /*if (!isset($data['c'])) { //renting
            $result = $sql->execute("SELECT `status` FROM `car` WHERE `id`=?", $data['car_id']);
            if (empty($result)) {
                error(404, "No car with id " . $data['car_id']);
                return false;
            } else if ($result[0]['status'] != 1) {
                error(403, "This car can not be rented at this time");
                return false;
            }
            $sql->execute('INSERT INTO `rent` (`user_id`, `car_id`) VALUES (?, ?)', $u_id, $data['car_id']);
            if (($sql->stmtError == 'Zero rows') && empty($sql->conError))
                out(['status' => 'OK']);
            else {
                error(500, 'SQL Error');
                out(['status' => 'SQL_ERROR', 'stmt' => $sql->stmtError, 'con' => $sql->conError]);
                return false;
            }
        } else {*/
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
        //}
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
