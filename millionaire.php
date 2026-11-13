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

$prizes = file_get_contents(__DIR__ . "/prizes.json");
$prizes_json = json_decode($prizes, true);

$prize = 0;
$safePrize = 0;

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
echo "               @reincarnation\n";

do {
    $choice = trim(readline("Choose an option: "));

    if (!in_array($choice, ["1", "2"], true)) {
        echo "Invalid input! Please enter 1 or 2.\n";
    }
} while (!in_array($choice, ["1", "2"], true));

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
do {
    $name = trim(readline("What's your name? "));

    if ($name === "") {
        echo "Invalid input! Please enter your name.\n";
    }
} while ($name === "");
sleep(1);

while ($number_questions < 15) {
    $question = $data_json["games"][0]["questions"][$number_questions];

    echo "\nQuestion " . ($number_questions + 1) . "\n";
    $questionPrize = $prizes_json[$number_questions + 1];
    printf ("%s, You are playing for $questionPrize Euro.\n",$name);
    echo $question["question"] . "\n";

    foreach ($question["content"] as $index => $option) {
        echo $letters[$index] . ": " . $option . "\n";
    }

    do {
        $answer = strtoupper(trim(readline("Your answer (A, B, C or D): ")));

        if (!in_array($answer, $letters, true)) {
        echo "Invalid input! Please enter A, B, C or D.\n";
        }
    } while (!in_array($answer, $letters, true));
    $correctAnswer = $letters[$question["correct"]];

    sleep(1);

    if ($answer === $correctAnswer) {
        $prize = $questionPrize;
        echo "Correct! Your prize: $prize Euro.\n";

        if ($prize === 500 or $prize === 16000) {
            $safePrize = $prize;
            echo "Safety prize reached!\n";
        }

        $number_questions++;
    } else {
        $prize = $safePrize;
        echo "Wrong! Game over!\n";
        break;
    }
}

sleep(1);
if ($prize === 0) {
    printf ("You won NOTHING!\n");
} else {
    printf ("You won %d Euro!\n",$prize);
}
