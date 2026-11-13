<?php
/**
 * Final Project of theme "PHP"
 *
 * PHP version 8.5
 *
 * Who wants wo be millionaire?
 * 
 * @category Application
 * @package  Phpdev
 * @author   Oleksandr Krizhanovskyi <krizhanovskyi.alex@gmail.com>
 * @copyright 2026 Oleksandr Krizhanovskyi
 * @license  https://opensource.org/licenses/MIT MIT License
 * @version  1.0.1
 */

$json = file_get_contents(__DIR__ . "/questions.json");
$data = json_decode($json, true);

$question = $data["games"][0]["questions"][0];
$letters = ["A", "B", "C", "D"];

sleep(1);
echo "Welcome to Who Wants to Be a Millionaire!\n";
sleep(1);
$name = readline("Whats your name? ");
sleep(1);
printf ("%s, Question for 50.- CHF:\n", $name);
echo $question["question"] . "\n";

foreach ($question["content"] as $index => $option) {
    echo $letters[$index] . ": " . $option . "\n";
}

$answer = strtoupper(trim(readline("Deine Antwort: ")));
$correctAnswer = $letters[$question["correct"]];

if ($answer === $correctAnswer) {
    echo "Richtig! Du hast 50 Euro gewonnen.\n";
} else {
    echo "Falsch! Du hast 0 Euro gewonnen.\n";
}