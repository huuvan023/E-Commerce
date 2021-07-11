@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách Mailchimp
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
            <th>Tên Email</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_email as $key => $brand_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $brand_pro->email }}</td>
            
          </tr>
          @endforeach
       
      </table>
      </tbody>

        <form action="{{url('export-csv-email')}}" method="POST">
          @csrf
       <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>

    </div>
    <!--
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
         
          </ul>
        </div>
      </div>
    </footer>
    !-->
  </div>
</div>
@endsection