<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JobVacancy extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, softDeletes;

    protected $table = "job_vacancies"; // the table name is burler in db

    protected $keyType = "string";
    public $incrementing = false;

        protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'salary',
        'company_id',
        'jobCategory_id',
        'jobVacancy_id',
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

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function jobCategory(){
        return $this->belongsTo(JobCategory::class, 'jobCategory_id', 'id');
    }


    public function jobApplications(){
        return $this->hasMany(JobApplication::class, 'jobVacancy_id', 'id');
    }

}
