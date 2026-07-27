<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiagnosticoEfectore
 * 
 * @property int $id
 * @property string|null $codigo_cie10
 *
 * @package App\Models
 */
class DiagnosticoEfectore extends Model
{
	protected $table = 'diagnostico_efectores';
	public $timestamps = false;

	protected $fillable = [
		'codigo_cie10'
	];
}
