<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionTipoEgreso
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon|null $borrado_en
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property string|null $codigo
 * 
 * @property Usuario|null $usuario
 * @property Collection|InternacionMovimiento[] $internacion_movimientos
 *
 * @package App\Models
 */
class InternacionTipoEgreso extends Model
{
	protected $table = 'internacion_tipo_egreso';
	public $timestamps = false;

	protected $casts = [
		'borrado_en' => 'datetime',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'borrado_en',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'creado_en',
		'modificado_en',
		'codigo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_movimientos()
	{
		return $this->hasMany(InternacionMovimiento::class, 'tipo_egreso_id');
	}
}
