<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionDiagnosticoPq
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $parte_id
 * @property int|null $diagnostico_id
 * @property int $borrado_logico
 * @property int $pre_quirurgico
 * 
 * @property Usuario|null $usuario
 * @property InternacionParteQuirurgico|null $internacion_parte_quirurgico
 * @property Diagnostico|null $diagnostico
 *
 * @package App\Models
 */
class InternacionDiagnosticoPq extends Model
{
	protected $table = 'internacion_diagnostico_pq';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'parte_id' => 'int',
		'diagnostico_id' => 'int',
		'borrado_logico' => 'int',
		'pre_quirurgico' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'parte_id',
		'diagnostico_id',
		'borrado_logico',
		'pre_quirurgico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_id');
	}

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class);
	}
}
