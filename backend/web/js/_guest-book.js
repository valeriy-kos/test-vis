/**
 * Created by valeriy on 12.09.15.
 */
jQuery(document).ready(function() {
    $(function () {
        tinymce.init({selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                /* "insertdatetime media table contextmenu paste moxiemanager imagetools",*/
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
            autosave_ask_before_unload: false,
        });
    });
});
