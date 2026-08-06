<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoCamaDestino
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $tipo_cama_destino
 * @property string $nombre
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofanoTipoCamaDestino $internacion_quirofano_tipo_cama_destino
 * @property Collection|ReservaQuirofano[] $reserva_quirofanos
 *
 * @package App\Models
 */
class InternacionQuirofanoCamaDestino extends Model
{
	protected $table = 'internacion_quirofano_cama_destino';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'tipo_cama_destino' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'tipo_cama_destino',
		'nombre',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_tipo_cama_destino()
	{
		return $this->belongsTo(InternacionQuirofanoTipoCamaDestino::class, 'tipo_cama_destino');
	}

	public function reserva_quirofanos()
	{
		return $this->hasMany(ReservaQuirofano::class, 'cama_destino');
	}
}
