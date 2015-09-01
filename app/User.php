<?php

namespace portaria;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    
    protected $casts = ['master' => 'boolean'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setMasterAttribute($value)
    {
        $this->attributes['master'] = $value ? 1 : 0;
    }
    public function getMasterAttribute()
    {
        return $this->attributes['master'] ? true : false;
    }

    /**
     * Returns the type of logged user
     *
     * @var string A: admin | M: morador | F: funcionario
     */
    public function getTipoUsuarioAttribute()
    {
        if($this->master)
        {
            return 'A';
        }
        else
        {
            if($this->morador != null)
                return 'M';
            if($this->funcionario != null)
                return 'F';
        }

        return null;
    }

    public function funcionario()
    {
        return $this->hasOne('portaria\Funcionario');
    }

    public function morador()
    {
        return $this->hasOne('portaria\Morador');
    }
}
