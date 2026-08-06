<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionInterconsultaComentario
 * 
 * @property int $id
 * @property int|null $interconsulta_id
 * @property int $creadopor_id
 * @property int $profesional_id
 * @property string $comentario
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * 
 * @property Personal $personal
 * @property InternacionInterconsultum|null $internacion_interconsultum
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class InternacionInterconsultaComentario extends Model
{
	protected $table = 'internacion_interconsulta_comentarios';
	public $timestamps = false;

	protected $casts = [
		'interconsulta_id' => 'int',
		'creadopor_id' => 'int',
		'profesional_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'interconsulta_id',
		'creadopor_id',
		'profesional_id',
		'comentario',
		'borrado_logico'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'profesional_id');
	}

	public function internacion_interconsultum()
	{
		return $this->belongsTo(InternacionInterconsultum::class, 'interconsulta_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}
}
