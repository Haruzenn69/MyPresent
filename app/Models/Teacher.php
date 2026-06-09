<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'nip', 'nama', 'bidang_studi'];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function user() { return $this->belongsTo(User::class); }
    public function classes() { return $this->hasMany(ClassRoom::class, 'wali_kelas'); }
    public function attendances() { return $this->hasMany(Attendance::class); }
    public function bidangStudi() { return $this->belongsTo(Subject::class, 'bidang_studi'); }
    public function subjects() { return $this->belongsToMany(Subject::class, 'class_subject_teacher', 'teacher_id', 'subject_id'); }

}
