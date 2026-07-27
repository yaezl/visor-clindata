<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarOrigenPrograma
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string|null $codigo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property Collection|FarPrograma[] $far_programas
 *
 * @package App\Models
 */
class FarOrigenPrograma extends Model
{
	protected $table = 'far_origen_programa';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'codigo',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function far_programas()
	{
		return $this->hasMany(FarPrograma::class, 'origen_id');
	}
}
