import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

$(function () {
    // $(function () {
        const table = $('#appointmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/appointment/data',
            columns: [
                { data: 'patient_name', name: 'patient.name' },
                { data: 'doctor_name', name: 'doctor.name' },
                { data: 'department_name', name: 'department.name' },
                { data: 'date', name: 'date' },
                { data: 'time', name: 'time' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        $(document).on('click', '.delete-appointment', function () {
            const id = $(this).data('id');
            const url = "";

            Swal.fire({
                title: 'Delete this appointment?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc2626',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url,
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: () => {
                            table.ajax.reload();
                            Swal.fire('Deleted', 'The appointment has been removed.', 'success');
                        },
                        error: () => {
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        },
                    });
                }
            });
        });
    // });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#appointmentForm').on('submit', function (e) {
    //     e.preventDefault();
    //
    //     const form = this;
    //     const formData = new FormData(form);
    //     const actionUrl = $(form).attr('action');
    //
    //     let method = $(form).find('input[name="_method"]').val() || 'POST';
    //     console.log("Form method:", method);
    //     Swal.fire({
    //         title: 'Processing...',
    //         allowOutsideClick: false,
    //         didOpen: () => Swal.showLoading()
    //     });
    //
    //     $.ajax({
    //         url: actionUrl,
    //         method: "POST",
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //
    //         success: function (response) {
    //             Swal.close();
    //
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: response.message,
    //                 timer: 1500,
    //                 showConfirmButton: false
    //             });
    //             console.log(response);
    //
    //             setTimeout(() => {
    //                 window.location.href = "/doctors";
    //             }, 1500);
    //         },
    //
    //         error: function (xhr) {
    //             Swal.close();
    //
    //             let errorMsg = 'Something went wrong';
    //
    //             if (xhr.responseJSON?.errors) {
    //                 errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
    //             }
    //
    //             Swal.fire({
    //                 title: 'Error!',
    //                 text: errorMsg,
    //                 icon: 'error'
    //             });
    //         }
    //     });
    // });
});
