<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diagnostico
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property int $created_by
 * @property int|null $tipo_id
 * @property int|null $subtipo_id
 * @property string|null $codigocie10
 * @property string|null $codigocie10sinonimo
 * @property bool $es_patologico
 * @property int|null $clase_id
 * @property string|null $infoparaelpaciente
 * @property bool $auditado
 * @property string|null $codigosnomedct
 * @property string|null $codigociap2
 * @property bool $borrado_logico
 * 
 * @property Tipodiagnostico|null $tipodiagnostico
 * @property Subtipodiagnostico|null $subtipodiagnostico
 * @property Clasediagnostico|null $clasediagnostico
 * @property Collection|AntecPerinatalDiagnostico[] $antec_perinatal_diagnosticos
 * @property Collection|Antecedenteheredofamiliar[] $antecedenteheredofamiliars
 * @property Collection|Antecedentepatologico[] $antecedentepatologicos
 * @property Collection|Auditoriadiagnostico[] $auditoriadiagnosticos
 * @property Collection|AutorizacionesDiagnostico[] $autorizaciones_diagnosticos
 * @property Collection|DiagnosticoDetalle[] $diagnostico_detalles
 * @property Collection|HojaIngresoDiagnostico[] $hoja_ingreso_diagnosticos
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|InternacionDefuncion[] $internacion_defuncions
 * @property Collection|InternacionDiagnosticoPq[] $internacion_diagnostico_pqs
 * @property Collection|MovimientoInternacionDiagnostico[] $movimiento_internacion_diagnosticos
 * @property Collection|SignoFisioterapium[] $signo_fisioterapia
 * @property Collection|TurnoDiagnostico[] $turno_diagnosticos
 *
 * @package App\Models
 */
class Diagnostico extends Model
{
	protected $table = 'diagnostico';

	protected $casts = [
		'modified_by' => 'int',
		'created_by' => 'int',
		'tipo_id' => 'int',
		'subtipo_id' => 'int',
		'es_patologico' => 'bool',
		'clase_id' => 'int',
		'auditado' => 'bool',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'categoria',
		'modified_by',
		'created_by',
		'tipo_id',
		'subtipo_id',
		'codigocie10',
		'codigocie10sinonimo',
		'es_patologico',
		'clase_id',
		'infoparaelpaciente',
		'auditado',
		'codigosnomedct',
		'codigociap2',
		'borrado_logico'
	];

	public function tipodiagnostico()
	{
		return $this->belongsTo(Tipodiagnostico::class, 'tipo_id');
	}

	public function subtipodiagnostico()
	{
		return $this->belongsTo(Subtipodiagnostico::class, 'subtipo_id');
	}

	public function clasediagnostico()
	{
		return $this->belongsTo(Clasediagnostico::class, 'clase_id');
	}

	public function antec_perinatal_diagnosticos()
	{
		return $this->hasMany(AntecPerinatalDiagnostico::class);
	}

	public function antecedenteheredofamiliars()
	{
		return $this->hasMany(Antecedenteheredofamiliar::class);
	}

	public function antecedentepatologicos()
	{
		return $this->hasMany(Antecedentepatologico::class);
	}

	public function auditoriadiagnosticos()
	{
		return $this->hasMany(Auditoriadiagnostico::class);
	}

	public function autorizaciones_diagnosticos()
	{
		return $this->hasMany(AutorizacionesDiagnostico::class);
	}

	public function diagnostico_detalles()
	{
		return $this->hasMany(DiagnosticoDetalle::class);
	}

	public function hoja_ingreso_diagnosticos()
	{
		return $this->hasMany(HojaIngresoDiagnostico::class);
	}

	public function informedeestudios()
	{
		return $this->hasMany(Informedeestudio::class);
	}

	public function internacion_defuncions()
	{
		return $this->hasMany(InternacionDefuncion::class, 'diagnostico_final_id');
	}

	public function internacion_diagnostico_pqs()
	{
		return $this->hasMany(InternacionDiagnosticoPq::class);
	}

	public function movimiento_internacion_diagnosticos()
	{
		return $this->hasMany(MovimientoInternacionDiagnostico::class);
	}

	public function signo_fisioterapia()
	{
		return $this->hasMany(SignoFisioterapium::class);
	}

	public function turno_diagnosticos()
	{
		return $this->hasMany(TurnoDiagnostico::class);
	}
}