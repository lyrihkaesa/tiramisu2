@extends('layouts.tabler')

@section('title','Toram fill Stat Simulator')
@section('description','Toram fill stats Skill level 4 Simulator calculator +20  +21')
@section('image',to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">

  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Fill Stat Simulator</h1>
    </div>

    <div class="row">
      <div class="col-12">
      @include('inc.cari')
      </div>

      <div class="col-12">
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
      </div>

      <div class="col-12">
        <div class="alert alert-info">
        Untuk melihat fill stats formula <a href="/fill_stats">klik disini</a>
        </div>

      </div>

    </div>

    <div class="row equal justify-content-center">

      <div class="col-md-6 mb-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Resep status </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div class="form-group">
              <label class="form-label">Type</label>
              <div class="selectgroup w-100">
                 <label class="selectgroup-item">
                     <input onclick="document.querySelector('#recipe_pot').value = 46" type="radio" value="w" class="selectgroup-input" checked="false" name="weap_arm" id="weap_arm">
                            <span class="selectgroup-button selectgroup-button-icon">Weapon</span>
                 </label>

                 <label class="selectgroup-item">
                     <input onclick="document.querySelector('#recipe_pot').value = 44" type="radio" value="a" checked="true" class="selectgroup-input" name="weap_arm" id="weap_arm">
                            <span class="selectgroup-button selectgroup-button-icon">Armor</span>
                 </label>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Recipe Pot</label>
              <input type="number" value="44" class="form-control" id="recipe_pot">
            </div>


            <div class="form-group">
              <label class="form-label">Starting Pot</label>
                   <input type="number" value="89" class="form-control" id="starting_pot">
            </div>

            <div class="form-group">
              <label class="form-label">Level prof bs</label>
            	<input type="number" min=1 max=200 class="form-control" id="prof" value=1 oninput="update_prof_lv();">
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary btn-pill m-1" onclick="start_stat()">Start!</button>

              <a href="/fill_stats" class="btn btn-pill btn-outline-warning m-1"><i class="fe fe-settings"></i> Manual formula</a>

            </div>


            <div class="mt-3">
              <small class="text-muted">Credit: <a href="https://sparkychildcharlie.github.io/statting_simulator" rel="nofollow" target="_blank">Charlie Kobayashi</a></small>
            </div>
          </div>
        </div>
      </div>
      <div class="w-100"></div>
      <div class="col-md-5 mb-5 hidden">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Status</h3>
          </div>
          <div class="card-body p-3">
            <div class="form-group">
              <div class="row gutter-xs p-3" id="workspace"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-5 hidden">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Formula</h3>
          </div>
          <div class="card-body p-3" id="formula_display">
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-5 hidden">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Material Used</h3>
          </div>
          <div class="card-body p-3" id="material_display">
          </div>
        </div>
      </div>

    </div>

    <!-- ads -->
    <div class="row">
      <div class="col-12">
        @includeWhen(!app()->isLocal(), 'inc.ads_article')</div>
    </div>

  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="saveImgModal" tabindex="-1" role="dialog" aria-labelledby="saveImgModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="saveImgModalTitle">Save As Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="imgsaved">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" id="dl-image">Download</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')

<style>
  @media (min-width: 768px) {
  .equal {
    display: -webkit-box;

  display: -webkit-flex;

  display: -ms-flexbox;

  display:         flex;
  }
}
  .hidden {
    display: none
  }

  .card {
    height: 100%
  }
</style>
@endsection

@section('footer')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/vendors/html2canvas.min.js"></script>
<script src="/assets/js/newfill.js"></script>

@endsection