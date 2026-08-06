<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemArancelPrecio
 * 
 * @property int $id
 * @property int $created_by
 * @property int $arancel_id
 * @property float $precio
 * @property Carbon $created_at
 * @property int $itemBono_id
 * 
 * @property ItemBono $item_bono
 * @property Usuario $usuario
 * @property Arancel $arancel
 *
 * @package App\Models
 */
class ItemArancelPrecio extends Model
{
	protected $table = 'item_arancel_precio';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'arancel_id' => 'int',
		'precio' => 'float',
		'itemBono_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'arancel_id',
		'precio',
		'itemBono_id'
	];

	public function item_bono()
	{
		return $this->belongsTo(ItemBono::class, 'itemBono_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function arancel()
	{
		return $this->belongsTo(Arancel::class);
	}
}
