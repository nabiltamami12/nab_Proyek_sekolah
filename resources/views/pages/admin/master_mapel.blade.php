@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active capitalize" aria-current="page" >Data Master Mata Pelajaran</li>
  </ol>
</nav>

<!-- <div class="alert alert-primary " role="alert">
  <h4 class="alert-heading">Info!</h4>
  <p>Jurnal oleh guru mata pelajaran dibuat untuk seluruh peserta didik yang mengikuti mata pelajarannya, setiap kejadian terhadap siswa di dalam kelas mata pelajaran yang Anda ampu dapat dicatat dalam jurnal guru agar dapat dimonitor Wali Kelas dan Guru BK</p>
</div> -->

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Daftar Mata Pelajaran</h6>
          <div class="dropdown mb-2">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#TambahData">Tambah Mapel</button>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pelajaran</th>
                  <th>Jurusan</th>
                  <th>KKM</th>
                  <th>Action</th>
                  <!-- <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>KKM</th> -->
                </tr>
              </thead>
              <tbody>
               @foreach($datas as $index => $row) 
                <tr>
                  <td>
                    {{$index+1}}
                  </td>

                  <td>
                    {{$row->nama_mapel}}
                  </td>

                  <td>
                    {{$row->jurusan->jurusan}}
                  </td>
                  <td>
                    {{$row->kkm->kkm}}
                  </td>

                  <td class="flex ">
                        <button class="text-blue-500 hover:text-blue-400 hover:text-white capitalize md:text-sm text-xs rounded-lg transition-all duration-300 ">
                          <span class="material-icons">
                            <a href="{{ url('data_master_mapel', $row->id)}}">
                            edit
                            </a>
                          </span>
                        </button>
                
                      <form method="post" action="{{ url('data_master_mapel', $row->id)}}" onclick="deleteData('{{$row->id}}', this)" >
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="button"  class="text-red-500 hover:text-red-400 hover:text-white capitalize md:text-sm text-xs rounded-lg transition-all duration-300">
                          <span class="material-icons"> 
                            delete_forever  
                          </span>
                        </button>
                      </form>
                    </td>
                </tr>
               @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="TambahDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title capitalize" id="exampleModalLabel">tambah mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
     <form action="{{ url ('data_master_mapel')}}" method="post">
      @csrf
      <div class="modal-body">
       
       @csrf

       <div class="form-group row">
         <div class="col-lg-3">
           <label class="col-form-label">Nama Mapel</label>
         </div>
         <div class="col-lg-8">
           <input type="text" name="mapel" class="form-control"> 
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-3">
           <label class="col-form-label">Jurusan</label>
         </div>
         <div class="col-lg-8">
           <select class="form-control" name="jurusan"  id="defaultconfig-3" type="text" placeholder="Type Something..">
            <option value="">-- jurusan --</option>
            @foreach($jurusan as $row) 
              <option value="{{$row->id}}">
                {{$row->jurusan}}
              </option>

              @endforeach
            </select>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-3">
           <label class="col-form-label">KKM</label>
         </div>
         <div class="col-lg-8">
           <select name="kkm" class="form-control form-control-sm mb-3">
              <option value="">- KKM -</option>

              @foreach($kkm as $row) 
              <option value="{{$row->id}}">
                {{$row->kkm}}
              </option>

              @endforeach
           </select>
         </div>
       </div>

     
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal </button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
  </form>
  </div>
</div>

<script type="text/javascript">
  function editData(id){
    console.log(id);
  }
  function deleteData(id, event) {
    Swal.fire({
      title: 'Apakah yakin menghapus data ini ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if(result.value) {
        event.submit();

        }
    })
  }
</script>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush