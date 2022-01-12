<?php

include 'helper.php';

const TOOL_ROCK = 'rock';
const TOOL_PAPER = 'paper';
const TOOL_SCISSORS = 'scissors';

$toolsArray = [
    0 => TOOL_ROCK,
    1 => TOOL_PAPER,
    2 => TOOL_SCISSORS
];



if (isset($_POST['play'])) {
    $playerChoice = $_POST['tool'];
    $pcChoice = rand(0, 2);
    $pcChoice = $toolsArray[$pcChoice];

    echo '<table>';
    echo '<tr><td ><img width="200" height="200" src="image/' . $playerChoice .
        '.png"></td><td>VS</td><td ><img width="200"  height="200" src="image/' . $pcChoice . '.png"></td></tr>';
    echo '</table>';

    if ($playerChoice == $pcChoice) {
        $results = 'Lygiosios';
        echo $playerChoice. ' '.$pcChoice. ' '.$results;

    } elseif ($playerChoice == TOOL_ROCK && $pcChoice == TOOL_SCISSORS){
        $results = 'Laimejote';
        echo $playerChoice. ' '.$pcChoice. ' '.$results;

    } elseif ($playerChoice == TOOL_PAPER && $pcChoice == TOOL_ROCK) {
        $results = 'Laimejote';
        echo $playerChoice. ' '.$pcChoice. ' '.$results;

    } elseif ($playerChoice == TOOL_SCISSORS && $pcChoice = TOOL_PAPER) {
        $results = 'Laimejote';
        echo $playerChoice. ' '.$pcChoice. ' '.$results;

    } else {
        $results = 'Pralaimejote';
        echo $playerChoice. ' '.$pcChoice. ' '.$results;
    }
    $data = [];
    $data[] = [$playerChoice, $pcChoice, $results];
    writeToCsv($data, 'result.csv');
}
