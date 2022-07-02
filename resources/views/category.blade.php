@extends('layouts.layout')
@section('content')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
        <br>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addData">
          add
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                  <th>No</th>
                  <th>tipe</th>
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Action</th>
                </tr>
            </thead>     
            <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->logging_type}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td> 
                      <button type="button" class="btn btn-xs btn-success edit" data-id="{{$item->id}}"><i class="fa fa-pencil"></i>edit</button>
                      {{
                          Form::open([
                          "method" => "DELETE",
                          "route" => ["destroy.category", $item["id"]]
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
      <form action="{{ route('add.category') }}" method="post" role="form">
      @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="type" class="form-label">Tipe Transaksi</label>
              <select name="type" class="form-select" id="type">
                <option selected></option>
                <option value="pemasukkan">Pemasukkan</option>
                <option value="pengeluaran">Pengeluaran</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Transaksi</label>
            <input name="name" type="text" class="form-control" id="name">
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
      <form action="{{ route('update.category') }}" method="post" role="form">
      @csrf
        <input name="id" type="text" class="form-control" id="edit_id" hidden>
        <div class="modal-body">
          <div class="mb-3">
            <label for="type" class="form-label">Tipe Transaksi</label>
              <select name="type" class="form-select" id="edit_type">
                <option selected></option>
                <option value="pemasukkan">Pemasukkan</option>
                <option value="pengeluaran">Pengeluaran</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Transaksi</label>
            <input name="name" type="text" class="form-control" id="edit_name">
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
        url : "{{route('edit.category')}}?id="+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#edit_id').val(data.id);
          $('#edit_type').val(data.logging_type);
          $('#edit_name').val(data.name);
          $('#edit_description').val(data.description);
          $('#editData').modal('show');
        }
      });
    });
  });
</script>
@endsection