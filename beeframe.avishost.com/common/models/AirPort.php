<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "airports".
 *
 * @property string|null $code
 * @property string|null $name
 * @property string|null $cityCode
 * @property string|null $cityName
 * @property string|null $countryName
 * @property string|null $countryCode
 * @property string|null $timezone
 * @property string|null $lat
 * @property string|null $lon
 * @property int|null $numAirports
 * @property string|null $city
 */
class AirPort extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CITY_TRUE = 'true';
    const CITY_FALSE = 'false';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'airports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'cityCode', 'cityName', 'countryName', 'countryCode', 'timezone', 'lat', 'lon', 'numAirports', 'city'], 'default', 'value' => null],
            [['numAirports'], 'integer'],
            [['city'], 'string'],
            [['code', 'cityCode'], 'string', 'max' => 50],
            [['name', 'cityName', 'countryName', 'countryCode'], 'string', 'max' => 200],
            [['timezone'], 'string', 'max' => 8],
            [['lat', 'lon'], 'string', 'max' => 32],
            ['city', 'in', 'range' => array_keys(self::optsCity())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'cityCode' => 'City Code',
            'cityName' => 'City Name',
            'countryName' => 'Country Name',
            'countryCode' => 'Country Code',
            'timezone' => 'Timezone',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'numAirports' => 'Num Airports',
            'city' => 'City',
        ];
    }


    /**
     * column city ENUM value labels
     * @return string[]
     */
    public static function optsCity()
    {
        return [
            self::CITY_TRUE => 'true',
            self::CITY_FALSE => 'false',
        ];
    }

    /**
     * @return string
     */
    public function displayCity()
    {
        return self::optsCity()[$this->city];
    }

    /**
     * @return bool
     */
    public function isCityTrue()
    {
        return $this->city === self::CITY_TRUE;
    }

    public function setCityToTrue()
    {
        $this->city = self::CITY_TRUE;
    }

    /**
     * @return bool
     */
    public function isCityFalse()
    {
        return $this->city === self::CITY_FALSE;
    }

    public function setCityToFalse()
    {
        $this->city = self::CITY_FALSE;
    }
}
