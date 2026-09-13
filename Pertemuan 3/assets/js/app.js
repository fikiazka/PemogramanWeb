// ===== Hamburger menu (JS-driven + animasi) =====

function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}


// ===== Counter jumlah baris =====

function updateRowCounter() {
    const table = document.querySelector(".table-responsive table");
    const counter = document.getElementById("row-counter");

    if (!table || !counter) return;

    const rows = table.querySelectorAll("tbody tr");
    let jumlahTampil = 0;

    rows.forEach(function (row) {
        if (row.style.display !== "none") {
            jumlahTampil++;
        }
    });

    counter.textContent =
        "Menampilkan " + jumlahTampil + " dari " + rows.length + " data";
}


// ===== Konfirmasi hapus =====

function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        console.log(e.target);
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;
        const row = btn.closest("tr");
        if (!row) return;
        const nama = row.querySelector("td")
            ? row.querySelector("td").textContent
            : "data ini";
        const yakin = confirm(
            'Yakin ingin menghapus "' + nama + '"?'
        );
        if (yakin) {
            row.remove();
            updateRowCounter();
        }
    });
}


// ===== Filter tabel berdasarkan kolom tertentu =====

function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");

    if (!input || !table) return;

    input.addEventListener("keyup", function () {

        const keyword = input.value.toLowerCase();

        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {

            // Hanya mengambil kolom pertama
            // Buku = kolom Judul
            // Anggota = kolom No. Anggota
            const kolom = row.querySelector("td");

            if (!kolom) return;

            const teks = kolom.textContent.toLowerCase();

            row.style.display = teks.includes(keyword)
                ? ""
                : "none";
        });

        updateRowCounter();
    });
}


// ===== Pesan error validasi =====

function tampilkanError(input, pesan) {

    hapusError(input);

    const span = document.createElement("span");

    span.className = "error";
    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}


function hapusError(input) {

    const next = input.nextElementSibling;

    if (next && next.classList.contains("error")) {
        next.remove();
    }
}


// ===== Validasi form menggunakan array =====

function initValidasiForm() {

    const form = document.getElementById("form-tambah");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        let valid = true;

        // Field wajib
        const fieldWajib = [
            {
                nama: "nama",
                pesan: "Nama wajib diisi."
            },
            {
                nama: "judul",
                pesan: "Judul wajib diisi."
            },
            {
                nama: "pengarang",
                pesan: "Pengarang wajib diisi."
            },
            {
                nama: "tahun",
                pesan: "Tahun wajib diisi."
            },
            {
                nama: "stok",
                pesan: "Stok wajib diisi."
            }
        ];

        fieldWajib.forEach(function (field) {

            const input = form.querySelector(
                "[name='" + field.nama + "']"
            );

            if (!input) return;

            if (input.value.trim() === "") {

                tampilkanError(input, field.pesan);

                valid = false;

            } else {

                hapusError(input);
            }
        });


        // ===== Validasi tahun =====

        const tahun = form.querySelector("[name='tahun']");

        if (tahun && tahun.value.trim() !== "") {

            const nilai = parseInt(tahun.value, 10);

            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {

                tampilkanError(
                    tahun,
                    "Tahun harus di antara 1900-2026."
                );

                valid = false;

            } else {

                hapusError(tahun);
            }
        }


        // ===== Validasi stok =====

        const stok = form.querySelector("[name='stok']");

        if (stok && stok.value.trim() !== "") {

            const nilai = parseInt(stok.value, 10);

            if (isNaN(nilai) || nilai < 0) {

                tampilkanError(
                    stok,
                    "Stok tidak boleh negatif."
                );

                valid = false;

            } else {

                hapusError(stok);
            }
        }


        // ===== Validasi ISBN =====

        const isbn = form.querySelector("[name='isbn']");

        if (isbn && isbn.value.trim() !== "") {

            const polaISBN = /^[0-9-]+$/;

            if (!polaISBN.test(isbn.value.trim())) {

                tampilkanError(
                    isbn,
                    "ISBN hanya boleh berisi angka dan tanda hubung (-)."
                );

                valid = false;

            } else {

                hapusError(isbn);
            }
        }


        // Jika tidak valid, form tidak dikirim
        if (!valid) {
            e.preventDefault();
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {

    initNavToggle();

    initHapusConfirm();

    initTableFilter();

    initValidasiForm();

    updateRowCounter();
});