<?php

// Include the Composer autoloader to load classes automatically
require_once __DIR__ . '/vendor/autoload.php';

// Import the required classes
use App\Services\ViolationClassifier;

// Create an instance of the ViolationClassifier
$classifier = new ViolationClassifier();

// Prepare the labeled training data
$X = [
    'This is a positive review.',
    'Negative experience with this product.',
    'The service was excellent.',
    // Add more training samples...
];

$y = [
    'positive',
    'negative',
    'positive',
    // Add more corresponding labels...
];

// Train the classifier
$classifier->train($X, $y);

// Classify new text data
$newText = 'This is a new text to classify.';
$predictedClass = $classifier->predict($newText);

// Output the predicted class
echo "Predicted class: $predictedClass";
