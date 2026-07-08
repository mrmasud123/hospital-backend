import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

$(function () {
    let table = $('#doctorTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/doctors/data',
            type: 'GET',
            dataSrc: function (json) {
                console.log(json.data);
                return json.data;
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        columnDefs: [
            {
                targets: '_all',
                createdCell: function (td) {
                    $(td).addClass('text-gray-800 dark:text-gray-200');
                }
            }
        ],
        columns: [
            { data: 'name', name: 'name', searchable: true },

            { data: 'email', name: 'email', searchable: true },
            { data: 'department', orderable: false, searchable: false },
            { data: 'specialization', orderable: false, searchable: false },
            { data: 'qualification', orderable: false, searchable: false },
            { data: 'status', orderable: false, searchable: false, className: '!text-center' },
            { data: 'role', orderable: false, searchable: false, className: '!text-center' },
            { data: 'action', orderable: false, searchable: false, className: '!text-right' }
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#doctorTable').on('click', '.deleteBtn', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This doctor will be deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/doctors/${id}`,
                    type: 'DELETE',
                    success: function () {
                        table.ajax.reload();
                        Swal.fire('Deleted!', 'Doctor has been deleted.', 'success');
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#doctorForm').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const actionUrl = $(form).attr('action');

        let method = $(form).find('input[name="_method"]').val() || 'POST';
        console.log("Form method:", method);
        Swal.fire({
            title: 'Processing...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: actionUrl,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
                Swal.close();

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                console.log(response);

                setTimeout(() => {
                    window.location.href = "/doctors";
                }, 1500);
            },

            error: function (xhr) {
                Swal.close();

                let errorMsg = 'Something went wrong';

                if (xhr.responseJSON?.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
                }

                Swal.fire({
                    title: 'Error!',
                    text: errorMsg,
                    icon: 'error'
                });
            }
        });
    });
});
