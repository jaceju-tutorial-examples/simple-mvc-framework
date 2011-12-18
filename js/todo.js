$(function () {
  try {
    $('#update-todo').trigger('reset');
    $('.check').click(function (e) {
      $checkbox = $(this);
      if ($checkbox.prop('checked')) {
        var id = $checkbox.val();
        $.post('./?act=done', { 'id': id }, function () {
          $checkbox.parents('.todo').addClass('done');
        });
      } else {
        e.preventDefault();
      }
    });
  } catch (e) {
    console.log(e);
  }
});