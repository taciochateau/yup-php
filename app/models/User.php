namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements JWTSubject
{
    use Authenticatable, Authorizable;

    protected $fillable = ['nome', 'sobrenome', 'email', 'password'];

    protected $hidden = ['password'];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notificationTypes()
    {
        return $this->hasMany(NotificationType::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}