@extends("layouts.adminLayout")
@section("contents")

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('admin/visit')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Edit Visit Report
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="user_form" name="user_form" action="{{url('admin/visit/'.$visit->id )}}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input {{ $errors->has('reportowner') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Report Owner<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="report_owner" type="text" value="{{ $visit->reportowner }}"  required>
                                    @if ($errors->has('reportowner'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('reportowner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('attendess') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Attendess<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="attendess" type="text" value="{{ $visit->attendess }}" required>
                                    @if ($errors->has('lastname'))
                                        <span class="attendess-block">
                                            <strong>{{ $errors->first('attendess') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                            <button type="submit" class="btn btn-info save_button">Save</button>
                            <button type="button" class="btn btn-info back_button">Back</button>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection