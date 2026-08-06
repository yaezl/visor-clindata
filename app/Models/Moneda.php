<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Moneda
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property string $signo
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|Conversion[] $conversions
 * @property Collection|Institucion[] $institucions
 * @property Collection|Movimiento[] $movimientos
 * @property Collection|Plan[] $plans
 * @property Collection|Recibopago[] $recibopagos
 *
 * @package App\Models
 */
class Moneda extends Model
{
	protected $table = 'moneda';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'signo',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function conversions()
	{
		return $this->hasMany(Conversion::class, 'moneda_destino_id');
	}

	public function institucions()
	{
		return $this->hasMany(Institucion::class, 'moneda_por_defecto_id');
	}

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class);
	}

	public function plans()
	{
		return $this->hasMany(Plan::class, 'moneda_deuda_id');
	}

	public function recibopagos()
	{
		return $this->hasMany(Recibopago::class);
	}
}
