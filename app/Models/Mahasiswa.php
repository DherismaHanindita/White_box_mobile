<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent
use App\Models\Mahasiswa;

class Mahasiswa extends Model //definisi model
{
   protected $table='mahasiswa'; //eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswa
   protected $primaryKey='nim'; //memamnggil isi DB dengan primay key

    protected $fillable=[
        'nim',
        'nama',
        'kelas_id',
        'jurusan',
        'Email',
        'Alamat',
        'TanggalLahir',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}