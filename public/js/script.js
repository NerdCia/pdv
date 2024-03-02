window.onload = () => {
  $('#addSaleModal').modal('show');
}

$(document).click(function(e) {
  if (!$(e.target).is('#collapseProducts')) {
    $('.collapse').collapse('hide');
  }
});