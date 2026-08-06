<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosProrrogaSolicitud
 * 
 * @property int $id
 * @property int|null $solicitud_de_compra_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon $fecha_de_solicitud
 * @property string|null $motivos
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosProrrogaSolicitud extends Model
{
	protected $table = 'suministros_prorroga_solicitud';
	public $timestamps = false;

	protected $casts = [
		'solicitud_de_compra_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha_de_solicitud' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'solicitud_de_compra_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'fecha_de_solicitud',
		'motivos',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
