import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

$(function () {
    console.log("Department page");
    let table = $('#departmentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/departments/data',
            type: 'GET',
            dataSrc: function (json) {
                console.log("DataTables response:", json);
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
            { data: 'code', name: 'code', searchable: true },
            // { data: 'head_doctor', name: 'headDoctor.name', orderable: false, searchable: false },
            { data: 'phone', name: 'phone', searchable: true },
            { data: 'status', name: 'is_active', orderable: false, searchable: false, className: 'text-center' },
            { data: 'action', orderable: false, searchable: false, className: 'text-right' }
        ]
    });

    // Delete button handler
    // $('#departmentTable').on('click', '.deleteBtn', function () {
    //     const id = $(this).data('id');
    //
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "This department will be deleted.",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: `/departments/${id}`,
    //                 type: 'DELETE',
    //                 data: { _token: $('meta[name="csrf-token"]').attr('content') },
    //                 success: function () {
    //                     table.ajax.reload();
    //                     Swal.fire('Deleted!', 'Department has been deleted.', 'success');
    //                 },
    //                 error: function () {
    //                     Swal.fire('Error', 'Something went wrong.', 'error');
    //                 }
    //             });
    //         }
    //     });
    // });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#departmentForm').on('submit', function (e) {
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
                    title: 'Success!',
                    text: response.message,
                    icon: 'success'
                }).then(() => {
                    window.location.href = "/departments";
                });
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
