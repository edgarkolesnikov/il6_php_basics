<?php
include 'formHelper.php';
$inputs = [
    [
    'type' =>'text',
    'name' =>'name',
    'placeholder' =>'Vardas'
    ],
    [
        'type' =>'text',
        'name' =>'name',
        'placeholder' =>'Pavarde'
    ],
    [
        'type' =>'password',
        'name' =>'password',
        'placeholder' =>'********'
    ],
    [
        'type' =>'password',
        'name' =>'password2',
        'placeholder' =>'********'
    ],
    [
        'type' =>'submit',
        'name' =>'submit',
        'placeholder' =>'OK'
    ],
    [
        'type' =>'select',
        'name' =>'Children_number',
        'value' => [0,1,2,3,'4+']
    ],
    [
    'type'=> 'textarea',
    'name'=> 'textarea',
    'rows'=> '4',
    'cols'=> '50'
    ]
];

echo '<form action="registration.php" method="post">';

foreach($inputs as $input){
    if($input['type'] !== 'select'){
    echo generateInput($input).'<br>';
}elseif($input['type'] === 'select'){
        echo generateSelect($input).'<br>';
    }else{
    echo generateTextArea($input);
    }
}

echo '</form>';




