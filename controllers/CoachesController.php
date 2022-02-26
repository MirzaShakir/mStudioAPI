<?php

namespace app\controllers;
use DateTime;
use DateTimeZone;
use Yii;
use yii\web\Controller;
use app\models\Coaches;
use app\models\Timezones;

class CoachesController extends Controller
{
	protected $strDefaultTimezone;
	protected $objTimeZone;
	function __construct($id, $module, $config = [])
	{
		parent::__construct($id, $module, $config);
		\Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
		$this->strDefaultTimezone = 'Asia/Kolkata';
		if( isset( $_REQUEST['timezone'] ) ) {
			$this->strDefaultTimezone = $_REQUEST['timezone'];
		}
		$this->objTimeZone = new DateTimeZone( $this->strDefaultTimezone );
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionGetCoachDetails() {
		if( isset( $_REQUEST['coachName'] ) ) {
			$strCoachName = $_REQUEST['coachName'];
		} else {
			$strError = 'Coach name is required to fetch details';
			return array('status' => false, 'error'=> $strError);
		}
		$arrCoaches = Coaches::findBySql("
			SELECT ci.id, ci.name, tz.timezone, ci.day_of_week, ci.available_at, ci.available_until FROM coach_info ci
			JOIN timezones tz ON ( ci.timezone = tz.name )
			WHERE ci.name = :coachName
		", [ 'coachName' => $strCoachName ] )->asArray()->all();
		//$arrTimezones = TimeZones::find()->all();
		if(count($arrCoaches) > 0 )
		{
			foreach( $arrCoaches as $intIndex => $arrCoach ) {
				$objCoachTimezone = new DateTimeZone( $arrCoach['timezone'] );
				$start_date = new DateTime( $arrCoach['available_at'], $objCoachTimezone);
				$end_date = new DateTime( $arrCoach['available_until'], $objCoachTimezone);
				$start_date->setTimeZone($this->objTimeZone);
				$end_date->setTimeZone($this->objTimeZone);
				$arrCoaches[$intIndex]['available_at'] = Coaches::formatTime( $start_date );
				$arrCoaches[$intIndex]['available_until'] = Coaches::formatTime( $end_date );
				$arrCoaches[$intIndex]['timeSlots'] = Coaches::getCoachTimeSlots( $start_date, $end_date, $objCoachTimezone );
				$arrCoaches[$intIndex]['timezone'] = $this->objTimeZone->getName();
			}

			return array('status' => true, 'data'=> $arrCoaches);
		}
		else
		{
			return array('status'=>false,'data'=> 'No Coaches Found');
		}

	}

	public function actionGetCoaches() {

		/*$utc_datetime = new DateTime(strtotime(), new DateTimeZone('UTC'));
		$pdt_date = $utc_datetime->setTimeZone(new DateTimeZone('America/Los_Angeles'));
		$pdt_date = $pdt_date->format("Y-m-d H:i:s");

		$date = new DateTime();
		$timeZone = $date->setTimezone('Asia/Kolkata');*/
		//$strTimeZone = $timeZone->getName();

		$arrCoaches = Coaches::findBySql("SELECT DISTINCT ci.name, tz.timezone FROM coach_info ci JOIN timezones tz ON ( ci.timezone = tz.name )")->all();
		//$arrTimezones = TimeZones::find()->all();
		if(count($arrCoaches) > 0 )
		{
			/*foreach( $arrCoaches as $intIndex => $arrCoach ) {
				$start_date = new DateTime( $arrCoach['available_at']);
				$end_date = new DateTime( $arrCoach['available_until']);
				$start_date->setTimeZone($this->objTimeZone);
				$end_date->setTimeZone($this->objTimeZone);
				$arrCoaches[$intIndex]['available_at'] = $start_date;
				$arrCoaches[$intIndex]['available_until'] = $end_date;
			}*/

			return array('status' => true, 'data'=> $arrCoaches);
		}
		else
		{
			return array('status'=>false,'data'=> 'No Coaches Found');
		}
	}

}