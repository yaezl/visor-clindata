<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmTurnoNotificacion
 * 
 * @property int $id
 * @property int $turno_id
 * @property bool $sms_enviado
 * @property bool $conf_sms_enviado
 * @property bool $mail_enviado
 * @property bool $conf_mail_enviado
 * @property bool $llamado_realizado
 * @property bool $conf_llamado_realizado
 * @property Carbon|null $mail_fechahora
 * @property Carbon|null $conf_mail_fechahora
 * @property Carbon|null $sms_fechahora
 * @property Carbon|null $conf_sms_fechahora
 * @property Carbon|null $call_fechahora
 * @property Carbon|null $conf_call_fechahora
 * @property string|null $mail_response
 * @property string|null $conf_mail_response
 * @property string|null $sms_response
 * @property string|null $conf_sms_response
 * @property string|null $call_response
 * @property string|null $conf_call_response
 * @property int $veces_notificado
 * @property bool $reprogramacion_sms_enviado
 * @property bool $reprogramacion_mail_enviado
 * @property bool $reprogramacion_llamado_realizado
 * @property Carbon|null $reprogramacion_mail_fechahora
 * @property Carbon|null $reprogramacion_sms_fechahora
 * @property Carbon|null $reprogramacion_call_fechahora
 * @property string|null $reprogramacion_mail_response
 * @property string|null $reprogramacion_sms_response
 * @property string|null $reprogramacion_call_response
 * @property bool $reprogramacion_whatsapp_enviado
 * @property Carbon|null $reprogramacion_whatsapp_fechahora
 * @property string|null $reprogramacion_whatsapp_response
 * @property bool $conf_whatsapp_enviado
 * @property Carbon|null $conf_whatsapp_fechahora
 * @property string|null $confWhatsappResponse
 * @property bool $post_turno_sms_enviado
 * @property Carbon|null $post_turno_sms_fechahora
 * @property string|null $post_turno_sms_response
 * @property bool $post_turno_mail_enviado
 * @property Carbon|null $post_turno_email_fechahora
 * @property string|null $post_turno_email_response
 * @property bool $post_turno_whatsapp_enviado
 * @property Carbon|null $post_turno_whatsapp_fechahora
 * @property string|null $post_turno_whatsapp_response
 * @property bool $post_turno_llamado_realizado
 * @property Carbon|null $post_turno_llamado_fechahora
 * @property string|null $post_turno_llamado_response
 * @property bool $a_demanda
 * @property Carbon|null $post_turno_mail_fechahora
 * @property string|null $post_turno_mail_response
 * @property Carbon|null $llamado_fechahora
 * @property string|null $llamado_response
 * @property Carbon|null $conf_llamado_fechahora
 * @property string|null $conf_llamado_response
 * @property Carbon|null $reprogramacion_llamado_fechahora
 * @property string|null $reprogramacion_llamado_response
 * @property bool $whatsapp_enviado
 * @property Carbon|null $whatsapp_fechahora
 * @property string|null $whatsapp_response
 * @property string|null $conf_whatsapp_response
 * @property bool $chattonic_enviado
 * @property Carbon|null $chattonic_fechahora
 * @property string|null $chattonic_response
 * @property bool $conf_chattonic_enviado
 * @property Carbon|null $conf_chattonic_fechahora
 * @property string|null $conf_chattonic_response
 * @property bool $reprogramacion_chattonic_enviado
 * @property Carbon|null $reprogramacion_chattonic_fechahora
 * @property string|null $reprogramacion_chattonic_response
 * @property bool $post_turno_chattonic_enviado
 * @property Carbon|null $post_turno_chattonic_fechahora
 * @property string|null $post_turno_chattonic_response
 * 
 * @property TurnoProgramado $turno_programado
 *
 * @package App\Models
 */
class CrmTurnoNotificacion extends Model
{
	protected $table = 'crm_turno_notificacion';
	public $timestamps = false;

