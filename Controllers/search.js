//constantly searches database as user types
function search() {
  var name = $('input#name').val();
  if ($.trim(name) != '') {
    $.post('name.php', {
      name: name
    }, function(data) {
      $('div#name-data').text(data);
    });
    var file = "id-pictures/".concat(name).concat(".jpg");
    picture.setAttribute('src', file);
  }
}