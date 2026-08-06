<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminNoticium
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $volanta
 * @property string $titulo
 * @property string|null $bajada
 * @property string|null $contenido
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * @property int|null $imagen_id
 * @property bool|null $es_principal
 * @property bool|null $muestro_en_pantalla
 * 
 * @property Usuario|null $usuario
 * @property Archivo|null $archivo
 *
 * @package App\Models
 */
class AdminNoticium extends Model
{
	protected $table = 'admin_noticia';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'imagen_id' => 'int',
		'es_principal' => 'bool',
		'muestro_en_pantalla' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'volanta',
		'titulo',
		'bajada',
		'contenido',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'imagen_id',
		'es_principal',
		'muestro_en_pantalla'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'imagen_id');
	}
}
