window.onload = () => {
  $('#addSaleModal').modal('show');
  $('#editProductModal').modal('show');
  $('#createCategoryModal').modal('show');
  $('#createProductModal').modal('show');
}

$(document).click(function(e) {
  if (!$(e.target).is('#collapseProducts')) {
    $('.collapse').collapse('hide');
  }
});