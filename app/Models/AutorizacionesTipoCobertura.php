<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesTipoCobertura
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $marca_agua
 * @property bool|null $requiere_autorizacion
 * @property int|null $valor_cobertura
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property int|null $valor_cobertura_discapacidad
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesTipoCobertura|null $autorizaciones_tipo_cobertura
 * @property Collection|AutorizacionesPlanAtpTipocobertura[] $autorizaciones_plan_atp_tipocoberturas
 * @property Collection|AutorizacionesTipoCobertura[] $autorizaciones_tipo_coberturas
 *
 * @package App\Models
 */
class AutorizacionesTipoCobertura extends Model
{
	protected $table = 'autorizaciones_tipo_cobertura';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'requiere_autorizacion' => 'bool',
		'valor_cobertura' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'valor_cobertura_discapacidad' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'marca_agua',
		'requiere_autorizacion',
		'valor_cobertura',
		'modified_at',
		'borrado_logico',
		'valor_cobertura_discapacidad'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_tipo_cobertura()
	{
		return $this->belongsTo(AutorizacionesTipoCobertura::class, 'valor_cobertura_discapacidad');
	}

	public function autorizaciones_plan_atp_tipocoberturas()
	{
		return $this->hasMany(AutorizacionesPlanAtpTipocobertura::class, 'tipocobertura_id');
	}

	public function autorizaciones_tipo_coberturas()
	{
		return $this->hasMany(AutorizacionesTipoCobertura::class, 'valor_cobertura_discapacidad');
	}
}
