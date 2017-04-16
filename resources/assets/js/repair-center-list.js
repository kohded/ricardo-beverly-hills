// Delete button on customer list - modal
$(function() {
    $('#deleteRepairCenterModal').on("show.bs.modal", function (e) {
        $(".repairCenterName").html($(e.relatedTarget).data('name'));
        $("#deleteRepairCenterId").attr("value", $(e.relatedTarget).data('id'));
    });
});