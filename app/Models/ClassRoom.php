<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';
    protected $fillable = ['nama_kelas', 'wali_kelas'];

    protected function casts(): array
    {
        return [
            'wali_kelas' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    public function waliKelas() { return $this->belongsTo(Teacher::class, 'wali_kelas'); }
    public function students() { return $this->hasMany(Student::class, 'kelas_id'); }
    public function attendances() { return $this->hasMany(Attendance::class, 'class_id'); }
    public function subjects() { return $this->belongsToMany(Subject::class, 'class_subject_teacher', 'class_id', 'subject_id'); }

}
