<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'full_name',
        'email',
        'level_id',
        'password',
        'departament_id',
        'role',
        'percent'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_level()
    {
        return $this->hasOne(UserLevel::class, 'id', 'level_id');
    }

    public function hasRole($role) {

        if ($this->user_level->name == $role) {

            return true;
        }

        return false;
    }

    public function on_criteria()
    {
        return $this->hasMany(UserOnCriteria::class, 'user_id', 'id');
    }

    public function on_criteria_active($id=null)
    {
        if(isset($id)){

            return $this->hasOne(UserOnCriteria::class, 'user_id', 'id')->where('status', '=', 1)->where('criteria_id' , '=', $id);
        }else{

            return $this->hasMany(UserOnCriteria::class, 'user_id', 'id')->where('status', '=', 1);
        }

    }

    public function get_percent_teacher()
    {
        return $this->on_criteria()->where('status', '=', 1)->where('increase', '=', 'positive')->sum("data") - $this->on_criteria()->where('status', '=', 1)->where('increase', '=', 'negative')->sum("data");
    }

    public function archive_criteria($criteria_id=null, $date_from=null, $date_to=null)
    {
        $criteria = $this->hasMany(ArchiveCriteriaModel::class, 'user_id', 'id');

        if (isset($criteria_id)) {

            $criteria->where('criteria_id', '=', $criteria_id)->where('status', '=', 1);
        }

        if(isset($date_from) && isset($date_to)){

            $criteria->whereBetween('created_at', [$date_from, $date_to])->where('status', '=', 1)->get();
        }

        return $criteria;
    }

    public function get_percent_archive_criteria($criteria_id, $date_from, $date_to)
    {

        return $this->archive_criteria($criteria_id, $date_from, $date_to)->sum("data");
    }

    public function get_percent_archive()
    {

        return $this->archive_criteria()->where('increase', '=', 'positive')->sum("data") - $this->archive_criteria()->where('increase', '=', 'negative')->sum("data");
    }

    public function departament()
    {
        return $this->hasOne(Departament::class, 'id', 'departament_id');
    }

    public function announcement()
    {
        return $this->hasMany(AnnouncementModel::class, 'user_id', 'id');
    }

    public function announcement_accept()
    {
        return $this->hasMany(AnnouncementModel::class, 'user_id', 'id')->where('status', '=', 1)->where('unfulfilled','=',0);
    }

    public function announcement_reject()
    {
        return $this->hasMany(AnnouncementModel::class, 'user_id', 'id')->where('status', '=', 2)->where('unfulfilled','=',0);
    }
    public function announcement_unfulfilled()
    {
        return $this->hasMany(AnnouncementModel::class, 'user_id', 'id')->where('status', '=', 1)->where('unfulfilled','=',1);
    }
    public function statement()
    {
        return $this->hasMany(StatementModel::class, 'user_id', 'id');
    }

    public function statement_accept()
    {
        return $this->hasMany(StatementModel::class, 'user_id', 'id')->where('status', '=', 1)->where('unfulfilled','=',0);
    }

    public function statement_reject()
    {
        return $this->hasMany(StatementModel::class, 'user_id', 'id')->where('status', '=', 2)->where('unfulfilled','=',0);
    }
    public function statement_unfulfilled()
    {
        return $this->hasMany(StatementModel::class, 'user_id', 'id')->where('status', '=', 1)->where('unfulfilled','=',1);
    }
    public function notifaction_recipient()
    {
        return $this->hasMany(NotificationUserModel::class, 'recipient_id', 'id')->where('status', '=', 0)->orderBy('created_at', 'desc');
    }

    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }

    public function articles_accept()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id')->where('status', '=', 1);
    }

    public function articles_reject()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id')->where('status', '=', 2);
    }

    public function generate_announcement($days, $month)
    {
        $array_days = [];

        $counts = 0;

        for ($i = 1; $i <= $days; $i++) {
            $count_items = AnnouncementModel::where('user_id', $this->attributes['id'])->where('status', '=', 1)->where('unfulfilled','=',0)->whereBetween('date', [(date("Y-{$month}-{$i}"). " 00:00:00"), (date("Y-{$month}-{$i}"). " 23:59:59")])->count();
            $counts += $count_items;
            array_push($array_days, ($count_items == 0 ? "" : $count_items));
        }

        return ['result' => $array_days, 'counts' => $counts];
    }

    public function generate_statement($days, $month)
    {
        $array_days = [];

        $counts = 0;

        for ($i = 1; $i <= $days; $i++) {
            $count_items = StatementModel::where('user_id', $this->attributes['id'])->where('status', '=', 1)->where('unfulfilled','=',0)->whereBetween('date', [(date("Y-{$month}-{$i}"). " 00:00:00"), (date("Y-{$month}-{$i}"). " 23:59:59")])->count();
            $counts += $count_items;
            array_push($array_days, ($count_items == 0 ? "" : $count_items));
        }

        return ['result' => $array_days, 'counts' => $counts];
    }
}
