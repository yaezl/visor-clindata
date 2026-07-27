<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosComentariosOrden
 * 
 * @property int $id
 * @property int|null $orden_de_compra_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string|null $comentarios
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosComentariosOrden extends Model
{
	protected $table = 'suministros_comentarios_orden';
	public $timestamps = false;

	protected $casts = [
		'orden_de_compra_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'orden_de_compra_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'comentarios',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
