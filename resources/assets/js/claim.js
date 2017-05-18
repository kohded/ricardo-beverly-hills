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
            $('#claim-order-details').collapse('show');
            $('#claim-new-customer').collapse('hide');
            editTypeSwitchHDL.setAttribute('value', 1);
        };

        editCustomerBTN.onclick = function () {
            $('#claim-order-details').collapse('show');
            $('#existing-customer-field').collapse('hide');
            editTypeSwitchHDL.setAttribute('value', 0);
        };
    }

    // Claim list icon popovers
    $('#icon-legend').popover({
        content: `<div class="row">
                    <div class="col-xs-12">
                        <h5><u>Action Needed</u></h5>
                        <p>
                          <span class="fa fa-suitcase text-warning" aria-hidden="true"></span>
                           : Authorize Replace Order
                        </p>
                        <p>
                          <span class="fa fa-truck text-warning" aria-hidden="true"></span>
                           : Enter Tracking Number
                        </p>
                        <h5><u>Claim</u></h5>
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
        placement: 'left',
        title: 'Icon Legend',
        trigger: 'hover',
    });
});

// If Charge is selected, unhide credit card button
$(function() {
    var courtesyOrCharge = $('input[name=courtesy_charge]');
    var chargeBtn = $('#charge_btn');
    courtesyOrCharge.change(function() {
        if($('input[name=courtesy_charge]:checked').val() == "Charge") {
            chargeBtn.removeClass("hidden");
        } else {
            chargeBtn.addClass("hidden");
        }
    });
});

// Pull in customer name and address on modal open
$(function() {
    $('#creditCardModal').on("show.bs.modal", function (e) {
        $('#ccname').val(function() {
            return $('#customer-first-name').val() + " " + $('#customer-last-name').val();
        });
        $('#ccaddress1').val(function() {
            return $('#customer-address1').val();
        });
        $('#ccaddress2').val(function() {
            return $('#customer-address2').val();
        });
        $('#cccity').val(function() {
            return $('#customer-city').val();
        });
        $('#ccstate').val(function() {
            return $('#customer-state').val();
        });
        $('#cczip').val(function() {
            return $('#customer-zip').val();
        });

        // Hook up print button to print and create print view
        $('#printbtn').click(function() { 
            $('#print-name').text(function() {
                return $('#ccname').val();
            });
            $('#print-ccnum').text(function() {
                return $('#ccnumber').val();
            });
            $('#print-exp').text(function() {
                return $('#ccexp').val();
            });
            $('#print-sec').text(function() {
                return $('#ccsec').val();
            });
            $('#print-address1').text(function() {
                return $('#ccaddress1').val();
            });
            $('#print-address2').text(function() {
                return $('#ccaddress2').val();
            });
            $('#print-city').text(function() {
                return $('#cccity').val();
            });
            $('#print-state').text(function() {
                return $('#ccstate').val();
            });
            $('#print-zip').text(function() {
                return $('#cczip').val();
            });
            window.print();
        });
    });
});


