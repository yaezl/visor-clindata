<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosSolicitudDeCompra
 * 
 * @property int $id
 * @property int|null $estado_id
 * @property int|null $unidad_requiriente_id
 * @property int|null $institucion_id
 * @property int|null $responsable_id
 * @property int|null $comprador_id
 * @property int|null $dependencia_id
 * @property int|null $tipo_de_solicitud_id
 * @property int|null $pagos_cabecera_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int|null $preactivado_id
 * @property int|null $activado_id
 * @property int|null $autorizado_fundacionpor_id
 * @property int|null $visto_fundacionpor_id
 * @property int|null $pagado_fundacionpor_id
 * @property int|null $pago_facultadpor_id
 * @property Carbon $fecha_de_solicitud
 * @property bool|null $autorizacion_coordinador
 * @property bool|null $autorizacion_director
 * @property bool|null $autorizacion_sec_administrativa
 * @property bool|null $autorizacion_decano
 * @property bool|null $autorizado_fundacion
 * @property bool|null $visto_fundacion
 * @property bool|null $a_revisar
 * @property bool|null $pago_facultad
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $preactivado_en
 * @property Carbon|null $activado_en
 * @property Carbon|null $autorizado_fundacion_en
 * @property Carbon|null $visto_fundacion_en
 * @property Carbon|null $pagado_fundacion_en
 * @property Carbon|null $pago_facultad_en
 * 
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class SuministrosSolicitudDeCompra extends Model
{
	protected $table = 'suministros_solicitud_de_compra';
	public $timestamps = false;

	protected $casts = [
		'estado_id' => 'int',
		'unidad_requiriente_id' => 'int',
		'institucion_id' => 'int',
		'responsable_id' => 'int',
		'comprador_id' => 'int',
		'dependencia_id' => 'int',
		'tipo_de_solicitud_id' => 'int',
		'pagos_cabecera_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'preactivado_id' => 'int',
		'activado_id' => 'int',
		'autorizado_fundacionpor_id' => 'int',
		'visto_fundacionpor_id' => 'int',
		'pagado_fundacionpor_id' => 'int',
		'pago_facultadpor_id' => 'int',
		'fecha_de_solicitud' => 'datetime',
		'autorizacion_coordinador' => 'bool',
		'autorizacion_director' => 'bool',
		'autorizacion_sec_administrativa' => 'bool',
		'autorizacion_decano' => 'bool',
		'autorizado_fundacion' => 'bool',
		'visto_fundacion' => 'bool',
		'a_revisar' => 'bool',
		'pago_facultad' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'preactivado_en' => 'datetime',
		'activado_en' => 'datetime',
		'autorizado_fundacion_en' => 'datetime',
		'visto_fundacion_en' => 'datetime',
		'pagado_fundacion_en' => 'datetime',
		'pago_facultad_en' => 'datetime'
	];

	protected $fillable = [
		'estado_id',
		'unidad_requiriente_id',
		'institucion_id',
		'responsable_id',
		'comprador_id',
		'dependencia_id',
		'tipo_de_solicitud_id',
		'pagos_cabecera_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'preactivado_id',
		'activado_id',
		'autorizado_fundacionpor_id',
		'visto_fundacionpor_id',
		'pagado_fundacionpor_id',
		'pago_facultadpor_id',
		'fecha_de_solicitud',
		'autorizacion_coordinador',
		'autorizacion_director',
		'autorizacion_sec_administrativa',
		'autorizacion_decano',
		'autorizado_fundacion',
		'visto_fundacion',
		'a_revisar',
		'pago_facultad',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'preactivado_en',
		'activado_en',
		'autorizado_fundacion_en',
		'visto_fundacion_en',
		'pagado_fundacion_en',
		'pago_facultad_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'dependencia_id');
	}
}
