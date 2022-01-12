<?php

echo 'The Game';
echo '<br>';
include 'core.php';

$tools = [
    TOOL_ROCK => 'Akmuo',
    TOOL_PAPER => 'Popierius',
    TOOL_SCISSORS => 'Zirkles'
];

echo '<form action="http://127.0.0.1:8000/thegame/index.php" method="POST">';
echo '<select name="tool">';
foreach ($tools as $key => $tool) {
    echo '<option value="' . $key . '">' . $tool . '</option>';
}
echo '</select>';
echo '<br>';

echo '<input type="submit" value="Play!!!" name="play">';
echo '</form>';


$results = getResults();
echo '<table>';
    foreach($results as $result){
        if(!empty($result)) {
            echo '<tr>';
            echo '<td>' . $result[0] . '</td>';
        echo '<td>' . $result[1] . '</td>';
        echo '<td>' . $result[2] . '</td>';

        echo '</tr>';
            }
    }


echo '</table>';