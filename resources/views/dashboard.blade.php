@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Beranda</h1>
  </div>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Drainase</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['drainase'] }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-water fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Peta Drainase</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['peta'] }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-map fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proyek</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['proyek'] }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-wrench fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Usulan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['usulan'] }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-book fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
