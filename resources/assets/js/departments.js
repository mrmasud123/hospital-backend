import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

$(function () {
    console.log("Department page");
    // let table = $('#departmentTable').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: '/departments/data',
    //         type: 'GET',
    //         dataSrc: function (json) {
    //             console.log("DataTables response:", json);
    //             return json.data;
    //         },
    //         error: function (xhr) {
    //             console.error("AJAX Error:", xhr.responseText);
    //         }
    //     },
    //     columnDefs: [
    //         {
    //             targets: '_all',
    //             createdCell: function (td) {
    //                 $(td).addClass('text-gray-800 dark:text-gray-200');
    //             }
    //         }
    //     ],
    //     columns: [
    //         { data: 'name', name: 'name', searchable: true },
    //         { data: 'code', name: 'code', searchable: true },
    //         { data: 'head_doctor', name: 'headDoctor.name', orderable: false, searchable: false },
    //         { data: 'phone', name: 'phone', searchable: true },
    //         { data: 'status', name: 'is_active', orderable: false, searchable: false, className: 'text-center' },
    //         { data: 'action', orderable: false, searchable: false, className: 'text-right' }
    //     ]
    // });

    $('#departmentTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "/departments/data",

        columns: [
            {
                data:'name',

                render:function(data,type,row){

                    return `
                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-300">🏥 </div>
                            <div>
                                <div class="font-semibold text-gray-800 dark:text-white">
                                    ${data}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    ${row.email}
                                </div>
                            </div>
                        </div>
                        `;
                    }
                },

            {
                data: 'code',
                render: function(data) {
                    return `
                    <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                        ${data}
                    </span>
                `;
                }
            },

            {
                data: 'head_doctor',
            },

            {
                data: 'phone'
            },

            {
                data: 'location'
            },

            {
                data: 'status',
                orderable: false,
                searchable: false
            },

            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ],

        pageLength: 10,

        language: {
            search: "",
            searchPlaceholder: "Search departments..."
        },

        drawCallback: function () {
            $('.dataTables_paginate .paginate_button')
                .addClass('rounded-md');
        }
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
