$(document).ready(function () {
    const $thumbnailInput = $("#img_thumbnail");
    const $thumbnailPreviewArea = $("#thumbnailPreviewArea");
    const $galleryInput = $("#gallery");
    const $galleryPreviewArea = $("#galleryPreviewArea");

    // Giá trị mặc định từ server
    const defaultThumbnail = "https://example.com/path-to-thumbnail.jpg"; // URL ảnh chính
    const defaultGallery = [
        "https://example.com/path-to-gallery1.jpg",
        "https://example.com/path-to-gallery2.jpg"
    ]; // Danh sách URL ảnh gallery

    // Hàm hiển thị preview từ URL
    function showPreviewFromUrl(urls, $previewArea) {
        $previewArea.empty();
        $.each(urls, function (index, url) {
            const $previewDiv = $(`
                <div class="preview-image">
                    <img src="${url}" alt="Preview Image">
                    <button type="button" class="remove-preview">&times;</button>
                </div>
            `);
            $previewArea.append($previewDiv);

            // Xử lý xóa ảnh khỏi preview
            $previewDiv.find(".remove-preview").on("click", function () {
                $previewDiv.remove();
            });
        });
    }

    // Hiển thị preview mặc định
    if (defaultThumbnail) {
        showPreviewFromUrl([defaultThumbnail], $thumbnailPreviewArea);
    }
    if (defaultGallery.length > 0) {
        showPreviewFromUrl(defaultGallery, $galleryPreviewArea);
    }

    // Kích hoạt chọn file khi nhấn nút
    $("#uploadThumbnailButton").on("click", function () {
        $thumbnailInput.click();
    });

    $("#uploadGalleryButton").on("click", function () {
        $galleryInput.click();
    });

    // Hiển thị preview khi chọn file
    function handleImageUpload($inputElement, $previewArea) {
        const files = $inputElement[0].files;
        $previewArea.empty();

        $.each(files, function (index, file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const $previewDiv = $(`
                    <div class="preview-image">
                        <img src="${e.target.result}" alt="Preview Image">
                        <button type="button" class="remove-preview">&times;</button>
                    </div>
                `);
                $previewArea.append($previewDiv);

                // Xử lý xóa ảnh khỏi preview
                $previewDiv.find(".remove-preview").on("click", function () {
                    $previewDiv.remove();
                    $inputElement.val(''); // Reset lại input file
                });
            };
            reader.readAsDataURL(file);
        });
    }

    // Xử lý sự kiện change của input file
    $thumbnailInput.on("change", function () {
        handleImageUpload($thumbnailInput, $thumbnailPreviewArea);
    });

    $galleryInput.on("change", function () {
        handleImageUpload($galleryInput, $galleryPreviewArea);
    });
});
