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
 * @version  1.0.0
 */

// a function that checks whether the answer to a question is correct
function itsRight(int $answer, int $solution): bool {
    return $answer === $solution;
}

echo "Willkommen bei Wer wird Millionaer!\n";
$name = readline("Wie heissen Sie? ");
printf ("%s, Frage fuer 50 Euro:\n", $name);
echo "Wie viel ist 2 + 2?\n";
echo "A: 3\n";
echo "B: 4\n";
echo "C: 5\n";
echo "D: 6\n";

// verification and validation of the incoming answer
do {
    $answer = strtoupper(trim(readline("Deine Antwort (A, B, C oder D): ")));

    $itsRight = in_array($answer, ["A", "B", "C", "D"], true);

    if (!$itsRight) {
        echo "Ungueltige Eingabe. Bitte A, B, C oder D eingeben.\n";
    }
} while (!$itsRight);

if ($answer === "B") {
    echo "Richtig! Du hast 50 Euro gewonnen.\n";
} else {
    echo "Falsch! Du hast 0 Euro gewonnen.\n";
}