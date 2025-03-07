<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #F6F0F0 !important;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .new-product-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 500px;
        }

        .new-product-form h2 {
            text-align: center;
            color: #735240;
            margin-bottom: 15px;
        }

        .new-product-form input,
        .new-product-form textarea,
        .new-product-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #E0D6D6;
            border-radius: 8px;
            font-size: 16px;
        }

        .new-product-form button {
            width: 100%;
            padding: 10px;
            background: #735240;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .new-product-form button:hover {
            background: #5a3d2b;
        }

        .file-input {
            border: 1px solid #E0D6D6;
            border-radius: 8px;
            padding: 10px;
            background-color: #f9f9f9;
            cursor: pointer;
            display: block;
            margin: 10px 0;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .image-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #E0D6D6;
        }

    </style>
</head>
<body>

    <div class="new-product-form">
        <h2>Add New Product</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Product Name" required>
            
            <textarea name="product_desc" placeholder="Product Description" rows="4" required></textarea>
            
            <input type="number" name="product_price" placeholder="Price" step="0.01" required>
            
            <input type="number" name="stock_quantity" placeholder="Stock Quantity" required>

            <label class="file-input">
                Upload Product Images
                <input type="file" name="product_images[]" multiple accept="image/*" onchange="previewImages(event)">
            </label>

            <div class="image-preview" id="imagePreview"></div>

            <select name="size_options" required>
                <option value="" disabled selected>Select Size Option</option>
                <option value="Adjustable">Adjustable</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>

            <input type="text" name="tags" placeholder="Tags/Keywords (comma separated)" required>

            <button type="submit">Add Product</button>
        </form>
    </div>

    <script>
        function previewImages(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ""; // Clear previous images
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        imagePreview.appendChild(img);
                    }

                    reader.readAsDataURL(file);
                }
            }
        }
    </script>

</body>
</html>
