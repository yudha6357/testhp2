@extends('layouts.layout')
@section('content')
  <div id="content">
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
      <H3 class="text-center">Data Keuangan</H3>
      <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col mr-2">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Saldo Saat ini</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">        
                      <?php 
                        $rupiah = "Rp " . number_format($available,0,',','.');
                        echo $rupiah;
                      ?> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengeluaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                        $rupiah = "Rp " . number_format($amount_expenditure,0,',','.');
                        echo $rupiah;
                      ?> 
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pemasukkan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                        $rupiah = "Rp " . number_format($amount_income,0,',','.');
                        echo $rupiah;
                      ?> 
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!---Container Fluid-->
  </div>
@endsection
