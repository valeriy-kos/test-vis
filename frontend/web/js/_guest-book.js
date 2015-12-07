/**
 * Created by valeriy on 12.09.15.
 */
jQuery(document).ready(function() {

    $(function () {
        // Prevent bootstrap dialog from blocking focusin
        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });
        tinymce.init({selector: "textarea",
                plugins:[
                    "advlist autolink lists link  moxiemanager image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste moxiemanager"
                ],

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            external_plugins: {
            "moxiemanager": "/js/moxiemanager/plugin.min.js"
                },
                autosave_ask_before_unload: false,
                setup: function(ed) {
                    ed.on("blur", function(ed) {
                    // here you use tinymce.activeEditor.setContent(...);
                    $('#guestbook-content').html(tinymce.activeEditor.getContent({ format: 'html' }));
                    return false;
                })}

            /*plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",*/
                /*"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image",*/
        });
    });

    /*$('#button-guest-book').click(function(e){
        e.preventDefault();
            var guestBook = $('#guest-book').serialize();
            var content = $('#guest-book').find('#tinymce').html();
            $.ajax({
                url:	'/site/valid-guest-book',
                data:	guestBook,
                type:	'post',
                dataType: "json",
                success: function(jsonDate, options){
                    if(!$.isEmptyObject(jsonDate)) {
                        $.each(jsonDate, function (ida, val) {
                            $('#'+ida).addClass("error");
                            $('#'+ida).next('.help-block').addClass("error");
                            $('#'+ida).next('.help-block').html(val);
                            if(ida=="Ok") $('#f_nakredit input[type="text"]').val('').attr('checked', false);
                            return false;
                        });
                    }
                }
            });
        });*/
});
