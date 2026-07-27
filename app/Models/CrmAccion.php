<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmAccion
 * 
 * @property int $id
 * @property int $creadopor_id
 * @property int $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $titulo
 * @property string|null $descripcion
 * @property string $imagen_tarjeta
 * @property string $codigo
 * @property bool $activa
 * @property bool $usa_email
 * @property bool $usa_sms
 * @property bool $usa_llamado
 * @property bool $activar_email
 * @property bool $activar_sms
 * @property bool $activar_llamado
 * @property string $emailCodigoTemplate
 * @property string $email_from
 * @property string $sms_from
 * @property string $call_from
 * @property string $sms_message_template
 * @property string $call_message_template
 * @property string $call_url
 * @property Carbon $hora_inicio
 * @property Carbon $hora_fin
 * @property string|null $opciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $extra_query
 * @property bool $envio_simultaneo
 * @property bool $usa_whatsapp
 * @property bool $activar_whatsapp
 * @property string|null $prioridad_accion
 * @property string $whatsappCodigoTemplate
 * @property string $whatsappCodigoIdiomaTemplate
 * @property string|null $parametrosTemplateWhatsapp
 * @property string|null $email_replyTo
 * @property bool $usa_chattonic
 * @property bool $activar_chattonic
 * @property string $chattonic_codigo_template
 * @property string|null $parametros_template_chattonic
 * @property bool $whatsAppTemplateButtonUrl
 * 
 * @property Collection|CrmNotificacion[] $crm_notificacions
 *
 * @package App\Models
 */
class CrmAccion extends Model
{
	protected $table = 'crm_accion';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'activa' => 'bool',
		'usa_email' => 'bool',
		'usa_sms' => 'bool',
		'usa_llamado' => 'bool',
		'activar_email' => 'bool',
		'activar_sms' => 'bool',
		'activar_llamado' => 'bool',
		'hora_inicio' => 'datetime',
		'hora_fin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'envio_simultaneo' => 'bool',
		'usa_whatsapp' => 'bool',
		'activar_whatsapp' => 'bool',
		'usa_chattonic' => 'bool',
		'activar_chattonic' => 'bool',
		'whatsAppTemplateButtonUrl' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'titulo',
		'descripcion',
		'imagen_tarjeta',
		'codigo',
		'activa',
		'usa_email',
		'usa_sms',
		'usa_llamado',
		'activar_email',
		'activar_sms',
		'activar_llamado',
		'emailCodigoTemplate',
		'email_from',
		'sms_from',
		'call_from',
		'sms_message_template',
		'call_message_template',
		'call_url',
		'hora_inicio',
		'hora_fin',
		'opciones',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'extra_query',
		'envio_simultaneo',
		'usa_whatsapp',
		'activar_whatsapp',
		'prioridad_accion',
		'whatsappCodigoTemplate',
		'whatsappCodigoIdiomaTemplate',
		'parametrosTemplateWhatsapp',
		'email_replyTo',
		'usa_chattonic',
		'activar_chattonic',
		'chattonic_codigo_template',
		'parametros_template_chattonic',
		'whatsAppTemplateButtonUrl'
	];

	public function crm_notificacions()
	{
		return $this->hasMany(CrmNotificacion::class, 'accion_id');
	}
}
