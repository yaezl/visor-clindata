<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarPrograma
 * 
 * @property int $id
 * @property int|null $origen_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property string|null $codigo
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * @property string|null $codigoIntegracion
 * 
 * @property FarOrigenPrograma|null $far_origen_programa
 * @property Usuario|null $usuario
 * @property Collection|Recepcionalmacen[] $recepcionalmacens
 * @property Collection|StkRecepcionalmacen[] $stk_recepcionalmacens
 *
 * @package App\Models
 */
class FarPrograma extends Model
{
	protected $table = 'far_programa';
	public $timestamps = false;

	protected $casts = [
		'origen_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'origen_id',
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'fecha_inicio',
		'fecha_fin',
		'codigo',
		'observaciones',
		'creado_en',
		'modificado_en',
		'activo',
		'codigoIntegracion'
	];

	public function far_origen_programa()
	{
		return $this->belongsTo(FarOrigenPrograma::class, 'origen_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function recepcionalmacens()
	{
		return $this->hasMany(Recepcionalmacen::class, 'programa_id');
	}

	public function stk_recepcionalmacens()
	{
		return $this->hasMany(StkRecepcionalmacen::class, 'programa_id');
	}
}
