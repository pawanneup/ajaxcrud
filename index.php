<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>AJAX CRUD</title>
</head>
<body>
  <div class="container">
  <h1 class="text-center">AJAX CRUD</h1>
  
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Users
  </button>

  <!-- Table -->
  <div class="m-3" id="displayTable">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">SN</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="userTableBody">
    
      </tbody>
    </table>
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">User Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="Phone" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Address" autocomplete="off" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="addUser()" data-bs-dismiss="modal" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <script>

    //delete user function
    function deleteUser(userId) {
   if (confirm("Are you sure you want to delete this user?")) {
    $.ajax({
      url: 'delete_user.php',  
      type: 'GET',
      data: {
        userId: userId  
      },
      success: function(response) {
        // Parse the response to ensure it's a JSON object
        let data = JSON.parse(response); // Ensure the response is an object

        console.log(data);  
        alert(data.status);

        if (data.status == 'success') {
          // Remove the user row from the table
          $("#userRow" + userId).remove(); 
          alert(data.message); // Show success message
        } else {
          alert("Error deleting the user: " + data.message); 
        }
      },
      error: function(xhr, status, error) {
        alert("An error occurred while deleting the user.");
      }
    });
  }
}







    //fetch data function
    function fetchData() {
      $.ajax({
        url: 'display.php',  
        type: 'GET',
        success: function(data) {
          let tableBody = $("#userTableBody");
          tableBody.empty();

          data.forEach((user, index) => {
            let row = `<tr id="userRow${user.id}">
              <td>${index + 1}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>${user.phone}</td>
              <td>${user.address}</td>
              <td>
                <button class="btn btn-info">Edit</button>
                <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
          
              </td>
            </tr>`;
            tableBody.append(row);
          });
        }
      });
    }

    // Add user function
    function addUser() {
      let nameADD = document.getElementById("name").value;
      let emailADD = document.getElementById("email").value;
      let phoneADD = document.getElementById("phone").value;
      let addressADD = document.getElementById("address").value;

      if (!nameADD || !emailADD || !phoneADD || !addressADD) {
        alert("Please fill all fields");
        return;
      }

      $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: {
          nameADD: nameADD,
          emailADD: emailADD,
          phoneADD: phoneADD,
          addressADD: addressADD
        },
        success: function(data) {
          console.log(data);
          fetchData();
        }
      });
    }

   

    $(document).ready(function() {
      fetchData();
    });
  </script>
</body>
</html>
