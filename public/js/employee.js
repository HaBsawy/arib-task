$(document).ready(function () {
    let columns = [
        {data: 'id', name: 'id'},
        {
            data: 'department_name',
            name: 'department_name',
            sortable: false,
        },
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {
            data: 'full_name',
            name: 'full_name',
            searchable: false,
            sortable: false,
        },
        {data: 'salary', name: 'salary'},
        {
            data: 'image',
            name: 'image',
            searchable: false,
            sortable: false,
            render: function (data, type, row) {
                console.log(data)
                return `<img src="${data || '/img/icon.svg'}" alt="${row['full_name']}" style="max-width: 70px">`;
            }
        },
        {
            data: 'manager_name',
            name: 'manager_name',
            sortable: false,
        },
    ];

    if (can('edit-employee') || can('delete-employee')) {
        columns.push({
            data: 'actions',
            name: 'actions',
            searchable: false,
            sortable: false,
            render: function (data, type, row) {
                let actions = [];
                if (can('edit-employee'))
                    actions.push(`<a href="${APP_URL}/employees/${row.id}/edit" class="btn btn-warning btn-sm mg-r-5 action-button edit-button"  data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil m-r-10"></i></a>`);
                if (can('delete-employee'))
                    actions.push(`<a href="#" data-id="${row.id}" class="btn btn-danger btn-sm action-button remove-button" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash m-r-10"></i></a>`);
                return actions.join('');
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
            url: APP_URL + "/employees",
            type: 'GET',
        },
        columns: columns,
        order: [
            [0, 'asc']
        ],
        pagingType: "full_numbers",
    };

    if (can('create-employee')) {
        options.dom = CONSTANT.LBFRTIP;
        options.buttons = [{
            text: 'Add New',
            className: 'btn-primary btn-theme',
            action: function () {
                document.location.href = APP_URL + '/employees/create';
            }
        }];
    }

    let table = $('#employees').DataTable(options);

    $(document).on('click', '.remove-button', function () {
        let employee_id = $(this).data('id');
        let url = APP_URL + '/employees/' + employee_id;
        let token = $('[name="csrf_token"]').attr('content');

        $.confirm({
            title: 'Are you sure you want to delete this employee?',
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
