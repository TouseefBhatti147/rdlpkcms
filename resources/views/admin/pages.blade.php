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
<a href="#">Manage Pages</a>
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
                      <span class="caption-subject bold uppercase"> Manage Pages</span>
                  </div>
            </div>
            <div class="portlet-body">
              <div class="page-title">
              @include('inc.messages')
              </div>
              <div class="table-toolbar">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="btn-group">
                            <a href="{{url('admin/pages/create')}}">  <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control"> Add New
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
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 70px;">Status</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 80px;">Image</th>
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
            { "width": "35%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "35%", "targets": 3 },
            ],
            "fixedColumns": true,
            "ajax": "{{ route('api.pages.index') }}",
            "columns": [
                { "data": "title", orderable: false},
                { "data": "status", orderable: true },
                { "data": "image", orderable: true },
                { "data": "action", name: 'action', orderable: false}
            ]
        });
    });

    // Delete commons table element via ajax
    $('body').on('click', '#delete-pages', function () {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "delete",
                url: SITEURL + "/admin/pages/delete/"+id,
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
@endsection





{{-- Old code --}}
{{--@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
    <a href="{{url('/admin/home')}}">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
    <a href="#">Manage Pages</a>
</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- Search box starts here -->
<div>
<!--Add new starts here -->
<a href="{{url('/admin/pages/create')}}" class="btn btn-md green"> Add New &nbsp;<i class="fa fa-plus"></i></a>
<!-- Add new ends here -->
<div class="table-group-actions pull-right">
  <form method="get" action="{{url('/admin/pages/search')}}">
{!! Form::text("searchpage",isset($PageEdit)?$PageEdit->searchpage:null,["class"=>"form-control input-inline input-small".($errors->has('searchpage')?" is-invalid":"")
                                                  ,"autofocus"
                                                  ,"placeholder"=>"Search Pages"
                                                  ,"required"]) !!}
      {{ Form::button('<i class="fa fa-search"></i> &nbsp;Search</button>', ['type' => 'submit', 'class' =>'btn btn-md green table-group-action-submit'] )  }}
      </form>
         </div>
    </div>
    <br>
  <!-- Search box ends here -->
  <!-- tring to add gallary functionality for files section  -->
  <!-- gallary functionality starts here -->
  <!-- BEGIN SAMPLE FORM PORTLET-->
  <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i><span class="caption-subject font-dark sbold uppercase">Manage Pages</span></div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive">
                    <div class="page-title">
                       @include('inc.messages')
                   </div>

                   <!-- Table logic starts here -->
                        <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                   <tr>
                                      <th><div class="table-title">Title</div></th>
                                   <th><div class="table-title">Status</div></th>
                                      <th><div class="table-title">Image</div></th>

                                      <th><div class="table-title">Actions</div></th>
                                  </tr>
                                  </thead>
                                     @foreach($Pages as $Page)
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="table-title">
                                            <div class="title caption-desc font-grey-cascade">{{$Page->title}}</div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="table-title">
                                            <div class="title caption-desc font-grey-cascade">@if ($Page->status == 1)
                                                  Enabled
                                                  @else Disabled
                                               @endif</div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="table-title">
                                          <img height="100px" style="object-fit: cover;" width="100px" src="{{asset((isset($Page) && $Page->image!='')?'uploads/'.$Page->image:'images/noimage.jpg')}}"></img>
                                        </div>
                                      </td>

                                      <td>
                                        <div class="actions">
                                          <br/>
                                          <div class="grid-container">
                                                 <div class="grid-item">
                                                   <table>
                                                     <thead>
                                      <a href="{{url('/admin/pages/update/'.$Page->id)}}" class="btn blue btn-md">
                                             <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                          </a>
                                        </thead>
                                           <thead>
                                          <button type="button" class="btn btn-danger btn-md" data-toggle="modal" href="#basic" data-target="#basic{{$Page->id}}">
                                          <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                          </button>
                                        </thead>
                                        </table>
                                        </div>
                                      </div>
                                              <!--Modal code starts here -->
                                              <div class="modal fade" id="basic{{$Page->id}}" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
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
                                                              {!! Form::open(['action' => ['pagesController@delete', $Page->id], 'method' => 'POST']) !!}
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
                                  </tbody>
                                @endforeach
                          </table>
                       <!-- Table logic ends here -->


                 </div>
               </div>
             </div>
            <nav>
            <ul class="pagination justify-content-end">
               {{ $Pages->links() }}
            </ul>
            </nav>
            <!--Card logic ends here -->
               <!-- gallary view logic ends here -->
               <!-- END SAMPLE FORM PORTLET-->
                      <!-- gallary functionality ends here -->
@endsection
--}}