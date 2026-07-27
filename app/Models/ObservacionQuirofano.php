<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ObservacionQuirofano
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property string|null $observacion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class ObservacionQuirofano extends Model
{
	protected $table = 'observacion_quirofanos';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}
}
