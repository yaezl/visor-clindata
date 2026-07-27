<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AreaServicio
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $piso_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * 
 * @property Piso|null $piso
 * @property Usuario|null $usuario
 * @property Collection|Agenda[] $agendas
 * @property Collection|Lugar[] $lugars
 *
 * @package App\Models
 */
class AreaServicio extends Model
{
	protected $table = 'area_servicio';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'piso_id' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'piso_id',
		'nombre',
		'codigo',
		'modified_at',
		'borrado_logico'
	];

	public function piso()
	{
		return $this->belongsTo(Piso::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function agendas()
	{
		return $this->hasMany(Agenda::class);
	}

	public function lugars()
	{
		return $this->hasMany(Lugar::class);
	}
}
