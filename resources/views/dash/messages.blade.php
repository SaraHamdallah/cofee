@extends('./layouts.dashMain')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Messages</h3>
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
                    <h2>List of Messages</h2>
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
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Show</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($messages as $message)
                        <tr>
                          <td>{{ $message->name }}</td>
                          <td>{{ $message->email }}</td>
                          <td>
                            <a href="{{ route('showMessage', $message->id) }}"><img src="{{ asset('assets/dash/images/edit.png') }}" alt="show"></a>
                          </td>
                          <td>
                            <form id="delete-form-{{ $message->id }}" action="{{ route('delMessage', $message->id) }}" method="post" style="display: none;">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" value="{{ $message->id }}" name="id">
                            </form>
                            <a href="javascript:void(0);"onclick="confirmDelete({{ $message->id }});">
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
          function confirmDelete(messageId) {
            if (confirm('Are you sure you want to delete this message?')) {
                document.getElementById('delete-form-' + messageId).submit();
            }
          }
        </script>
@endsection