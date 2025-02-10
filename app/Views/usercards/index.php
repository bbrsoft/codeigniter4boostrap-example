<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List (Cards)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-3 text-center">User List (Cards View)</h2>
    
    <!-- Search Input -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Search username/email...">

    <!-- Sorting Buttons -->
    <div class="d-flex justify-content-center mb-3">
        <button class="btn btn-primary me-2 sortable" data-sort="id" data-order="asc">Sort by ID</button>
        <button class="btn btn-success me-2 sortable" data-sort="username" data-order="asc">Sort by Username</button>
        <button class="btn btn-info sortable" data-sort="email" data-order="asc">Sort by Email</button>
    </div>

    <!-- Cards Container -->
    <div id="userCards" class="row">
        <!-- Data akan dimuat di sini via AJAX -->
    </div>
    
    <!-- Pagination -->
    <div id="pagination" class="text-center mt-3"></div>
</div>

<script>
$(document).ready(function() {
    function loadCards(page = 1, search = '', sort = 'id', order = 'asc') {
        $.get("<?= site_url('usercards/fetch') ?>", { page: page, search: search, sort: sort, order: order }, function(data) {
            $("#userCards").html(data);
        });
    }

    loadCards();

    // Pencarian
    $("#search").on("keyup", function() {
        loadCards(1, $(this).val());
    });

    // Sorting
    $(".sortable").on("click", function() {
        let sort = $(this).data("sort");
        let order = $(this).data("order") === "asc" ? "desc" : "asc";
        
        $(".sortable").removeClass("active");
        $(this).addClass("active").data("order", order);

        loadCards(1, $("#search").val(), sort, order);
    });

    // Pagination Handling
    $(document).on("click", ".pagination a", function(e) {
        e.preventDefault();
        let page = $(this).data("ci-pagination-page");
        loadCards(page, $("#search").val(), $(".sortable.active").data("sort"), $(".sortable.active").data("order"));
    });
});
</script>

</body>
</html>
