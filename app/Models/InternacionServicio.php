<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionServicio
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $codigo
 * @property string $descripcion
 * @property string|null $color
 * @property bool $critico
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property string|null $area_pami
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 *
 * @package App\Models
 */
class InternacionServicio extends Model
{
	protected $table = 'internacion_servicio';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'critico' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'codigo',
		'descripcion',
		'color',
		'critico',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'area_pami'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'origen_id');
	}
}
