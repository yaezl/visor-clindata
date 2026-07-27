<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArancelCategorium
 * 
 * @property int $id
 * @property int|null $arancel_id
 * @property int|null $categoria_id
 * 
 * @property Arancel|null $arancel
 * @property Categorium|null $categorium
 * @property Nomenclable $nomenclable
 *
 * @package App\Models
 */
class ArancelCategorium extends Model
{
	protected $table = 'arancel_categoria';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'arancel_id' => 'int',
		'categoria_id' => 'int'
	];

	protected $fillable = [
		'arancel_id',
		'categoria_id'
	];

	public function arancel()
	{
		return $this->belongsTo(Arancel::class);
	}

	public function categorium()
	{
		return $this->belongsTo(Categorium::class, 'categoria_id');
	}

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class, 'id');
	}
}
