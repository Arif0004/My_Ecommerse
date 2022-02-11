<?php


function greetings($name = "Shahin")
{
    return "Hello $name";
}

function generateUniqueId()
{
    return uniqid();
}

function calculateProductStar($reviews): ?int
{
    $count = count($reviews);
    if ($count === 0) {
        return null;
    }
    $sum = 0;
    foreach ($reviews as $review) {
        $sum += $review->rating;
    }

    return floor($sum / count($reviews));
}
