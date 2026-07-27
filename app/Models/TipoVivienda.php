<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoVivienda
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|PersonaVivienda[] $persona_viviendas
 *
 * @package App\Models
 */
class TipoVivienda extends Model
{
	protected $table = 'tipo_vivienda';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function persona_viviendas()
	{
		return $this->hasMany(PersonaVivienda::class, 'tipovivienda_id');
	}
}
