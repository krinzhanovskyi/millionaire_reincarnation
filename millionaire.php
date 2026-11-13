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
 * @version  2.0.0
 */

// initializing and validation the question file
if (is_readable(__DIR__ . "/questions.json")) {
    $json = file_get_contents(__DIR__ . "/questions.json");
    $data_json = json_decode($json, true);
} else {
    exit("Error: questions.json is missing or cannot be read.\n");
}

// initializing and validation the winnings amount file
if (is_readable(__DIR__ . "/prizes.json")) {
    $prizes = file_get_contents(__DIR__ . "/prizes.json");
    $prizes_json = json_decode($prizes, true);
} else {
    exit("Error: prizes.json is missing or cannot be read.\n");
}

// definition of variables for the prize amount
$prize = 0;
$safePrize = 0;

// definition of variables for answers
$letters = ["A", "B", "C", "D"];
$number_questions = 0;
$tableContentWidth = 45;
$printTableBorder = function () use ($tableContentWidth): void {
    echo str_repeat("-", $tableContentWidth + 4) . "\n";
};
$printTableRow = function (string $text, int $padding = STR_PAD_RIGHT) use ($tableContentWidth): void {
    echo "| " . str_pad($text, $tableContentWidth, " ", $padding) . " |\n";
};

// start menu 
sleep(1);
$printTableBorder();
$printTableRow("Welcome to Who Wants to Be a Millionaire!", STR_PAD_BOTH);
$printTableBorder();
$printTableRow("1. Start game", STR_PAD_BOTH);
$printTableBorder();
$printTableRow("2. Exit", STR_PAD_BOTH);
$printTableBorder();
$printTableRow("@reincarnation", STR_PAD_BOTH);
$printTableBorder();

// selecting an option 
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

// getting a name to use in questions
sleep(1);
do {
    $name = trim(readline("What's your name? "));

    if ($name === "") {
        echo "Invalid input! Please enter your name.\n";
    }
} while ($name === "");
sleep(1);

// expression for asking questions
while ($number_questions < 15) {
    if ($number_questions > 0) {
        // menu with choice to continue or stop
        $text = "Your current prize: $prize Euro.";
        $printTableBorder();
        $printTableRow($text);
        $printTableBorder();
        $printTableRow("1. Continue playing", STR_PAD_BOTH);
        $printTableBorder();
        $printTableRow("2. Take the money", STR_PAD_BOTH);
        $printTableBorder();

        // validation of input
        do {
            $choice = trim(readline("Choose an option: "));

            if (!in_array($choice, ["1", "2"], true)) {
                echo "Invalid input! Please enter 1 or 2.\n";
            }
        } while (!in_array($choice, ["1", "2"], true));
        
        // choice finish the test
        if ($choice === "2") {
            echo "You chose to take the money!\n";
            break;
        }
    }
    
    $question = $data_json["questions"][$number_questions];

    // the question and the text that accompanies it
    sleep(1);
    $printTableBorder();
    echo "Question " . ($number_questions + 1) . "\n"; /* updating number of question */
    $questionPrize = $prizes_json[$number_questions + 1]; /* updating the prize value */
    printf ("%s, You are playing for $questionPrize Euro.\n",$name);
    echo $question["question"] . "\n"; /* question from json file */

    // validating answer
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

    // receiving an answer and validation
    if ($answer === $correctAnswer) {
        $prize = $questionPrize;
        $printTableBorder();
        $printTableRow("Correct!", STR_PAD_BOTH);
        $printTableBorder();
    
        // definition checkpoint
        if ($prize === 500 or $prize === 16000) {
            $safePrize = $prize;
            $printTableBorder();
            $printTableRow("Safety prize reached!", STR_PAD_BOTH);
            $printTableBorder();
        }

        $number_questions++;
    } else {    /* response to an incorrect answer */
        $prize = $safePrize; /* if a checkpoint has been reached, used the nearest one as a reward */
        $printTableBorder();
        $printTableRow("Wrong! Game over!", STR_PAD_BOTH);
        $printTableBorder();
        break;
    }
}

// announcement of the Session Results
sleep(1);
if ($prize === 0) {
    $text = "You won NOTHING!";
} else {
    $text = "You won $prize Euro!";
}
$printTableBorder();
$printTableRow($text, STR_PAD_BOTH);
$printTableBorder();
