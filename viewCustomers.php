<div>
  <h2>école</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">NOM - école</th>
        <th class="text-center">NOM - enfant</th>
        <th class="text-center">AGE</th>
        <th class="text-center">classe</th>
        <th class="text-center">Disease</th>
        <th class="text-center">AVS</th>
        <th class="text-center">Thérapeute</th>
        <th class="text-center">Rapport</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      include_once "../config/dbconnect.php";

      // SQL query - ensure correct table and field names
      $sql = "SELECT product.*, category.category_name FROM product 
              JOIN category ON product.category_id = category.category_id";
      $result = $conn->query($sql);

      // Check if the query was successful
      if ($result === false) {
          // Output error message
          echo "<tr><td colspan='9'>Error: " . $conn->error . "</td></tr>";
      } else {
          $count = 1;
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
    ?>
      <tr>
        <td class="text-center"><?= $count ?></td>
        <td class="text-center"><img height='100px' src='<?= htmlspecialchars($row["product_image"]) ?>'></td>
        <td class="text-center"><?= htmlspecialchars($row["product_name"]) ?></td>
        <td class="text-center"><?= htmlspecialchars($row["product_desc"]) ?></td>
        <td class="text-center"><?= htmlspecialchars($row["category_name"]) ?></td>
        <td class="text-center"><?= htmlspecialchars($row["price"]) ?></td>
        <td class="text-center"><button class="btn btn-primary" style="height:40px" onclick="itemEditForm('<?= htmlspecialchars($row['product_id']) ?>')">Edit</button></td>
        <td class="text-center"><button class="btn btn-danger" style="height:40px" onclick="itemDelete('<?= htmlspecialchars($row['product_id']) ?>')">Delete</button></td>
      </tr>
    <?php
                  $count++;
              }
          } else {
              echo "<tr><td colspan='9' class='text-center'>No products found</td></tr>";
          }
      }
    ?>
    </tbody>
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add école
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Thérapeute</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form enctype='multipart/form-data' onsubmit="addItems()" method="POST">
            <div class="form-group">
              <label for="name">Thérapeute Name:</label>
              <input type="text" class="form-control" id="p_name" required>
            </div>
            <div class="form-group">
              <label for="price">Age:</label>
              <input type="number" class="form-control" id="p_price" required>
            </div>
            <div class="form-group">
              <label for="desc">Description:</label>
              <input type="text" class="form-control" id="p_desc" required>
            </div>
            <div class="form-group">
              <label>Category:</label>
              <select id="category" class="form-control">
                <option disabled selected>Select category</option>
                <?php
                  $sql = "SELECT * FROM category";
                  $result = $conn->query($sql);

                  if ($result === false) {
                      echo "<option disabled>Error: " . $conn->error . "</option>";
                  } else {
                      while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . htmlspecialchars($row['category_id']) . "'>" . htmlspecialchars($row['category_name']) . "</option>";
                      }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="file">Choose Image:</label>
              <input type="file" class="form-control-file" id="file">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add Item</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
