<?php
namespace App\Http\Controllers; 
use App\Models\Mahasiswa; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
 /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
//  public function index()
//  {
//  //fungsi eloquent menampilkan data menggunakan pagination
//  $mahasiswa = Mahasiswa::all(); // Mengambil semua isi tabel
//  $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
//  return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
//  }
public function index(){
    // $data = Mahasiswa::paginate(4);
    // return view('mahasiswa.index',compact('data'));
    // yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
    $mahasiswa = Mahasiswa::with('kelas')->get();
    $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
    return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
}
 public function create()
 {
//  return view('mahasiswa.create');
$kelas = Kelas::all(); //mendapatkan data dari tabel kelas
return view('mahasiswa.create',['kelas' => $kelas]);
 }
 public function store(Request $request)
 {
 //melakukan validasi data
 $request->validate([
    'Nim' => 'required',
    'Nama' => 'required',
    'Kelas' => 'required',
    'Jurusan' => 'required',
    'Email' => 'required',
    'Alamat' => 'required',
    'TanggalLahir' => 'required',
 ]);

 $mahasiswa = new Mahasiswa;
 $mahasiswa->nim = $request->get('Nim');
 $mahasiswa->nama = $request->get('Nama');
//  $mahasiswa->kelas = $request->get('Kelas');
 $mahasiswa->jurusan = $request->get('Jurusan');
 $mahasiswa->save();

 $kelas = new Kelas;
 $kelas->id = $request->get('Kelas');

 //fungsi eloquent untuk menambah data dengan relasi belongsTo
 $mahasiswa->kelas()->associate($kelas);
 $mahasiswa->save();
 
//  //dd($request->all());
//  //fungsi eloquent untuk menambah data
//  Mahasiswa::create($request->all());
 //jika data berhasil ditambahkan, akan kembali ke halaman utama
 return redirect()->route('mahasiswa.index')
 ->with('success', 'Mahasiswa Berhasil Ditambahkan');
 }
 public function show($nim)
 {
 //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
 $Mahasiswa = Mahasiswa::where('nim', $nim)->first();
 return view('mahasiswa.detail', compact('Mahasiswa'));
 }
 public function edit($nim)
 {
//menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
 $Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();
 return view('mahasiswa.edit', compact('Mahasiswa'));
 }
 public function update(Request $request, $nim)
 {
//melakukan validasi data
 $request->validate([
 'Nim' => 'required',
 'Nama' => 'required',
 'Kelas' => 'required',
 'Jurusan' => 'required',
 'Email' => 'required',
 'Alamat' => 'required',
 'TanggalLahir' => 'required',
 ]);
//fungsi eloquent untuk mengupdate data inputan kita
 Mahasiswa::where('nim', $nim)
 ->update([
 'nim'=>$request->Nim,
 'nama'=>$request->Nama,
 'kelas'=>$request->Kelas,
 'jurusan'=>$request->Jurusan,
 'email'=>$request->Email,
 'alamat'=>$request->Alamat,
 'tanggallahir'=>$request->TanggalLahir,
 ]);
//jika data berhasil diupdate, akan kembali ke halaman utama
 return redirect()->route('mahasiswa.index')
 ->with('success', 'Mahasiswa Berhasil Diupdate');
 }
 public function destroy( $nim)
 {
//fungsi eloquent untuk menghapus data
 Mahasiswa::where('nim', $nim)->delete();
 return redirect()->route('mahasiswa.index')
 -> with('success', 'Mahasiswa Berhasil Dihapus');
 }
 public function search(Request $request){
    // Get the search value from the request
    $search = $request->input('search');
    //dd($search);
    // Search in the title and body columns from the posts table
    $data = Mahasiswa::where('nim', 'LIKE', "%{$search}%")
        ->orWhere('nama', 'LIKE', "%{$search}%")
        ->paginate();

    // Return the search view with the resluts compacted
    return view('mahasiswa.search', compact('data'));
}
}; 