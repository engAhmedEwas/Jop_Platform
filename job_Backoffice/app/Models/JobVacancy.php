<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;
use App\Models\JobCategory;


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
        'companyId',
        'jobCategoryId',
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
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }

    public function jobCategory(){
        return $this->belongsTo(JobCategory::class, 'jobCategoryId', 'id');
    }


    public function jobVacancy(){
        return $this->hasMany(JobVacancy::class, 'jobVacancyId', 'id');
    }

}
