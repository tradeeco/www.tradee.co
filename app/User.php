<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Models\UserProfile;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'phone', 'address', 'post_code', 'area_suburb_id', 'slug'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

//    protected static function boot()
//    {
//        static::created(function ($model) {
//            UserProfile::create(['user_id'=> $model->id]);
//
//            return true;
//        });
//    }

    public function userExperiences()
    {
        return $this->hasMany('App\Models\UserExperience');
    }

    public function userJobInterestedLocations()
    {
        return $this->hasMany('App\Models\UserJobInterestedLocation');
    }
//    public static function authenticate($username, $password)
//    {
//        $user = User::where('username', $username)->first();
//        if (!Hash::check($password, $user->password)) {
//            return false;
//        }
//        return $user;
//    }

//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = Hash::make($password);
//    }
    public static $accountRules = [
        'file' => 'mimes:png,gif,jpeg,jpg,bmp',
        'short_bio.*' => 'max:1000',
        'category_id.*' => 'required',
        'length_id.*' => 'required',
        'area_suburb_id.*' => 'required',
    ];

    public static $accountMessages = [
        'photo_ids.required' => 'The photo field is required'
    ];

    public static function initAccountValidation($request)
    {
        $messages = [];
        if (isset($request)) {
            foreach ($request->get('category_id') as $key => $val) {
                $messages['category_id.' . $key . '.required'] = 'This field is required.';
                $messages['length_id.' . $key . '.required'] = 'This field is required.';
            }

            foreach ($request->get('area_suburb_id') as $key => $val) {
                $messages['area_suburb_id.' . $key . '.required'] = 'This field is required.';
            }
        }


        User::$accountMessages = array_merge(User::$accountMessages, $messages);

    }

    public static $contactRules = [
        'first_name' => 'required:max:25',
        'last_name' => 'max:25',
        'address' => 'max:25',
        'phone' => 'max:25',
        'post_code' => 'max:25',
    ];

    public static $contactMessages = [
        'photo_ids.required' => 'The photo field is required'
    ];
}
