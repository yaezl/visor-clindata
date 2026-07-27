<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipounidadmedida
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|ArticuloTipopresentacion[] $articulo_tipopresentacions
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 *
 * @package App\Models
 */
class Tipounidadmedida extends Model
{
	protected $table = 'tipounidadmedida';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function articulo_tipopresentacions()
	{
		return $this->hasMany(ArticuloTipopresentacion::class);
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'unidadMedida_id');
	}
}
