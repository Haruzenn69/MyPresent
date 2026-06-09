<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'nis', 'nama', 'kelas_id', 'jenis_kelamin', 'alamat'];

    protected function casts(): array
    {
        return [
            'kelas_id' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    public function user() { return $this->belongsTo(User::class); }
    public function kelas() { return $this->belongsTo(ClassRoom::class, 'kelas_id'); }
    public function attendanceDetails() { return $this->hasMany(AttendanceDetail::class); }
}
