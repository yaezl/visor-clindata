<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ValidoCpm
 * 
 * @property int $id
 * @property bool $valido_cpm
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class ValidoCpm extends Model
{
	protected $table = 'valido_cpm';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'valido_cpm' => 'bool'
	];

	protected $fillable = [
		'valido_cpm'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
