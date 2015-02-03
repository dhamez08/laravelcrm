<!-- modal for creating custom forms -->
<div class="modal fade" id="add-opportunity-form-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">Add new Opportunity</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'clients/create-opportunities/'.$client_id)) }}
        <input type="hidden" name="id" id="opportunity-id-hidden" value="" />
      	<div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Opportunity Name:</label>
                  <input type="text" class="form-control" name="opportunity_name" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Opportunity Description:</label>
                  <textarea class="form-control" name="opportunity_description"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Expected Value (£):</label>
                  <input type="text" class="form-control" name="expected_value" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Milestone & Probability of Winning:</label>
                  <div class="row">
                    <div class="col-md-6">
                      <select name="milestone" class="form-control">
                        <option value="0">Select a milestone</option>
                      @foreach($milestones as $key => $milestone)
                        <option value="{{ $key }}">{{ $milestone }}</option>
                      @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <select name="probability" class="form-control">
                        <option value="0">Select a probability</option>
                      @foreach($probabilities as $key => $probability)
                        <option value="{{ $key }}">{{ $probability }}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Expected Close Date:</label>
                  <input type="text" class="form-control" name="close_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-autoclose="true" />
                </div>
              </div>
            </div>
            <div class="row op_status" style="display:none">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Status:</label>
                  <select name="status" class="form-control">
                    <option value="0">Open</option>
                    <option value="1">Close</option>
                  </select>
                </div>
              </div>
            </div>
            @if(count($opp_tags)>0)
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Assign Tag: <small>(select multiple by holding Crtl)</small></label>
                  <select multiple="multiple" name="tag[]" class="form-control">
                  @foreach($opp_tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      	<div class="row">
	      	<div class="col-md-12">
	      		<button type="submit" class="btn blue">Save</button>
	      		<button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
	      	</div>
      	</div>
      	{{ Form::close() }}
      </div>

    </div>
  </div>
</div>
<!-- end modal -->