$(function() {
    $('#convertToReplaceOrderModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#claimNumberInput").attr("value", claimNumber);
    });
});

$(function() {
    $('#enterPartAvailabilityModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#availClaimNumberInput").attr("value", claimNumber);

        $("#partsNeeded").html($(e.relatedTarget).data('parts'));
    });
});

$(function() {
    $('#enterTrackingModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#trackingClaimNumberInput").attr("value", claimNumber);

        $("#trackingNumber").html($(e.relatedTarget).data('tracking'));
    });
});