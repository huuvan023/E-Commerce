@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Admin
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">       
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="form-control"  placeholder="Search">
          <span class="input-group-btn">
            <button  class="btn btn-success" type="button">Tìm kiếm!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên admin</th>
            <th>Avatar</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_admin as $key => $admin)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $admin->admin_name }}</td>
            <td><img src="public/uploads/admin/{{ $admin->admin_image }}" height="100" width="100"></td>
            <td>{{ $admin->  admin_email }}</td>
            <td>{{ $admin->admin_phone }}</td>
            <td><span class="text-ellipsis">
            <?php
               if($admin->admin_status==0){
                ?>
                <a href="{{URL::to('/unactive-admin/'.$admin->admin_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-admin/'.$admin->admin_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-admin/'.$admin->admin_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-admin/'.$admin->admin_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
        
      </table>
      <form action="{{url('export-csv-admin')}}" method="POST">
          @csrf
       <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>
    </div>
    
    <footer class="panel-footer">
    <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          {!!$all_admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection