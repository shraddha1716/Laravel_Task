<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Task</title>
</head>

<body>
  <!-- ----------------------------- Add User ------------------------------ -->
  <div class="container p-5">
    <form action="{{ route('item.store') }}" method="POST">
      @csrf
      <h1 class="text-center text-success">Add User </h1>
      <div>
          @if (session('success'))
        <div class="text-success">{{ session('success') }}</div>
        @endif
      </div>
      <div class="container p-3 m-5">
        <div class="form-row">
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Name" name="name">
          </div>
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Username" name="uname">
          </div>
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Last name" name="lname">
          </div>
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Mobile Number" name="mobno">
          </div>
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Email Address" name="email">
          </div>
          <div class="col-4 p-2">
            <input type="text" class="form-control" placeholder="Password" name="password">
          </div>
        </div>
      </div>


      <!-- ----------------------------------Add Product ------------------------------- -->
      <div class="container p-5">
        <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-info p-2" onclick="addRow()">Add</button>
        </div>
        <table class="tabel">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Quantity</th>
              <th>Product Type</th>
              <th>Discount Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="form-control" type="text" name="product_name[]"></td>
              <td><input class="form-control" type="number" name="product_price[]"></td>
              <td><input class="form-control" type="number" name="product_quantity[]"></td>
              <td>
                <select class="form-control" name="product_type[]" onchange="toggleDiscount(this)">
                  <option value="flat">Flat</option>
                  <option value="discount">Discount</option>
                </select>
              </td>
              <td><input class="form-control" type="number" name="discount_amount[]" readonly></td>
            </tr>
          </tbody>
        </table>
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 p-3">
            <input type="text" class="form-control"  id="finalAmount" name="final_amount" placeholder="Final Amount" readonly>
            </div>
        </div>  
        <div class="d-flex justify-content-center">  
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>
      </form>
      
    <!-- ------------------------------ Show Product ----------------------------------- -->
    <div class="container p-3 m-5">
    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
            <div class="form-group">
                <label for="name">Filter by Name:</label>
                <select class="form-control" id="name" name="name">
                    <option value="">All Names</option>
                    @foreach($distinctNames as $name)
                        <option value="{{ $name }}"{{ $name === request('name') ? ' selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply Filter</button>
        </form>
      <table class="table table-striped">
        <thead>
          <tr>
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
          </tr>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
      {{ $users->appends(request()->input())->links() }}
    </div>
  </div>

  <!-- ----------------------------------- start script ----------------------------------------- -->
  <script>
    function toggleDiscount(selectElement) {
      const discountAmountInput = selectElement.parentElement.nextElementSibling.querySelector('input[name="discount_amount[]"]');
      if (selectElement.value === 'discount') {
        discountAmountInput.removeAttribute('readonly');
      } else {
        discountAmountInput.setAttribute('readonly', 'true');
      }
    }

    function addRow() {
      const table = document.querySelector('table tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
                <td><input class="form-control" type="text" name="product_name[]"></td>
                <td><input class="form-control" type="number" name="product_price[]"></td>
                <td><input class="form-control" type="number" name="product_quantity[]"></td>
                <td>
                    <select class="form-control" name="product_type[]" onchange="toggleDiscount(this)">
                        <option value="flat">Flat</option>
                        <option value="discount">Discount</option>
                    </select>
                </td>
                <td><input class="form-control" type="number" name="discount_amount[]" readonly></td>
            `;
      table.appendChild(newRow);
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>