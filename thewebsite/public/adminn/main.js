function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: 'Bạn muốn xóa?',
        text: "Bạn chắc chắn muốn xóa chứ!!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'DELETE!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if (data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Đã xóa!',
                            'Thành công'
                          )
                    }

                },
                error: function() {

                }
            });
          
        }
      })
}


$(function () {
    $(document).on('click', '.action_delete', actionDelete);
}) 