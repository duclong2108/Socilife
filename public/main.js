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
    $('.discount').keyup(function(){
        var discount = $(this).val();
        var coin=$('.coin_original').val();
        var price=$('.price_original').val();
        if(discount>100||discount<0){
            alert('Giảm giá quá lớn hoặc quá thấp mức cho phép')
        }else{
            $('.coin_reduce').val(parseInt(coin)*(100-parseFloat(discount))/100);
            $('.price_reduce').val(parseInt(price)*(100-parseFloat(discount))/100);
        }
    })
    document.addEventListener("DOMContentLoaded", function() {
        var lazyloadImages = document.querySelectorAll("img.lazy");    
        var lazyloadThrottleTimeout;
        
        function lazyload () {
          if(lazyloadThrottleTimeout) {
            clearTimeout(lazyloadThrottleTimeout);
          }    
          
          lazyloadThrottleTimeout = setTimeout(function() {
              var scrollTop = window.pageYOffset;
              lazyloadImages.forEach(function(img) {
                  if(img.offsetTop < (window.innerHeight + scrollTop)) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                  }
              });
              if(lazyloadImages.length == 0) { 
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
              }
          }, 20);
        }
        
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
      });
});
