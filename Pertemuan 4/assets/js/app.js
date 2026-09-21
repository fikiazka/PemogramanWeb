document.addEventListener("DOMContentLoaded", function () {
    const navToggle =
        document.getElementById("nav-toggle-btn");
    const nav =
        document.querySelector("header nav");
    if (navToggle && nav) {
        navToggle.addEventListener(
            "click",
            function () {
                nav.classList.toggle("show");
            }
        );
    }
    const searchInput =
        document.getElementById("search-input");
    if (searchInput) {
        searchInput.addEventListener(
            "input",
            function () {
                const keyword =
                    searchInput.value.toLowerCase();
                const rows =
                    document.querySelectorAll(
                        "table tbody tr"
                    );
                rows.forEach(function (row) {
                    const text =
                        row.textContent.toLowerCase();
                    if (text.includes(keyword)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
        );
    }
    const tombolHapus =
        document.querySelectorAll(
            ".btn-hapus"
        );
    tombolHapus.forEach(function (button) {
        button.addEventListener(
            "click",
            function () {
                const konfirmasi =
                    confirm(
                        "Apakah kamu yakin ingin menghapus data ini?"
                    );
                if (konfirmasi) {
                    const row =
                        button.closest("tr");
                    if (row) {
                        row.remove();
                    }
                }
            }
        );
    });
    const form =
        document.getElementById("form-tambah");
    if (form) {
        form.addEventListener(
            "submit",
            function (event) {
                const inputs =
                    form.querySelectorAll(
                        "input[required], select[required]"
                    );
                let valid = true;
                inputs.forEach(
                    function (input) {
                        if (
                            input.value.trim() === ""
                        ) {
                            valid = false;
                        }
                    }
                );
                if (!valid) {
                    event.preventDefault();
                    alert(
                        "Silakan lengkapi data yang wajib diisi."
                    );
                }
            }
        );
    }
});