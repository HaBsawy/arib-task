$(document).ready(function () {
    let columns = [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {
            data: 'employees_count',
            name: 'employees_count',
            searchable: false,
            sortable: false,
        },
        {
            data: 'salary_sum',
            name: 'salary_sum',
            searchable: false,
            sortable: false,
        },
        {
            data: 'actions',
            name: 'actions',
            searchable: false,
            sortable: false,
            render: function (data, type, row) {
                let actions = [];
                if (can('edit-department'))
                    actions.push(`<a href="${APP_URL}/departments/${row.id}/edit" class="btn btn-warning btn-sm mg-r-5 action-button edit-button"  data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil m-r-10"></i></a>`);
                if (can('delete-department'))
                    actions.push(`<a href="#" data-id="${row.id}" class="btn btn-danger btn-sm action-button remove-button" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash m-r-10"></i></a>`);
                return actions.join('');
            }
        },
    ];

    let options = {
        processing: true,
        serverSide: true,
        retrieve: true,
        responsive: true,
        paging: false,
        oLanguage: {sProcessing: "<i class='fa fa-refresh fa-spin fa-2x'></i>"},
        ajax: {
            url: APP_URL + "/departments",
            type: 'GET',
        },
        columns: columns,
        order: [
            [0, 'asc']
        ],
        pagingType: "full_numbers",
    };

    if (can('create-department')) {
        options.dom = CONSTANT.LBFRTIP;
        options.buttons = [{
            text: 'Add New',
            className: 'btn-primary btn-theme',
            action: function () {
                document.location.href = APP_URL + '/departments/create';
            }
        }];
    }

    $('#departments').DataTable(options);

    $(document).on('click', '.remove-button', function () {
        let department_id = $(this).data('id');
        let url = APP_URL + '/departments/' + department_id;
        let token = $('[name="csrf_token"]').attr('content');

        $.confirm({
            title: 'Are you sure you want to delete this department?',
            content: `
                <form action="${url}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${token}">
                </form>`,
            theme: CONSTANT.SUPERVAN,
            buttons: {
                confirm: function () {
                    this.$content.find('form').submit();
                },
                close: {
                    text: 'Close'
                }
            }
        });
    });

});
