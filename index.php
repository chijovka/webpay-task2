<?php

//сортировка массива
function sort_assoc_array($arr) {
    function cmp($row1, $row2)
    {
        $a = $row1['data']['sort'];
        $b = $row2['data']['sort'];

        return $a <=> $b;
        //если версия PHP меньше 7
        /*if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;*/
    }

    usort($arr, "cmp");

    return $arr;
}

//добавление поля "group"
function add_group_field($arr) {
    $arr = array_map(function($item) {
        switch ($item['type']) {
            case boolval(preg_match("/^1/", $item['type'])):
                $group_name = 'group_a';
                break;
            case boolval(preg_match_all("/^3[2,6]/", $item['type'])):
                $group_name = 'group_b';
                break;
            case boolval(preg_match("/^3[0-1,3-5,7-9]/", $item['type'])):
                $group_name = 'group_c';
                break;
            default:
                $group_name = 'group_d';
        }

        $item['group'] = $group_name;

        return $item;
    }, $arr);

    return $arr;
}

//исходный массив
$arr = [
    ['id' => 1, 'data' => ['sort' => 3], 'type' => 101],
    ['id' => 2, 'data' => ['sort' => 4], 'type' => 321],
    ['id' => 3, 'data' => ['sort' => 1], 'type' => 210],
    ['id' => 4, 'data' => ['sort' => 5], 'type' => 764],
    ['id' => 5, 'data' => ['sort' => 2], 'type' => 357]
];

//сортируем массив
$sorted_array = sort_assoc_array($arr);

//получаем массив с полем "group"
$result_array = add_group_field($sorted_array);