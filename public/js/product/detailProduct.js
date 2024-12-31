$('#detailProductModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Nút bấm mở modal

    // Lấy dữ liệu từ data-* attributes
    const sku = button.data('sku');
    const name = button.data('name');
    const priceRegular = button.data('price_regular');
    const priceSale = button.data('price_sale');
    const shortDescription = button.data('short_description');
    const category = button.data('category');
    const isActive = button.data('is_active');
    const imgThumbnail = button.data('img_thumbnail');
    const fullImgThumbnailUrl = `http://127.0.0.1:8000/storage/${imgThumbnail}`;
    let tags = button.data('tags');

    // Parse tags nếu cần
    try {
        if (typeof tags === 'string') {
            tags = JSON.parse(tags);
        }
    } catch (error) {
        console.error('Error parsing tags:', error);
        tags = [];
    }

    // Gán dữ liệu vào modal
    $('#modal-sku').text(sku);
    $('#modal-name').text(name);
    $('#modal-price-regular').text(priceRegular);
    $('#modal-price-sale').text(priceSale);
    $('#modal-short-description').text(shortDescription);
    $('#modal-category').text(category);
    $('#modal-is-active').text(isActive ? 'Có' : 'Không');
    $('#modal-img-thumbnail').attr('src', fullImgThumbnailUrl);

    const $tagsContainer = $('#modal-tags');
    $tagsContainer.empty();

    if (Array.isArray(tags)) {
        tags.forEach(tag => {
            $tagsContainer.append(`<span class="badge bg-primary me-1">${tag['name']}</span>`);
        });
    }
});
