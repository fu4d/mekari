@extends('layouts.base',['title'=>'Laravel Angular'])

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>Item Management</h1>
        </div>
        <div class="pull-right" style="padding-top:30px">
            <div class="box-tools" style="display:inline-table">
              <div class="input-group">
                  <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                  <span class="input-group-addon">Search</span>
              </div>
            </div>
            <button class="btn btn-success" id="btn-add" data-toggle="modal" data-target="#linkEditorModal">Create New</button>
        </div>
    </div>
</div>
<table class="table table-bordered pagin-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th width="220px">Action</th>
        </tr>
    </thead>
    <tbody  id="items-list">
         <?php $index = 1 ?>
    	@foreach ($values as $value)
        <tr id="item{{$value->id}}" >
            <td><input type="checkbox" name="itemid" class="itemid" value="{{ $value->id }}"> <span> {{ $index++ }} </span></td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->description }}</td>
            <td>
            <button data-toggle="modal" value="{{ $value->id }}" class="btn  btn-info btn-edit">Edit</button>
            <button value="{{ $value->id }}" class="btn btn-danger delete-item">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr><td colspan="4">
            <button onclick="removeall()" class="btn btn-danger">Delete All</button></td></tr>
    </tfoot>
</table>
<nav class="pull-right">
    <ul class="pagination justify-content-end">
        {{ $values->links() }}
    </ul>
</nav>

<!-- Create Modal -->
<div class="modal fade" id="linkEditorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modalFormData" method="POST" name="addItem" role="form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Item</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <strong>Title : </strong>
                            <div class="form-group">
                                <input type="hidden" id="item_id">
                                <input ng-model="form.title" type="text" placeholder="Item Name" id="item_name" name="title" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <strong>Description : </strong>
                            <div class="form-group" >
                                <textarea ng-model="form.description" id="description" class="form-control" required>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-save" value="update" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

@stop

@section('customjs')
<script type="text/javascript">
    jQuery(document).ready(function($){
    ////----- Open the modal to CREATE an item -----////
    jQuery('#btn-add').click(function () {
      jQuery('#btn-save').val("add");
      jQuery('#modalFormData').trigger("reset");
    });

    ////----- Open the modal to UPDATE a link -----////
    jQuery('body').on('click', '.btn-edit', function () {
      var item_id = $(this).val();
      $.get('/items/' + item_id, function (data) {
        jQuery('#item_id').val(data.id);
        jQuery('#item_name').val(data.title);
        jQuery('#description').val(data.description);
        jQuery('#btn-save').val("update");
        jQuery('#linkEditorModal').modal('show');
      });
    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });
      e.preventDefault();
      var formData = {
        title: jQuery('#item_name').val(),
        description: jQuery('#description').val(),
      };
      var state = jQuery('#btn-save').val();
      var type = "POST";
      var item_id = jQuery('#item_id').val();
      var ajaxurl = '/items';
      if (state == "update") {
        type = "PUT";
        ajaxurl = '/items/' + item_id;
      }

      $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            let rowindex = parseInt($('#items-list tr:last-child td:first-child').find('span').html())+1;
            console.log(rowindex);
            var item = '<tr id="item' + data.id + '"><td><input type="checkbox" name="itemid" class="itemid" value="' + data.id + '"> <span>'+rowindex+'</span></td><td>' + data.title + '</td><td>' + data.description + '</td>';
            item += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
            item += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
            if (state == "add") {
                jQuery('#items-list').append(item);
            } else {
                $("#item" + item_id).replaceWith(item);
            }
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
      });
    });

    ////----- DELETE item and remove from the page -----////
    jQuery('.delete-item').click(function () {
      var result = confirm("Are you sure delete this item?");
      if (result) {
        var item_id = $(this).val();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });
        $.ajax({
          type: "DELETE",
          url: '/items/' + item_id,
          success: function (data) {
              console.log(data);
              $("#item" + item_id).remove();
          },
          error: function (data) {
              console.log('Error:', data);
          }
        });
      }
    });
});

function removeall(){
    var result = confirm("Are you sure delete these items?");
    if (result) {
      var selected = $('input[name="itemid"]:checked');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      selected.each(function() {
        let item_id = this.value;
        $.ajax({
          type: "DELETE",
          url: '/items/' + item_id,
          success: function (data) {
              console.log(data);
              $("#item" + item_id).remove();
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
      });
    }
}
</script>
@stop
