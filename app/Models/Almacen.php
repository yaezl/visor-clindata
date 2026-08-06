<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Almacen
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $ver_stock
 * @property int|null $pedir_stock
 * @property int|null $dar_stock
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * @property bool $es_farmacia_central
 * @property string|null $codigo
 * @property string|null $observaciones
 * @property bool $distribuye
 * @property int|null $institucion_id
 * @property string|null $codigoIntegracion
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property UsuarioAlmacen|null $usuario_almacen
 * @property Collection|AdminPermisoUsuario[] $admin_permiso_usuarios
 * @property Almacencuentum|null $almacencuentum
 * @property Collection|Articuloalmacenminmax[] $articuloalmacenminmaxes
 * @property Collection|AtpAlmacen[] $atp_almacens
 * @property Collection|FarBloqueoAlmacen[] $far_bloqueo_almacens
 * @property Collection|FarCierreInventario[] $far_cierre_inventarios
 * @property Collection|FarDetalleHojaPedido[] $far_detalle_hoja_pedidos
 * @property Collection|FarDetalleSolicitud[] $far_detalle_solicituds
 * @property Collection|FarPedidoAlmacen[] $far_pedido_almacens
 * @property Collection|HojaConsumo[] $hoja_consumos
 * @property Collection|InternacionHojaEnfermeriaConsumoDescartable[] $internacion_hoja_enfermeria_consumo_descartables
 * @property Collection|InternacionSala[] $internacion_salas
 * @property Collection|Lugar[] $lugars
 * @property Collection|Permiso[] $permisos
 *
 * @package App\Models
 */
class Almacen extends Model
{
	protected $table = 'almacen';
	public $timestamps = false;

	protected $casts = [
		'ver_stock' => 'int',
		'pedir_stock' => 'int',
		'dar_stock' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool',
		'es_farmacia_central' => 'bool',
		'distribuye' => 'bool',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'ver_stock',
		'pedir_stock',
		'dar_stock',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'activo',
		'es_farmacia_central',
		'codigo',
		'observaciones',
		'distribuye',
		'institucion_id',
		'codigoIntegracion'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function usuario_almacen()
	{
		return $this->belongsTo(UsuarioAlmacen::class, 'dar_stock');
	}

	public function admin_permiso_usuarios()
	{
		return $this->belongsToMany(AdminPermisoUsuario::class, 'admin_permiso_usuario_almacen', 'almacen_id', 'permiso_usuario_id');
	}

	public function almacencuentum()
	{
		return $this->hasOne(Almacencuentum::class);
	}

	public function articuloalmacenminmaxes()
	{
		return $this->hasMany(Articuloalmacenminmax::class);
	}

	public function atp_almacens()
	{
		return $this->hasMany(AtpAlmacen::class);
	}

	public function far_bloqueo_almacens()
	{
		return $this->hasMany(FarBloqueoAlmacen::class);
	}

	public function far_cierre_inventarios()
	{
		return $this->belongsToMany(FarCierreInventario::class, 'far_cierre_inventario_almacen', 'almacen_id', 'cierre_inventario_id')
					->withPivot('id', 'creado_por_id', 'modificado_por_id', 'creado_en', 'modificado_en', 'finalizado');
	}

	public function far_detalle_hoja_pedidos()
	{
		return $this->hasMany(FarDetalleHojaPedido::class);
	}

	public function far_detalle_solicituds()
	{
		return $this->hasMany(FarDetalleSolicitud::class, 'almacen_a_solicitar');
	}

	public function far_pedido_almacens()
	{
		return $this->hasMany(FarPedidoAlmacen::class);
	}

	public function hoja_consumos()
	{
		return $this->hasMany(HojaConsumo::class);
	}

	public function internacion_hoja_enfermeria_consumo_descartables()
	{
		return $this->hasMany(InternacionHojaEnfermeriaConsumoDescartable::class);
	}

	public function internacion_salas()
	{
		return $this->belongsToMany(InternacionSala::class, 'internacion_sala_almacenes_a_solicitar', 'almacen_id', 'sala_id')
					->withPivot('id', 'created_by', 'modified_by', 'prioridad', 'creado_en', 'modificado_en', 'borradoLogico');
	}

	public function lugars()
	{
		return $this->hasMany(Lugar::class);
	}

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'permiso_almacen_distribuye')
					->withPivot('id', 'usuario_id', 'creadopor_id', 'modificadopor_id', 'creado_en', 'modificado_en', 'borrado_logico');
	}
}
