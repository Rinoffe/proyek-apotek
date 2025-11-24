function searchProduk() {
    let keyword = document.getElementById("searchInput").value;

    // MASUKKAN KEYWORD KE URL
    const url = new URL(window.location);
    url.searchParams.set("search", keyword);
    window.history.pushState({}, "", url);

    fetch("../filter/produkFilter.php?search=" + keyword)
        .then(response => response.text())
        .then(html => {
            document.getElementById("productList").innerHTML = html;
    });
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const savedSearch = urlParams.get("search");

    if (savedSearch) {
        document.getElementById("searchInput").value = savedSearch;

        // otomatis panggil filter
        fetch("../filter/produkFilter.php?search=" + savedSearch)
            .then(response => response.text())
            .then(html => {
                document.getElementById("productList").innerHTML = html;
            });
    }
};