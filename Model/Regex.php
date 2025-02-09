<!--
  Collection of Regex Expressions
-->
<?php
// This will find the current page based on the the matching string between a "/" and a "."
//e.g. http://localhost/Stream/View/movies.php?msg=:Logged%20in will find -> "movies"
$currentPageValidator = "/([^\/.]+)\./" ;

// Date Validation
// This checks: Date must be a valid date including 29days in february on a leap year and days are correct per month
$dateValidator = "^(?:(?:[0-9]{4})-(?:(?:0[13578]|1[02])-(?:0[1-9]|[1-2][0-9]|3[01])|(?:0[469]|11)-(?:0[1-9]|[1-2][0-9]|30)|02-(?:0[1-9]|1[0-9]|2[0-8]))|(?:(?:[0-9]{2})(?:0[48]|[2468][048]|[13579][26])|(?:(?:[13579][26]|[2468][048]|0[48])00))-02-29)$";

// Name Validation
// This checks: Name must only contain letters  
$nameValidator = "/^[a-zA-Z ]*$/";

// Username Validation
// This checks: Username must contain only letters and numbers
$usernameValidator = "/^[a-zA-Z0-9]*$/";

// Email Validation
// This checks: Email must contain one or more alphanumeric characters, dots, underscores, percent signs, plus signs, or hyphens,
// an @ symbol, one or more alphanumeric characters, dots, or hyphens for the domain name, a dot,
// two or more alphabetic characters for the top-level domain (e.g., com, org, co.uk).
$emailValidator = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
  
// Password Validation
// This checks: 
$oneNumberValidator = "#[0-9]+#";

// Password Validation
// This checks: String must contain 1 Uppercase Letter
$oneUppercaseValidator = "#[A-Z]+#";

// Password Validation
// This checks: String must contain 1 Lowercase Letter
$oneLowercaseValidator = "#[a-z]+#";

// Password Validation
// This checks: Password must be At least 8 characters long, Contains at least 1 number, Contains at least 1 uppercase letter, Contains at least 1 lowercase letter
$passwordValidator = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
?>
