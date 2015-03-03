<div id="friendsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="friendsModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Friends</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th width="5%">&nbsp;</th>
                    <th width="85%">Name</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($sub_users) && count($sub_users) > 0)
                    @foreach($sub_users as $friend)
                    <tr>
                      <td>{{ Form::checkbox('friends[]', $friend->user_id, false, array('class' => 'form-control')) }}</td>
                      <td>{{ $friend->first_name }} {{ $friend->last_name }}</td>
                      <td><a href="#" class="btn btn-sm btn-success">Chat</a></td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="3">
                        <div class="alert alert-info">No friends.</div>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>