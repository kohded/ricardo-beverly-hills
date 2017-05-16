/**
 * Created by peter on 5/15/2017.
 */
// This code is for toggling a form for users to edit comments
$(function() {

    $('.comment-edit-links').click(function() {
        const commentId = $(this).attr('effected-id');
        const originalCommentHandle = $('#original-comment-' + commentId);
        const originalComment = originalCommentHandle.text();
        const targetEditLinkHandle =  $('#comment-edit-link-' + commentId);
        const targetFormHandle = $('#comment-form-' + commentId);
        const targetCancelButtonHandle = $('#comment-cancel-edit-' + commentId);
        const elementThatWasClicked = $(this);

        originalCommentHandle.addClass('hidden');
        targetEditLinkHandle.addClass('hidden');
        targetFormHandle.removeClass('hidden');

        targetCancelButtonHandle.click(function() {
            event.preventDefault();

            originalCommentHandle.removeClass('hidden');
            originalCommentHandle.html(originalComment);
            targetEditLinkHandle.removeClass('hidden');
            targetFormHandle.addClass('hidden');
        });
    });

});