	protected $casts = [
		'turno_id' => 'int',
		'sms_enviado' => 'bool',
		'conf_sms_enviado' => 'bool',
		'mail_enviado' => 'bool',
		'conf_mail_enviado' => 'bool',
		'llamado_realizado' => 'bool',
		'conf_llamado_realizado' => 'bool',
		'mail_fechahora' => 'datetime',
		'conf_mail_fechahora' => 'datetime',
		'sms_fechahora' => 'datetime',
		'conf_sms_fechahora' => 'datetime',
		'call_fechahora' => 'datetime',
		'conf_call_fechahora' => 'datetime',
		'veces_notificado' => 'int',
		'reprogramacion_sms_enviado' => 'bool',
		'reprogramacion_mail_enviado' => 'bool',
		'reprogramacion_llamado_realizado' => 'bool',
		'reprogramacion_mail_fechahora' => 'datetime',
		'reprogramacion_sms_fechahora' => 'datetime',
		'reprogramacion_call_fechahora' => 'datetime',
		'reprogramacion_whatsapp_enviado' => 'bool',
		'reprogramacion_whatsapp_fechahora' => 'datetime',
		'conf_whatsapp_enviado' => 'bool',
		'conf_whatsapp_fechahora' => 'datetime',
		'post_turno_sms_enviado' => 'bool',
		'post_turno_sms_fechahora' => 'datetime',
		'post_turno_mail_enviado' => 'bool',
		'post_turno_email_fechahora' => 'datetime',
		'post_turno_whatsapp_enviado' => 'bool',
		'post_turno_whatsapp_fechahora' => 'datetime',
		'post_turno_llamado_realizado' => 'bool',
		'post_turno_llamado_fechahora' => 'datetime',
		'a_demanda' => 'bool',
		'post_turno_mail_fechahora' => 'datetime',
		'llamado_fechahora' => 'datetime',
		'conf_llamado_fechahora' => 'datetime',
		'reprogramacion_llamado_fechahora' => 'datetime',
		'whatsapp_enviado' => 'bool',
		'whatsapp_fechahora' => 'datetime',
		'chattonic_enviado' => 'bool',
		'chattonic_fechahora' => 'datetime',
		'conf_chattonic_enviado' => 'bool',
		'conf_chattonic_fechahora' => 'datetime',
		'reprogramacion_chattonic_enviado' => 'bool',
		'reprogramacion_chattonic_fechahora' => 'datetime',
		'post_turno_chattonic_enviado' => 'bool',
		'post_turno_chattonic_fechahora' => 'datetime'
	];

	protected $fillable = [
		'turno_id',
		'sms_enviado',
		'conf_sms_enviado',
		'mail_enviado',
		'conf_mail_enviado',
		'llamado_realizado',
		'conf_llamado_realizado',
		'mail_fechahora',
		'conf_mail_fechahora',
		'sms_fechahora',
		'conf_sms_fechahora',
		'call_fechahora',
		'conf_call_fechahora',
		'mail_response',
		'conf_mail_response',
		'sms_response',
		'conf_sms_response',
		'call_response',
		'conf_call_response',
		'veces_notificado',
		'reprogramacion_sms_enviado',
		'reprogramacion_mail_enviado',
		'reprogramacion_llamado_realizado',
		'reprogramacion_mail_fechahora',
		'reprogramacion_sms_fechahora',
		'reprogramacion_call_fechahora',
		'reprogramacion_mail_response',
		'reprogramacion_sms_response',
		'reprogramacion_call_response',
		'reprogramacion_whatsapp_enviado',
		'reprogramacion_whatsapp_fechahora',
		'reprogramacion_whatsapp_response',
		'conf_whatsapp_enviado',
		'conf_whatsapp_fechahora',
		'confWhatsappResponse',
		'post_turno_sms_enviado',
		'post_turno_sms_fechahora',
		'post_turno_sms_response',
		'post_turno_mail_enviado',
		'post_turno_email_fechahora',
		'post_turno_email_response',
		'post_turno_whatsapp_enviado',
		'post_turno_whatsapp_fechahora',
		'post_turno_whatsapp_response',
		'post_turno_llamado_realizado',
		'post_turno_llamado_fechahora',
		'post_turno_llamado_response',
		'a_demanda',
		'post_turno_mail_fechahora',
		'post_turno_mail_response',
		'llamado_fechahora',
		'llamado_response',
		'conf_llamado_fechahora',
		'conf_llamado_response',
		'reprogramacion_llamado_fechahora',
		'reprogramacion_llamado_response',
		'whatsapp_enviado',
		'whatsapp_fechahora',
		'whatsapp_response',
		'conf_whatsapp_response',
		'chattonic_enviado',
		'chattonic_fechahora',
		'chattonic_response',
		'conf_chattonic_enviado',
		'conf_chattonic_fechahora',
		'conf_chattonic_response',
		'reprogramacion_chattonic_enviado',
		'reprogramacion_chattonic_fechahora',
		'reprogramacion_chattonic_response',
		'post_turno_chattonic_enviado',
		'post_turno_chattonic_fechahora',
		'post_turno_chattonic_response'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}
}
