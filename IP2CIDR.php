<?php

class IP2CIDR {

    function iprange_to_cidr($startip, $endip) {
        $cidr2mask = [0x00000000, 0x80000000, 0xC0000000,
            0xE0000000, 0xF0000000, 0xF8000000,
            0xFC000000, 0xFE000000, 0xFF000000,
            0xFF800000, 0xFFC00000, 0xFFE00000,
            0xFFF00000, 0xFFF80000, 0xFFFC0000,
            0xFFFE0000, 0xFFFF0000, 0xFFFF8000,
            0xFFFFC000, 0xFFFFE000, 0xFFFFF000,
            0xFFFFF800, 0xFFFFFC00, 0xFFFFFE00,
            0xFFFFFF00, 0xFFFFFF80, 0xFFFFFFC0,
            0xFFFFFFE0, 0xFFFFFFF0, 0xFFFFFFF8,
            0xFFFFFFFC, 0xFFFFFFFE, 0xFFFFFFFF];
        $startaddr = ip2long($startip);
        $endaddr = ip2long($endip);
		
        if ($startaddr > $endaddr) {
            throw new Exception("Starting IP must be less than the end IP");
        }
        $cidrlist = array();
        while ($endaddr >= $startaddr) {
            $maxsize = 32;
            while ($maxsize > 0) {
                $mask = $cidr2mask[$maxsize - 1];
                $maskedbase = $startaddr & $mask;
                if ($maskedbase != $startaddr) {
                    break;
                }
                $maxsize -=1;
            }
            $x = log($endaddr - $startaddr + 1) / log(2);
            $maxdiff = 32 - floor($x);
            $new_maxsize = $maxsize < $maxdiff ? $maxdiff : $maxsize;
            $cidrlist[] = long2ip($startaddr) . "/" . $new_maxsize;
            $startaddr += pow(2, (32 - $new_maxsize));
        }
        return $cidrlist;
    }

    function solveCIDR($startip, $endip) {
        if (!preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $startip) ||
                !preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $endip)) {
            throw new Exception("IP address is not valid");
        }
        if (($startip == "0.0.0.0") || ($endip == "0.0.0.0") ||
                ($startip == "255.255.255.255") || ($endip == "255.255.255.255")) {
            throw new Exception("Special IP address error");
        }
        return $this->iprange_to_cidr($startip, $endip);
    }

}
