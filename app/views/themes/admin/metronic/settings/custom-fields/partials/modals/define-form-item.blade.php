<!-- modal for defining form items -->
<div class="modal fade" id="define-form-item-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      {{
        Form::open(
          array(
            'url' =>  '#'
          )
        )
      }}      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Define Form Item</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

              <div class="form-body">
                <div class="form-group">
                  {{ Form::label('signature_name', 'Signature Name') }}
                  {{ 
                    Form::text
                    (
                      'signature_name', '', array('class' => 'form-control', 'required' => 'required')
                    ) 
                  }}
                </div>
                <div class="form-group">
                  {{ Form::label('signature_body', 'Signature Body') }}
                  {{ 
                    Form::textarea
                    (
                      'signature_body', '', array('class' => 'form-control', 'required' => 'required')
                    ) 
                  }}                                    
                </div>
              </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn blue">Save</button>
        <button type="button" class="btn default" data-dismiss="modal">Close</button>               
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- end modal -->