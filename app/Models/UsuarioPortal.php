<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortal
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int|null $created_by_usuario_portal
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property string $dtype
 * @property int|null $persona_id
 * 
 * @property Usuario $usuario
 * @property UsuarioPortal|null $usuario_portal
 * @property Persona|null $persona
 * @property Collection|Persona[] $personas
 * @property Collection|TurnoProgramado[] $turno_programados
 * @property Collection|UsuarioPortal[] $usuario_portals
 * @property UsuarioPortalCelular|null $usuario_portal_celular
 * @property UsuarioPortalEmail|null $usuario_portal_email
 * @property UsuarioPortalFacebook|null $usuario_portal_facebook
 * @property UsuarioPortalFirebase|null $usuario_portal_firebase
 * @property UsuarioPortalGoogle|null $usuario_portal_google
 *
 * @package App\Models
 */
class UsuarioPortal extends Model
{
	protected $table = 'usuario_portal';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'created_by_usuario_portal' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'persona_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'created_by_usuario_portal',
		'modified_at',
		'borrado_logico',
		'dtype',
		'persona_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'created_by_usuario_portal');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class)
					->withPivot('id', 'created_by', 'modified_by', 'principal', 'provisorio', 'type', 'borrado_logico', 'modified_at');
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}

	public function usuario_portals()
	{
		return $this->hasMany(UsuarioPortal::class, 'created_by_usuario_portal');
	}

	public function usuario_portal_celular()
	{
		return $this->hasOne(UsuarioPortalCelular::class, 'id');
	}

	public function usuario_portal_email()
	{
		return $this->hasOne(UsuarioPortalEmail::class, 'id');
	}

	public function usuario_portal_facebook()
	{
		return $this->hasOne(UsuarioPortalFacebook::class, 'id');
	}

	public function usuario_portal_firebase()
	{
		return $this->hasOne(UsuarioPortalFirebase::class, 'id');
	}

	public function usuario_portal_google()
	{
		return $this->hasOne(UsuarioPortalGoogle::class, 'id');
	}
}
