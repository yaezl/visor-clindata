<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEstudioPq
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $parte_id
 * @property int|null $estudio_id
 * @property int $borrado_logico
 * @property string|null $codigo
 * @property int $es_principal
 * @property string|null $observacion_procedimiento
 * @property string|null $numero_autorizacion
 * 
 * @property Usuario|null $usuario
 * @property InternacionParteQuirurgico|null $internacion_parte_quirurgico
 * @property Estudio|null $estudio
 * @property Collection|BonoPartequirurgico[] $bono_partequirurgicos
 *
 * @package App\Models
 */
class InternacionEstudioPq extends Model
{
	protected $table = 'internacion_estudio_pq';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'parte_id' => 'int',
		'estudio_id' => 'int',
		'borrado_logico' => 'int',
		'es_principal' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'parte_id',
		'estudio_id',
		'borrado_logico',
		'codigo',
		'es_principal',
		'observacion_procedimiento',
		'numero_autorizacion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function bono_partequirurgicos()
	{
		return $this->hasMany(BonoPartequirurgico::class, 'estudiopartequirurgico_id');
	}
}
