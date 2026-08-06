<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosOrdenDeCompra
 * 
 * @property int $id
 * @property int|null $prorroga_id
 * @property int|null $unidad_requiriente_id
 * @property int|null $proveedor_id
 * @property int|null $responsable_id
 * @property int|null $solicitud_de_compra_id
 * @property int|null $institucion_id
 * @property int|null $dependencia_id
 * @property int|null $tipo_id
 * @property int|null $pagos_cabecera_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int|null $autorizado_fundacionpor_id
 * @property int|null $visto_fundacionpor_id
 * @property int|null $autorizado_pagopor_id
 * @property int|null $pagado_fundacionpor_id
 * @property int|null $pago_facultadpor_id
 * @property string|null $numero
 * @property string|null $ejercicio
 * @property string|null $referencia
 * @property Carbon|null $fecha_de_retiro
 * @property Carbon|null $fecha_de_ejecucion
 * @property string|null $estado
 * @property string|null $notas
 * @property bool|null $es_licitacion
 * @property bool|null $autorizado_fundacion
 * @property bool|null $visto_fundacion
 * @property bool|null $autorizado_pago
 * @property bool|null $pagado
 * @property bool|null $pago_facultad
 * @property string|null $licitacion_tipo
 * @property string|null $licitacion_clase
 * @property string|null $licitacion_modalidad
 * @property string|null $licitacion_numero
 * @property string|null $licitacion_ejercicio
 * @property string|null $expediente_numero
 * @property string|null $expediente_adjudicacion
 * @property string|null $expediente_observaciones
 * @property string|null $expediente_datos_adjudicatario
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $autorizado_fundacion_en
 * @property Carbon|null $visto_fundacion_en
 * @property Carbon|null $autorizado_pago_en
 * @property Carbon|null $pagado_fundacion_en
 * @property Carbon|null $pago_facultad_en
 * 
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class SuministrosOrdenDeCompra extends Model
{
	protected $table = 'suministros_orden_de_compra';
	public $timestamps = false;

	protected $casts = [
		'prorroga_id' => 'int',
		'unidad_requiriente_id' => 'int',
		'proveedor_id' => 'int',
		'responsable_id' => 'int',
		'solicitud_de_compra_id' => 'int',
		'institucion_id' => 'int',
		'dependencia_id' => 'int',
		'tipo_id' => 'int',
		'pagos_cabecera_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'autorizado_fundacionpor_id' => 'int',
		'visto_fundacionpor_id' => 'int',
		'autorizado_pagopor_id' => 'int',
		'pagado_fundacionpor_id' => 'int',
		'pago_facultadpor_id' => 'int',
		'fecha_de_retiro' => 'datetime',
		'fecha_de_ejecucion' => 'datetime',
		'es_licitacion' => 'bool',
		'autorizado_fundacion' => 'bool',
		'visto_fundacion' => 'bool',
		'autorizado_pago' => 'bool',
		'pagado' => 'bool',
		'pago_facultad' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'autorizado_fundacion_en' => 'datetime',
		'visto_fundacion_en' => 'datetime',
		'autorizado_pago_en' => 'datetime',
		'pagado_fundacion_en' => 'datetime',
		'pago_facultad_en' => 'datetime'
	];

	protected $fillable = [
		'prorroga_id',
		'unidad_requiriente_id',
		'proveedor_id',
		'responsable_id',
		'solicitud_de_compra_id',
		'institucion_id',
		'dependencia_id',
		'tipo_id',
		'pagos_cabecera_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'autorizado_fundacionpor_id',
		'visto_fundacionpor_id',
		'autorizado_pagopor_id',
		'pagado_fundacionpor_id',
		'pago_facultadpor_id',
		'numero',
		'ejercicio',
		'referencia',
		'fecha_de_retiro',
		'fecha_de_ejecucion',
		'estado',
		'notas',
		'es_licitacion',
		'autorizado_fundacion',
		'visto_fundacion',
		'autorizado_pago',
		'pagado',
		'pago_facultad',
		'licitacion_tipo',
		'licitacion_clase',
		'licitacion_modalidad',
		'licitacion_numero',
		'licitacion_ejercicio',
		'expediente_numero',
		'expediente_adjudicacion',
		'expediente_observaciones',
		'expediente_datos_adjudicatario',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'autorizado_fundacion_en',
		'visto_fundacion_en',
		'autorizado_pago_en',
		'pagado_fundacion_en',
		'pago_facultad_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'responsable_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'dependencia_id');
	}
}
