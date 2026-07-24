"use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showReportModal(id) {
    let modal = $('#reportModal');
    modal.find('[name=complaint_id]').val(id);
    modal.modal('show');
}

$(document).on('click', '.addToShortList', function () {
    if(!$(this).data('login')) {
        notify('error', 'Please login first.');
        return;
    }
    
    let profileId = $(this).data('profile_id');
    let url = $(this).data('action');
    let li = $(this).parents('li');
    $.ajax({
        type: "post",
        url: url,
        data: {
            profile_id: profileId
        },
        beforeSend: function () {
            $(li).find('a').html(`<i class="far fa-star"></i>${config.loadingText.addShortList}..`);
        },
        success: function (response) {
            if (response.error) {
                notify('error', response.error);
            } else {
                li.find('a').remove();
                li.html(`
                    <a href="javascript:void(0)"
                        class="removeFromShortList"
                        data-profile_id="${profileId}"
                        data-action="${config.routes.removeShortList}">
                        <i class="far fa-star"></i>${config.buttonText.removeShortList}
                    </a>
                `);
                notify('success', response.success);
            }
        }
    });
});

$(document).on('click', '.removeFromShortList', function () {
    let profileId = $(this).data('profile_id');
    let url = $(this).data('action');
    let li = $(this).parents('li');

    $.ajax({
        type: "post",
        url: url,
        data: {
            profile_id: profileId
        },
        beforeSend: function () {
            $(li).find('a').html(`<i class="far fa-star"></i>${config.loadingText.removeShortList}..`);
        },
        success: function (response) {
            if (response.error) {
                notify('error', response.error);
            } else {
                li.find('a').remove();
                li.html(`
                <a href="javascript:void(0)"
                    data-profile_id="${profileId}"
                    data-action="${config.routes.addShortList}"
                    data-login="true"
                    class="addToShortList">
                    <i class="far fa-star"></i>${config.buttonText.addShortList}
                </a>
                `);
                notify('success', response.success);
            }
        }
    });
})
