<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionInterconsultaTipo
 * 
 * @property int $id
 * @property int $creadopor_id
 * @property int $modificadopor_id
 * @property string|null $codigo
 * @property string $nombre
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class InternacionInterconsultaTipo extends Model
{
	protected $table = 'internacion_interconsulta_tipos';

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'codigo',
		'nombre',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}
}
