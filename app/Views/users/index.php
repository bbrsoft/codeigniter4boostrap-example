<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-3">User List</h2>
    <input type="text" id="search" class="form-control mb-3" placeholder="Search username/email...">

    <div id="userTable">
        <!-- Tabel dimuat melalui AJAX -->
    </div>
</div>

<script>
$(document).ready(function() {
    function loadTable(page = 1, search = '', sort = 'id', order = 'asc') {
        $.get("<?= site_url('user/fetch') ?>", { page: page, search: search, sort: sort, order: order }, function(data) {
            $("#userTable").html(data);
        });
    }

    loadTable();

    $("#search").on("keyup", function() {
        loadTable(1, $(this).val(), $(".sortable.active").data("sort"), $(".sortable.active").data("order"));
    });

    $(document).on("click", ".pagination a", function(e) {
        e.preventDefault();
        let page = $(this).data("ci-pagination-page");
        loadTable(page, $("#search").val(), $(".sortable.active").data("sort"), $(".sortable.active").data("order"));
    });

    $(document).on("click", ".sortable", function() {
        let sort = $(this).data("sort");
        let order = $(this).data("order") === "asc" ? "desc" : "asc";

        $(".sortable").removeClass("active");
        $(this).addClass("active").data("order", order);

        loadTable(1, $("#search").val(), sort, order);
    });
});


</script>

</body>
</html>
