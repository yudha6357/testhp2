@extends('layouts.layout')
@section('content')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        <br>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addData">
          add
        </button>
        <br><br><br>
        <h6>Filter Date</h6>
        <form action="{{ route('filter.transaction') }}" method="post" role="form">
        @csrf
          <div class="col-12">
            <div class="coll-6">
              </div>
              <div class="row align-items-start">
                <div class="col-2">
                  <div class="mb-3 sm-3">
                    <label for="start" class="form-label">mulai</label>
                    <input name="start" type="Date" class="form-control" id="start">
                  </div>
              </div>
              <div class="col-2">
                <div class="mb-3 sm-3">
                    <label for="end" class="form-label">Sampai</label>
                    <input name="end" type="Date" class="form-control" id="end">
                </div>
              </div>
              <div class="col">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Find</button>
          </div>
        </form>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Kategori</th>
                  <th>Transaksi</th>
                  <th>Nominal</th>
                  <th>Deskripsi</th>
                  <th>Action</th>
                </tr>
            </thead>     
            <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->category->logging_type}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                      <?php 
                        $rupiah = "Rp " . number_format($item->nominal,0,',','.');
                        echo $rupiah;
                      ?>                  
                    </td>
                    <td>{{$item->description}}</td>
                    <td> 
                      <button type="button" class="btn btn-xs btn-success edit" data-id="{{$item->id}}"><i class="fa fa-pencil"></i>edit</button>
                      {{
                          Form::open([
                          "method" => "DELETE",
                          "route" => ["destroy.transaction", $item["id"]]
                          ])
                      }}
                      <button class="span6 btn btn-small btn-danger" type="submit" style="float: left">
                          <i class='pe-7s-trash'></i>
                          Delete
                      </button>
                      {{ Form::close() }}

                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('add.transaction') }}" method="post" role="form">
      @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="category" class="form-label">Kategory</label>
              <select name="category" class="form-select" id="category">
                <option selected></option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Transaksi</label>
            <input name="name" type="text" class="form-control" id="name">
          </div>
          <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input name="nominal" type="text" class="form-control" id="nominal">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input name="description" type="text" class="form-control" id="description">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- moda edit data -->
<div class="modal inmodal fade" id="editData" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('update.transaction') }}" method="post" role="form">
      @csrf
        <input name="id" type="text" class="form-control" id="edit_id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="category" class="form-label">Kategory</label>
              <select name="category" class="form-select" id="edit_category">
                <option selected></option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
              </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Transaksi</label>
            <input name="name" type="text" class="form-control" id="edit_name" >
          </div>
          <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input name="nominal" type="text" class="form-control" id="edit_nominal">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input name="description" type="text" class="form-control" id="edit_description">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
    //edit data
    $('.edit').on("click",function() {
      var id = $(this).attr('data-id');
      $.ajax({
        url : "{{route('edit.transaction')}}?id="+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#edit_id').val(data.id);
          $('#edit_category').val(data.category);
          $('#edit_name').val(data.name);
          $('#edit_nominal').val(data.nominal);
          $('#edit_description').val(data.description);
          $('#editData').modal('show');
        }
      });
    });

    var dengan_rupiah = document.getElementById('nominal');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  });
</script>
@endsection