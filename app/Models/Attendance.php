<?php

namespace App\Models;

use Database\Factories\AttendanceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['class_id', 'subject_id', 'teacher_id', 'tanggal', 'academic_year_id', 'qr_code_token', 'qr_code_path', 'qr_expires_at'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'qr_expires_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function kelas() { return $this->belongsTo(ClassRoom::class, 'class_id'); }
    public function subject() { return $this->belongsTo(Subject::class); }
    public function guru() { return $this->belongsTo(Teacher::class, 'teacher_id'); }
    public function academicYear() { return $this->belongsTo(AcademicYear::class); }
    public function details() { return $this->hasMany(AttendanceDetail::class); }
}
