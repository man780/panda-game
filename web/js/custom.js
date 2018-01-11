/**
 * Created by admin on 11.01.2018.
 */
$(function(){
    $("#createBannerButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });
});