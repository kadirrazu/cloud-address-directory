jQuery(document).ready(function($) {
            
    $('#directory-table').DataTable();

    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });

} );