<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AGFAORMOUT
 * 
 * @property int $id
 * @property Carbon|null $ORM_01_HIS_DATE
 * @property Carbon|null $MSH_06_RIS_DATE
 * @property Carbon|null $MSH_06_RIS_TRANS_DATE
 * @property string|null $ORC_04_QP_REQ_ID
 * @property string|null $ORC_21_QP_SERV_ID
 * @property string|null $ORC_10_QP_USER_RIS
 * @property string|null $ORC_25_QP_STATUS
 * @property string|null $OBR_16_QP_MED_ID
 * @property Carbon|null $OBR_6_QP_REQ_DATE
 * @property string|null $PID_01_ID
 * @property string|null $PID_02_ID
 * @property string|null $PID_03_ID
 * @property string|null $PV1_18_PTYPE
 * @property string|null $OBR_04_EXAM_CODE
 * @property string|null $OBR_04_EXAM_DESC
 * @property string|null $OBR_02_QP_EXAM_ID
 * @property string|null $OBR_31_PREST_INFO
 * @property string|null $OBR_13_ORDER_INFO
 * @property string|null $OBR_18_ACC_NUMBER
 * @property Carbon|null $OBR_07_EXAM_DATE
 * @property string|null $OBR_32_EXECUTE_ID
 * @property string|null $ORM_02_STATUS_HIS
 * @property string|null $ORM_03_BILLING_CODE
 * @property string|null $ORC_3_2_PERF_DEPT
 * @property string|null $OBR_34_ROOM
 *
 * @package App\Models
 */
class AGFAORMOUT extends Model
{
	protected $table = 'AGFA_ORM_OUT';
	public $timestamps = false;

	protected $casts = [
		'ORM_01_HIS_DATE' => 'datetime',
		'MSH_06_RIS_DATE' => 'datetime',
		'MSH_06_RIS_TRANS_DATE' => 'datetime',
		'OBR_6_QP_REQ_DATE' => 'datetime',
		'OBR_07_EXAM_DATE' => 'datetime'
	];

	protected $fillable = [
		'ORM_01_HIS_DATE',
		'MSH_06_RIS_DATE',
		'MSH_06_RIS_TRANS_DATE',
		'ORC_04_QP_REQ_ID',
		'ORC_21_QP_SERV_ID',
		'ORC_10_QP_USER_RIS',
		'ORC_25_QP_STATUS',
		'OBR_16_QP_MED_ID',
		'OBR_6_QP_REQ_DATE',
		'PID_01_ID',
		'PID_02_ID',
		'PID_03_ID',
		'PV1_18_PTYPE',
		'OBR_04_EXAM_CODE',
		'OBR_04_EXAM_DESC',
		'OBR_02_QP_EXAM_ID',
		'OBR_31_PREST_INFO',
		'OBR_13_ORDER_INFO',
		'OBR_18_ACC_NUMBER',
		'OBR_07_EXAM_DATE',
		'OBR_32_EXECUTE_ID',
		'ORM_02_STATUS_HIS',
		'ORM_03_BILLING_CODE',
		'ORC_3_2_PERF_DEPT',
		'OBR_34_ROOM'
	];
}
