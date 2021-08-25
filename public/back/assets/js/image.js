$(document).ready(function () {
    // image uploader in form

    $(".image-model").imageUploader({
        extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
        mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
        label: "Upload Image",

        maxSize: 11000000,
        maxFiles: 3,

        // preloaded: preload
    });

});
