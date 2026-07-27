<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Piso
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $institucion_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 * @property Collection|Agenda[] $agendas
 * @property Collection|AreaServicio[] $area_servicios
 *
 * @package App\Models
 */
class Piso extends Model
{
	protected $table = 'piso';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'institucion_id' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'institucion_id',
		'nombre',
		'codigo',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function agendas()
	{
		return $this->hasMany(Agenda::class);
	}

	public function area_servicios()
	{
		return $this->hasMany(AreaServicio::class);
	}
}
