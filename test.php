<?php

require "IPToCIDR.php"

$arr_cidr = IPToCIDR::solveCIDR("192.168.0.1", "192.168.0.16");
var_dump($arr_cidr);
