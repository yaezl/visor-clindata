<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaPlansocial
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $plansocial_id
 * @property int|null $origenplansocial_id
 * @property int|null $tipo_beneficiario_id
 * @property int|null $tipo_parentesco_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $observacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $fecha_caducidad
 * @property bool|null $pension
 * @property bool|null $certificado
 * 
 * @property Persona|null $persona
 * @property Plansocial|null $plansocial
 * @property Origenplansocial|null $origenplansocial
 * @property TipoBeneficiario|null $tipo_beneficiario
 * @property TipoParentesco|null $tipo_parentesco
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class PersonaPlansocial extends Model
{
	protected $table = 'persona_plansocial';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'plansocial_id' => 'int',
		'origenplansocial_id' => 'int',
		'tipo_beneficiario_id' => 'int',
		'tipo_parentesco_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'fecha_caducidad' => 'datetime',
		'pension' => 'bool',
		'certificado' => 'bool'
	];

	protected $fillable = [
		'persona_id',
		'plansocial_id',
		'origenplansocial_id',
		'tipo_beneficiario_id',
		'tipo_parentesco_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'fecha_caducidad',
		'pension',
		'certificado'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function plansocial()
	{
		return $this->belongsTo(Plansocial::class);
	}

	public function origenplansocial()
	{
		return $this->belongsTo(Origenplansocial::class);
	}

	public function tipo_beneficiario()
	{
		return $this->belongsTo(TipoBeneficiario::class);
	}

	public function tipo_parentesco()
	{
		return $this->belongsTo(TipoParentesco::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
