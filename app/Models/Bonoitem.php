<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bonoitem
 * 
 * @property int $id
 * @property int|null $bono_id
 * @property int|null $cotizacion_id
 * @property int $cantidad
 * @property int|null $practica_id
 * @property int|null $bonoitem_related_id
 * @property string $numero_autorizacion
 * @property int|null $medico_solicitante_id
 * @property bool|null $aInformar
 * @property bool|null $a_informar_diferido
 * @property string|null $tipo_medico_solicitante
 * @property string|null $numero_medico_solicitante
 * @property Carbon|null $fechaReceta
 * @property Carbon|null $fecha_realizado
 * @property string|null $extras
 * @property int|null $unidadNegocio_id
 * 
 * @property Personal|null $personal
 * @property UnidadNegocio|null $unidad_negocio
 * @property Bono|null $bono
 * @property Cotizacion|null $cotizacion
 * @property Estudio|null $estudio
 * @property Bonoitem|null $bonoitem
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|BrokerInfo[] $broker_infos
 * @property TedefOdontoBonoitem|null $tedef_odonto_bonoitem
 *
 * @package App\Models
 */
class Bonoitem extends Model
{
	protected $table = 'bonoitem';
	public $timestamps = false;

	protected $casts = [
		'bono_id' => 'int',
		'cotizacion_id' => 'int',
		'cantidad' => 'int',
		'practica_id' => 'int',
		'bonoitem_related_id' => 'int',
		'medico_solicitante_id' => 'int',
		'aInformar' => 'bool',
		'a_informar_diferido' => 'bool',
		'fechaReceta' => 'datetime',
		'fecha_realizado' => 'datetime',
		'unidadNegocio_id' => 'int'
	];

	protected $fillable = [
		'bono_id',
		'cotizacion_id',
		'cantidad',
		'practica_id',
		'bonoitem_related_id',
		'numero_autorizacion',
		'medico_solicitante_id',
		'aInformar',
		'a_informar_diferido',
		'tipo_medico_solicitante',
		'numero_medico_solicitante',
		'fechaReceta',
		'fecha_realizado',
		'extras',
		'unidadNegocio_id'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'medico_solicitante_id');
	}

	public function unidad_negocio()
	{
		return $this->belongsTo(UnidadNegocio::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class, 'practica_id');
	}

	public function bonoitem()
	{
		return $this->belongsTo(Bonoitem::class, 'bonoitem_related_id');
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class, 'bonoitem_related_id');
	}

	public function broker_infos()
	{
		return $this->hasMany(BrokerInfo::class, 'bono_item_id');
	}

	public function tedef_odonto_bonoitem()
	{
		return $this->hasOne(TedefOdontoBonoitem::class);
	}
}
