<?php
require_once 'connect_database.php';
$listCategory = "SELECT * FROM category";
$resultCategory  = $conn->query($listCategory)->fetchAll();

if(isset($_POST['btnSave'])) {
    // nhận toàn bộ dữ liệu từ các ô input form để push lên 
    // echo "<pre>";
    // var_dump($_POST);
    // die;
     $productName = $_POST['product_name'];
     $categoryId = $_POST['category_id'];
     $price = $_POST['price'];
     $quantity = $_POST['quantity'];
     $targetDir = "images/"; // tạo ra giá trị bằng đúng tên thư mục đã được chọn 
     // đường dẫn đền file được lưu 
     $targetFile = $targetDir.$_FILES['image']['name'];
     // tiến hành thực hiện upload file ảnh di chuyển file ảnh từ máy lên server 
     if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFile)) {
        $imageUrl = $targetFile;
     }
     // xong việc upfile 
     // insert vào cơ sở dữ liệu
     $sql = "INSERT INTO products VALUES(NULL,'$productName','$price','$imageUrl','$quantity','$categoryId')";
     $result = $conn->exec($sql);
     if($result) {
        header("location:index.php");
     }
     
}
?> 
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Form thêm sản phẩm</title>
</head>
<body>
    <div class="add-form">
        <h1>Thêm Sản Phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Tên Sản Phẩm:</label>
                <input type="text" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm">
                <span></span>
            </div>

            <div class="form-group">
                <label for="category">Danh mục:</label>
                <select id="category" name="category_id">
                    <?php foreach($resultCategory as $key=>$value) { ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['category_name']; ?></option>
                    <?php } ?>
                      
                </select>
                <span></span>
            </div>

            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="text" name="price" id="price" placeholder="Nhập giá">
                <span></span>
            </div>

            <div class="form-group">
                <label for="image">Ảnh:</label>
                <input type="file" name="image" accept="image/*">
                <span></span>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="text" name="quantity" id="quantity" placeholder="Nhập số lượng">
                <span></span>
            </div>

            <button class="submit-button" name="btnSave" type="submit">Thêm</button>
        </form>

    </div>

</body>
</html>