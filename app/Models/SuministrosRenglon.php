<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosRenglon
 * 
 * @property int $id
 * @property int|null $orden_de_compra_id
 * @property int|null $suministro_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int|null $entregadopor_id
 * @property float $cantidad
 * @property string|null $descripcion
 * @property float $precio
 * @property float|null $precioReal
 * @property string|null $estado
 * @property bool|null $entregado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $entregado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosRenglon extends Model
{
	protected $table = 'suministros_renglon';
	public $timestamps = false;

	protected $casts = [
		'orden_de_compra_id' => 'int',
		'suministro_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'entregadopor_id' => 'int',
		'cantidad' => 'float',
		'precio' => 'float',
		'precioReal' => 'float',
		'entregado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'entregado_en' => 'datetime'
	];

	protected $fillable = [
		'orden_de_compra_id',
		'suministro_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'entregadopor_id',
		'cantidad',
		'descripcion',
		'precio',
		'precioReal',
		'estado',
		'entregado',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'entregado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'entregadopor_id');
	}
}
