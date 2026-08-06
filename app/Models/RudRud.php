<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RudRud
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $institucion_id
 * @property int|null $estado_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $descripcion
 * @property Carbon $fecha_pedido
 * @property Carbon|null $fecha_resolucion
 * @property string|null $valorizacion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * @property bool $anonimo
 * @property int|null $dependencia_sub_categoria_id
 * @property int|null $origen_demanda_id
 * @property int|null $demanda_relacionada_id
 * @property int|null $direccion_id
 * @property int|null $institucion_registrante_id
 * @property int|null $gestion_id
 * @property int|null $ambitodelhecho_id
 * @property Carbon|null $fecha_programada
 * @property bool $mail_encurso_enviado
 * @property bool $mail_resuelto_enviado
 * @property Carbon|null $mail_encurso_fechahora
 * @property Carbon|null $mail_resuelto_fechahora
 * @property string|null $mail_encurso_response
 * @property string|null $mail_resuelto_response
 * 
 * @property Persona|null $persona
 * @property Institucion|null $institucion
 * @property AdminGestion|null $admin_gestion
 * @property AdminAmbitoHecho|null $admin_ambito_hecho
 * @property Usuario|null $usuario
 * @property DependenciaSubCategorium|null $dependencia_sub_categorium
 * @property OrigenDemanda|null $origen_demanda
 * @property Direccion|null $direccion
 *
 * @package App\Models
 */
class RudRud extends Model
{
	protected $table = 'rud_rud';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'institucion_id' => 'int',
		'estado_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'fecha_pedido' => 'datetime',
		'fecha_resolucion' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'anonimo' => 'bool',
		'dependencia_sub_categoria_id' => 'int',
		'origen_demanda_id' => 'int',
		'demanda_relacionada_id' => 'int',
		'direccion_id' => 'int',
		'institucion_registrante_id' => 'int',
		'gestion_id' => 'int',
		'ambitodelhecho_id' => 'int',
		'fecha_programada' => 'datetime',
		'mail_encurso_enviado' => 'bool',
		'mail_resuelto_enviado' => 'bool',
		'mail_encurso_fechahora' => 'datetime',
		'mail_resuelto_fechahora' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'institucion_id',
		'estado_id',
		'creado_por_id',
		'modificado_por_id',
		'descripcion',
		'fecha_pedido',
		'fecha_resolucion',
		'valorizacion',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'anonimo',
		'dependencia_sub_categoria_id',
		'origen_demanda_id',
		'demanda_relacionada_id',
		'direccion_id',
		'institucion_registrante_id',
		'gestion_id',
		'ambitodelhecho_id',
		'fecha_programada',
		'mail_encurso_enviado',
		'mail_resuelto_enviado',
		'mail_encurso_fechahora',
		'mail_resuelto_fechahora',
		'mail_encurso_response',
		'mail_resuelto_response'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function admin_gestion()
	{
		return $this->belongsTo(AdminGestion::class, 'gestion_id');
	}

	public function admin_ambito_hecho()
	{
		return $this->belongsTo(AdminAmbitoHecho::class, 'ambitodelhecho_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function dependencia_sub_categorium()
	{
		return $this->belongsTo(DependenciaSubCategorium::class, 'dependencia_sub_categoria_id');
	}

	public function origen_demanda()
	{
		return $this->belongsTo(OrigenDemanda::class);
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}
}
