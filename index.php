<?php
    $name = "Kathrin";

    if($name == "Kathrin"){
        echo "Hello Kathrin";
    } else {
        echo "Nice name";
    }

    echo "<hr>";

    $rating = 9;
    $rated = false;

    if($rating >= 1 && $rating <= 10 && is_int($rating)){
        if($rated == true){
            echo "You already voted";
        } else {
            echo "Thanks for voting";
            echo "<br>";
            echo "Thank you for your rating";
        }
    } else {
        echo "Invalid rating, only numbers between 1 and 10";
    }

    echo "<hr>";

    // $currentHour = date("g A");
    $currentHour = date("H");

    if($currentHour < 12){
        echo "Good morning $name";
    } elseif($currentHour >= 12 && $currentHour < 19){
        echo "Good afternoon $name";
    } else {
        echo "Good evening $name";
    }

    echo "<hr>";

    $voters = [
        'Andrej' => [true, 9],
        'Martin' => [false, 4],
        'Darko' => [false, 6],
        'Diana' => [false, 3],
        'Nikola' => [true, 9],
        'Pavel' => [true, 10],
        'Dimitar' => [false, 1],
        'Aleksandar' => [true, 5],
        'Damjan' => [true, 3],
        'Stefan' => [false, 7]
    ];

    forEach($voters as $voter => $values){
        $currentHour = date("H");

        if($currentHour < 12){
            $greeting = "Good morning $voter";
        } elseif($currentHour >= 12 && $currentHour < 19){
            $greeting = "Good afternoon $voter";
        } else {
            $greeting = "Good evening $voter";
        }

        if($values[1] >= 1 && $values[1] <= 10){
            if($values[0] == "true"){
                $votingStatus = "You already voted with a $values[1]";
            } else {
                $votingStatus = "Thanks for voting with a $values[1]";
            }
        } else {
            $votingStatus = "Invalid rating, only numbers between 1 and 10";
        }

        echo $greeting . ', ' . $votingStatus . "<br>";
    }


?>