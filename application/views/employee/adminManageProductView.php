<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Supropriyo Enterprise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('css/admin/adminManageProductView.css') ?>" rel="stylesheet">
</head>

<body>

    <?php if ($this->session->flashdata('msg')) { ?>
        <script>
            alert("<?= $this->session->flashdata('msg') ?>");
        </script>
    <?php } ?>

    <!-- Main Content -->
    <div class="main-content">

        <div class="welcome">
            <h1>Add New Product</h1>
            <p>Product Management System</p>
        </div>

        <div class="product-container">

            <!-- Header -->
            <div class="form-header">
                <h4 class="form-title">
                    <i class="fas fa-box me-2"></i>Add New Product
                </h4>
                <p class="form-subtitle">Fill in the product details below</p>
            </div>

            <!-- Form Body -->
            <div class="form-body">

                <form method="post"
                    action="<?= isset($product) ? base_url('Employee/updateProduct/' . $product->seprod_id) : base_url('Employee/addProduct') ?>"
                    enctype="multipart/form-data">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="form-grid">

                        <div class="mb-3">
                            <label class="form-label">Product Name <span class="required">*</span></label>
                            <input type="text" name="productName"
                                value="<?= isset($product) ? $product->seprod_name : '' ?>" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">Product Image</label>

                            <input type="file" name="productImg" class="form-control" id="productImg">

                            <?php if (isset($product) && !empty($product->seprod_img)) { ?>

                                <div class="mt-2">
                                    <p class="text-muted mb-1">Current Image:</p>

                                    <img src="<?= base_url('uploads/products/' . $product->seprod_img) ?>" width="120"
                                        class="img-thumbnail">

                                </div>

                            <?php } ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Information <span class="required">*</span></label>
                            <textarea name="productInfo"
                                class="form-control"><?= isset($product) ? $product->seprod_inf : '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Link</label>
                            <input type="text" name="productLink" class="form-control"
                                value="<?= isset($product) ? $product->seprod_link : '' ?>"
                                placeholder="https://example.com/product">
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="action-buttons">

                        <?php if (isset($product)) { ?>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-edit me-2"></i> Update Product
                            </button>

                        <?php } else { ?>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Add Product
                            </button>

                        <?php } ?>

                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>

                    </div>

                </form>
                <!--  -->
            </div>

        </div>

    </div>

</body>

</html>