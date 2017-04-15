$(function() {
    $('#convertToReplaceOrderModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#claimNumberInput").attr("value", claimNumber);
    });
});