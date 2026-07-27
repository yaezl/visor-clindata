<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BrokerInfo
 * 
 * @property int $id
 * @property int|null $bono_item_id
 * @property string|null $brokerId
 * @property string $brokerMensaje
 * @property string $brokerMensajeGeneral
 * @property bool $brokerActivo
 * @property int $cantidadAutorizada
 * @property float $copago
 * @property int $item_bono_id
 * 
 * @property Bonoitem|null $bonoitem
 * @property ItemBono $item_bono
 *
 * @package App\Models
 */
class BrokerInfo extends Model
{
	protected $table = 'broker_info';
	public $timestamps = false;

	protected $casts = [
		'bono_item_id' => 'int',
		'brokerActivo' => 'bool',
		'cantidadAutorizada' => 'int',
		'copago' => 'float',
		'item_bono_id' => 'int'
	];

	protected $fillable = [
		'bono_item_id',
		'brokerId',
		'brokerMensaje',
		'brokerMensajeGeneral',
		'brokerActivo',
		'cantidadAutorizada',
		'copago',
		'item_bono_id'
	];

	public function bonoitem()
	{
		return $this->belongsTo(Bonoitem::class, 'bono_item_id');
	}

	public function item_bono()
	{
		return $this->belongsTo(ItemBono::class);
	}
}
