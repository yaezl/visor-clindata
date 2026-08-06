<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Familium
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property string|null $observacion
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $jefeDeFamilia_id
 * 
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Collection|Familiarelacion[] $familiarelacions
 *
 * @package App\Models
 */
class Familium extends Model
{
	protected $table = 'familia';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'jefeDeFamilia_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'observacion',
		'fecha_inicio',
		'fecha_fin',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'jefeDeFamilia_id'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'jefeDeFamilia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function familiarelacions()
	{
		return $this->hasMany(Familiarelacion::class, 'familia_id');
	}
}
