<?php

/** @var yii\web\View $this */

use common\models\Hotel;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>This is the About page. You may modify the following file to customize its content:</p>

  <code><?= __FILE__ ?></code>
</div>
<?php $form = \yii\widgets\ActiveForm::begin(); ?>


  <input name="cityCode" placeholder="Enter city iata code" />
  <input type="submit" />
  <?php \yii\widgets\ActiveForm::end(); ?>
  <?php
  if (isset($_POST['cityCode'])){

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


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-city?cityCode='.$_POST['cityCode'].'&radius=5&radiusUnit=KM&hotelSource=ALL',
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

curl_close($curl);

$php_result = json_decode($response);


//print_r($php_result);


foreach ($php_result->data as $hotel) {


  //print_r($hotel);
  $found_hotel = Hotel::findOne(['name'=>$hotel->name]);
  if(!$found_hotel && isset($hotel->address->cityName )){
    echo "going to save hotel..<br>";
    $new_hotel= new Hotel();
    $new_hotel->name=$hotel->name;
    $new_hotel->city_name=$hotel->address->cityName;
    $new_hotel->save();
    print_r($new_hotel->getErrors());
  }
  echo "name:" . $hotel->name;
  echo "<br>";
  echo "iata code :" . $hotel->iataCode;
  echo "<br>";
  if (isset($hotel->address->cityName)) {
    echo $hotel->address->cityName;
  } else {
     echo "No city name";
  } 
    
  echo "<hr>";
}
  }

