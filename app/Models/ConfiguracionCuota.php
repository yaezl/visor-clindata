<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfiguracionCuota
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int|null $institucion_id
 * @property int|null $tarjetadepago_id
 * @property string $cantidad_cuotas
 * @property string $porcentaje_intereses
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario $usuario
 * @property Tarjetadepago|null $tarjetadepago
 * @property Institucion|null $institucion
 * @property Collection|Pagocontarjetacredito[] $pagocontarjetacreditos
 *
 * @package App\Models
 */
class ConfiguracionCuota extends Model
{
	protected $table = 'configuracion_cuotas';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'institucion_id' => 'int',
		'tarjetadepago_id' => 'int',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'institucion_id',
		'tarjetadepago_id',
		'cantidad_cuotas',
		'porcentaje_intereses',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function tarjetadepago()
	{
		return $this->belongsTo(Tarjetadepago::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function pagocontarjetacreditos()
	{
		return $this->hasMany(Pagocontarjetacredito::class, 'configuracion_cuotas_id');
	}
}
