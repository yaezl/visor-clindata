<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AGFAADT
 * 
 * @property int $MSH_10_ID
 * @property string $MSH_STATUS
 * @property string|null $MSH_MESSAGE
 * @property string $EVN_01_TYPECODE
 * @property Carbon $EVN_02_RECDATE
 * @property int $PID_01_ID
 * @property string $PID_02_ID
 * @property string|null $PID_03_ID
 * @property string $PID_05_LNAMEF
 * @property string $PID_05_LNAMEM
 * @property string $PID_05_FNAME
 * @property Carbon $PID_07_DOB
 * @property string $PID_08_SEX
 * @property string $PID_11_STREET
 * @property string $PID_12_TOWN
 * @property string $PID_11_CITY
 * @property string|null $PID_13_PHONE
 * @property string|null $PID_13_PHONE2
 * @property string $PID_16_MARITSTAT
 * @property string|null $PID_19_EMAIL
 * @property string $PID_28_NATIONALITY
 * @property int|null $MRG_01_OLDPID
 * @property string|null $NK1_02_FNAME
 * @property string|null $PV1_18_STATUS
 * @property string|null $PV1_03_LOCATION
 * @property string|null $PV1_03_BED
 * @property string|null $PV1_03_ROOM
 * @property string|null $PV1_04_ADMTYPE
 * @property string|null $PV1_07_ATTDOC
 * @property string|null $PV1_19_VISITNR
 * @property string|null $PV1_19_REMARKS
 * @property Carbon|null $PV1_44_ADMITDATE
 * @property Carbon|null $PV1_45_DISCHARGEDATE
 * @property string|null $PID_11_STREET_NRO
 * @property string|null $PID_13_PHONE2_CODE
 * @property string|null $PID_31_ID
 * @property string $MSH_STATUS_RIS
 * @property string $MSH_STATUS_ADT
 *
 * @package App\Models
 */
class AGFAADT extends Model
{
	protected $table = 'AGFA_ADT';
	protected $primaryKey = 'MSH_10_ID';
	public $timestamps = false;

	protected $casts = [
		'EVN_02_RECDATE' => 'datetime',
		'PID_01_ID' => 'int',
		'PID_07_DOB' => 'datetime',
		'MRG_01_OLDPID' => 'int',
		'PV1_44_ADMITDATE' => 'datetime',
		'PV1_45_DISCHARGEDATE' => 'datetime'
	];

	protected $fillable = [
		'MSH_STATUS',
		'MSH_MESSAGE',
		'EVN_01_TYPECODE',
		'EVN_02_RECDATE',
		'PID_01_ID',
		'PID_02_ID',
		'PID_03_ID',
		'PID_05_LNAMEF',
		'PID_05_LNAMEM',
		'PID_05_FNAME',
		'PID_07_DOB',
		'PID_08_SEX',
		'PID_11_STREET',
		'PID_12_TOWN',
		'PID_11_CITY',
		'PID_13_PHONE',
		'PID_13_PHONE2',
		'PID_16_MARITSTAT',
		'PID_19_EMAIL',
		'PID_28_NATIONALITY',
		'MRG_01_OLDPID',
		'NK1_02_FNAME',
		'PV1_18_STATUS',
		'PV1_03_LOCATION',
		'PV1_03_BED',
		'PV1_03_ROOM',
		'PV1_04_ADMTYPE',
		'PV1_07_ATTDOC',
		'PV1_19_VISITNR',
		'PV1_19_REMARKS',
		'PV1_44_ADMITDATE',
		'PV1_45_DISCHARGEDATE',
		'PID_11_STREET_NRO',
		'PID_13_PHONE2_CODE',
		'PID_31_ID',
		'MSH_STATUS_RIS',
		'MSH_STATUS_ADT'
	];
}
