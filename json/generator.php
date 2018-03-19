<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 17.03.2018
 * Time: 11:44
 */
//
//class GeneratorData
//{
//    public $data = [];
//
//    public function has(string $text)
//    {
//        foreach ($this->data as $item) {
//            if ($item->text == $text) {
//                return $item;
//            }
//        }
//        return null;
//    }
//
//}

class GeneratorDataItem
{
    public $text;
    public $count;
    public $calculated_probability;
}

function generate_calculated_probabilities(array &$array, int $count) {
    foreach ($array as $item) {
        if ($item instanceof GeneratorDataItem) {
            $item->calculated_probability = $item->count / $count;
        }
    }
    return $array;
}


function get_item_from_objects_array(string $text, array $data)
{
    if (!is_null($data)) {
        foreach ($data as $item) {
            if ($item->text == $text) {
                return $item;
            }
        }
    }
    return null;
}

function random_generator(JsonData $jsonData, int $num)
{
    for ($i = 0; $i < $num; $i++) {
        if (isset($jsonData)) {
            $randomStringWeight = 0;
            try {
                $randomStringWeight = mt_rand(0, $jsonData->sum-1);
            } catch (Exception $e) {
            }
//            if ($randomStringWeight == 0) continue;
            $data = $jsonData->data;
            if (isset($data[0]) and $data[0] instanceof DataItem) {
                $emptyWeight = 0;

                for ($j = 0; $j < count($data); $j++) {
                    if ($data[$j] instanceof DataItem) {
//                        echo $j;
                        if ($emptyWeight <= $randomStringWeight) {
                            $emptyWeight += $data[$j]->weight;
                            if ($emptyWeight > $randomStringWeight) {
                                yield $data[$j]->text;
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

}


function random_generator_handler(JsonData $jsonData)
{
    $generator = random_generator($jsonData, 1000);
    $data = [];

    foreach ($generator as $string) {
        $item = get_item_from_objects_array($string, $data);
        if ($item != null) {
            $item->count += 1;
        } else {
            $dataItem = new GeneratorDataItem();
            $dataItem->text = $string;
            $dataItem->count = 1;
            array_push($data, $dataItem);
        }
    }
    generate_calculated_probabilities($data, 1000);

    return $data;
}