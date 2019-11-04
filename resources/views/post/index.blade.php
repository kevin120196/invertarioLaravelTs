@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-12">
      <h1>Simple laravel Crud Ajax</h1>
  </div>  
</div>

<div class="row">
    <div class="table table-responsive">
        <table class="table table-bondered" id="table">
            <thead>
                <th width="150px" class="text-center">No</th>
                <th>Title</th>
                <th>Body</th>
                <th>Create At</th>
                <th class="text-center" width="150px">
                    <a href="#" class="create-modal btn btn-success btn-sm" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i></a>
                </th>
            </thead>

            <tbody>
                {{csrf_field()}}
                <?php $no=1;?>
                @foreach ($post as $key => $value)
                   <tr class="post {{$value->id}}">
                       <td>{{$no++}}</td>
                       <td>{{$value->title}}</td>
                       <td>{{$value->body}}</td>
                       <td>{{$value->create_at}}</td>
                       <td>
                            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}"  data-title="{{$value->title}}" data-body="{{$value->body}}">
                                <i class="fa fa-trash"></i>
                            </a>
                       </td>
                   </tr>                     
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="create" class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Post</h4>
                <button type="submit" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
          
                <form method="post" action="/Post" class="form-horizontal" role="form">
                        {{ csrf_field() }}
    
                    <div class="form-group row add">
                        <label for="title" class="control-label col-sm-2">Title</label>
                        <div class="col-md-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="your title here">
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="body" class="control-label col-sm-2">Body</label>
                        <div class="col-md-10">
                            <input type="text" name="body" class="form-control" id="body" placeholder="your body here">
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" id="add"  class="btn btn-success"><span class="fa fa-save">Save Post</span></button>
                <button type="submit" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close">Close</span></button>
            </div>
        </div>
    </div>
</div>
@endsection