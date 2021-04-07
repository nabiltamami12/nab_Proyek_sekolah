<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterPenilaianPengetahuan extends Model
{
    //
    protected $table = 'master_penilaian_pengetahuans';
    protected $fillable = [
        'id',
        'hapus',
        'pertemuan',
        'kelas_mapel_id',
        'skema_penilaian',
        'kompetensi_dasar_id',
        'penilaian_harian',
        'instruksi',
        'mulai_pengerjaan',
        'finish_pengerjaan'
    ];

    public function kompetensi_dasar () {
        return $this->belongsTo('App\Model\KompetensiDasar', 'kompetensi_dasar_id', 'id');
    }

 public function jadwal_pelajaran() {
        return $this->belongsTo('App\Model\MasterJadwalPelajaran', 'kelas_mapel_id', 'id');
    }

    public function kelas_mapel() {
        return $this->belongsTo('App\MasterJadwalPelajaran', 'kelas_mapel_id', 'id');
    }

    public function tugas_pengetahuan() {
        return $this->hasMany('App\Model\TugasSiswaPengetahuan', 'penilaian_pengetahuan_id', 'id');
    }
       public function nilai() {
        return $this->hasMany('App\Model\MasterNilaiPengetahuan', 'penilaian_pengetahuan_id', 'id');
    }
}
