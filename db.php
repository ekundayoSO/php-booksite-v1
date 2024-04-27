<?php

$connection = new mysqli('db', 'root', 'lionPass', 'booksite');

if (!$connection) {
    die("Database Connection failed");
}
