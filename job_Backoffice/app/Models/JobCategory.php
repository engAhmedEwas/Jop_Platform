<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, softDeletes;

    protected $table = "job_categories"; // the table name is burler in db

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'name',
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

    public function jobVacancy(){
        return $this->hasMany(JobVacancy::class, 'categoryId', 'id');
    }

}
