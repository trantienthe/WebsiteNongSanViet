function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: 'Bạn muốn xóa sản phẩm này?',
        text: "Bạn đã chắc chắn xóa chứ!",
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
                            'Sản phẩm đã được xóa!',
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