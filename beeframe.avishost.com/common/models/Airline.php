<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "airlines".
 *
 * @property int $id
 * @property string $iatacode
 * @property string $business_name
 */
class Airline extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'airlines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iatacode', 'business_name'], 'required'],
            [['iatacode'], 'string', 'max' => 8],
            [['business_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iatacode' => 'Iatacode',
            'business_name' => 'Business Name',
        ];
    }

}
