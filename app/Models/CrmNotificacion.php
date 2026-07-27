<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmNotificacion
 * 
 * @property int $id
 * @property int $accion_id
 * @property int $referencia
 * @property bool $sms_enviado
 * @property bool $mail_enviado
 * @property bool $llamado_realizado
 * @property Carbon|null $sms_fechahora
 * @property Carbon|null $mail_fechahora
 * @property Carbon|null $llamado_fechahora
 * @property string|null $sms_response
 * @property string|null $mail_response
 * @property string|null $llamado_response
 * @property int $sms_veces_enviado
 * @property int $mail_veces_enviado
 * @property int $llamado_veces_realizado
 * @property Carbon $created_at
 * @property bool $envio_anulado
 * @property Carbon|null $anulacion_fechahora
 * @property bool $whatsapp_enviado
 * @property Carbon|null $whatsapp_fechahora
 * @property string|null $whatsapp_response
 * @property int $whatsapp_veces_enviado
 * @property bool $chattonic_enviado
 * @property Carbon|null $chattonic_fechaHora
 * @property string|null $chattonic_response
 * @property int $chattonic_veces_enviado
 * 
 * @property CrmAccion $crm_accion
 *
 * @package App\Models
 */
class CrmNotificacion extends Model
{
	protected $table = 'crm_notificacion';
	public $timestamps = false;

	protected $casts = [
		'accion_id' => 'int',
		'referencia' => 'int',
		'sms_enviado' => 'bool',
		'mail_enviado' => 'bool',
		'llamado_realizado' => 'bool',
		'sms_fechahora' => 'datetime',
		'mail_fechahora' => 'datetime',
		'llamado_fechahora' => 'datetime',
		'sms_veces_enviado' => 'int',
		'mail_veces_enviado' => 'int',
		'llamado_veces_realizado' => 'int',
		'envio_anulado' => 'bool',
		'anulacion_fechahora' => 'datetime',
		'whatsapp_enviado' => 'bool',
		'whatsapp_fechahora' => 'datetime',
		'whatsapp_veces_enviado' => 'int',
		'chattonic_enviado' => 'bool',
		'chattonic_fechaHora' => 'datetime',
		'chattonic_veces_enviado' => 'int'
	];

	protected $fillable = [
		'accion_id',
		'referencia',
		'sms_enviado',
		'mail_enviado',
		'llamado_realizado',
		'sms_fechahora',
		'mail_fechahora',
		'llamado_fechahora',
		'sms_response',
		'mail_response',
		'llamado_response',
		'sms_veces_enviado',
		'mail_veces_enviado',
		'llamado_veces_realizado',
		'envio_anulado',
		'anulacion_fechahora',
		'whatsapp_enviado',
		'whatsapp_fechahora',
		'whatsapp_response',
		'whatsapp_veces_enviado',
		'chattonic_enviado',
		'chattonic_fechaHora',
		'chattonic_response',
		'chattonic_veces_enviado'
	];

	public function crm_accion()
	{
		return $this->belongsTo(CrmAccion::class, 'accion_id');
	}
}
