// Delete button on product list - modal
$(function() {
    $('#deleteProductModal').on("show.bs.modal", function (e) {
        var productStyle = $(e.relatedTarget).data('style');
        $(".productStyle").html(productStyle);
        $("#deleteProductStyle").attr("value", productStyle);
    });
});