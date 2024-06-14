@extends('layouts.admin')
@section('css')
<link href="{{asset('assets/layouts/layout4/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="{{url('/admin/home')}}">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<a href="#">Manage Files</a>
</li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!--Code for new data table ends here -->
<div class="row">
  <div class="col-md-12 col-md-offset-0">
  <div class="portlet light bordered">
        <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Manage Files</span>
                  </div>
            </div>
            <div class="portlet-body">
              <div class="page-title">
              @include('inc.messages')
              </div>

              <div class="row" id="search">
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                      {!! Form::text("file_title",null,["class"=>"form-control".($errors->has('file_title')?" is-invalid":"")
                      ,"placeholder"=>"File Title"
                      ,"id"=>"file_title"
                      ]) !!}
                       <label for="file_title">Title</label>
                      </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group form-md-line-input">
                      {{Form::select("file_category",[
                          '' => 'Select Category',
                          'logo' => 'Logo',
                                        'slider' => 'Slider',
                                        'partnersandassociates' => 'Partners $ Associates',
                                        'broucher'=>'Broucher',
                                           'newsletter'=>'News Letter',
                                           'ourgroup'=>'Our Group',
                                              'isocertificates'=>'Iso Certificates',
                                        'others'=>'Others'
                          ]
                         ,null,
                          [
                          "class" => "form-control",
                          "data-placeholder" => "Select Category",
                          "id"=>"file_category"
                        ])
                     }}
                    <label for="file_category"> File Category</label>
                    </div>
               </div>
             
           
                    <div class="form-group col-md-2" style="margin-top: 32px;">
                    <div class="controls">
                    <button type="text" id="btn-search" class="btn red btn-circle  form-control"><span class="glyphicon glyphicon-search">&nbsp;Search</button>
                   </div>
                 </div>
                 <div class="form-group col-md-2" style="margin-top: 32px;">
                    <div class="controls"> 
                    <button type="text" id="btn-reset" class="btn red btn-circle form-control"><span class="glyphicon glyphicon-refresh">&nbsp;Reset</button>
                   </div>
                 </div>
            </div>
              <br>
              <div class="table-toolbar">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="btn-group">
                            <a href="{{url('admin/files/create')}}">  <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control"> Add New
                                  <i class="fa fa-plus"></i>
                              </button></a>
                          </div>
                      </div>
                 </div>
              </div>

              <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="datatable">
                  <thead>
                      <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 500px;">Title</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 500px;">Category</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 70px;">Status</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 70px;">File</th>
                          <th class="sorting_asc float-left" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 100px;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
            </br>



     </div> <!-- Column ends here -->
</div><!-- Row ends here -->


@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
var SITEURL = '{{URL::to('')}}';
    $(document).ready( function () {
        $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    // Viewing Data in Ajax DataTable
     $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "columnDefs": [
            { "width": "20%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "10%", "targets": 2 },
            { "width": "25%", "targets": 3 },
            { "width": "25%", "targets": 3 },
            ],
            "fixedColumns": true,
            "ajax": {
              "url": "{{ route('api.files.index') }}",
              "data": function (d) {
                    d.file_title = $('#file_title').val();
                    d.file_category = $('#file_category').val();
                 }
              },
            //"ajax": "{{ route('api.files.index') }}",
            "columns": [
                { "data": "title", orderable: false},
                { "data": "category", orderable: true },
                { "data": "status", orderable: true },
                { "data": "file", orderable: true },
                { "data": "action", name: 'action', orderable: false}
            ]
        });
    });

    $('#btn-search').click(function(){
      $('#datatable').DataTable().draw(true);
      });

    //Code for button reset starts here
    $('#btn-reset').click(function(){
      $('#file_title').val('');
      $('#file_category').val('').change();
      $('#datatable').DataTable().draw(true); });
    //Code for button reset ends here

    // Delete commons table element via ajax
    $('body').on('click', '#delete-files', function () {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "delete",
                url: SITEURL + "/admin/files/delete/"+id,
                success: function (data) {
                var oTable = $('#datatable').dataTable();
                 oTable.fnDraw(false);
                                var messages = $('.page-title');
                                var successHtml = '<div class="alert alert-success"> '+ data.message +
                               '</div>';

                               $(messages).html(successHtml);
                //  $("#msg").html(data.msg);
                //  $('#page-title').replaceWith($('#page-title',data));
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
      });
});

</script>

<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();

}

</script>
@endsection



