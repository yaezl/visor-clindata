<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DependenciaSubCategorium
 * 
 * @property int $id
 * @property int|null $institucion_categoria_id
 * @property int|null $subcategoria_id
 * @property int|null $institucion_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property Collection|RudRud[] $rud_ruds
 *
 * @package App\Models
 */
class DependenciaSubCategorium extends Model
{
	protected $table = 'dependencia_sub_categoria';
	public $timestamps = false;

	protected $casts = [
		'institucion_categoria_id' => 'int',
		'subcategoria_id' => 'int',
		'institucion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'institucion_categoria_id',
		'subcategoria_id',
		'institucion_id',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function rud_ruds()
	{
		return $this->hasMany(RudRud::class, 'dependencia_sub_categoria_id');
	}
}
