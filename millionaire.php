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
$data_json = json_decode($json, true);

$letters = ["A", "B", "C", "D"];
$number_questions = 0;

sleep(1);
echo "---------------------------------------------\n";
echo "| Welcome to Who Wants to Be a Millionaire! |\n";
echo "---------------------------------------------\n";
echo "              | 1. Start game |\n";
echo "              -----------------\n";
echo "              |    2. Exit    |\n";
echo "              -----------------\n";

$choice = readline("Choose an option: ");

switch ($choice) {
    case "1":
        echo "Let's play!\n";
        break;

    case "2":
        exit("Goodbye!\n");

    default:
        exit("Invalid option.\n");
}

sleep(1);
$name = readline("What's your name? ");
sleep(1);

while ($number_questions < 15) {
    $question = $data_json["games"][0]["questions"][$number_questions];

    echo "\nQuestion " . ($number_questions + 1) . "\n";
    echo $question["question"] . "\n";

    foreach ($question["content"] as $index => $option) {
        echo $letters[$index] . ": " . $option . "\n";
    }

    $answer = strtoupper(trim(readline("Your answer: ")));
    $correctAnswer = $letters[$question["correct"]];

    if ($answer === $correctAnswer) {
        echo "Correct!\n";
        $number_questions++;
    } else {
        echo "Wrong! Game over!\n";
        break;
    }
}