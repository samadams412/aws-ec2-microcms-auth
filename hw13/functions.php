<?php
// Validation helper functions

function validateName($name) {
    // Alphabet characters, hyphens, and apostrophes only
    if (empty($name)) {
        return "empty";
    } elseif (!preg_match("/^[a-zA-Z\-' ]+$/", $name)) {
        return "invalid";
    }
    return "valid";
}

function validateEmail($email) {
    if (empty($email)) {
        return "empty";	// Use php built-in filter constant
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "invalid";
    }
    return "valid";
}

function validatePhone($phone) {
    // Digits only
    if (empty($phone)) {
        return "empty";
    } elseif (!ctype_digit($phone)) {
        return "invalid";
    }
    return "valid";
}
// For username, password, and comments
function validateStandard($field) {
    if (empty($field)) {
        return "empty";
    }
    return "valid";
}
?>