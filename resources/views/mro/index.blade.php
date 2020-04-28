@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->
<script>
    function edit(obj) {
        var id = obj.parent().parent().attr("item_id");
        var url = "{{ url('/mro') }}";
        location.href=url + "/" + id + "/edit";
    }
    $(function(){
        $('#example1').DataTable( {
            "bPaginate": true,
            "searching": true,
            "bFilter": false, 
            "bInfo": false,
            "scrollX": true,
            "bSortable": false,
            "ordering": false
        } );
    })
</script>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           MRO COMPANIES
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">               
                <!--//Account list-->
                <div class="box account_list">
                  
                    <div class="box-header with-border">
                        <a href="{{url('/mro/create')}}" class="btn btn-info ">Add New</a>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 50px;"><input type="checkbox" /></th>
                                                <th style="width: 150px;">Company</th>
                                                <th style="width: 150px;">Country</th>
                                                <th style="width: 150px;">Create</th>
                                                <th style="width: 268px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ( count($companys)>0 )
                                                @foreach ($companys as $tr)
                                                    <tr class="gradeA odd" item_id="<?php echo $tr->id ?>">
                                                        <td class=""><input type="checkbox" /></td>
                                                        <td class=" ">{{$tr->company}}</td>
                                                        <td class=" ">{{$tr->country }}</td>
                                                        <td class=" ">{{$tr->created_at }}</td>

                                                        <td class="center ">
                                                            <a onclick="edit($(this))" class="btn btn-primary btn-xs edit"><i class="fa fa-edit "></i> Edit</a>                                     @if(Auth::user()->role == 1)                  
                                                                <a href="{{ url('/mro/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-trash "></i> Delete</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .form-group.custom_input{
        margin-right: 20px
    }
</style>
@endsection