/*=========================================================================================
    File Name: form-file-uploader.js
    Description: dropzone
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

Dropzone.autoDiscover = false;

$(function() {
    "use strict";

    var singleFile = $("#dpz-single-file");
    var multipleFiles = $("#dpz-multiple-files");
    var buttonSelect = $("#dpz-btn-select-files");
    var limitFiles = $("#dpz-file-limits");
    var acceptFiles = $("#dpz-accept-files");
    var removeThumb = $("#dpz-remove-thumb");
    var removeAllThumbs = $("#dpz-remove-all-thumb");

    // Basic example
    singleFile.dropzone({
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1
    });

    // Multiple Files
    multipleFiles.dropzone({
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 0.5, // MB
        clickable: true
    });

    // Use Button To Select Files
    buttonSelect.dropzone({
        clickable: "#select-files" // Define the element that should be used as click trigger to select files.
    });

    // Limit File Size and No. Of Files
    limitFiles.dropzone({
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 0.5, // MB
        maxFiles: 5,
        maxThumbnailFilesize: 1 // MB
    });

    // Accepted Only Files
    acceptFiles.dropzone({
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        acceptedFiles: "image/*"
    });

    //Remove Thumbnail

    //INI YANG ASLI
    // removeThumb.dropzone({
    //     paramName: "file",
    //     maxFilesize: 1,
    //     addRemoveLinks: true,
    //     dictRemoveFile: " Trash"
    // });

    removeThumb.dropzone({
        paramName: "output_file", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        acceptedFiles: "image/*",

        // init: function() {
        //     // Using a closure.
        //     var _this = this;

        //     // Setup the observer for the button.
        //     $("#clear-dropzone").on("click", function() {
        //         // Using "_this" here, because "this" doesn't point to the dropzone anymore
        //         _this.removeAllFiles();
        //         // If you want to cancel uploads as well, you
        //         // could also call _this.removeAllFiles(true);
        //     });
        // }
    });

    // Remove All Thumbnails
    removeAllThumbs.dropzone({
        paramName: "input_file", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        acceptedFiles: "image/*",

        // init: function() {
        //     // Using a closure.
        //     var _this = this;

        //     // Setup the observer for the button.
        //     $("#clear-dropzone").on("click", function() {
        //         // Using "_this" here, because "this" doesn't point to the dropzone anymore
        //         _this.removeAllFiles();
        //         // If you want to cancel uploads as well, you
        //         // could also call _this.removeAllFiles(true);
        //     });
        // }
    });
});
