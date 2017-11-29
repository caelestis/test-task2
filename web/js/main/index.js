$(document).ready(function(){
    $('#tasks').DataTable({
        'bFilter': false,
        'pageLength': 3,
        'lengthMenu': [3, 10, 25, 50, 100],
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.13/i18n/Russian.json'
        },
        "aaSorting": [[ 1, "desc" ]]
    });

    $('#tasks a').editable();
});

$(document).on('click', '.change_status', function () {
    var id = $(this).closest('tr').data("key");

    $.ajax({
        url: "/main/change-status",
        type: "post",
        data:'id=' + id,
        success: function(data) {
            // location.reload();
        }
    });
});
