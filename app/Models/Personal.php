<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Personal
 * 
 * @property int $id
 * @property int $persona_id
 * @property string $matricula_provincial
 * @property string $matricula_nacional
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $etiqueta_id
 * @property string|null $legajo
 * @property string $mail_institucion
 * @property bool $borrado_logico
 * @property string|null $universidad
 * @property string|null $codigo_ad_hoc
 * @property string|null $colegiatura
 * @property string|null $link_videollamada
 * @property string|null $codigoProvinciaMatricula
 * @property string|null $damsuId
 * @property int|null $idCondicionIva
 * 
 * @property CondicionIva|null $condicion_iva
 * @property Persona $persona
 * @property Etiquetum|null $etiquetum
 * @property Collection|AntecedenteNOpatologico[] $antecedente_n_opatologicos
 * @property Collection|Antecedenteheredofamiliar[] $antecedenteheredofamiliars
 * @property Collection|Antecedentepatologico[] $antecedentepatologicos
 * @property Collection|Antecedentequirurgico[] $antecedentequirurgicos
 * @property Collection|AreaPrivada[] $area_privadas
 * @property Collection|Asignacion[] $asignacions
 * @property Collection|Bonocriterio[] $bonocriterios
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|Consultum[] $consulta
 * @property Collection|DebitosYCredito[] $debitos_y_creditos
 * @property Collection|Derivacion[] $derivacions
 * @property Collection|DocumentosHc[] $documentos_hcs
 * @property Collection|InternacionEstudiosInternacion[] $internacion_estudios_internacions
 * @property Collection|InternacionHojaIndicacione[] $internacion_hoja_indicaciones
 * @property Collection|InternacionInterconsultum[] $internacion_interconsulta
 * @property Collection|InternacionInterconsultaComentario[] $internacion_interconsulta_comentarios
 * @property Collection|InternacionOrden[] $internacion_ordens
 * @property Collection|InternacionProfesionalPq[] $internacion_profesional_pqs
 * @property Collection|ItemAutorizacion[] $item_autorizacions
 * @property Collection|MovimientoCaja[] $movimiento_cajas
 * @property Collection|PastoralEvento[] $pastoral_eventos
 * @property Collection|Especialidad[] $especialidads
 * @property Collection|Institucion[] $institucions
 * @property Collection|Personalinterviniente[] $personalintervinientes
 * @property Collection|ProfesionalPlan[] $profesional_plans
 * @property Collection|ReservaQuirofanoProfesional[] $reserva_quirofano_profesionals
 * @property Collection|Solicitudturno[] $solicitudturnos
 * @property Collection|SuministrosPersonalCargoProvisorio[] $suministros_personal_cargo_provisorios
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Personal extends Model
{
	use SoftDeletes;
	protected $table = 'personal';

	protected $casts = [
		'persona_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'etiqueta_id' => 'int',
		'borrado_logico' => 'bool',
		'idCondicionIva' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'matricula_provincial',
		'matricula_nacional',
		'created_by',
		'modified_by',
		'deleted_by',
		'etiqueta_id',
		'legajo',
		'mail_institucion',
		'borrado_logico',
		'universidad',
		'codigo_ad_hoc',
		'colegiatura',
		'link_videollamada',
		'codigoProvinciaMatricula',
		'damsuId',
		'idCondicionIva'
	];

	public function condicion_iva()
	{
		return $this->belongsTo(CondicionIva::class, 'idCondicionIva');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function etiquetum()
	{
		return $this->belongsTo(Etiquetum::class, 'etiqueta_id');
	}

	public function antecedente_n_opatologicos()
	{
		return $this->hasMany(AntecedenteNOpatologico::class);
	}

	public function antecedenteheredofamiliars()
	{
		return $this->hasMany(Antecedenteheredofamiliar::class);
	}

	public function antecedentepatologicos()
	{
		return $this->hasMany(Antecedentepatologico::class);
	}

	public function antecedentequirurgicos()
	{
		return $this->hasMany(Antecedentequirurgico::class);
	}

	public function area_privadas()
	{
		return $this->hasMany(AreaPrivada::class);
	}

	public function asignacions()
	{
		return $this->hasMany(Asignacion::class);
	}

	public function bonocriterios()
	{
		return $this->hasMany(Bonocriterio::class, 'medico_id');
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class, 'medico_solicitante_id');
	}

	public function consulta()
	{
		return $this->hasMany(Consultum::class);
	}

	public function debitos_y_creditos()
	{
		return $this->hasMany(DebitosYCredito::class, 'profesional_id');
	}

	public function derivacions()
	{
		return $this->hasMany(Derivacion::class);
	}

	public function documentos_hcs()
	{
		return $this->hasMany(DocumentosHc::class);
	}

	public function internacion_estudios_internacions()
	{
		return $this->hasMany(InternacionEstudiosInternacion::class);
	}

	public function internacion_hoja_indicaciones()
	{
		return $this->hasMany(InternacionHojaIndicacione::class);
	}

	public function internacion_interconsulta()
	{
		return $this->hasMany(InternacionInterconsultum::class, 'medico_solicitado_id');
	}

	public function internacion_interconsulta_comentarios()
	{
		return $this->hasMany(InternacionInterconsultaComentario::class, 'profesional_id');
	}

	public function internacion_ordens()
	{
		return $this->hasMany(InternacionOrden::class);
	}

	public function internacion_profesional_pqs()
	{
		return $this->hasMany(InternacionProfesionalPq::class, 'profesional_id');
	}

	public function item_autorizacions()
	{
		return $this->hasMany(ItemAutorizacion::class, 'medicoSolicitante_id');
	}

	public function movimiento_cajas()
	{
		return $this->hasMany(MovimientoCaja::class);
	}

	public function pastoral_eventos()
	{
		return $this->hasMany(PastoralEvento::class, 'responsable_id');
	}

	public function especialidads()
	{
		return $this->belongsToMany(Especialidad::class, 'personal_especialidad');
	}

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'personal_institucion');
	}

	public function personalintervinientes()
	{
		return $this->hasMany(Personalinterviniente::class);
	}

	public function profesional_plans()
	{
		return $this->hasMany(ProfesionalPlan::class);
	}

	public function reserva_quirofano_profesionals()
	{
		return $this->hasMany(ReservaQuirofanoProfesional::class);
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class);
	}

	public function suministros_personal_cargo_provisorios()
	{
		return $this->hasMany(SuministrosPersonalCargoProvisorio::class, 'personalreemplazado_id');
	}

	public function usuario()
	{
		return $this->hasOne(Usuario::class);
	}
}
