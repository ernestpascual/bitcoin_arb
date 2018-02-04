<html>
<head> 
    <title> BitArb </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/animate.css">
</head>
<body>

<div class="wrapper">
    <div class="row">
        <div class="col-md-10">
            <div class="animated flash infinite"> 
                <div class="center">
                <h1>Bitcoin - USD Arbitrage Table</h1> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
        <table class="table table-hover table-responsive">
            <thead>
                <th>Exchange</th>
                <th>Price</th>
            </thead>
            <tbody>

<?php
/**
 * Bitcoin Arbitrage Monitor
 * 
 * Created by: Ernest Eugene Pascual on 2/5/2018
 * Copyright 2018. All Rights Reserved
 */

// using curl to perform GET request
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.cryptocompare.com/api/data/coinsnapshot/?fsym=BTC&tsym=USD",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

//decode JSON response to array
$response = json_decode($response, true);

//access API elements
$exchanges = $response['Data']['Exchanges'];

// search lower trees from API data, render each object property as string
foreach ($exchanges as $exc){
    echo "<tr><td>" . $exc['MARKET'] . "</td><td>" . number_format((float)$exc["PRICE"] , 2,'.',''). "</td></tr>";
}

?>
</tbody></table>
</div>
</body>
</html>