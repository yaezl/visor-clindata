<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HcPerinatalDatosBasico
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string|null $domicilio
 * @property string|null $localidad
 * @property string|null $telefono
 * @property Carbon $fecha_nacimiento
 * @property string|null $edad_aproximada
 * @property bool|null $menor_15_mayor_35
 * @property int|null $etnia
 * @property bool|null $alfabeta
 * @property int|null $estudios
 * @property int|null $mayor_nivel
 * @property string|null $estado_civil
 * @property bool|null $vive_sola
 * @property Carbon|null $control_prenatal_en
 * @property Carbon|null $parto_en
 * @property string $documento
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|HcPerinatal[] $hc_perinatals
 *
 * @package App\Models
 */
class HcPerinatalDatosBasico extends Model
{
	protected $table = 'hc_perinatal_datos_basicos';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'fecha_nacimiento' => 'datetime',
		'menor_15_mayor_35' => 'bool',
		'etnia' => 'int',
		'alfabeta' => 'bool',
		'estudios' => 'int',
		'mayor_nivel' => 'int',
		'vive_sola' => 'bool',
		'control_prenatal_en' => 'datetime',
		'parto_en' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'domicilio',
		'localidad',
		'telefono',
		'fecha_nacimiento',
		'edad_aproximada',
		'menor_15_mayor_35',
		'etnia',
		'alfabeta',
		'estudios',
		'mayor_nivel',
		'estado_civil',
		'vive_sola',
		'control_prenatal_en',
		'parto_en',
		'documento',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function hc_perinatals()
	{
		return $this->hasMany(HcPerinatal::class, 'basicos_id');
	}
}
