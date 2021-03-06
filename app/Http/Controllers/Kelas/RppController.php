<?php

namespace App\Http\Controllers\Kelas;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Auth;
use App\Model\MasterRpp;
use DB;
class RppController extends BaseController
{
    public function index(Request $request){

       
          $rpp = MasterRpp::where([
            ['hapus', '=', 0],
            ['kelas_id', '=', $request->session()->get('kelas_mapel')]
        ])->get();
        return view('pages.kelas.rpp', [
            'rpp'=> $rpp,
            // 'role_id_user'=> $role_id_user,

        ]);
      
    }
 public function rpp_admin(Request $request){

        $role_id_user = $request->user()->user_detail->role_id;
        if ( $role_id_user == 1) {
             $rpp = MasterRpp::where([
            ['hapus', '=', 0],
        ])->get();
        return view('pages.admin.rpp', [
            'rpp'=> $rpp,
            'role_id_user'=> $role_id_user,
        ]);
        }
     
    }
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function store(Request $request) {
        // $request->validate([
        //     'file' => 'required|mimes:pdf,xlx',
        // ]);
        $file = $request->file('file');
        $filename = time().'.'.$file->getClientOriginalName();
        $file_formatted = str_replace(' ', '_', $filename);
        
        $file->move('rpp', $file_formatted);
        MasterRpp::create([
            'name' => $request->input('name'),
            'name_file' => $file_formatted,
            'created_at' => time(),
            'kelas_id' => $request->session()->get('kelas_mapel')

        ]);

        return redirect('kelas/rpp');
        
    }

    public function edit($id) {

    }

    public function update($id) {

        
    }


    public function destroy($id) {
       MasterRpp::where('id', $id)->update([
           'hapus'=> 1
       ]);

       return redirect('kelas/rpp');
    }

}
