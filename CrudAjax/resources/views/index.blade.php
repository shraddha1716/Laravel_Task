<!DOCTYPE html>
<html>
<head>
    <title>Item Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Item Table</h2>
        <input type="text" id="item_name" placeholder="Enter item name">
        <button id="add_item">Add Item</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="item_table">
                
            </tbody>
        </table>
    </div>

    <script>
        // Load items when the page loads
        loadItems();

        // Function to fetch items from the server if main data in only in single json format i.e return       response()->json($items); && return response($data);
        function loadItems() {
            $.ajax({ 
                url: '/loaditems', 
                type: 'GET',
                dataType:'json', // ha data type automatic json data la array madhe convert karato
                success: function(data) { // ata data madhe fakt item cha array ahe 
                 $('#item_table').html('');
                    var t_row='';
                    data.forEach(function(key){
                        t_row += '<tr><td>'+key.id+'</td><td>'+key.name+'</td><td><button class="edit_item" data-id="'+key.id+'">Edit</button><button class="delete_item" data-id="'+key.id+'">Delete</button></td></tr>';
                    })
                    $('#item_table').html(t_row);

                    // ----------------------- using for loop---------------------------

                    // for(var i= 0; i<data.length;i++)
                    // {
                        // op += '<tr><td>'+data[i].id+'</td><td>'+data[i].name+'</td><td><button class="edit_item" data-id="'+data[i].id+'">Edit</button><button class="delete_item" data-id="'+data[i].id+'">Delete</button></td></tr>';
                    // }  
                    // $('#item_table').html(op);

                    // -------------------------- end for loop -------------------------------
                }
            }); 
        }

         // Function to fetch items from the server if main data in multiple array of  json format like main data json of json format i.e response()->json(['message' => 'Item fetch successfully','data'=>$data]);

        // function loadItems() {
        //     $.ajax({ 
        //         url: '/loaditems', 
        //         type: 'GET',
        //         dataType:'json',  // ha baher cha jo json array ahe tyala array madhe anato but ajun
                //  tya  array madhe jo data ahe to pn json ahe tyasathi apluala json.parse method used karavi lagel
        //         success: function(result) {
        //          $('#item_table').html('');
        //          var op='';
                 // var data= JSON.parse(result['data']); // bahercha data jhala arry madhe but item cha jo data to json of json hota tyala convert krnyasathi parse() used keli .
        //       data.forEach(function(key){
        //       op += '<tr><td>'+key.id+'</td><td>'+key.name+'</td><td><button class="edit_item" data-id="'+key.id+'">Edit</button><button class="delete_item" data-id="'+key.id+'">Delete</button></td></tr>';
        //         })
        //         $('#item_table').html(op);

        //         }
        //     }); 
        // }


        // Add Item
        $('#add_item').click(function() {
            var name = $('#item_name').val();
            $.ajax({
                url: '/items', 
                type: 'POST',
                data: {
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#item_name').val('');
                    loadItems(); 
                }
            });
        });

        // Edit Item
        $(document).on('click', '.edit_item', function() {
            var id = $(this).data('id');
            var newName = prompt('Edit item name:');
            if (newName !== null) {
                $.ajax({
                    url: '/items/' + id, 
                    type: 'PUT',
                    data: {
                        name: newName,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        loadItems(); 
                    }
                });
            }
        });

        // Delete Item
        $(document).on('click', '.delete_item', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '/items/' + id, 
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        loadItems(); 
                    }
                });
            }
        });
    </script>
</body>
</html>
