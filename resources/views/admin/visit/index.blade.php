@extends("layouts.adminLayout")
@section("contents")

<script>
    function edit(obj) {
        var id = obj.parent().parent().attr("item_id");
        var url = "{{ url('admin/visit') }}";
        location.href=url + "/" + id + "/edit";
    }


</script>
<div class="content-wrapper" style="min-height: 916px;">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            VISIT REPORT
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">               
                <!--//Account list-->
                <div class="box account_list">
                  
                    <div class="box-header with-border">
                        <a href="{{url('/admin/visit/create')}}" class="btn btn-info ">Add New</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 15%;">REPORT OWNER</th>
                                                <th style="width: 15%;">ATTENDESS</th>
                                                <th style="width: 15%;">DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($visits as $tr)
                                               
                                                <tr class="gradeA odd" item_id="<?php echo $tr->id ?>">
                                                    <td class=" ">{{$tr->reportowner}}</td>
                                                    <td class=" ">{{$tr->attendess }}</td>
                                                    <td class=" ">{{$tr->created_at }}</td>

                                                    <td class="center ">
                                                        <a onclick="edit($(this))" class="btn btn-primary btn-xs edit"><i class="fa fa-edit "></i> Edit</a>                                                       
                                                        <a href="{{ url('admin/users/delete/'.$tr->id)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-trash "></i> Delete</a>
                                                    </td>
                                                </tr>
                                               
                                            @endforeach
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
<style>
    .form-group.custom_input{
        margin-right: 20px
    }
</style>
@endsection
