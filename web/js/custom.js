/**
 * Created by admin on 11.01.2018.
 */
$(function(){
    $("#createBranchButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createTeamButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });
});