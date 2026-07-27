<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AGFAORUIN
 * 
 * @property int $id
 * @property string|null $MSH_07_RIS_DATE
 * @property string|null $PID_03_PAC_ID
 * @property string|null $PID_04_ALT_PAC_ID
 * @property string|null $PID_05_LNAME
 * @property string|null $PID_05_FNAME
 * @property string|null $PID_07_DOB
 * @property string|null $PID_08_SEX
 * @property string|null $PID_11_STREET
 * @property string|null $PID_12_COD_CITY
 * @property string|null $PID_13_PHONE
 * @property string|null $PID_14_PHONE
 * @property string|null $PV1_02_PAT_CLASS
 * @property string|null $PV1_07_ATT_DOC_ID
 * @property string|null $PV1_07_ATT_DOC_LNAME
 * @property string|null $PV1_07_ATT_DOC_FNAME
 * @property string|null $PV1_08_REF_DOC_ID
 * @property string|null $PV1_08_REF_DOC_LNAME
 * @property string|null $PV1_08_REF_DOC_FNAME
 * @property string|null $PV1_09_CONS_DOC_ID
 * @property string|null $PV1_09_CONS_DOC_LNAME
 * @property string|null $PV1_09_CONS_DOC_FNAME
 * @property string|null $PV1_19_VISIT_NBR
 * @property string|null $ORC_05_STATUS
 * @property string|null $OBR_04_SERV_ID
 * @property string|null $OBR_04_SERV_TXT
 * @property string|null $OBR_07_DATE
 * @property string|null $OBR_25_RES_STATUS
 * @property string|null $OBX_05_OBS
 *
 * @package App\Models
 */
class AGFAORUIN extends Model
{
	protected $table = 'AGFA_ORU_IN';
	public $timestamps = false;

	protected $fillable = [
		'MSH_07_RIS_DATE',
		'PID_03_PAC_ID',
		'PID_04_ALT_PAC_ID',
		'PID_05_LNAME',
		'PID_05_FNAME',
		'PID_07_DOB',
		'PID_08_SEX',
		'PID_11_STREET',
		'PID_12_COD_CITY',
		'PID_13_PHONE',
		'PID_14_PHONE',
		'PV1_02_PAT_CLASS',
		'PV1_07_ATT_DOC_ID',
		'PV1_07_ATT_DOC_LNAME',
		'PV1_07_ATT_DOC_FNAME',
		'PV1_08_REF_DOC_ID',
		'PV1_08_REF_DOC_LNAME',
		'PV1_08_REF_DOC_FNAME',
		'PV1_09_CONS_DOC_ID',
		'PV1_09_CONS_DOC_LNAME',
		'PV1_09_CONS_DOC_FNAME',
		'PV1_19_VISIT_NBR',
		'ORC_05_STATUS',
		'OBR_04_SERV_ID',
		'OBR_04_SERV_TXT',
		'OBR_07_DATE',
		'OBR_25_RES_STATUS',
		'OBX_05_OBS'
	];
}
