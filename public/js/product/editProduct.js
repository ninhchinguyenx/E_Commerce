$(document).on('click', '.edit-product-btn', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const price_regular = $(this).data('price_regular');
    const price_sale = $(this).data('price_sale');
    const quantity = $(this).data('quantity');
    const short_description = $(this).data('short_description');
    const detailed_description = $(this).data('detailed_description');
    const category = $(this).data('category');
    const is_active = $(this).data('is_active');
    const is_good_deal = $(this).data('is_good_deal');
    const is_hot_deal = $(this).data('is_hot_deal');
    const is_new = $(this).data('is_new');
    const tags = $(this).data('tags');
    const tagIds = tags.map(tag => tag.id);
    const imgThumbnail = $(this).data('img_thumbnail');
    const gallery = $(this).data('gallery');
    // Điền dữ liệu vào modal
    $('#editProductModal input[name="name"]').val(name);
    $('#editProductModal input[name="price_regular"]').val(price_regular);
    $('#editProductModal input[name="price_sale"]').val(price_sale);
    $('#editProductModal input[name="quantity"]').val(quantity);
    $('#editProductModal textarea[name="short_description"]').val(short_description);
    $('#editProductModal textarea[name="detailed_description"]').val(detailed_description);
    $('#editProductModal input[name="category_id"]').val(category);
    $('#editProductModal input[name="is_active"]').val(is_active);
    $('#editProductModal input[name="is_good_deal"]').val(is_good_deal);
    $('#editProductModal input[name="is_new"]').val(is_new);
    $('#editProductModal input[name="is_hot_deal"]').val(is_hot_deal);
    $('#tag123 option').each(function () {
        if (tagIds.includes(parseInt($(this).val()))) {
            $(this).prop('selected', true);  // Đánh dấu là đã chọn
        }
    });
    $('.form-check-input').each(function () {
        if ($(this).val() == "1") {
            $(this).prop('checked', true); // Đánh dấu checkbox nếu giá trị là 1
        }
    });

    $('#editProductModal form').attr('action', `http://127.0.0.1:8000/admin/products/${id}`);

   
});