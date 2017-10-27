<?php

require "Config/config.php";
require "Core/Dispatcher.php";

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
