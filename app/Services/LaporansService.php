<?php

namespace App\Services;

use App\Http\Resources\DokumenPendukungResource;
use App\Http\Resources\KeluargaKlienResource;
use App\Http\Resources\LangkahTelahDilakukanResource;
use App\Http\Resources\LaporansResource;
use App\Http\Resources\LintasOPDResource;
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
        $data['rt'] = "1";
        $data['rw'] = "1";

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
        if($kasus){
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
            $ResourcePelaku = new PelakuResource($p);
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
        return ModelUtils::filterNullValues([
            'nomor_register' => $laporan->nomor_register,
            'pengaduan' => [
                    'hari' => Carbon::parse($laporan->created_at)->format('l'),
                    'tanggal' => Carbon::parse($laporan->created_at)->format('d/m/Y'),
                    'waktu' => Carbon::parse($laporan->created_at)->format('H:i'),
                    'sumber_aduan' => $laporan->sumber_aduan,
            ],
            'petugas' => [
                'nama' => $laporan->satgas_pelapor->nama,
                'no_hp' => $laporan->satgas_pelapor->no_telp,
            ],
            'petugas2' => [
                'nama' => $laporan->previous_satgas->nama,
                'no_hp' => $laporan->previous_satgas->no_telp,
            ],
            'penanganan_awal' => count($penanganan_awal) > 0 ?
            [
                'hari' => Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('l'),
                'tanggal' => Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('d/m/Y'),
                'waktu' => Carbon::parse($penanganan_awal[0]->tanggal_penanganan_awal)->format('H:i'),
            ] :  null,
            'tanggal_penjangkauan' => [
                'hari' => Carbon::parse($laporan->tanggal_penjangkauan)->format('l'),
                'tanggal' => Carbon::parse($laporan->tanggal_penjangkauan)->format('d/m/Y'),
                'waktu' => Carbon::parse($laporan->tanggal_penjangkauan)->format('H:i'),
            ],
            'data_pelapor' => [
                'nama_lengkap' => $laporan->nama_pelapor,
                'nik' => $laporan->nik_pelapor,
                'alamat_domisili' => $laporan->alamat_pelapor,
                'kota' => $laporan->kota_pelapor->nama,
                'no_telp' => $laporan->no_telp_pelapor,
            ],
            'data_klien' => [
                'nama_lengkap' => $laporan->nama_klien,
                'nik' => $laporan->nik_klien,
                'no_kk' => $laporan->detail_klien ? $laporan->detail_klien->no_kk : null,
                'ttl' => $detailKlien ? $detailKlien->kota_lahir->nama . ', '. Carbon::parse($detailKlien->tanggal_lahir)->format('d F Y') : null,
                'usia' => $laporan->usia . ' Tahun',
                'jenis_kelamin' => $laporan->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki',
                'agama' => $detailKlien ? $detailKlien->agama->nama : null,
                'pendidikan_terakhir' => $laporan->pendidikan->nama,
                'pekerjaan' => $detailKlien ? $detailKlien->pekerjaan->nama : null,
                'status_pernikahan' => $detailKlien ? $detailKlien->status_perkawinan->nama : null,
                'alamat_kk' => $laporan->detail_klien ? $laporan->detail_klien->alamat_kk : null,
                'alamat_domisili' => $laporan->alamat_klien,
                'no_telp' => $laporan->no_telp_klien,
            ],
            'data_keluarga_klien' => $ResourceKeluargaKlien,
            'data_kasus' => [
                'jenis_klien' => $detailKlien ? $detailKlien->jenis_klien : null,
                'kategori_klien' => $detailKlien ? $detailKlien->kategori_klien : null,
                'tipe_permasalahan' => $laporan->kategori->nama,
                'kategori_kasus' => $kasus ?  $kasus->kategori_kasus->nama : null,
                'jenis_kasus' => $kasus ? $kasus->jenis_kasus->nama : null,
                'deskripsi_singkat_kasus' => $kasus ? $kasus->deskripsi : null,
                'lokasi_kejadian' => $kasus ? $kasus->lokasi_kasus : null,
                'tanggal_dan_waktu_kejadian' =>  $kasus ? Carbon::parse($kasus->tanggal_jam_kejadian)->isoFormat('D MMMM YYYY') . ', ' . Carbon::parse($kasus->tanggal_jam_kejadian)->format('H:i') . ' ' . Carbon::parse($kasus->tanggal_jam_kejadian)->tzName : null
            ],
            'situasi_keluarga' => $laporan->situasi_keluarga,
            'kronologi_kejadian' => $laporan->kronologi_kejadian,
            'harapan_klien_dan_keluarga' => $laporan->harapan_klien_dan_keluarga,
            'kondisi_klien' => $laporan->kondisi_klien ? [
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
        ]);
    }
}