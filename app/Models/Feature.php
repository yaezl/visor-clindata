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
 * Class Feature
 * 
 * @property int $id
 * @property int|null $modulo_id
 * @property int|null $configdialog_id
 * @property string $titulo
 * @property string $tituloPlural
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * 
 * @property Modulo|null $modulo
 * @property ConfigDialog|null $config_dialog
 * @property Collection|ConfigMenu[] $config_menus
 * @property Collection|Permiso[] $permisos
 *
 * @package App\Models
 */
class Feature extends Model
{
	use SoftDeletes;
	protected $table = 'feature';

	protected $casts = [
		'modulo_id' => 'int',
		'configdialog_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'modulo_id',
		'configdialog_id',
		'titulo',
		'tituloPlural',
		'created_by',
		'modified_by',
		'deleted_by'
	];

	public function modulo()
	{
		return $this->belongsTo(Modulo::class);
	}

	public function config_dialog()
	{
		return $this->belongsTo(ConfigDialog::class, 'configdialog_id');
	}

	public function config_menus()
	{
		return $this->hasMany(ConfigMenu::class);
	}

	public function permisos()
	{
		return $this->hasMany(Permiso::class);
	}
}
