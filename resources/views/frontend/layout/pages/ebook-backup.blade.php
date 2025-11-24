@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
        <title>Ebook Details - {{ env('APP_NAME') }}</title>
    @endsection

    <!-- ebook view -->
    <section id="quicktech-view" class="pt-100">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="quikctech-pdf-head d-flex justify-content-between align-items-center">
                        <div class="quikctech-pdff">
                            <h4>Ebook Name</h4>
                            <h1>{{ $ebook->title }}</h1>
                        </div>

                        <div class="quicktech-controls">
                            <button class="quicktech-prev"><i class="fa-solid fa-arrow-left-long"></i></button>
                            <span>Page: <span class="quicktech-current">1</span></span>
                            <button class="quicktech-next"><i class="fa-solid fa-arrow-right-long"></i></button>

                            <!-- Bookmark Button -->
                            <button id="bookmark-btn" class="btn btn-primary">Bookmark</button>

                            <!-- Top Bookmarks Display -->
                            <span class="ms-3 text-success" id="top-bookmarks" style="font-weight: bold;">No Bookmarks Yet</span>
                        </div>
                    </div>

                    <!-- Bookmarked Status -->
                    <div id="bookmarked-status" class="mt-3 text-info" style="font-weight: bold;"></div>

                    <!-- PDF Viewer (Fallback with PDF.js) -->
                    <div id="pdf-viewer" class="quicktech-frame" style="width: 100%; height: 600px; overflow: auto; max-width: 100%; max-height: 80vh;"></div>

                </div>
            </div>
        </div>
    </section>
    <!-- ebook view -->

    <!-- Scripts -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

    <script>
        const currentPageElement = document.querySelector(".quicktech-current");
        const prevBtn = document.querySelector(".quicktech-prev");
        const nextBtn = document.querySelector(".quicktech-next");
        const bookmarkBtn = document.getElementById("bookmark-btn");
        const pdfViewer = document.getElementById("pdf-viewer");
        const topBookmarks = document.getElementById("top-bookmarks");
        const bookmarkedStatus = document.getElementById("bookmarked-status");

        let currentPage = localStorage.getItem("lastReadPage") ? parseInt(localStorage.getItem("lastReadPage")) : 1;
        let totalPages = 0;

        // Load PDF using PDF.js
        const url = "{{ asset($ebook->pdf) }}";
        let pdfDoc = null;

        // Fetch the PDF and initialize rendering
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderPage(currentPage);
        });

        function renderPage(pageNum) {
            pdfDoc.getPage(pageNum).then(function(page) {
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                const scale = 1.5; // Adjust scale for better readability and responsiveness
                const viewport = page.getViewport({ scale: scale });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });

                // Clear previous content and append the new page
                pdfViewer.innerHTML = "";
                pdfViewer.appendChild(canvas);

                currentPageElement.textContent = pageNum;
                history.pushState(null, null, `?page=${pageNum}`);
                localStorage.setItem("lastReadPage", pageNum);

                prevBtn.disabled = pageNum <= 1;
                nextBtn.disabled = pageNum >= totalPages;

                updateBookmarkButtonState();
            });
        }

        function updateBookmarkButtonState() {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            if (bookmarks.includes(currentPage)) {
                bookmarkBtn.textContent = "Remove Bookmark";
                bookmarkBtn.classList.remove("btn-primary");
                bookmarkBtn.classList.add("btn-danger");
                bookmarkedStatus.textContent = `Page ${currentPage} is Bookmarked!`;
                bookmarkedStatus.style.color = "green";
                bookmarkedStatus.style.display = "block"; // Show the status
            } else {
                bookmarkBtn.textContent = "Bookmark";
                bookmarkBtn.classList.remove("btn-danger");
                bookmarkBtn.classList.add("btn-primary");
                bookmarkedStatus.style.display = "none"; // Hide the status if not bookmarked
            }

            // Update the top bookmarks display
            displayTopBookmarks();
        }

        // Display the list of bookmarked pages
        function displayTopBookmarks() {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            if (bookmarks.length > 0) {
                topBookmarks.textContent = "Bookmarked Pages: " + bookmarks.join(", ");
            } else {
                topBookmarks.textContent = "No Bookmarks Yet";
            }
        }

        // Navigation buttons
        prevBtn.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
            }
        });

        nextBtn.addEventListener("click", () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderPage(currentPage);
            }
        });

        // Toggle Bookmark (Add/Remove)
        bookmarkBtn.addEventListener("click", () => {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            if (bookmarks.includes(currentPage)) {
                // Remove the current page from bookmarks
                const index = bookmarks.indexOf(currentPage);
                if (index > -1) {
                    bookmarks.splice(index, 1);
                    localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
                    alert(`Page ${currentPage} removed from bookmarks.`);
                }
            } else {
                // Add the current page to bookmarks
                bookmarks.push(currentPage);
                localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
                alert(`Page ${currentPage} bookmarked!`);
            }
            updateBookmarkButtonState();
        });

        // Scroll event for page navigation
        pdfViewer.addEventListener("wheel", function(event) {
            if (event.deltaY > 0 && currentPage < totalPages) {
                // Scroll down: Go to next page
                currentPage++;
                renderPage(currentPage);
            } else if (event.deltaY < 0 && currentPage > 1) {
                // Scroll up: Go to previous page
                currentPage--;
                renderPage(currentPage);
            }
        });

        window.onload = function () {
            updateBookmarkButtonState();
        };
    </script>
@endsection
