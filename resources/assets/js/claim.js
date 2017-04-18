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

// New customer form
if (document.getElementById("existing-customer")) {
    var existingCustomerBTN = document.getElementById("existing-customer");
    var existingCustomerFields = document.getElementById("existing-customer-field");

    var editCustomerBTN = document.getElementById("edit-customer-info");
    var editCustomerFields = document.getElementById("claim-new-customer");

    editCustomerFields.style.display = "none";
    existingCustomerFields.style.display = "none";

    var editTypeSwitchHDL = document.getElementById("edit-type-switch");

    existingCustomerBTN.onclick = function () {
        editCustomerFields.style.display = 'none';
        existingCustomerFields.style.display = 'block';
        editTypeSwitchHDL.setAttribute("value", 1);
    }

    editCustomerBTN.onclick = function () {
        existingCustomerFields.style.display = 'none';
        editCustomerFields.style.display = 'block';
        editTypeSwitchHDL.setAttribute("value", 0);
    }
}

