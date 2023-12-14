
<style>
    /* Custom styling for the loading overlay */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(
            255,
            255,
            255,
            0.7
        ); /* Semi-transparent white background */
        z-index: 9999; /* Higher z-index to overlay on top of content */
        /* display: none; Initially hidden */
        display: none;
    }
    .loading-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<!-- Loading Overlay -->
 <div class="loading-overlay" id="loadingOverlay">
     <div class="loading-icon">
         <div class="spinner-border" role="status"></div>
     </div>
 </div>

 <script>

    if (typeof showLoader !="function")
    {

        function showLoader(parent_selector = "") {
            $(`${parent_selector} .loading-overlay`).css("display", "block");
        }

    }

    if (typeof hideLoader != "function")
    {

        function hideLoader(parent_selector = "") {
            $(`${parent_selector} .loading-overlay`).css("display", "none");
        }

    }
 </script>
