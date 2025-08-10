<?php

/** @var yii\web\View $this */

use common\models\Airline;
use common\models\AirPort;

$this->title = 'My Yii Application';

?>



<?php $form = \yii\widgets\ActiveForm::begin(); ?>


  <input name="origin" placeholder="origin" />
  <input name="destination" placeholder="destination" />
  
  <input name="date" placeholder="date" />


  <input type="submit" />


<?php \yii\widgets\ActiveForm::end(); ?>

<?php


if (isset($_POST['origin']) and isset($_POST['destination']) and isset($_POST['date'])) {

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

  



  $tomorrow = date("Y-m-d", strtotime("+1 day"));



  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://test.api.amadeus.com/v2/shopping/flight-offers',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
  "currencyCode": "USD",
  "originDestinations": [
    {
      "id": "1",
      "originLocationCode": "'.$_POST['origin'].'",
      "destinationLocationCode": "'.$_POST['destination'].'",
      "departureDateTimeRange": {
        "date": "' . $_POST['date'] . '",
        "time": "10:00:00"
      }
    }
  ],
  "travelers": [
    {
      "id": "1",
      "travelerType": "ADULT"
    }
  ],
  "sources": [
    "GDS"
  ],
  "searchCriteria": {
    "maxFlightOffers": 100,
    "flightFilters": {
      "cabinRestrictions": [
        {
          "cabin": "BUSINESS",
          "coverage": "MOST_SEGMENTS",
          "originDestinationIds": [
            "1"
          ]
        }
      ]
    }
  }
}',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $result->access_token
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
        foreach ($php_result->data as $flight) {


          ?>

          <div class="col-lg-4">
            <?php foreach ($flight->itineraries[0]->segments as $segment) {







              if ($segment->carrierCode) {


                //check iatacode airline exist in my db or not 
                $fund_iata_airline = Airline::findOne(['iatacode' => $segment->carrierCode]);
                if (!$fund_iata_airline) {



                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=' . $segment->carrierCode,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                      'Authorization: Bearer ' . $result->access_token
                    ),
                  ));

                  $response = curl_exec($curl);

                  //echo $response;
        
                  curl_close($curl);
                  //$php_resultAirline = json_decode($response, true);
        
                  $data = json_decode($response, true);

                  if (isset($data['data'][0])) {
                    $airline = $data['data'][0]['businessName'];

                    $new_airline = new Airline();
                    $new_airline->iatacode = $segment->carrierCode;
                    $new_airline->business_name = $airline;
                    $new_airline->save();

                  } else {
                    $airline = "---";

                  }

                } else {
                  $airline = $fund_iata_airline->business_name;
                }

                // Access the business name
//$businessName = $data['data'][0]['businessName'];
        

              }

              //print_r( $php_resultAirline['data'][0]['businessName']);
//
//print_r($php_resultAirline->data[0]);
//print_r($php_resultAirline->dat);
        

$departure_name = AirPort::findOne(['code'=>$segment->departure->iataCode]);
$arrival_name = AirPort::findOne(['code'=>$segment->arrival->iataCode]);



              echo $segment->departure->iataCode."-".$departure_name->name." ".$departure_name->cityName.  "--->";
              echo $segment->arrival->iataCode."-".$arrival_name->name." ".$arrival_name->cityName."(" . $airline . ")";

              ?>
              <h2><?php ?></h2>
              <?php

              ?>


            <?php } ?>

            <p>

            </p>

            <p><a class="btn btn-outline-secondary">€
                <?php
                echo $flight->price->total;
                ?>
              </a></p>


          </div>

        <?php } ?>

      </div>

    </div>
  </div>


<?php } ?>