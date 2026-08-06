<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaUsuarioPortal
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int $persona_id
 * @property int $usuario_portal_id
 * @property bool $principal
 * @property bool $provisorio
 * @property int $type
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario|null $usuario
 * @property UsuarioPortal $usuario_portal
 * @property Persona $persona
 * @property Collection|TurnoProgramado[] $turno_programados
 *
 * @package App\Models
 */
class PersonaUsuarioPortal extends Model
{
	protected $table = 'persona_usuario_portal';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'persona_id' => 'int',
		'usuario_portal_id' => 'int',
		'principal' => 'bool',
		'provisorio' => 'bool',
		'type' => 'int',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'persona_id',
		'usuario_portal_id',
		'principal',
		'provisorio',
		'type',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class);
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}
}
