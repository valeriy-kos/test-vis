/**
 * Created by valeriy on 25.10.15.
 */
$(document).ready( function() {
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
})