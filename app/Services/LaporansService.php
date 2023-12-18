<?php

namespace App\Services;

use App\Http\Resources\DokumenPendukungResource;
use App\Http\Resources\KeluargaKlienResource;
use App\Http\Resources\LangkahTelahDilakukanResource;
use App\Http\Resources\LaporansResource;
use App\Http\Resources\LintasOPDResource;
use App\Http\Resources\PelakuCetakResource;
use App\Http\Resources\PelakuResource;
use App\Http\Resources\RAKKResource;
use App\Http\Resources\RRKKResource;
use App\Models\DetailKasus;
use App\Models\DetailKlien;
use App\Models\DokumenPendukung;
use App\Models\Kategoris;
use App\Models\KeluargaKlien;
use App\Models\Laporans;
use App\Models\Kronologis;
use App\Models\LangkahTelahDilakukan;
use App\Models\LintasOPD;
use App\Models\ModelUtils;
use App\Models\Pelaku;
use App\Models\PenangananAwal;
use App\Models\RAKK;
use App\Models\RRKK;
use App\Models\Statuses;
use App\Services\BaseService;
use Carbon\Carbon;


use App\Models\User;
use App\Repositories\LaporansRepository;

class LaporansService extends BaseService
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }


    /*
    Add new services
    OR
    Override existing service here...
    */
    public function create($data)
    {
        $kronologis = $data['kronologis'] ?? null;
        unset($data['kronologis']);

        $data['status_id'] = 1;
        $data['token'] = strtoupper(str()->random(8));

        $admin = User::where('role_id', 2)->first()->id;
        $data['satgas_pelapor_id'] = $admin;
        $data['previous_satgas_id'] = $admin;
        $data['kota_id_pelapor'] = 1;
        // $data['rt'] = "1";
        // $data['rw'] = "1";

        if (isset($data['dokumentasi_pengaduan'])) {
            $data['dokumentasi_pengaduan'] = $this->uploadFile($data['dokumentasi_pengaduan'], 'dokumentasi_pengaduan');
        }

        $data = $this->repository->create($data);

        if (isset($kronologis)) {
            $this->saveKronologis($kronologis, $data->id, $data->satgas_pelapor_id);
        }

        $data = new $this->resource($data->fresh());

        return $data;
    }

    public function update($id, $data)
    {
        $foreign = ['status', 'kategori', 'pendidikan', 'satgas pelapor', 'previous satgas'];

        foreach ($foreign as $f) {
            $d = str_replace(' ', '_', $f);
            if (isset($data[$d])) {
                $f = strtolower($f);
                $f = str_replace(' ', '_', $f);
                $data[$f . "_id"] = $data[$d]['id'];
                unset($data[$d]);
            }
        }

        $data = $this->repository->update($id, $data);
        $data = new $this->resource($data);
        return $data;
    }

    public function getByToken($token)
    {
        $token = $this->repository->getByToken($token);
        return new LaporansResource($token);
    }

    public function getAll()
    {
        $data = request('page') ? $this->repository->getWithPaginate(request('search')) : $this->repository->getAll();

        return $this->resource::collection($data);
    }

    private function saveKronologis($kronologis, $laporan_id, $satgas_pelapor_id)
    {
        $k = new Kronologis();
        $repository = $k->repository();

        foreach ($kronologis as $k) {
            $k['laporan_id'] = $laporan_id;
            $k['admin_id'] = $satgas_pelapor_id;
            $repository->create($k);
        }
    }

    private function uploadFile($file, $folder)
    {
        $file = $file ?? null;
        $file_value = [];
        if ($file) {
            foreach ($file as $f) {
                $extension = $f->getClientOriginalExtension();
                $file_name = str()->uuid() . '.' . $extension;
                $path = $f->storePubliclyAs('public/' . $folder, $file_name);
                $path = str_replace('public', 'storage', $path);
                $file_value[] = env('APP_DESTINATION') . $path;
            }
            return json_encode($file_value);
        }
        return null;
    }

    public function setStatusPenjangkauan($data){
        $data['jenis'] = 'status_'.$data['jenis'];
        $this->repository->update(
            $data['laporan_id'],
            [
                $data['jenis'] => $data['status']
            ]
        );
    }

    public function getCountByRwKategori($kelurahan_id,$tanggal_start,$tanggal_end) {
        /* 
        $dataFormat  = [
            [
        
                'kategori_id' => 1,
                'kategori_nama'
                'count_total' => [
                    [
                        'rt' => 1,
                        'count' => 2
                    ],
                    [
                        'rt' => 2,
                        'count' => 3
                    ]
                ]
            ],
            [
        
                'kategori_id' => 2,
                'count_total' => [
                    [
                        'rt' => 1,
                        'count' => 2
                    ],
                    [
                        'rt' => 2,
                        'count' => 3
                    ]
                ]
            ]
        ] */
        $data = [];
        $rws = $this->repository->getRw();
        for ($i=0; $i < count($rws); $i++) { 
            $rws[$i]['rw'] =(int) ltrim($rws[$i]['rw'], '0') ?: '0';
        }
        $rws = $rws->sortBy('rw')->values();
        
        $kategoris = Kategoris::all();

        foreach ($kategoris as $kategori) {
            $data_kategori = [
                'kategori_id' => $kategori->id,
                'kategori_nama' => $kategori->nama,
                'count_total' => []
            ];
            foreach ($rws as $rw) {
                $count = $this->repository->getCountByKelurahanRwKategori($kelurahan_id, $rw->rw, $kategori->id,$tanggal_start,$tanggal_end);
                $data_kategori['count_total'][] = [
                    'rw' => $rw->rw,
                    'count' => $count
                ];
            }
            $data[] = $data_kategori;
        }
        
        return $data;
    }

    public function cetakLaporan($laporan_id){
        $laporan = $this->repository->getById($laporan_id);
        $penanganan_awal = new PenangananAwal();
        $penanganan_awal = $penanganan_awal->repository()->getByLaporanId($laporan_id);
        $keluargaKlien = new KeluargaKlien();
        $keluargaKlien = $keluargaKlien->repository()->getAll([
            'laporan_id' => $laporan_id
        ]);
        $ResourceKeluargaKlien = [];
        foreach ($keluargaKlien as $keluarga) {
            $ResourceKeluargaKlien[] = new KeluargaKlienResource($keluarga);
        }
        $detailKlien = new DetailKlien();
        $detailKlien = $detailKlien->repository()->getByLaporanId($laporan_id);
        $kasus = new DetailKasus();
        $kasus = $kasus->repository()->getByLaporanId($laporan_id);
        if(count($kasus) > 0){
            $kasus = $kasus[0];
        }
        $langkah_telah_dilakukan = new LangkahTelahDilakukan();
        $langkah_telah_dilakukan = $langkah_telah_dilakukan->repository()->getByLaporanId($laporan_id);
        $ResourceLangkahTelahDilakukan = [];
        for ($i=0; $i < count($langkah_telah_dilakukan); $i++) { 
            $langkah_telah_dilakukan[$i]['tanggal_pelayanan'] = Carbon::parse($langkah_telah_dilakukan[$i]['tanggal_pelayanan'])->format('d M Y');
            $ResourceLangkahTelahDilakukan[] = new LangkahTelahDilakukanResource($langkah_telah_dilakukan[$i]);
        }
        $dokumen_pendukung = new DokumenPendukung();
        $dokumen_pendukung = $dokumen_pendukung->repository()->getByLaporanId($laporan_id);
        $ResourceDokumenPendukung = [];
        foreach ($dokumen_pendukung as $dokumen) {
            $ResourceDokumenPendukung[] = new DokumenPendukungResource($dokumen);
        }
        $pelaku = new Pelaku();
        $pelaku = $pelaku->repository()->getByLaporanId($laporan_id);
        $ResourcePelaku = [];
        foreach ($pelaku as $p) {
            $ResourcePelaku = new PelakuCetakResource($p);
        }

        $RAKK = new RAKK();
        $RAKK =
            count($RAKK->repository()->getByLaporanId($laporan_id)) > 0 ? 
                new RAKKResource($RAKK->repository()->getByLaporanId($laporan_id)[0]) 
                : null;
    

        $RRKK = new RRKK();
        $RRKK =
            count($RRKK->repository()->getByLaporanId($laporan_id)) > 0 ? 
                new RRKKResource($RRKK->repository()->getByLaporanId($laporan_id)[0]) 
                : null;

        $lintasOpd = new LintasOPD();
        $lintasOpd = $lintasOpd->repository()->getByLaporanId($laporan_id);
        $ResourceLintasOpd = [];
        foreach ($lintasOpd as $lintas) {
            $ResourceLintasOpd[] = new LintasOPDResource($lintas);
        }

        function getHariIndo($day){
            if ($day == 'Sunday') {
                return 'Minggu';
            }elseif ($day == 'Monday') {
                return 'Senin';
            }elseif ($day == 'Tuesday') {
                return 'Selasa';
            }elseif ($day == 'Wednesday') {
                return 'Rabu';
            }elseif ($day == 'Thursday') {
                return 'Kamis';
            }elseif ($day == 'Friday') {
                return 'Jumat';
            }elseif ($day == 'Saturday') {
                return 'Sabtu';
            }else{
                return '-';
            }
        }
        return [
            'nomor_register' => isset($laporan->nomor_register) ? $laporan->nomor_register : null,
            'pengaduan' => [
                    'hari' => isset($laporan->created_at) ? getHariIndo(Carbon::parse($laporan->created_at)->format('l')) : null,
                    'tanggal' =>isset($laporan->created_at) ? Carbon::parse($laporan->created_at)->format('d/m/Y') : null,
                    'waktu' =>isset($laporan->created_at) ? Carbon::parse($laporan->created_at)->format('H:i') : null,
                    'sumber_aduan' =>isset($laporan->sumber_pengaduan) ? $laporan->sumber_pengaduan : null,
            ],
            'petugas' => [
                'nama' => isset($laporan->satgas_pelapor) && isset($laporan->satgas_pelapor->nama) ? $laporan->satgas_pelapor->nama : null,
                'no_hp' => isset($laporan->satgas_pelapor) && isset($laporan->satgas_pelapor->no_telp) ?  $laporan->satgas_pelapor->no_telp : null,
            ],
            'petugas2' => [
                'nama' => isset($laporan->previous_satgas) && isset($laporan->previous_satgas->nama) ? $laporan->previous_satgas->nama : null,
                'no_hp' => isset($laporan->previous_satgas) && isset($laporan->previous_satgas->no_telp) ? $laporan->previous_satgas->no_telp : null,
            ],
            'penanganan_awal' =>isset($penanganan_awal) && count($penanganan_awal) > 0 ?
            [
                'hari' => getHariIndo(Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('l')),
                'tanggal' => Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('d/m/Y'),
                'waktu' => Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('H:i'),
            ] :  null,
            'tanggal_penjangkauan' => [
                'hari' =>isset($laporan->tanggal_penjangkauan) ? getHariIndo(Carbon::parse($laporan->tanggal_penjangkauan)->format('l')) : null,
                'tanggal' => isset($laporan->tanggal_penjangkauan) ? Carbon::parse($laporan->tanggal_penjangkauan)->format('d/m/Y') : null,
                'waktu' => isset($laporan->tanggal_penjangkauan) ? Carbon::parse($laporan->tanggal_penjangkauan)->format('H:i') : null,
            ],
            'data_pelapor' => [
                'nama_lengkap' =>isset($laporan->nama_pelapor) ? $laporan->nama_pelapor : null,
                'nik' => isset($laporan->nik_pelapor) ? $laporan->nik_pelapor : null,
                'alamat_domisili' => isset($laporan->alamat_pelapor) ? $laporan->alamat_pelapor : null,
                'kota' => isset($laporan->kota_pelapor) && isset($laporan->kota_pelapor->nama) ? $laporan->kota_pelapor->nama : null,
                'no_telp' =>isset($laporan->no_telp_pelapor) ? $laporan->no_telp_pelapor : null,
            ],
            'data_klien' => [
                'nama_lengkap' => isset($laporan->nama_klien) ? $laporan->nama_klien : null,
                'nik' => isset($laporan->nik_klien) ? $laporan->nik_klien : null,
                'no_kk' => isset($laporan->detail_klien) ? $laporan->detail_klien->no_kk : null,
                'ttl' => $detailKlien && isset($detailKlien->kota_lahir) && isset($detailKlien->kota_lahir->nama) ? $detailKlien->kota_lahir->nama . ', '. Carbon::parse($detailKlien->tanggal_lahir)->format('d F Y')  : null,
                'usia' => isset($laporan->usia) ? $laporan->usia . ' Tahun' : null,
                'jenis_kelamin' => isset($laporan->jenis_kelamin) ? ($laporan->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki') : null,
                'agama' => $detailKlien && isset($detailKlien->agama) && isset($detailKlien->agama->nama) ? $detailKlien->agama->nama : null,
                'pendidikan_terakhir' =>isset($laporan->pendidikan) && isset($laporan->pendidikan->nama) ? $laporan->pendidikan->nama : null,
                'pekerjaan' => $detailKlien && isset($detailKlien->pekerjaan) && isset($detailKlien->pekerjaan->nama) ? $detailKlien->pekerjaan->nama : null,
                'status_pernikahan' => $detailKlien && isset($detailKlien->status_perkawinan)&& isset($detailKlien->status_perkawinan->nama) ? $detailKlien->status_perkawinan->nama : null,
                'alamat_kk' => isset($laporan->detail_klien) && isset($laporan->detail_klien->alamat_kk) ? $laporan->detail_klien->alamat_kk : null,
                'alamat_domisili' =>isset($laporan->alamat_klien) ? $laporan->alamat_klien : null,
                'no_telp' =>isset($laporan->no_telp_klien) ? $laporan->no_telp_klien : null,
            ],
            'data_keluarga_klien' => $ResourceKeluargaKlien,
            'data_kasus' => [
                'jenis_klien' => $detailKlien && isset($detailKlien->jenis_klien) ? $detailKlien->jenis_klien : null,
                'kategori_klien' => $detailKlien && isset($detailKlien->kategori_klien) ? $detailKlien->kategori_klien : null,
                'tipe_permasalahan' =>isset($laporan->kategori) && isset($laporan->kategori->nama)? $laporan->kategori->nama : null,
                'kategori_kasus' => $kasus && isset($kasus->kategori_kasus) && isset($kasus->kategori_kasus->nama) ?  $kasus->kategori_kasus->nama : null,
                'jenis_kasus' => $kasus && isset($kasus->jenis_kasus) && isset($kasus->jenis_kasus->nama) ? $kasus->jenis_kasus->nama : null,
                'deskripsi_singkat_kasus' => $kasus && isset($kasus->deskripsi) ? $kasus->deskripsi : null,
                'lokasi_kejadian' => $kasus && isset($kasus->lokasi_kasus) ? $kasus->lokasi_kasus : null,
                'tanggal_dan_waktu_kejadian' =>  $kasus && isset($kasus->tanggal_jam_kejadian) ? Carbon::parse($kasus->tanggal_jam_kejadian)->isoFormat('D MMMM YYYY') . ', ' . Carbon::parse($kasus->tanggal_jam_kejadian)->format('H:i') . ' ' . Carbon::parse($kasus->tanggal_jam_kejadian)->tzName : null
            ],
            'situasi_keluarga' => isset($laporan->situasi_keluarga) ? $laporan->situasi_keluarga : null,
            'kronologi_kejadian' => isset($laporan->kronologi_kejadian) ? $laporan->kronologi_kejadian :null,
            'harapan_klien_dan_keluarga' =>isset($laporan->harapan_klien_dan_keluarga) ? $laporan->harapan_klien_dan_keluarga :null,
            'kondisi_klien' => isset($laporan->kondisi_klien) && $laporan->kondisi_klien ? [
                'fisik' => $laporan->kondisi_klien->fisik,
                'psikologis' => $laporan->kondisi_klien->psikologis,
                'sosial' => $laporan->kondisi_klien->sosial,
                'spiritual'=> $laporan->kondisi_klien->spiritual,
            ] : null,
            'langkah_telah_dilakukan' => $ResourceLangkahTelahDilakukan,
            'dokumen_pendukung' =>  $ResourceDokumenPendukung,
            'pelaku' => $ResourcePelaku,
            'rencana_analisis_kebutuhan_klien' => $RAKK,
            'rencana_rujukan_kebutuhan_klien' => $RRKK,
            'langkah_yang_telah_dilakukan_lintas_opd' => $ResourceLintasOpd,
        ];
    }
}