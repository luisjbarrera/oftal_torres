<?php

$database = new mysqli("localhost", "citasoftalmo", "XsB/#kbeR##85@J", "citas");
if ($database->connect_error) {
    die("Connection failed:  " . $database->connect_error);
}
