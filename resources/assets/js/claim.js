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

// Hide / show parts information based on if user clicks replace or repair order
$(function() {
    var partsInputs = $('#partsInputs');
    var partDetails = $('#partDetails');
    var partsRequiredRadio = $("#partsRequiredRadio");
    var partsNotRequiredRadio = $("#partsNotRequiredRadio");

    $('#replaceOrderBtn').click(function() {
        // Hide parts fields that aren't necessary
        partsInputs.slideUp();
        partsNotRequiredRadio.attr('checked', true);
    });
    $('#repairOrderBtn').click(function() {
        // Show parts fields if they are hidden
        if ( partsInputs.is(":hidden")) {
            partsInputs.show();
            partsRequiredRadio.attr('checked', false);
            partsNotRequiredRadio.attr('checked', false);
        }
    });

    partsNotRequiredRadio.click(function() {
        // Hide part details that aren't necessary
        partDetails.slideUp();
        $("#partsNotRequiredRadio").attr('checked', true);
        $('#part-needed').attr('input', "");
    });
    partsRequiredRadio.click(function() {
        // Show part details if they are hidden
        if ( partDetails.is(":hidden")) {
            partDetails.show();
        }
    });

    // New / exisitng customer buttons for claims
    if (document.getElementById("existing-customer")) {
        var existingCustomerBTN = document.getElementById("existing-customer");
        var editCustomerBTN = document.getElementById("edit-customer-info");
        var editTypeSwitchHDL = document.getElementById("edit-type-switch");

        existingCustomerBTN.onclick = function () {
            $('#claim-new-customer').collapse('hide');
            editTypeSwitchHDL.setAttribute("value", 1);
        };

        editCustomerBTN.onclick = function () {
            $('#existing-customer-field').collapse('hide');
            editTypeSwitchHDL.setAttribute("value", 0);
        };
    }

    // Claim list icon popovers
    $('#action-needed-icons').popover({
        content: `<div class="row">
                    <div class="col-xs-12">
                    <p>
                      <span class="fa fa-suitcase text-warning" aria-hidden="true"></span>
                       : Authorize Replace Order
                    </p>
                    <p>
                      <span class="fa fa-truck text-warning" aria-hidden="true"></span>
                       : Enter Tracking Number
                    </p>
                    </div>
                  </div>`,
        html: true,
        placement: 'right',
        title: 'Action Needed Icons',
        trigger: 'hover',
    });

    $('#claim-icons').popover({
        content: `<div class="row">
                    <div class="col-xs-12">
                    <p>
                      <span class="fa fa-wrench text-primary" aria-hidden="true"></span>
                       : Repair Order
                    </p>
                    <p>
                      <span class="fa fa-suitcase text-primary" aria-hidden="true"></span>
                       : Replace Order
                    </p>
                    </div>
                  </div>`,
        html: true,
        placement: 'right',
        title: 'Claim Icons',
        trigger: 'hover',
    });
});

