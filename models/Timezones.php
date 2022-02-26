<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coach_info".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $timezone
 * @property string|null $remarks
 */
class Timezones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timezones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['available_at', 'available_until'], 'safe'],
            [['name', 'timezone', 'remarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'timezone' => 'Timezone',
            'remarks' => 'Remarks'
        ];
    }
}
