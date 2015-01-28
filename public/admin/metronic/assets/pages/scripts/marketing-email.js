/**
 * Created by dhamez on 1/29/15.
 */
var MarketingEmail = function(){
    var emails = null;

    return {
        init: function(){
            emails = new Array();

            $('body').on('click','.remove-email',function(){
                var email = $(this).closest('li');
                var message_id = email.attr('id').split('email-').join('');
                var index = emails.indexOf(message_id);
                emails.splice(index,1);
                email.remove();
                console.log(emails);
            });

            $('#select2_user').on('change',function(){
                var option = $('#select2_user option:selected');
                var li = $('<li>').attr('id','email-'+option.val()).append(option.data('fullname')).append($('<i>').addClass('fa fa-times remove-email'));

                var email_list = $('#email-list');
                if(email_list.find('#email-'+option.val()).length == 0){
                    email_list.append(li);
                    emails.push(option.val());
                }
            })
        }
    }

}()