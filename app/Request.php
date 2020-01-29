<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRole;

class Request extends Model
{
    protected $fillable = [
        'status', 'price', 'type','ad_date','description','company_name','website_url','product_image','client_id','influencer_id'
    ];
    public function users(){
        return $this-> belongsToMany(User::class);
    }
}
