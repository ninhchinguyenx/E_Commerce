
    $(document).ready(function () {
    // Khu vực upload ảnh chính
    const $uploadThumbnailArea = $("#uploadThumbnailArea");
    const $uploadThumbnailButton = $("#uploadThumbnailButton");
    const $thumbnailInput = $("#img_thumbnail");
    const $thumbnailPreviewArea = $("#thumbnailPreviewArea");

    // Khu vực upload ảnh gallery
    const $uploadGalleryArea = $("#uploadGalleryArea");
    const $uploadGalleryButton = $("#uploadGalleryButton");
    const $galleryInput = $("#gallery");
    const $galleryPreviewArea = $("#galleryPreviewArea");

    // Hàm xử lý upload và preview ảnh
    function handleImageUpload($inputElement, $previewArea) {
        const files = $inputElement[0].files;
        $previewArea.empty(); // Xóa preview cũ

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

    // Kích hoạt chọn file khi nhấn nút (ảnh chính)
    $uploadThumbnailButton.on("click", function () {
        $thumbnailInput.click();
    });

    // Hiển thị preview khi chọn file (ảnh chính)
    $thumbnailInput.on("change", function () {
        handleImageUpload($thumbnailInput, $thumbnailPreviewArea);
    });

    // Kích hoạt chọn file khi nhấn nút (ảnh gallery)
    $uploadGalleryButton.on("click", function () {
        $galleryInput.click();
    });

    // Hiển thị preview khi chọn file (ảnh gallery)
    $galleryInput.on("change", function () {
        handleImageUpload($galleryInput, $galleryPreviewArea);
    });

    // Kéo thả ảnh vào khu vực upload (ảnh chính)
    $uploadThumbnailArea.on("dragover", function (event) {
        event.preventDefault();
        $uploadThumbnailArea.addClass("dragging");
    });

    $uploadThumbnailArea.on("dragleave", function () {
        $uploadThumbnailArea.removeClass("dragging");
    });

    $uploadThumbnailArea.on("drop", function (event) {
        event.preventDefault();
        $uploadThumbnailArea.removeClass("dragging");
        const files = event.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            $thumbnailInput[0].files = files; // Gán file cho input
            handleImageUpload($thumbnailInput, $thumbnailPreviewArea);
        }
    });

    // Kéo thả ảnh vào khu vực upload (ảnh gallery)
    $uploadGalleryArea.on("dragover", function (event) {
        event.preventDefault();
        $uploadGalleryArea.addClass("dragging");
    });

    $uploadGalleryArea.on("dragleave", function () {
        $uploadGalleryArea.removeClass("dragging");
    });

    $uploadGalleryArea.on("drop", function (event) {
        event.preventDefault();
        $uploadGalleryArea.removeClass("dragging");
        const files = event.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            $galleryInput[0].files = files; // Gán file cho input
            handleImageUpload($galleryInput, $galleryPreviewArea);
        }
    });
    });