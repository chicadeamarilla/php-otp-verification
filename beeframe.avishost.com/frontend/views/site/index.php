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
<<<<<<< Updated upstream

=======
  //echo $response;
>>>>>>> Stashed changes



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
<<<<<<< Updated upstream
    
    //print_r($php_result->data);
    //exit();
        foreach ($php_result->data as $flight) {


$travelres = '
      {
        "id": "1",
        "dateOfBirth": "1982-01-16",
        "name": {
          "firstName": "JORGE",
          "lastName": "GONZALES"
        },
        "gender": "MALE",
        "contact": {
          "emailAddress": "jorge.gonzales833@telefonica.es",
          "phones": [
            {
              "deviceType": "MOBILE",
              "countryCallingCode": "34",
              "number": "480080076"
            }
          ]
        },
        "documents": [
          {
            "documentType": "PASSPORT",
            "birthPlace": "Madrid",
            "issuanceLocation": "Madrid",
            "issuanceDate": "2015-04-14",
            "number": "00000000",
            "expiryDate": "2025-04-14",
            "issuanceCountry": "ES",
            "validityCountry": "ES",
            "nationality": "ES",
            "holder": true
          }
        ]
      },
      {
        "id": "2",
        "dateOfBirth": "2012-10-11",
        "gender": "FEMALE",
        "contact": {
          "emailAddress": "jorge.gonzales833@telefonica.es",
          "phones": [
            {
              "deviceType": "MOBILE",
              "countryCallingCode": "34",
              "number": "480080076"
            }
          ]
        },
        "name": {
          "firstName": "ADRIANA",
          "lastName": "GONZALES"
        }
      }
        ';

   // $travelres = json_decode($travelres);

    //print_r($travelres); 


$new_order = ['data'=>['type'=>"flight-order","flightOffers"=>[$flight]]];

$newBlock = [
    "travelers" => [
        [
            "id" => "1",
            "dateOfBirth" => "1982-01-16",
            "name" => [
                "firstName" => "JORGE",
                "lastName" => "GONZALES"
            ],
            "gender" => "MALE",
            "contact" => [
                "emailAddress" => "jorge.gonzales833@telefonica.es",
                "phones" => [
                    [
                        "deviceType" => "MOBILE",
                        "countryCallingCode" => "34",
                        "number" => "480080076"
                    ]
                ]
            ],
            "documents" => [
                [
                    "documentType" => "PASSPORT",
                    "birthPlace" => "Madrid",
                    "issuanceLocation" => "Madrid",
                    "issuanceDate" => "2025-04-14",
                    "number" => "00000000",
                    "expiryDate" => "2035-04-14",
                    "issuanceCountry" => "ES",
                    "validityCountry" => "ES",
                    "nationality" => "ES",
                    "holder" => true
                ]
            ]
        ],
        
    ],
    "remarks" => [
        "general" => [
            [
                "subType" => "GENERAL_MISCELLANEOUS",
                "text" => "ONLINE BOOKING FROM INCREIBLE VIAJES"
            ]
        ]
    ],
    "ticketingAgreement" => [
        "option" => "DELAY_TO_CANCEL",
        "delay" => "6D"
    ],
    "contacts" => [
        [
            "addresseeName" => [
                "firstName" => "PABLO",
                "lastName" => "RODRIGUEZ"
            ],
            "companyName" => "INCREIBLE VIAJES",
            "purpose" => "STANDARD",
            "phones" => [
                [
                    "deviceType" => "LANDLINE",
                    "countryCallingCode" => "34",
                    "number" => "480080071"
                ],
                [
                    "deviceType" => "MOBILE",
                    "countryCallingCode" => "33",
                    "number" => "480080072"
                ]
            ],
            "emailAddress" => "support@increibleviajes.es",
            "address" => [
                "lines" => ["Calle Prado, 16"],
                "postalCode" => "28014",
                "cityName" => "Madrid",
                "countryCode" => "ES"
            ]
        ]
    ]
];

// Rebuild data with new block inserted after "flightOffers"
$newData = [];
foreach ($new_order['data'] as $key => $value) {
    $newData[$key] = $value;
    if ($key === 'flightOffers') {
        foreach ($newBlock as $bKey => $bValue) {
            $newData[$bKey] = $bValue;
        }
    }
}

$new_order['data'] = $newData;

// Output pretty JSON
$finalJson = json_encode($new_order);
//echo $finalJson;



=======
        foreach ($php_result->data as $flight) {


>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                    if(!$new_airline->save()){
                      print_r($new_airline->getErros());
                    }else{
                      echo "save new one<br>";
                    }
=======
                    $new_airline->save();
>>>>>>> Stashed changes

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



<<<<<<< Updated upstream
              if($departure_name)
              echo $segment->departure->iataCode."-".$departure_name->name." ".$departure_name->cityName.  "--->";
              if($arrival_name){
              echo $segment->arrival->iataCode."-".$arrival_name->name." ".$arrival_name->cityName."(" . $airline . ")";
              }else{
                echo "no arrival_name found  on : ".$segment->arrival->iataCode."<br>";
              }
=======
              echo $segment->departure->iataCode."-".$departure_name->name." ".$departure_name->cityName.  "--->";
              echo $segment->arrival->iataCode."-".$arrival_name->name." ".$arrival_name->cityName."(" . $airline . ")";

>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
              <p><a class="btn btn-outline-secondary">
                ORDER NOW
              </a></p>

=======
>>>>>>> Stashed changes

          </div>

        <?php } ?>

      </div>

    </div>
  </div>


<?php } ?>