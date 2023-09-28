<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
        <div class="container pt-5">
        <table id="table_data" class="table table-striped text-center">
            <div class="row">
                <div class="col-lg-10">
                </div>
                <div class="col-lg-2">
                <input type="text" id="search" placeholder="Search products">
                </div>
            </div>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Product</th>
                </tr>
            </thead>
            <tbody id="product-list">
               @foreach($all_data as $product)
               <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_name}}</td>

               </tr>
               @endforeach
            </tbody>
        </table>
        <div class="pagination">
        {{ $all_data->links() }}
        </div>
        </div>
        <script>
            $(document).ready(function () {
                loadItems();
                
                $('#search').on('keyup', function () {
                    var keyword = $(this).val();

                    $.ajax({
                        url: '/search', // route used kel tr tikade name route banava lagato 
                        method: 'GET',
                        data: { keyword: keyword },
                        success: function (data) {
                            var productList = $('#product-list');
                            productList.empty(); // Clear the existing rows

                            data.forEach(function (product) {
                                // Create a new table row and append it to the table body
                                productList.append(
                                    '<tr>' +
                                    '<td>' + product.id + '</td>' +
                                    '<td>' + product.product_name + '</td>' +
                                    '</tr>'
                                );
                            });
                        },
                    });
                });

                // pagination

                function loadItems(page = 1) 
                {
                    $.ajax({
                        url: '/pagination?page=' + page,
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var itemsList = $('#product-list');
                            itemsList.empty();

                            $.each(data.data, function (index, item) {
                                itemsList.append('<tr>' +
                                        '<td>' + item.id + '</td>' +
                                        '<td>' + item.product_name + '</td>' +
                                        '</tr>');
                            });

                            // Update pagination links
                            $('.pagination').html(data.links);
                        },
                    });
                }

                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    loadItems(page);
                });
         });
            
        </script>

    </body>
</html>