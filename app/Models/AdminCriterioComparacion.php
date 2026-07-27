<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminCriterioComparacion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $descripcion
 * @property string $operador
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|AdminConfiguracionTemporal[] $admin_configuracion_temporals
 *
 * @package App\Models
 */
class AdminCriterioComparacion extends Model
{
	protected $table = 'admin_criterio_comparacion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'descripcion',
		'operador',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function admin_configuracion_temporals()
	{
		return $this->hasMany(AdminConfiguracionTemporal::class, 'criterio_comparacion_id');
	}
}
