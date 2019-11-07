@extends('layouts.master')
@section('title','Tool')
@section('styles')
<style>
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right shadow animated-fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div> --}}
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label>Url: </label>
                            <input class="form-control" type="text" name="url">
                        </div>
                        <div class="form-group">
                            <label>Website: </label>
                            <select class="form-control select-website" name="website">
                                <option>- Website -</option>
                                @foreach ($website as $element)
                                <option value="{{$element->id}}">{{$element->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categoies: </label>
                            <select class="form-control select-category" name="category">
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" name="" value="Crawl">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $(".select-website").on("change", function() {
        var id = $(this).find("option:selected").val();

        $.ajax({
            url: "{{ route('getCategoryByWebsiteId') }}",
            method: "get",
            data: {
                id
            },
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    var html = '';
                    for (var i = 0; i < data.data.length; i++) {
                        html += "<option value='" + data.data[i].id + "'>" + data.data[i].name + "</option>";
                    }
                    $(".select-category").html(html);
                }
            },
            error: function() {
                toastr.error("Failed to get");
            }
        });
    });
});

</script>
@endsection
