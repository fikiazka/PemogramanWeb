// ===== Fungsi generik untuk memuat data JSON =====

async function muatData(namaFile, daftarKunci) {

    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    if (loading) {
        loading.style.display = "block";
    }

    tbody.innerHTML = "";

    try {

        // simulasi delay jaringan
        await new Promise(resolve => setTimeout(resolve, 3000));

        const res = await fetch("../data/" + namaFile);

        if (!res.ok) {
            throw new Error(
                "Gagal mengambil data (status " + res.status + ")"
            );
        }

        const data = await res.json();

        data.forEach(function (item) {

            const tr = document.createElement("tr");

            let isi = "";

            daftarKunci.forEach(function (kunci) {

                isi += "<td>" + item[kunci] + "</td>";

            });

            isi +=
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";

            tr.innerHTML = isi;

            tbody.appendChild(tr);

        });

    } catch (err) {

        tbody.innerHTML =
            "<tr><td colspan=\"" + (daftarKunci.length + 1) + "\">" +
            "Gagal memuat data: " + err.message +
            "</td></tr>";

    } finally {

        if (loading) {
            loading.style.display = "none";
        }

    }
}