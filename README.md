# ip2cidr-php
ip2cidr in php code, from https://github.com/viruslab/ip2cidr

## Introduction

A simple Ruby gem for converting a range of IP addresses to a list of CIDR blocks.

## Usage

Using the class:

```
$arr_cidr = IPToCIDR::solveCIDR("192.168.0.1", "192.168.0.16");
var_dump($arr_cidr);
```
```
array(5) {
  [0] =>
  string(14) "192.168.0.1/32"
  [1] =>
  string(14) "192.168.0.2/31"
  [2] =>
  string(14) "192.168.0.4/30"
  [3] =>
  string(14) "192.168.0.8/29"
  [4] =>
  string(15) "192.168.0.16/32"
}
```

This gem cannot use either 0.0.0.0 or 255.255.255.255 as inputs and will return an Exception if they are used as inputs.

## Authors

Monyer
Guys in https://github.com/viruslab/ip2cidr
