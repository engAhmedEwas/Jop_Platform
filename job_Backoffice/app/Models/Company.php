<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, softDeletes;

    protected $table = "companies"; // the table name is burler in db

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'industry',
        'website',
        'owner_id',
        'company_id',
    ];

    protected $dates =[
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function jobVacancies(){
        return $this->hasMany(JobVacancy::class, 'company_id', 'id');
    }

    public function jobApplications(){
        return $this->hasManyThrough(JobApplication::class, JobVacancy::class, 'company_id', 'jobVacancy_id' , 'id');
    }
}
