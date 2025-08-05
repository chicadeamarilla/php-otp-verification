<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://test.api.amadeus.com/v1/security/oauth2/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=mQfAaHYglYg0q3s50celqqhSyJFUGzrv&client_secret=Eueo8LdI6VAKIOYp',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;



$result = json_decode($response);
//echo $result->access_token;





$tomorrow = date("Y-m-d", strtotime("+1 day"));




$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=LAX&destinationLocationCode=DXB&departureDate='.$tomorrow.'&adults=1&nonStop=false&max=250',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
   'Authorization: Bearer '.$result->access_token
  ),
));




$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$php_result = json_decode($response);





?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            
            
            <?php
            foreach($php_result->data as $flight){
                
            
            ?>
            
            <div class="col-lg-4">
                <?php foreach($flight->itineraries[0]->segments as $segment){
                
                echo $segment->departure->iataCode."--->";
                echo $segment->arrival->iataCode."(".$segment->carrierCode.")";
                
                    ?>
                    <h2><?php  ?></h2>
                    <?php
            
                ?>
                
                
                <?php } ?>
                
                <p>
                    
                </p>
                
                <p><a class="btn btn-outline-secondary" >€ <?php
echo $flight->price->total;
?></a></p>
                
                
            </div>
            
            <?php } ?>
           
        </div>

    </div>
</div>
