/**
 * Created by admin on 11.01.2018.
 */
$(function(){
    $("#createBranchButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $(".updateBranchButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createTeamButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $(".updateTeamButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createFotoButton").click(function(){
        console.log();
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createVideoButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createAchievmentsButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createAdsButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createNewsButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createRoleButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createDocumentButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $("#createProductButton").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });

    $(".openModalForm").click(function(){
        $("#modal").modal('show')
            .find('#modalContentBackend')
            .load($(this).attr('value'));
    });
});