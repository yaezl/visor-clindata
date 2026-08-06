<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporteconfig
 * 
 * @property int $id
 * @property int|null $reporte_id
 * @property int|null $institucion_id
 * @property int|null $modulo_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property string $seccion
 * @property string $etiqueta
 * 
 * @property Reporte|null $reporte
 * @property Institucion|null $institucion
 * @property Modulo|null $modulo
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Reporteconfig extends Model
{
	protected $table = 'reporteconfig';
	public $timestamps = false;

	protected $casts = [
		'reporte_id' => 'int',
		'institucion_id' => 'int',
		'modulo_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'reporte_id',
		'institucion_id',
		'modulo_id',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en',
		'seccion',
		'etiqueta'
	];

	public function reporte()
	{
		return $this->belongsTo(Reporte::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function modulo()
	{
		return $this->belongsTo(Modulo::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}
}
