@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           UPLOAD FLEETS DATA
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <input class="file col-md-6" type="file" name="file">
                {{-- <span class="btn btn-success fileinput-button">
                <span>Open Data Search File</span>
                <input type="file" name="file" data-url={{route('getheader')}}>
                </span> --}}
                <button type="submit" class="btn btn-warning">Import DB Data</button>
                {{-- <button type="submit" class="btn btn-submit">search</button> --}}
            </div>
        </form>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection