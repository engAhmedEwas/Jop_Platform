<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JobApplication;
use App\Models\User;


class Resume extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, softDeletes;

    protected $table = "resumes"; // the table name is burler in db

    protected $keyType = "string";
    public $incrementing = false;

        protected $fillable = [
        'fileName',
        'fileUri',
        'contactDetails',
        'summary',
        'experience',
        'education',
        'skills',
        'user_id',
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

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function jobApplication(){
        return $this->hasMany(JobApplication::class, 'resume_id', 'id');
    }
}
