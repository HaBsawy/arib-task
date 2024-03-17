$(document).ready(function () {
    let columns = [
        {data: 'id', name: 'id'},
        {
            data: 'employee_name',
            name: 'employee_name',
            searchable: false,
            sortable: false,
        },
        {data: 'name', name: 'name'},
        {data: 'status', name: 'status'},
    ];

    if (can('edit-task')) {
        columns.push({
            data: 'actions',
            name: 'actions',
            searchable: false,
            sortable: false,
            render: function (data, type, row) {
                return `<a href="${APP_URL}/tasks/${row.id}/edit" class="btn btn-warning btn-sm mg-r-5 action-button edit-button"  data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil m-r-10"></i></a>`;
            }
        })
    }

    let options = {
        processing: true,
        serverSide: true,
        retrieve: true,
        responsive: true,
        paging: false,
        oLanguage: {sProcessing: "<i class='fa fa-refresh fa-spin fa-2x'></i>"},
        ajax: {
            url: APP_URL + "/tasks",
            type: 'GET',
        },
        columns: columns,
        order: [
            [0, 'asc']
        ],
        pagingType: "full_numbers",
    };

    if (can('create-task')) {
        options.dom = CONSTANT.LBFRTIP;
        options.buttons = [{
            text: 'Add New',
            className: 'btn-primary btn-theme',
            action: function () {
                document.location.href = APP_URL + '/tasks/create';
            }
        }];
    }

    $('#tasks').DataTable(options);
});
