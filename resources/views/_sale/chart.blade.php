@extends('layouts.adminlte')
@section('title','กราฟรายงานการขายบัตร')
@section('header','กราฟรายงานการขายบัตรแต่ละโซน')

@section('content')

  <div class="col-md-2 col-sm-3">
    <input type="date" name="before" class="form-control" id="before" placeholder="กรุณาระบุวันที่" value="2018-12-15">
  </div>
  <div class="col-md-2 col-sm-3">
    <input type="date" name="after" class="form-control" id="after" placeholder="กรุณาระบุวันที่" value="2018-12-17">
  </div>
  <div class="col-md-8 col-sm-6">
    <button type="" class="btn btn-primary" id="sale-total">แบ่งตามยอดขาย</button>
    <button type="" class="btn btn-primary" id="sale-amount">แบ่งตามจำนวนลูกค้า</button>
    <button type="" class="btn btn-primary" id="sale-ticket">แบ่งตามประเภทบัตร</button>
  </div>


<div class="chart col-md-12 col-sm-12" style="width: 60%; margin: 0 auto; height: 500px">
  <canvas class="canvas" style="height: 100%"></canvas>
</div>

@section('script')
<script src="/js/chart.js"></script>
<script src="/js/jquery.js"></script>
<script src="/js/chart_sale.js"></script>
@endsection
@endsection()