@extends('./layouts.dashMain')

@section('content')
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Manage {{ $title1 }}</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>List of {{ $title }}</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                      <!-- Success Alert -->
                    @if(session('success'))
                      <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                      </div>
                    @endif

                    <!-- Error Alert -->
                    @if($errors->has('error'))
                      <div class="alert alert-danger" role="alert">
                          {{ $errors->first('error') }}
                      </div>
                    @endif
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Beverage Date</th>
                          <th>Title</th>
                          <th>Published</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($beverages as $beverage)
                        <tr>
                          <td>{{ $beverage->created_at->format('d M Y') }}</td>
                          <td>{{ $beverage->title }}</td>
                          <td>{{ $beverage->published ? 'Yes' : 'No'}}</td>
                          <td><a href="{{ route('editBeverage', $beverage->id) }}"><img src="{{ asset('assets/dash/images/edit.png') }}" alt="Edit"></a></td>
                          <td>
                            <form id="delete-form-{{ $beverage->id }}" action="{{ route('delBeverage', $beverage->id) }}" method="post" style="display: none;">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" value="{{ $beverage->id }}" name="id">
                            </form>
                            <a href="javascript:void(0);"onclick="confirmDelete({{ $beverage->id }});">
                            <img src="{{ asset('assets/dash/images/delete.png') }}" alt="Delete">
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function confirmDelete(beverageId) {
      if (confirm('Are you sure you want to delete this beverage?')) {
        document.getElementById('delete-form-' + beverageId).submit();
      }
    }
  </script>
@endsection