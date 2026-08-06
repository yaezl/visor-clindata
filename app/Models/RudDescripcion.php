<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RudDescripcion
 * 
 * @property int $id
 * @property int $rud_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class RudDescripcion extends Model
{
	protected $table = 'rud_descripcion';
	public $timestamps = false;

	protected $casts = [
		'rud_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'rud_id',
		'creado_por_id',
		'modificado_por_id',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
