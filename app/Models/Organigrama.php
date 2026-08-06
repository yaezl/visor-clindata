<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organigrama
 * 
 * @property int $id
 * @property int|null $institucion_id
 * @property int|null $institucion_padre_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int $nivel
 * @property string|null $descripcion
 * @property int|null $codigo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Organigrama extends Model
{
	protected $table = 'organigrama';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'institucion_padre_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'nivel' => 'int',
		'codigo' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'institucion_id',
		'institucion_padre_id',
		'creado_por_id',
		'modificado_por_id',
		'nivel',
		'descripcion',
		'codigo',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'institucion_padre_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
