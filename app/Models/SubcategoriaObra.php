<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubcategoriaObra
 * 
 * @property int $id
 * @property int|null $archivo_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $nombre
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Archivo|null $archivo
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SubcategoriaObra extends Model
{
	protected $table = 'subcategoria_obra';
	public $timestamps = false;

	protected $casts = [
		'archivo_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'archivo_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'nombre',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}
}
