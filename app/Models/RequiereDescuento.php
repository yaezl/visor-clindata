<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequiereDescuento
 * 
 * @property int $id
 * @property int|null $descuento_id
 * @property bool|null $requiereDescuento
 * 
 * @property Atributo $atributo
 * @property Descuento|null $descuento
 *
 * @package App\Models
 */
class RequiereDescuento extends Model
{
	protected $table = 'requiere_descuento';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'descuento_id' => 'int',
		'requiereDescuento' => 'bool'
	];

	protected $fillable = [
		'descuento_id',
		'requiereDescuento'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}

	public function descuento()
	{
		return $this->belongsTo(Descuento::class);
	}
}
