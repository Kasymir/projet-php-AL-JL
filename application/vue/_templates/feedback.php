<?php

$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)) {
    echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $feedback_positive . '</div>';
}

if (isset($feedback_negative)) {
    echo '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> ' . $feedback_negative . '</div>';
}