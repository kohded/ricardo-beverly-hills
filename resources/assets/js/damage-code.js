// Delete button on customer list - modal
$(function() {
    $('#deleteDamageCodeModal').on("show.bs.modal", function (e) {
        $(".damageCodeName").html($(e.relatedTarget).data('name'));
        $("#deleteDCName").attr("value", $(e.relatedTarget).data('name'));
        $("#deleteDamageCodeId").attr("value", $(e.relatedTarget).data('id'));
    });
});