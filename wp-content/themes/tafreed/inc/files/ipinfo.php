<?php
function ipInfo($ip = '', $purpose = "location", $deep_detect = TRUE)
{
    $output = [];
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $forwarded_fors = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
                if (count($forwarded_fors) && isset($forwarded_fors[0])) {
                    if (filter_var($forwarded_fors[0], FILTER_VALIDATE_IP)) {
                        $ip = $forwarded_fors[0];
                    }
                }
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), '', strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=" . $ip);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);

            $cout = curl_exec($curl);
            if (curl_error($curl)) {
                return $output;
            }
            curl_close($curl);

            $ipdat = @json_decode($cout);
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = ['address' => implode(", ", array_reverse($address))];
                        break;
                    case "city":
                        $output = ['city' => @$ipdat->geoplugin_city];
                        break;
                    case "state":
                        $output = ['state' => @$ipdat->geoplugin_regionName];
                        break;
                    case "region":
                        $output = ['region' => @$ipdat->geoplugin_regionName];
                        break;
                    case "country":
                        $output = ['country' => @$ipdat->geoplugin_countryName];
                        break;
                    case "countrycode":
                        $output = ['countrycode' => @$ipdat->geoplugin_countryCode];
                        break;
                }
            }
        } catch (Exception $ex) {
            return ['error' => $ex];
        }
    }
    return $output;
}

function getIpInfo()
{
    echo json_encode(ipInfo());
    exit;
}

add_action("wp_ajax_ipinfo", "getIpInfo");
add_action("wp_ajax_nopriv_ipinfo", "getIpInfo");
