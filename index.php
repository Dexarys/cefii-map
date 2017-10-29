<?php

session_start();
session_regenerate_id();

require "Config/config.php";
require "Core/Dispatcher.php";

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
