// Convert to replace order modal
$(function() {
    $('#convertToReplaceOrderModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#claimNumberInput").attr("value", claimNumber);
    });
});

// Enter part availability modal
$(function() {
    $('#enterPartAvailabilityModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#availClaimNumberInput").attr("value", claimNumber);

        $("#partsNeeded").html($(e.relatedTarget).data('parts'));
    });
});

// Enter tracking modal 
$(function() {
    $('#enterTrackingModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#trackingClaimNumberInput").attr("value", claimNumber);

        $("#trackingNumber").html($(e.relatedTarget).data('tracking'));
    });
});

// Delete button on claim list - modal
$(function() {
    $('#deleteClaimModal').on("show.bs.modal", function (e) {
        var claimNumber = $(e.relatedTarget).data('claim');
        $(".claimId").html(claimNumber);
        $("#deleteClaimNumberInput").attr("value", claimNumber);
    });
});

// New claim confirmation modal
$(function() {
    $('#confirmNewClaimBtn').click(function() {
        $('#newClaimForm').submit();
    });
});

// New / exisitng customer buttons for claims
if (document.getElementById("existing-customer")) {
    var existingCustomerBTN = document.getElementById("existing-customer");
    var editCustomerBTN = document.getElementById("edit-customer-info");
    var editTypeSwitchHDL = document.getElementById("edit-type-switch");

    existingCustomerBTN.onclick = function () {
        $('#claim-new-customer').collapse('hide');
        editTypeSwitchHDL.setAttribute("value", 1);
    }

    editCustomerBTN.onclick = function () {
        $('#existing-customer-field').collapse('hide');
        editTypeSwitchHDL.setAttribute("value", 0);
    }
}

