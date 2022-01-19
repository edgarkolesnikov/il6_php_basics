<?php

function generateInput($data){
    $input = '';
    $input .= '<input ';
    foreach ($data as $key => $value){
        $input.=$key.'="'.$value.'" ';
    }
    $input .= '>';
    return $input;
}

//[
//    'type' =>'select',
//    'name' =>'Children_number',
//    'options' => [0,1,2,3,'4+']
//]



function generateSelect($data){
    $input = '';
    $input .= '<select name="'.$data['name'].'">';
    foreach($data['value'] as $option){
        $input .= '<option value="'.$option.'">'.$option.'</option>';
    }
    $input.='</select>';
    return $input;
}


function generateTextArea($data){
    $input = '';
    $input .= '<textarea ';
    foreach($data as $key=>$value){
        $input .= $key.'="'.$value.'" ';
    }
    $input .= '>';
}
