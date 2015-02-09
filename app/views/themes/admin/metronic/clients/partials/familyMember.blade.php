<div class="modal fade familyMember" tabindex="-1" role="dialog" aria-labelledby="familyMember" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="ModalLabel">Add Family Member</h4>
            </div>

            {{ Form::open(
                array(
                        'action' => array('Clients\ClientsController@postFamilyPerson'),
                        'method' => 'POST',
                        'role'=>'form',
                        'id' => 'familyForm'
                    )
                )
            }}

            <div class="modal-body">
                <div class="col-lg-12">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            {{
                                                Form::select(
                                                    'title',
                                                    \Config::get('crm.person_title'),
                                                    null,
                                                    array(
                                                        'class'=>'form-control input-sm',
                                                        'id' => 'member_title'
                                                    )
                                                );
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            {{
                                                Form::text(
                                                    'first_name',
                                                    null,
                                                    array(
                                                        'class'=>'form-control input-sm',
                                                        'id' => 'member_firstname'
                                                    )
                                                );
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            {{
                                                Form::text(
                                                    'last_name',
                                                    null,
                                                    array(
                                                        'class'=>'form-control input-sm',
                                                        'id' => 'member_lastname'
                                                    )
                                                );
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth</label>
                                            {{
                                                Form::text(
                                                    'dob',
                                                    null,
                                                    array(
                                                        'class'=>'form-control input-sm input-sm',
                                                        'data-provide'=>'datepicker',
                                                        'data-date-format'=>'dd/mm/yyyy',
                                                        'data-date-autoclose' => 'true',
                                                        'id' => 'member_birthdate'
                                                    )
                                                );
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label class="control-label">Relationship</label>
                                            {{
                                                Form::select(
                                                    'relationship',
                                                    \Config::get('crm.people_relationship'),
                                                    null,
                                                    array(
                                                        'class'=>'form-control input-sm',
                                                        'id' => 'member_relation'
                                                    )
                                                );
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{
                                Form::hidden(
                                    'clientId',
                                    $customer->id,
                                    array(
                                        'class'=>'form-control input-sm',
                                        'id' => 'customer_id'
                                    )
                                );
                            }}
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-blue">Add Member</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>

@section('footer-custom-js')
    @parent
        <script>
            $(function(){
                $(document).on("submit","#familyForm",function(e){
                    e.preventDefault();
                    var title           = $("#member_title").val();
                    var firstname       = $("#member_firstname").val();
                    var lastname        = $("#member_lastname").val();
                    var birthdate       = $("#member_birthdate").val();
                    var relationship    = $("#member_relation").val();
                    var customer_id     = $("#customer_id").val();
                    var _token          = $("input[name='_token']").val();

                    var data = {
                        title: title,
                        first_name: firstname,
                        last_name: lastname,
                        dob: birthdate,
                        relationship: relationship,
                        clientId: customer_id,
                        _token: '{{csrf_token()}}'
                    };

                    var action = $(this).attr('action');

                    $.post(action, data,function( response ){
                        if( response.flag == true){
                            showSuccessAlert('Success', response.message);
                        } else {
                            var msg = '';
                            $.each( response.message, function(key,val){
                                msg += '<p>';
                                msg += val;
                                msg += '</p>';
                            });
                            showErrorAlert("Validation Failed",msg);
                        }
                    });
                })
            });

            function showSuccessAlert(title,message){
                bootbox.dialog({
                            title: title,
                            message: message,
                            buttons: {
                                success: {
                                    label: "Ok",
                                    className: "btn-primary",
                                    callback: function() {
                                            location.reload();
                                    }
                                }
                            }
                        }
                );
            }
            function showErrorAlert(title,message){
                bootbox.dialog({
                            title: title,
                            message: message,
                            buttons: {
                                success: {
                                    label: "Ok",
                                    className: "btn-primary",
                                    callback: function(){
                                        $(".bootbox-close-button").click();
                                    }
                                }
                            }
                        }
                );
            }
        </script>
@stop