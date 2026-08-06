<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DebitosYCredito
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int|null $profesional_id
 * @property int|null $item_bono_id
 * @property int|null $iva_id
 * @property int|null $tipo_practica_id
 * @property int $tipo
 * @property string|null $concepto
 * @property Carbon $fecha
 * @property float $importe
 * @property float $honorario
 * @property float $gasto
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Personal|null $personal
 * @property ItemBono|null $item_bono
 * @property Tipopractica|null $tipopractica
 * @property TipoPlan|null $tipo_plan
 *
 * @package App\Models
 */
class DebitosYCredito extends Model
{
	protected $table = 'debitos_y_creditos';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'profesional_id' => 'int',
		'item_bono_id' => 'int',
		'iva_id' => 'int',
		'tipo_practica_id' => 'int',
		'tipo' => 'int',
		'fecha' => 'datetime',
		'importe' => 'float',
		'honorario' => 'float',
		'gasto' => 'float',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'profesional_id',
		'item_bono_id',
		'iva_id',
		'tipo_practica_id',
		'tipo',
		'concepto',
		'fecha',
		'importe',
		'honorario',
		'gasto',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'profesional_id');
	}

	public function item_bono()
	{
		return $this->belongsTo(ItemBono::class);
	}

	public function tipopractica()
	{
		return $this->belongsTo(Tipopractica::class, 'tipo_practica_id');
	}

	public function tipo_plan()
	{
		return $this->belongsTo(TipoPlan::class, 'iva_id');
	}
}
