<div class="modal fade client-message-preview" tabindex="-1" role="dialog" aria-labelledby="client-message-preview" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="ModalLabel">MESSAGE PREVIEW</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 message-details"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer-custom-js')
    @parent

    <script>
        $(function(){
            $("a.client-message-view").click(function(e){
                e.preventDefault();
                var data = $(this).attr("data-url") + "&show=modal&_token={{csrf_token()}}";
                var title = "Message: " + $(this).attr("data-subject");

                $(".message-details").load(data);
                $(".client-message-preview").find(".modal-title").html(title);
                $(".client-message-preview").modal("show");
            });
        });
    </script>
@stop
