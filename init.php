<?php
    require_once 'Classes/DatabaseClass.php';

    // connect to database
    $DB = new Database();
    $DB->connect("localhost", "userassignment", "root", "caviakooi");

    // set main variables
    $username   = isset($_POST["username"]) ? $_POST["username"] : null;
    $password   = isset($_POST["password"]) ? $_POST["password"] : null;
    $name       = isset($_POST["name"]) ? $_POST["name"] : null;
    $email      = isset($_POST["email"]) ? $_POST["email"] : null;