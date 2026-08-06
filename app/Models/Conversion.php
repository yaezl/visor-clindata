<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Conversion
 * 
 * @property int $id
 * @property int $created_by
 * @property int $institucion_id
 * @property int $moneda_destino_id
 * @property int $moneda_origen_id
 * @property int $modified_by
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property string $multiplicador
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Moneda $moneda
 * @property Usuario $usuario
 * @property Institucion $institucion
 * @property Collection|Movimiento[] $movimientos
 * @property Collection|Recibopago[] $recibopagos
 *
 * @package App\Models
 */
class Conversion extends Model
{
	protected $table = 'conversion';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'institucion_id' => 'int',
		'moneda_destino_id' => 'int',
		'moneda_origen_id' => 'int',
		'modified_by' => 'int',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'institucion_id',
		'moneda_destino_id',
		'moneda_origen_id',
		'modified_by',
		'inicio_vigencia',
		'fin_vigencia',
		'multiplicador',
		'modified_at',
		'borrado_logico'
	];

	public function moneda()
	{
		return $this->belongsTo(Moneda::class, 'moneda_destino_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class);
	}

	public function recibopagos()
	{
		return $this->hasMany(Recibopago::class);
	}
}
