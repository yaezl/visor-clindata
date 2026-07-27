<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bono
 * 
 * @property int $id
 * @property int|null $turnoprogramado_id
 * @property int|null $turnoguardia_id
 * @property int|null $persona_internacion_id
 * @property string $numero
 * @property int $estado
 * @property int|null $tipobono_id
 * @property int|null $bono_related_id
 * @property bool $a_refacturar
 * @property int|null $plan_id
 * @property int|null $persona_id
 * @property Carbon $fecha
 * @property string $numero_autorizacion
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property int|null $institucion_id
 * @property Carbon|null $confirmado_en
 * @property int|null $condicion_iva
 * @property bool $a_liquidar
 * @property Carbon|null $liquidadoEn
 * @property Carbon|null $liquidadoEnMensual
 * @property string $nro_beneficiario
 * @property int|null $recargo_id
 * 
 * @property TipoPlan|null $tipo_plan
 * @property Recargo|null $recargo
 * @property TurnoProgramado|null $turno_programado
 * @property Institucion|null $institucion
 * @property TurnoGuardium|null $turno_guardium
 * @property InternacionPersona|null $internacion_persona
 * @property Tipobono|null $tipobono
 * @property Bono|null $bono
 * @property Plan|null $plan
 * @property Persona|null $persona
 * @property Usuario|null $usuario
 * @property Collection|Bono[] $bonos
 * @property Collection|BonoDetallesolicitud[] $bono_detallesolicituds
 * @property Collection|BonoEstudiointernacion[] $bono_estudiointernacions
 * @property Collection|BonoHojaconsumo[] $bono_hojaconsumos
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|BonoMedicamentopartequirurgico[] $bono_medicamentopartequirurgicos
 * @property Collection|BonoPartequirurgico[] $bono_partequirurgicos
 * @property Bonocriterio|null $bonocriterio
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|Envioapersona[] $envioapersonas
 * @property Collection|ItemBono[] $item_bonos
 * @property Collection|Notaitem[] $notaitems
 * @property Collection|PagoQr[] $pago_qrs
 * @property Collection|Prefacturaitem[] $prefacturaitems
 *
 * @package App\Models
 */
class Bono extends Model
{
	protected $table = 'bono';
	public $timestamps = false;

	protected $casts = [
		'turnoprogramado_id' => 'int',
		'turnoguardia_id' => 'int',
		'persona_internacion_id' => 'int',
		'estado' => 'int',
		'tipobono_id' => 'int',
		'bono_related_id' => 'int',
		'a_refacturar' => 'bool',
		'plan_id' => 'int',
		'persona_id' => 'int',
		'fecha' => 'datetime',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'institucion_id' => 'int',
		'confirmado_en' => 'datetime',
		'condicion_iva' => 'int',
		'a_liquidar' => 'bool',
		'liquidadoEn' => 'datetime',
		'liquidadoEnMensual' => 'datetime',
		'recargo_id' => 'int'
	];

	protected $fillable = [
		'turnoprogramado_id',
		'turnoguardia_id',
		'persona_internacion_id',
		'numero',
		'estado',
		'tipobono_id',
		'bono_related_id',
		'a_refacturar',
		'plan_id',
		'persona_id',
		'fecha',
		'numero_autorizacion',
		'creadopor_id',
		'modificadopor_id',
		'creado_en',
		'modificado_en',
		'institucion_id',
		'confirmado_en',
		'condicion_iva',
		'a_liquidar',
		'liquidadoEn',
		'liquidadoEnMensual',
		'nro_beneficiario',
		'recargo_id'
	];

	public function tipo_plan()
	{
		return $this->belongsTo(TipoPlan::class, 'condicion_iva');
	}

	public function recargo()
	{
		return $this->belongsTo(Recargo::class);
	}

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turnoprogramado_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function turno_guardium()
	{
		return $this->belongsTo(TurnoGuardium::class, 'turnoguardia_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function tipobono()
	{
		return $this->belongsTo(Tipobono::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class, 'bono_related_id');
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadopor_id');
	}

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'bono_related_id');
	}

	public function bono_detallesolicituds()
	{
		return $this->hasMany(BonoDetallesolicitud::class);
	}

	public function bono_estudiointernacions()
	{
		return $this->hasMany(BonoEstudiointernacion::class);
	}

	public function bono_hojaconsumos()
	{
		return $this->hasMany(BonoHojaconsumo::class);
	}

	public function informedeestudios()
	{
		return $this->belongsToMany(Informedeestudio::class);
	}

	public function bono_medicamentopartequirurgicos()
	{
		return $this->hasMany(BonoMedicamentopartequirurgico::class);
	}

	public function bono_partequirurgicos()
	{
		return $this->hasMany(BonoPartequirurgico::class);
	}

	public function bonocriterio()
	{
		return $this->hasOne(Bonocriterio::class);
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class);
	}

	public function envioapersonas()
	{
		return $this->belongsToMany(Envioapersona::class, 'envioapersona_bono', 'bono_id', 'envio_id');
	}

	public function item_bonos()
	{
		return $this->hasMany(ItemBono::class);
	}

	public function notaitems()
	{
		return $this->hasMany(Notaitem::class);
	}

	public function pago_qrs()
	{
		return $this->hasMany(PagoQr::class);
	}

	public function prefacturaitems()
	{
		return $this->hasMany(Prefacturaitem::class);
	}
}
