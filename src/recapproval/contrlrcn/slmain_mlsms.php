<?php
 /*function http_post_xml($xml, $url) {
       $url_ = preg_replace('/^(https|http):\/\//i', '', $url);
        $parts = explode('/', $url_);
        $server = array_shift($parts);
        $script = '/' . implode('/', $parts);
        $port = '';

        preg_match('/^http(s)?:\/\/.*:(\d+)/i', $url, $matches);
        if (count($matches)) {
            $port = $matches[2];
        }

        $usessl = 0;

        if (preg_match('/^https/i', $url)) {
            $usessl = 1;
            if (!strlen($port)) {
                $port = '443';
            }
        } else {
            if (!strlen($port)) {
                $port = '80';
            }
        }

        if ($usessl) {
            $socket = fsockopen('ssl://' . $server, $port, $errorno, $errstr, 30);
        } else {
            $socket = fsockopen($server, $port, $errorno, $errstr, 30);
        }

        if (!$socket) {
            print($errorno . ' ' . $errstr);
            return;
        }

        $defaultgateway = "sms.raffsoft.co.ug";
        $server = ($server) ? $server : $defaultgateway;

        $headers = "POST $script HTTP/1.1\n";
        $headers .= "Host: $server\n";
        $headers .= "Content-Type: text/xml\n";
        $headers .= "Content-Length: " . strlen($xml) . "\r\n\r\n";
        $xml_response = '';
        $full_response = '';

        fwrite($socket, $headers . $xml);

        while (!feof($socket)) {
            $response = fgets($socket);
            $full_response .= $response;
            if (preg_match("/^<\?xml version=/", $response) or preg_match('/<YbsSmgw>/', $response)) {
                $xml_response .= "$response\n";

                while (!feof($socket)) {
                    $response = fgets($socket);
                    $full_response .= $response;
                    $xml_response .= $response;
                }

                break;
            }
        }

        fclose($socket);

        if (!strlen($xml_response)) {
            return $full_response;
        } else {
            return $xml_response;
        }
    }*/
?>