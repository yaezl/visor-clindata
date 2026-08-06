<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lugar
 * 
 * @property int $id
 * @property int|null $comportamiento_id
 * @property string $nombre
 * @property string|null $notas
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $turnero_id
 * @property int|null $area_servicio_id
 * @property string|null $codigo
 * @property int|null $almacen_id
 * 
 * @property AreaServicio|null $area_servicio
 * @property Almacen|null $almacen
 * @property Comportamiento|null $comportamiento
 * @property Turnero|null $turnero
 * @property Collection|Agenda[] $agendas
 * @property Collection|Totem[] $totems
 *
 * @package App\Models
 */
class Lugar extends Model
{
	use SoftDeletes;
	protected $table = 'lugar';

	protected $casts = [
		'comportamiento_id' => 'int',
		'borrado_logico' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'turnero_id' => 'int',
		'area_servicio_id' => 'int',
		'almacen_id' => 'int'
	];

	protected $fillable = [
		'comportamiento_id',
		'nombre',
		'notas',
		'borrado_logico',
		'created_by',
		'modified_by',
		'deleted_by',
		'turnero_id',
		'area_servicio_id',
		'codigo',
		'almacen_id'
	];

	public function area_servicio()
	{
		return $this->belongsTo(AreaServicio::class);
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function comportamiento()
	{
		return $this->belongsTo(Comportamiento::class);
	}

	public function turnero()
	{
		return $this->belongsTo(Turnero::class);
	}

	public function agendas()
	{
		return $this->hasMany(Agenda::class);
	}

	public function totems()
	{
		return $this->hasMany(Totem::class);
	}
}
