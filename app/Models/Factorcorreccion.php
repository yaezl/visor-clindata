<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Factorcorreccion
 * 
 * @property int $id
 * @property int|null $arancel_id
 * 
 * @property Arancel|null $arancel
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Factorcorreccion extends Model
{
	protected $table = 'factorcorreccion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'arancel_id' => 'int'
	];

	protected $fillable = [
		'arancel_id'
	];

	public function arancel()
	{
		return $this->belongsTo(Arancel::class);
	}

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
