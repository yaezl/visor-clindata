<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmVacunaNotificacion
 * 
 * @property int $id
 * @property int|null $aplicacion_vacuna_id
 * @property int|null $persona_id
 * @property bool $sms_enviado
 * @property bool $mail_enviado
 * @property bool $llamado_realizado
 * @property Carbon|null $mail_fechahora
 * @property Carbon|null $sms_fechahora
 * @property Carbon|null $call_fechahora
 * @property string|null $mail_response
 * @property string|null $sms_response
 * @property string|null $call_response
 * 
 * @property HcAplicacionVacuna|null $hc_aplicacion_vacuna
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class CrmVacunaNotificacion extends Model
{
	protected $table = 'crm_vacuna_notificacion';
	public $timestamps = false;

	protected $casts = [
		'aplicacion_vacuna_id' => 'int',
		'persona_id' => 'int',
		'sms_enviado' => 'bool',
		'mail_enviado' => 'bool',
		'llamado_realizado' => 'bool',
		'mail_fechahora' => 'datetime',
		'sms_fechahora' => 'datetime',
		'call_fechahora' => 'datetime'
	];

	protected $fillable = [
		'aplicacion_vacuna_id',
		'persona_id',
		'sms_enviado',
		'mail_enviado',
		'llamado_realizado',
		'mail_fechahora',
		'sms_fechahora',
		'call_fechahora',
		'mail_response',
		'sms_response',
		'call_response'
	];

	public function hc_aplicacion_vacuna()
	{
		return $this->belongsTo(HcAplicacionVacuna::class, 'aplicacion_vacuna_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
