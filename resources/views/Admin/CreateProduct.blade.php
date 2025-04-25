<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
    <h2>Add New Product</h2>

    <div id="message"></div>

    <form id="productForm" method="Post">
       @csrf
          <div>
            <label for="form-control">Product Name</label>
            <input type="text" name="product_name">
          </div> 
          
          <div>
            <label for="form-control">Description</label>
            <input type="text" name="description">
          </div> 

          <div>
            <label for="form-control">Price</label>
            <input type="text" name="price">
          </div> 


          <div>
          <label for="form-control">Discount (%):</label>
          <input type="number" name="discount" value="0" min="0" max="100">
          </div> 
          <button type="submit">Add Product</button>

    </form>

    
    <br>
    <a href="">➡ View All Products</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // Setup CSRF token
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Form submit
    // $('#productForm').on('submit', function(e) {
    //     e.preventDefault();

    //     let formData = $(this).serialize();

    //     $.ajax({
    //         type: 'POST',
    //         url: '/admin/productstore',
    //         data: formData,
    //         success: function(response) {
    //             $('#message').html('<p style="color:green;">' + response.message + '</p>');
    //             $('#productForm')[0].reset();
    //         },


           
    //         error: function(xhr) {
    //             let errors = xhr.responseJSON.errors;
    //             let errorHtml = '<ul style="color:red;">';
    //             $.each(errors, function(key, value) {
    //                 errorHtml += '<li>' + value[0] + '</li>';
    //             });
    //             errorHtml += '</ul>';
    //             $('#message').html(errorHtml);
    //         }

               
    //     });
    // });





    $('#productForm').on('submit',function(e){
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({

            type:'Post',
            url:'/admin/productstore',
            data:formData,
            success:function(response){
                $('#message').html('<p style="color:green;">'+ response.message + '</p>');
                $('#productForm')[0].reset();
            },
            error:function(xhr){
                let errors = xhr.responseJSON.errors;
                let errorHtml ='<ul style="color:red;">';
                $.each(errors,function(key,value){
                      errorHtml+='<li>'+value[0]+'</li>';
                });

              errorHtml+='</ul>';
              $('#message').html(errorHtml);

            }


        })
    })
    
</script>

</body>
</html>