{{-- Old files code --}}
{{--@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
    <li>
       <a href="{{url('/admin/home')}}">Home</a>
       <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="#">Manage Files</a>
   </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
   <!-- class="justify-content-right" -->
                <!-- Search box starts here -->
                <div>
                <!--Add new starts here -->
                <a href="{{url('/admin/files/create')}}" class="btn btn-md green"> Add New &nbsp;<i class="fa fa-plus"></i></a>
                <!-- Add new ends here -->
                <div class="table-group-actions pull-right">
                  <form method="get" action="{{url('/admin/files/search')}}">
                      {!! csrf_field() !!}

                       {{Form::select("category",[
                             'logo' => 'Logo',
                             'slider' => 'Slider',
                             'partnersandassociates' => 'Partners $ Associates',
                             'newsletter'=>'News Letter',
                             'ourgroup'=>'Our Group',
                                'isocertificates'=>'Iso Certificates',
                             'broucher'=>'Broucher',
                             'others'=>'Others' ]
                             ,
                              (isset($File)?$File->category:null)
                                ,
                                       [
                                          "class" => "table-group-action-input form-control input-inline input-small input-md",
                                          "placeholder" => "category"
                                       ])
                                 }}

                          {{ Form::button('<i class="fa fa-search"></i> &nbsp;Search</button>', ['type' => 'submit', 'class' =>'btn btn-md green table-group-action-submit'] )  }}
                          </form>
                         </div>
                    </div>
                  <!-- Search box ends here -->
                  <br/>
                  <!-- tring to add gallary functionality for files section  -->
                  <!-- gallary functionality starts here -->
                  <!-- BEGIN SAMPLE FORM PORTLET-->
                  <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-dark"></i><span class="caption-subject font-dark sbold uppercase">Manage Files</span></div>
                            </div>
                            <div class="portlet-body">
                              <div class="table-responsive">
                                    <div class="page-title">
                                       @include('inc.messages')
                                   </div>
                           @foreach($Files as $File)
                          <!-- gallary starts here -->
                            <div class="grid-container">
                                   <div class="grid-item">
                                      <table>
                                         <tr>
                                            <td>
                                              <div class="form-group">
                                                <div class="image-diemensions">
                                                     <embed height="150px" width="300px" src="{{asset((isset($File) && $File->image!='')?'uploads/'.$File->image:'images/nofile.png')}}"  />
                                               </div>
                                                 <div class="image-caption">
                                                        <p id="demo#{{$File->id}}"></p>
                                                     <div class="title caption-desc font-grey-cascade">Title : {{$File->title}}</div>
                                                       @if($File->image != '')
                                                           <div class="caption-desc font-grey-cascade">File Path &nbsp;<pre id="{{$File->id}}" class="mt-code js-link">/uploads/{{$File->image}}</pre>
                                                            </div>

                                                      <!--<div class="caption-desc font-grey-cascade">
                                                       <p id="mt-target-3" class="">File Path:<pre class="mt-code">/uploads/{{$File->image}}</pre></p>
                                                       <a href="javascript:;" class="btn blue-steel mt-clipboard" data-clipboard-action="copy" data-clipboard-target="#mt-target-3">
                                                           <i class="icon-note"></i>&nbsp;Copy</a>
                                                       </div>
                                                         -->

                                                       @endif

                                                          <div class="actions">
                                                            <br/>
                                                            <button onclick="copyToClipboard('#{{$File->id}}')" class="js-copybtn btn blue-steel"><i class="icon-note"></i>&nbsp;Copy Path</button>

                                                            <a href="{{url('/admin/files/update/'.$File->id)}}" class="btn blue btn-md">
                                                               <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-md" data-toggle="modal" href="#basic" data-target="#basic{{$File->id}}">
                                                            <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                                            </button>

                                                                <!--Modal code starts here -->
                                                                <div class="modal fade" id="basic{{$File->id}}" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                                                   <div class="modal-dialog">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                            <h4 class="modal-title"></h4>
                                                                            </div>

                                                                            <div class="modal-body">Are you sure You want to delete this !!! </div>

                                                                            <div class="modal-footer">
                                                                              <div class="grid-container">
                                                                                     <div class="grid-item">
                                                                                       <table>
                                                                                         <thead>
                                                                               <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                             </thead>
                                                                                 <thead>
                                                                                {!! Form::open(['action' => ['filesController@delete', $File->id], 'method' => 'POST']) !!}
                                                                                   {{ Form::hidden('_method', 'DELETE') }}
                                                                                   {{ Form::submit('Yes Delete !!' ,['class'=>'btn red']) }}
                                                                                   {!! Form::close() !!}
                                                                                  {{csrf_field()}}
                                                                                </thead>
                                                                                </table>
                                                                              </div>
                                                                            </div>
                                                                       </div>
                                                                       <!-- /.modal-content -->
                                                                  </div>
                                                                   <!-- /.modal-dialog -->
                                                            </div>
                                                           <!--Modal code ends here -->
                                                   </div>
                                                 </div>
                                            </td>
                                          </tr>
                                      </table>
                                  </div>
                             </div>
                      <!-- GALLARY ENDS HERE -->
               @endforeach
             </div>
           </div>
         </div>
       <nav>
        <ul class="pagination justify-content-end">
          {{ $Files->links() }}
        </ul>
      </nav>
 <!--Card logic ends here -->
    <!-- gallary view logic ends here -->
    <!-- END SAMPLE FORM PORTLET-->
  <!-- gallary functionality ends here -->
@endsection
@section('scripts')
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();

}

</script>

@endsection
--}}