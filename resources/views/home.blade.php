<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search</title>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
  

  <!-- <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.css')}}"> -->
  <link rel="stylesheet" href="{{asset('assets\admin\plugins\datatables\extensions\Responsive\css\dataTables.responsive.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/_all-skins.min.css')}}">

  <!-- Daterange picker -->
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- ../assets/admin/bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

  <!-- DataTables -->
  <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.js')}}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> --}}
  <!-- SlimScroll -->
  <script src="{{asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('assets\admin\plugins\datatables\extensions\Responsive\js\dataTables.responsive.js')}}"></script>

  <script src="{{asset('assets/admin/js/jquery.validate.min.js')}}"></script>
  {{-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/select.js"></script> --}}


 </head>
 <body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">    
        <br />
        <h3 align="center">Search</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title">Search Process</h3>
            </div>
            <div class="panel-body">
            {{-- <form action="{{route('import')}}" method="POST" enctype="multipart/form-data"> --}}
            <form action="{{url('search')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="advance-search">
                    <div class="row">
                        <input class="file col-md-6" type="file" name="file" data-url={{route('getheader')}}>
                        {{-- <span class="btn btn-success fileinput-button">
                        <span>Open Data Search File</span>
                        <input type="file" name="file" data-url={{route('getheader')}}>
                        </span> --}}
                        <button type="submit" class="btn btn-warning">Import DB Data</button>
                        <button class="btn btn-submit col-md-6" id="searchBtn">search</button>
                        {{-- <button type="submit" class="btn btn-submit">search</button> --}}
                    </div>
                    
                    
                </div>
                <br>
                <div class="advance-search">
                    <span class="desc">ADVANCED SEARCH</span>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <span class="desc">Database Fields</span>
                            @for ($i = 0; $i < 5; $i++)
                            <select class="form-control" id="data_sel{{$i}}" name="data_sel[]">
                                <option></option>
                                @foreach ($fieldLists as $item)
                                    <option>{{$item}}</option>
                                @endforeach
                            </select>
                            <br>
                            @endfor
                        </div>
                        <div class="col-md-6">
                            <span class="desc">Data Search File</span>
                            @for ($i = 0; $i < 5; $i++)
                            <select class="form-control" id="search_sel{{$i}}" name="search_sel[]">
                                <option></option>
                            </select>
                            <br>
                            @endfor
                        </div>
                    </div>
                </div>
                <br>
                
            </form>
            <div class="advance-search" id="searchContent" data-url={{route('search.content')}}></div>
               
            </div>
        </div>
    </div>
    <div class="loader" style="display: none"></div>
    <script>
        
        $(document).ready(function(){
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                default_load(page);
            });

            $('[name=file]').change(function(e){
                e.preventDefault();
                var form = $('form')[0];
                var formData = new FormData(form);
                
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: $('[name=file]').data('url'),
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                        var xml = '<option></option';
                        for(var i=0; i<5; i++){
                            $('#search_sel' + i).html(xml);
                        }
                    },
                    success: function(data) {
                        // console.log(data.headings)
                        var xml = '';
                        data.headings[0].forEach(function (element, index) {
                            xml = xml + '<option value="' + index + '">' + element + '</option>';
                        });
                        // console.log(xml)
                        for(var i=0; i<5; i++){
                            $('#search_sel' + i).append(xml);
                        }
                    }
                });
            })

            $('#searchBtn').click(function(e){
                e.preventDefault();
                default_load(1);
            })
            function default_load (page) {
                var form = $('form')[0];
                var formData = new FormData(form);
                formData.append("page", page);
                console.log(form);
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: $("#searchContent").data('url'),
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                        // Show image container
                        // $("#search-section").css("background-color", "#ececec");
                        $("#searchContent").html('');
                        $(".loader").show();
                    },
                    success:function(data){
                        console.log(data);
                        $("#searchContent").html(data.content);
                    },
                    complete:function(data){
                        // Hide image container
                        // $("#search-section").css("background-color", "white");
                        $(".loader").hide();
                    }
                });
            }
        })
    </script>
 </body>
</html>