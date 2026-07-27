<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Atributo
 * 
 * @property int $id
 * @property int|null $regla_id
 * @property string $dtype
 * 
 * @property Regla|null $regla
 * @property Copago|null $copago
 * @property Factorcorreccion|null $factorcorreccion
 * @property Multiplicador|null $multiplicador
 * @property Noconvenida|null $noconvenida
 * @property PermiteAgregarIva|null $permite_agregar_iva
 * @property PermiteIgnorarReglasCobro|null $permite_ignorar_reglas_cobro
 * @property PorcentajeIva|null $porcentaje_iva
 * @property Precio|null $precio
 * @property Reintegrable|null $reintegrable
 * @property RequiereAutorizacion|null $requiere_autorizacion
 * @property RequiereDescuento|null $requiere_descuento
 * @property RequiereInforme|null $requiere_informe
 * @property RequiereOrden|null $requiere_orden
 * @property RequiereValidacion|null $requiere_validacion
 * @property ValidoCpm|null $valido_cpm
 *
 * @package App\Models
 */
class Atributo extends Model
{
	protected $table = 'atributo';
	public $timestamps = false;

	protected $casts = [
		'regla_id' => 'int'
	];

	protected $fillable = [
		'regla_id',
		'dtype'
	];

	public function regla()
	{
		return $this->belongsTo(Regla::class);
	}

	public function copago()
	{
		return $this->hasOne(Copago::class, 'id');
	}

	public function factorcorreccion()
	{
		return $this->hasOne(Factorcorreccion::class, 'id');
	}

	public function multiplicador()
	{
		return $this->hasOne(Multiplicador::class, 'id');
	}

	public function noconvenida()
	{
		return $this->hasOne(Noconvenida::class, 'id');
	}

	public function permite_agregar_iva()
	{
		return $this->hasOne(PermiteAgregarIva::class, 'id');
	}

	public function permite_ignorar_reglas_cobro()
	{
		return $this->hasOne(PermiteIgnorarReglasCobro::class, 'id');
	}

	public function porcentaje_iva()
	{
		return $this->hasOne(PorcentajeIva::class, 'id');
	}

	public function precio()
	{
		return $this->hasOne(Precio::class, 'id');
	}

	public function reintegrable()
	{
		return $this->hasOne(Reintegrable::class, 'id');
	}

	public function requiere_autorizacion()
	{
		return $this->hasOne(RequiereAutorizacion::class, 'id');
	}

	public function requiere_descuento()
	{
		return $this->hasOne(RequiereDescuento::class, 'id');
	}

	public function requiere_informe()
	{
		return $this->hasOne(RequiereInforme::class, 'id');
	}

	public function requiere_orden()
	{
		return $this->hasOne(RequiereOrden::class, 'id');
	}

	public function requiere_validacion()
	{
		return $this->hasOne(RequiereValidacion::class, 'id');
	}

	public function valido_cpm()
	{
		return $this->hasOne(ValidoCpm::class, 'id');
	}
}
