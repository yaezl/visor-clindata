<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoTipoAnestesium
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Collection|ReservaQuirofano[] $reserva_quirofanos
 *
 * @package App\Models
 */
class InternacionQuirofanoTipoAnestesium extends Model
{
	protected $table = 'internacion_quirofano_tipo_anestesia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function reserva_quirofanos()
	{
		return $this->hasMany(ReservaQuirofano::class, 'tipo_anestesia');
	}
}
