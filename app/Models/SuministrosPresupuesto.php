<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosPresupuesto
 * 
 * @property int $id
 * @property int|null $solicitud_de_compra_id
 * @property int|null $orden_de_compra_id
 * @property int|null $pagos_cabecera_id
 * @property int|null $proveedor_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminado_por_id
 * @property string|null $comentario
 * @property bool $activo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosPresupuesto extends Model
{
	protected $table = 'suministros_presupuestos';
	public $timestamps = false;

	protected $casts = [
		'solicitud_de_compra_id' => 'int',
		'orden_de_compra_id' => 'int',
		'pagos_cabecera_id' => 'int',
		'proveedor_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminado_por_id' => 'int',
		'activo' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'solicitud_de_compra_id',
		'orden_de_compra_id',
		'pagos_cabecera_id',
		'proveedor_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminado_por_id',
		'comentario',
		'activo',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
