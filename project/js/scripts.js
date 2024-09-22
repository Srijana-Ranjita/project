function searchItems() {
    const query = document.getElementById("searchQuery").value;
    
    // Implement AJAX call to PHP to search items based on query.
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `php/search_items.php?query=${query}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById("searchResults").innerHTML = this.responseText;
        }
    }
    xhr.send();
}
