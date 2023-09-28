<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="message m-5">
                
            </div>
            <form class="form-inline m-5">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Product Name">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Product Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Product Price">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Product Quantity</label>
                    <input type="text" class="form-control" id="quantity" placeholder="Product Quantity">
                </div>
                <button type="button" id="add_product" class="btn btn-primary mb-2 add_product">Add Product</button>
            </form>
            <h2 class="text-center text-info">Tabel</h2>
            <table class="table table-striped text-center">
                    <thead>
                        <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="t_body">
                        
                    </tbody>
            </table>
        </div>
        <script>
            fetch_product();
            //show all produtc
            function fetch_product() 
            {
                $.ajax({ 
                    url: '/fetch_product', 
                    type: 'GET',
                    dataType:'json',
                    success: function(response) {
                        $('#t_body').html('');
                        var rows_data='';
                        var sr_no = 1;
                        response.forEach(function(key){
                            rows_data +='<tr data-id="'+key.id+'"><td>'+sr_no+'</td><td>'+key.name+'</td><td>'+key.price+'</td><td>'+key.quantity+'</td><td><button class="btn btn-info edit_product" data-id="'+key.id+'">Edit</button><button class="btn btn-danger m-3 delete_product" data-id="'+key.id+'">Delete</button></td></tr>';

                            sr_no++;
                        }) 
                        $('#t_body').html(rows_data);
                    }
                }); 
            }

            // Add Product & update product
           $('#add_product').click(function() {
                var action = $(this).data('action');
                var id = $(this).data('id');

                var name = $('#name').val();
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                var url = (action === 'edit') ? '/update_product/' + id : '/add_product';
                $.ajax({
                    url: url, 
                    type: 'POST',
                    data: {
                        name: name,
                        price: price,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                        },
                    dataType:'json',
                    success: function(response)
                     {
                        var productLength = response.product.length;

                        $('#name').val('');
                        $('#price').val('');
                        $('#quantity').val('');

                        $('.message').html('<div class="alert alert-success">' + response.message + '</div>');

                        var product =response.product;

                        var numberOfRows = $('#t_body').find('tr').length;
                        numberOfRows++;
                        console.log("Number of rows in the table: " + numberOfRows);

                        if (action =='edit') 
                        {
                            var updatedRow = '<tr data-id="'+product.id+'"><td>' + id + '</td><td>' + product.name + '</td><td>' + product.price + '</td><td>' + product.quantity + '</td><td><button class="btn btn-info edit_product" data-id="' + product.id + '">Edit</button><button class="btn btn-danger m-3 delete_product" data-id="' + product.id + '">Delete</button></td></tr>';
                             $('#t_body tr[data-id="'+id+'"]').replaceWith(updatedRow);
                        } 
                        else 
                        { 
                            $('#t_body').append('<tr data-id="'+product.id+'"><td>' +numberOfRows + '</td><td>' +product.name + '</td><td>' +product.price + '</td><td>' +product.quantity + '</td><td><button class="btn btn-info edit_product" data-id="' +product.id + '">Edit</button><button class="btn btn-danger m-3 delete_product" data-id="' +product.id + '">Delete</button></td></tr>');
                        }
                        $('.add_product').text('Add Product').data('action', 'add').removeData('id');
                    }
                 });
            });


            $(document).on('click', '.delete_product', function() {
                var id = $(this).data('id');
                var row = $(this).closest('tr'); // Get the table row associated with the delete button
                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        url: '/delete_product/' + id, 
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }, 
                        success: function(response) {
                            row.remove(); 
                            $('.message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }); 
                }
            });

            

           
            // Show one product
            $(document).on('click', '.edit_product', function() {
            var id = $(this).data('id');
                $.ajax({
                    url: '/edit_product/' + id, 
                    type: 'GET',
                    dataType:'json',
                    success: function(response)
                    {
                        $('#name').val(response.name);
                        $('#price').val(response.price);
                        $('#quantity').val(response.quantity);
                        $('.add_product').text('Edit Product').data('action', 'edit').data('id', id);
                    }
                });
            });
        </script>   
    </body> 
</html>