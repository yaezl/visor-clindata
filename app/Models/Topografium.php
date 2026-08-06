<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Topografium
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borradoLogico
 * 
 * @property Collection|DermatologiaTopografium[] $dermatologia_topografia
 *
 * @package App\Models
 */
class Topografium extends Model
{
	use SoftDeletes;
	protected $table = 'topografia';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'borradoLogico'
	];

	public function dermatologia_topografia()
	{
		return $this->hasMany(DermatologiaTopografium::class, 'topografia_id');
	}
}
