<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticuloTipopresentacion
 * 
 * @property int $id
 * @property int|null $articulo_id
 * @property int|null $tipounidadmedida_id
 * @property int|null $tipopresentacion_id
 * @property string $dosis
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property float $precio
 * @property string|null $codigo
 * @property string|null $troquel
 * @property string|null $codigo_barras
 * @property string|null $laboratorio
 * @property string|null $nombre_comercial
 * @property int|null $idUbicacionAlmacen
 * 
 * @property UbicacionAlmacen|null $ubicacion_almacen
 * @property Articulo|null $articulo
 * @property Tipounidadmedida|null $tipounidadmedida
 * @property Tipopresentacion|null $tipopresentacion
 * @property Usuario|null $usuario
 * @property Collection|Articuloalmacenminmax[] $articuloalmacenminmaxes
 * @property Collection|Articulocronico[] $articulocronicos
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 * @property Collection|AtpAlmacen[] $atp_almacens
 * @property Collection|AutorizacionesItem[] $autorizaciones_items
 * @property Collection|AutorizacionesMedicacion[] $autorizaciones_medicacions
 * @property Collection|AutorizacionesPlanAtpTipocobertura[] $autorizaciones_plan_atp_tipocoberturas
 * @property Collection|AutorizacionesReintegroMedicamento[] $autorizaciones_reintegro_medicamentos
 * @property Collection|Consumo[] $consumos
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|FarCierreInventarioAtp[] $far_cierre_inventario_atps
 * @property Collection|FarDetallePedidoAlmacen[] $far_detalle_pedido_almacens
 * @property Collection|FarDetalleSolicitud[] $far_detalle_solicituds
 * @property Collection|FarFrascoPlanHidratacion[] $far_frasco_plan_hidratacions
 * @property Collection|HojaConsumo[] $hoja_consumos
 * @property Collection|InternacionHojaEnfermeriaConsumoDescartable[] $internacion_hoja_enfermeria_consumo_descartables
 * @property Collection|InternacionHojaEnfermeriaIngreso[] $internacion_hoja_enfermeria_ingresos
 * @property Collection|InternacionHojaEnfermeriaMedicacion[] $internacion_hoja_enfermeria_medicacions
 * @property Collection|InternacionMedicamentoPa[] $internacion_medicamento_pas
 * @property Collection|InternacionParteAnestesico[] $internacion_parte_anestesicos
 * @property Collection|Lote[] $lotes
 * @property Collection|ProcedimientoArticulotipopresentacion[] $procedimiento_articulotipopresentacions
 * @property Collection|RelacionArticulotpPrestacion[] $relacion_articulotp_prestacions
 * @property Collection|ReservaQuirofanoMedicamento[] $reserva_quirofano_medicamentos
 *
 * @package App\Models
 */
class ArticuloTipopresentacion extends Model
{
	protected $table = 'articulo_tipopresentacion';
	public $timestamps = false;

	protected $casts = [
		'articulo_id' => 'int',
		'tipounidadmedida_id' => 'int',
		'tipopresentacion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'precio' => 'float',
		'idUbicacionAlmacen' => 'int'
	];

	protected $fillable = [
		'articulo_id',
		'tipounidadmedida_id',
		'tipopresentacion_id',
		'dosis',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'precio',
		'codigo',
		'troquel',
		'codigo_barras',
		'laboratorio',
		'nombre_comercial',
		'idUbicacionAlmacen'
	];

	public function ubicacion_almacen()
	{
		return $this->belongsTo(UbicacionAlmacen::class, 'idUbicacionAlmacen');
	}

	public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}

	public function tipounidadmedida()
	{
		return $this->belongsTo(Tipounidadmedida::class);
	}

	public function tipopresentacion()
	{
		return $this->belongsTo(Tipopresentacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function articuloalmacenminmaxes()
	{
		return $this->hasMany(Articuloalmacenminmax::class, 'articulotipopresentacion_id');
	}

	public function articulocronicos()
	{
		return $this->hasMany(Articulocronico::class, 'articulotipopresentacion_id');
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'articulotipopresentacion_id');
	}

	public function atp_almacens()
	{
		return $this->hasMany(AtpAlmacen::class, 'atp_id');
	}

	public function autorizaciones_items()
	{
		return $this->hasMany(AutorizacionesItem::class, 'articulotipopresentacion_id');
	}

	public function autorizaciones_medicacions()
	{
		return $this->hasMany(AutorizacionesMedicacion::class);
	}

	public function autorizaciones_plan_atp_tipocoberturas()
	{
		return $this->hasMany(AutorizacionesPlanAtpTipocobertura::class, 'atp_id');
	}

	public function autorizaciones_reintegro_medicamentos()
	{
		return $this->hasMany(AutorizacionesReintegroMedicamento::class, 'articulotipopresentacion_id');
	}

	public function consumos()
	{
		return $this->hasMany(Consumo::class, 'articulotipopresentacion_id');
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class, 'articulotipopresentacion_id');
	}

	public function far_cierre_inventario_atps()
	{
		return $this->hasMany(FarCierreInventarioAtp::class, 'atp_id');
	}

	public function far_detalle_pedido_almacens()
	{
		return $this->hasMany(FarDetallePedidoAlmacen::class, 'atp_id');
	}

	public function far_detalle_solicituds()
	{
		return $this->hasMany(FarDetalleSolicitud::class, 'atp_id');
	}

	public function far_frasco_plan_hidratacions()
	{
		return $this->hasMany(FarFrascoPlanHidratacion::class, 'atp_id');
	}

	public function hoja_consumos()
	{
		return $this->hasMany(HojaConsumo::class, 'articulotipopresentacion_id');
	}

	public function internacion_hoja_enfermeria_consumo_descartables()
	{
		return $this->hasMany(InternacionHojaEnfermeriaConsumoDescartable::class, 'articulotipopresentacion_id');
	}

	public function internacion_hoja_enfermeria_ingresos()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIngreso::class, 'solucion_id');
	}

	public function internacion_hoja_enfermeria_medicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaMedicacion::class, 'atp_id');
	}

	public function internacion_medicamento_pas()
	{
		return $this->hasMany(InternacionMedicamentoPa::class, 'articulotipopresentacion_id');
	}

	public function internacion_parte_anestesicos()
	{
		return $this->hasMany(InternacionParteAnestesico::class);
	}

	public function lotes()
	{
		return $this->hasMany(Lote::class, 'articulotipopresentacion_id');
	}

	public function procedimiento_articulotipopresentacions()
	{
		return $this->hasMany(ProcedimientoArticulotipopresentacion::class, 'atp_id');
	}

	public function relacion_articulotp_prestacions()
	{
		return $this->hasMany(RelacionArticulotpPrestacion::class, 'articulotipopresentacion_id');
	}

	public function reserva_quirofano_medicamentos()
	{
		return $this->hasMany(ReservaQuirofanoMedicamento::class, 'articulo_tipo_presentacion_id');
	}
}
