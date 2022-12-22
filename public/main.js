$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.select-all').click(function () {
        if (this.checked == true) {
            $('input[type="checkbox"]').prop('checked', true);
        } else {
            $('input[type="checkbox"]').prop('checked', false);
        }
    });
    $(".delete-all").click(function () {
        var allVals = [];
        $(".sub_ck:checked").each(function () {
            allVals.push($(this).attr("data-id"));
        });
        if (allVals.length <= 0) {
            alert("Chọn cột cần xóa");
        } else {
            var record = $(this).attr("record");
            Swal.fire({
                title: "Bạn có chắc xóa các dữ liệu đã chọn?",
                text: "Bạn sẽ không thể khôi phục dữ liệu!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý xóa!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: "/admin/delete-all/" + record,
                        type: "GET",
                        data: {
                            ids: join_selected_values,
                        },
                        success: function (resp) {
                            if (resp["status"] === true) {
                                $(".sub_ck:checked").each(function () {
                                    $(this).parents("tr").remove();
                                    window.location.reload();
                                });
                            }
                        },
                        error: function () {
                            alert("ERROR");
                        },
                    });
                }
            });
        }
    });
    $(".confirmdelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: "Bạn có chắc?",
            text: "Bạn sẽ không thể khôi phục dữ liệu!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý xóa!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    "/admin/delete/" + record + "/" + recordid;
            }
        });
    });
});