<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoTipoCamaDestino
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Collection|InternacionQuirofanoCamaDestino[] $internacion_quirofano_cama_destinos
 *
 * @package App\Models
 */
class InternacionQuirofanoTipoCamaDestino extends Model
{
	protected $table = 'internacion_quirofano_tipo_cama_destino';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano_cama_destinos()
	{
		return $this->hasMany(InternacionQuirofanoCamaDestino::class, 'tipo_cama_destino');
	}
}
