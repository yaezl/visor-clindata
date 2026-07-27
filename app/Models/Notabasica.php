<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notabasica
 * 
 * @property int $id
 * @property string|null $examenfisico
 * @property string|null $evoluciontto
 * @property string $motivo_consulta
 * @property int|null $medicion_id
 * @property int|null $medicion_ginecologia_id
 * @property string|null $analisis
 * @property string|null $antecedenteActual
 * @property int|null $pronosticoFuncion
 * @property int|null $pronosticoVida
 * @property int|null $aparatosYSistemas_id
 * @property int|null $exploracionFisica_id
 * @property string|null $resultadosPrevios
 * @property string|null $terapeuticaEmpleada
 * 
 * @property ExploracionFisica|null $exploracion_fisica
 * @property AparatosYSistema|null $aparatos_y_sistema
 * @property Consultadetalle $consultadetalle
 * @property Medicion|null $medicion
 * @property ConsultaMedicionGinecologium|null $consulta_medicion_ginecologium
 * @property Collection|Informedeestudio[] $informedeestudios
 *
 * @package App\Models
 */
class Notabasica extends Model
{
	protected $table = 'notabasica';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'medicion_id' => 'int',
		'medicion_ginecologia_id' => 'int',
		'pronosticoFuncion' => 'int',
		'pronosticoVida' => 'int',
		'aparatosYSistemas_id' => 'int',
		'exploracionFisica_id' => 'int'
	];

	protected $fillable = [
		'examenfisico',
		'evoluciontto',
		'motivo_consulta',
		'medicion_id',
		'medicion_ginecologia_id',
		'analisis',
		'antecedenteActual',
		'pronosticoFuncion',
		'pronosticoVida',
		'aparatosYSistemas_id',
		'exploracionFisica_id',
		'resultadosPrevios',
		'terapeuticaEmpleada'
	];

	public function exploracion_fisica()
	{
		return $this->belongsTo(ExploracionFisica::class, 'exploracionFisica_id');
	}

	public function aparatos_y_sistema()
	{
		return $this->belongsTo(AparatosYSistema::class, 'aparatosYSistemas_id');
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function medicion()
	{
		return $this->belongsTo(Medicion::class);
	}

	public function consulta_medicion_ginecologium()
	{
		return $this->belongsTo(ConsultaMedicionGinecologium::class, 'medicion_ginecologia_id');
	}

	public function informedeestudios()
	{
		return $this->belongsToMany(Informedeestudio::class, 'notabasica_informedeestudio');
	}
}
