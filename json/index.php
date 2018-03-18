<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 17.03.2018
 * Time: 11:42
 */

include "generator.php";

require "index.html";

class DataItem
{
    public $text;
    public $weight;
    public $probability;
}

class JsonData
{
    public $sum;
    public $data = [];
}

function createObjects(array $strings_array)
{
    $sum_weight = 0;
    $data = [];
    foreach ($strings_array as $item) {
        $weight_index = strrpos($item, " ");
        if ($weight_index !== false) {
            $item_weight = (int)substr(trim($item), $weight_index + 1);
            $sum_weight += $item_weight;

            $data_item = new DataItem();
            $data_item->text = trim($item);
            $data_item->weight = $item_weight;

            array_push($data, $data_item);

        }
    }
    createProbabilities($data, $sum_weight);
//    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    $json_data = new JsonData();
    $json_data->sum = $sum_weight;
    $json_data->data = $data;

    return $json_data;
}


function createProbabilities(array $data, int $sum)
{
    foreach ($data as $item) {
        if (is_object($item)) {
            $item->probability = ($item->weight) / $sum;
        }
    }
    return $data;
}

function echoObject($object)
{
    echo json_encode($object, JSON_PRETTY_PRINT)."<br/><br/>";
}

$message = "";
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}

$strings_array = explode("\n", $message);

$data = createObjects($strings_array);

echoObject($data);

//$newData = random_generator_handler($data);
echoObject(random_generator_handler($data));