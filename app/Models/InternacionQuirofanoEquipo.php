<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoEquipo
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property int $cantidad
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Collection|ReservaQuirofanoEquipo[] $reserva_quirofano_equipos
 *
 * @package App\Models
 */
class InternacionQuirofanoEquipo extends Model
{
	protected $table = 'internacion_quirofano_equipo';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'cantidad' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'cantidad',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function reserva_quirofano_equipos()
	{
		return $this->hasMany(ReservaQuirofanoEquipo::class, 'equipo_id');
	}
}
