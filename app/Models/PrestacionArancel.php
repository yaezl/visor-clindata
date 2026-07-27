<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestacionArancel
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property int|null $arancel_id
 * 
 * @property Prestacion|null $prestacion
 * @property Arancel|null $arancel
 * @property Nomenclable $nomenclable
 *
 * @package App\Models
 */
class PrestacionArancel extends Model
{
	protected $table = 'prestacion_arancel';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'prestacion_id' => 'int',
		'arancel_id' => 'int'
	];

	protected $fillable = [
		'prestacion_id',
		'arancel_id'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function arancel()
	{
		return $this->belongsTo(Arancel::class);
	}

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class, 'id');
	}
}
