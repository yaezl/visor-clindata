<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notaitem
 * 
 * @property int $id
 * @property int|null $notacredito_id
 * @property int|null $notadebito_id
 * @property int|null $bono_id
 * 
 * @property Notacredito|null $notacredito
 * @property Notadebito|null $notadebito
 * @property Bono|null $bono
 *
 * @package App\Models
 */
class Notaitem extends Model
{
	protected $table = 'notaitem';
	public $timestamps = false;

	protected $casts = [
		'notacredito_id' => 'int',
		'notadebito_id' => 'int',
		'bono_id' => 'int'
	];

	protected $fillable = [
		'notacredito_id',
		'notadebito_id',
		'bono_id'
	];

	public function notacredito()
	{
		return $this->belongsTo(Notacredito::class);
	}

	public function notadebito()
	{
		return $this->belongsTo(Notadebito::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
