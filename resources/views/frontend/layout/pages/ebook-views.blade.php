@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
        <title>Ebook Details - {{ env('APP_NAME') }}</title>
    @endsection

    <section id="quicktech-view" class="pt-100">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="quikctech-pdf-head d-flex justify-content-between align-items-center">
                        <div class="quicktech-controls">
                            <button class="quicktech-prev"><i class="fa-solid fa-arrow-left-long"></i></button>
                            <span>Page: <span class="quicktech-current">1</span></span>
                            <button class="quicktech-next"><i class="fa-solid fa-arrow-right-long"></i></button>

                            <button id="bookmark-btn" class="btn btn-primary">Bookmark</button>
                            <button id="theme-toggle" class="btn btn-secondary ms-2">🌙 Dark Mode</button>
                            <button id="fullwidth-toggle" class="btn btn-outline-dark ms-2">🖥️ Full Width</button>
                            <button id="zoom-in" class="btn btn-success ms-2">➕ Zoom In</button>
                            <button id="zoom-out" class="btn btn-warning ms-2">➖ Zoom Out</button>
                            <button id="fit-screen" class="btn btn-info ms-2">🖼️ Fit to Screen</button>

                            <span class="ms-3 text-success" id="top-bookmarks" style="font-weight: bold;">No Bookmarks Yet</span>
                        </div>
                    </div>

                    <div id="bookmarked-status" class="mt-3 text-info" style="font-weight: bold;"></div>

                    <div class="d-flex">
                        <!-- Scrollable Thumbnails Sidebar -->
                        <div id="thumbnail-sidebar" style="width: 120px; overflow-y: auto; border-right: 1px solid #ccc; padding-right: 10px;"></div>

                        <!-- PDF Viewer Section -->
                        <div style="flex: 1;">
                            <button id="fullscreen-toggle" class="btn btn-dark mb-2">🔳 Fullscreen</button>
                            <div id="pdf-viewer" class="quicktech-frame" style="width: 100%; height: calc(100vh - 180px); overflow: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        html, body {
            overflow: hidden !important;
            height: 100%;
        }

        #quicktech-view {
            height: 100vh;
        }

        body.dark-mode {
            background-color: #121212;
            color: #f1f1f1;
        }

        body.dark-mode .quikctech-pdf-head {
            background-color: #1e1e1e;
        }

        body.dark-mode .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        body.dark-mode .btn-secondary {
            background-color: #444;
            border-color: #444;
        }

        body.dark-mode #pdf-viewer {
            background-color: #1e1e1e;
        }

        body.dark-mode canvas {
            filter: brightness(0.95) contrast(1.05);
        }

        body.fullwidth-mode #quicktech-view {
            padding-top: 0;
        }

        body.fullwidth-mode .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0;
            margin: 0;
        }

        body.fullwidth-mode .col-lg-12 {
            padding: 0 !important;
        }

        body.fullwidth-mode #pdf-viewer {
            width: 100vw !important;
            height: 100vh !important;
            max-height: none;
        }

        body.fullwidth-mode canvas {
            display: block;
            margin: 0 auto;
        }

        #thumbnail-sidebar {
            height: calc(100vh - 180px);
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
        }

        #thumbnail-sidebar::-webkit-scrollbar {
            width: 8px;
        }

        #thumbnail-sidebar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #thumbnail-sidebar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        #thumbnail-sidebar canvas {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: transform 0.2s ease;
            margin-bottom: 10px;
        }

        #thumbnail-sidebar canvas:hover {
            transform: scale(1.05);
            border-color: #007bff;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

    <script>
        const currentPageElement = document.querySelector(".quicktech-current");
        const prevBtn = document.querySelector(".quicktech-prev");
        const nextBtn = document.querySelector(".quicktech-next");
        const bookmarkBtn = document.getElementById("bookmark-btn");
        const pdfViewer = document.getElementById("pdf-viewer");
        const topBookmarks = document.getElementById("top-bookmarks");
        const bookmarkedStatus = document.getElementById("bookmarked-status");
        const themeToggleBtn = document.getElementById("theme-toggle");
        const fullwidthToggleBtn = document.getElementById("fullwidth-toggle");
        const zoomInBtn = document.getElementById("zoom-in");
        const zoomOutBtn = document.getElementById("zoom-out");
        const fitScreenBtn = document.getElementById("fit-screen");
        const thumbnailSidebar = document.getElementById("thumbnail-sidebar");
        const fullscreenToggle = document.getElementById("fullscreen-toggle");

        let currentPage = localStorage.getItem("lastReadPage") ? parseInt(localStorage.getItem("lastReadPage")) : 1;
        let totalPages = 0;
        let scale = 1.5;
        const minScale = 0.5;
        const maxScale = 3;

        const url = "{{ asset($ebook->pdf) }}";
        let pdfDoc = null;

        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderPage(currentPage);
            generateThumbnails();
        });

        function renderPage(pageNum) {
            pdfDoc.getPage(pageNum).then(function(page) {
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                const viewport = page.getViewport({ scale: scale });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({ canvasContext: context, viewport: viewport });

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

        function generateThumbnails() {
            thumbnailSidebar.innerHTML = "";
            const thumbnailCanvases = new Array(totalPages).fill(null);

            for (let i = 1; i <= totalPages; i++) {
                ((pageNum) => {
                    pdfDoc.getPage(pageNum).then(function(page) {
                        const viewport = page.getViewport({ scale: 0.25 });
                        const canvas = document.createElement("canvas");
                        const context = canvas.getContext("2d");

                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        page.render({ canvasContext: context, viewport: viewport }).promise.then(() => {
                            canvas.classList.add("mb-2");
                            canvas.style.cursor = "pointer";
                            canvas.title = `Page ${pageNum}`;
                            canvas.addEventListener("click", () => {
                                currentPage = pageNum;
                                renderPage(currentPage);
                            });

                            thumbnailCanvases[pageNum - 1] = canvas;

                            if (thumbnailCanvases.every(c => c !== null)) {
                                thumbnailSidebar.innerHTML = "";
                                thumbnailCanvases.forEach(c => thumbnailSidebar.appendChild(c));
                            }
                        });
                    });
                })(i);
            }
        }

        function updateBookmarkButtonState() {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            if (bookmarks.includes(currentPage)) {
                bookmarkBtn.textContent = "Remove Bookmark";
                bookmarkBtn.classList.remove("btn-primary");
                bookmarkBtn.classList.add("btn-danger");
                bookmarkedStatus.textContent = `Page ${currentPage} is Bookmarked!`;
                bookmarkedStatus.style.color = "green";
                bookmarkedStatus.style.display = "block";
            } else {
                bookmarkBtn.textContent = "Bookmark";
                bookmarkBtn.classList.remove("btn-danger");
                bookmarkBtn.classList.add("btn-primary");
                bookmarkedStatus.style.display = "none";
            }
            displayTopBookmarks();
        }

        function displayTopBookmarks() {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            topBookmarks.textContent = bookmarks.length > 0 ? 
                "Bookmarked Pages: " + bookmarks.join(", ") : "No Bookmarks Yet";
        }

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

        bookmarkBtn.addEventListener("click", () => {
            const bookmarks = JSON.parse(localStorage.getItem("bookmarks")) || [];
            if (bookmarks.includes(currentPage)) {
                bookmarks.splice(bookmarks.indexOf(currentPage), 1);
                alert(`Page ${currentPage} removed from bookmarks.`);
            } else {
                bookmarks.push(currentPage);
                alert(`Page ${currentPage} bookmarked!`);
            }
            localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
            updateBookmarkButtonState();
        });

        zoomInBtn.addEventListener("click", () => {
            if (scale < maxScale) {
                scale += 0.2;
                renderPage(currentPage);
            }
        });

        zoomOutBtn.addEventListener("click", () => {
            if (scale > minScale) {
                scale -= 0.2;
                renderPage(currentPage);
            }
        });

        fitScreenBtn.addEventListener("click", () => {
            const viewerWidth = pdfViewer.offsetWidth;
            pdfDoc.getPage(currentPage).then((page) => {
                const viewport = page.getViewport({ scale: 1 });
                const ratio = viewerWidth / viewport.width;
                scale = ratio;
                renderPage(currentPage);
            });
        });

        fullscreenToggle.addEventListener("click", () => {
            const viewer = document.documentElement;
            if (!document.fullscreenElement) {
                viewer.requestFullscreen().catch(err => {
                    alert(`Error attempting fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        });

        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-mode");
            themeToggleBtn.textContent = "☀️ Bright Mode";
        }

        themeToggleBtn.addEventListener("click", function () {
            document.body.classList.toggle("dark-mode");
            const isDark = document.body.classList.contains("dark-mode");
            themeToggleBtn.textContent = isDark ? "☀️ Bright Mode" : "🌙 Dark Mode";
            localStorage.setItem("theme", isDark ? "dark" : "light");
        });

        if (localStorage.getItem("fullwidth") === "on") {
            document.body.classList.add("fullwidth-mode");
            fullwidthToggleBtn.textContent = "📏 Standard Width";
        }

        fullwidthToggleBtn.addEventListener("click", function () {
            const isFull = document.body.classList.toggle("fullwidth-mode");
            fullwidthToggleBtn.textContent = isFull ? "📏 Standard Width" : "🖥️ Full Width";
            localStorage.setItem("fullwidth", isFull ? "on" : "off");
        });

        window.onload = function () {
            updateBookmarkButtonState();
        };

        // Disable right-click (context menu)
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault(); // Prevent the context menu
        });
    </script>
@endsection
