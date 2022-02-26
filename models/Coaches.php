<?php

namespace app\models;

use Yii;
use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * This is the model class for table "coach_info".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $timezone
 * @property string|null $day_of_week
 * @property string|null $available_at
 * @property string|null $available_until
 */
class Coaches extends \yii\db\ActiveRecord
{
	public static $strTimeFormat = 'h:i A';

	/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coach_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timeSlots'], 'each'],
            [['available_at', 'available_until'], 'safe'],
            [['name', 'timezone', 'day_of_week'], 'string', 'max' => 255],
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
            'day_of_week' => 'Day Of Week',
            'available_at' => 'Available At',
            'available_until' => 'Available Until',
            'timeSlots' => 'Time Slots',
        ];
    }

    public static function getCoachTimeSlots( DateTime $strStartTime, DateTime $strEndTime, DateTimeZone $objTimeZone, $strDuration = '30' )
    {
		$arrReturnArray = [];// Define output
		/*$strStartTime    = $strStartTime->getTimeStamp(); //Get Timestamp
		$strEndTime      = $strEndTime->getTimeStamp(); //Get Timestamp*/

		$AddMins  =  $strDuration;

		while ($strStartTime <= $strEndTime) //Run loop
		{
			$arrReturnArray[] = [ $strStartTime->format(self::$strTimeFormat), $strStartTime->add(new DateInterval('PT' . $AddMins . 'M'))->format(self::$strTimeFormat) ];
			//$strStartTime += $AddMins; //Endtime check
		}
		return $arrReturnArray;
    }

    public static function formatTime( DateTime $strDateTime ) {
    	return $strDateTime->format(self::$strTimeFormat);
	}

	public $timeSlots;


	public function getNewProperty(){

		return $this->timeSlots;

	}


	public function setNewProperty($timeSlots){

		$this->timeSlots = $timeSlots;

	}

}
