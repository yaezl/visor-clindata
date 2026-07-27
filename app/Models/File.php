<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * 
 * @property int $id
 * @property string $name
 * @property string $code_name
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class File extends Model
{
	protected $table = 'files';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'code_name',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
