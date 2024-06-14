<a
href="{{url('/admin/newsletters/update/'.$id)}}"
data-toggle="tooltip"
data-id="{{ $id }}"
data-original-title="Edit"
class="red btn btn-xs">
   <span class="glyphicon glyphicon-edit">
     Edit
   </span>
</a>
<button
type="button"
data-toggle="modal"
href="#basic"
data-target="#basic{{$id}}"
class="red btn btn-xs">
     <span class="glyphicon glyphicon-remove-circle">
       Delete
     </span>
</button>
<!--Modal code starts here -->
<div class="modal fade" id="basic{{$id}}" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title"></h4>
</div>
<div class="modal-body">Are you sure You want to delete this !!! </div>
<div class="modal-footer">
<div class="row">
<div class="col-md-8 pull-left">
</div>
<div class="col-md-2">
        <button class="btn red btn-sm delete" id="delete-newsletters" data-dismiss="modal" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}">Yes Delete !!</button>
</div>
  <div class="col-md-2">
       <a type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</a>
  </div>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</div>
<!--Modal code ends here -->

<!-- Third Model starts here -->
<!-- Third Model ends here -->
