// Fungsi untuk menyimpan data form ke dalam cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Fungsi untuk mendapatkan nilai cookie berdasarkan nama
function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}

// Ketika halaman dimuat, periksa apakah ada data tersimpan dalam cookie
document.addEventListener("DOMContentLoaded", function() {
    const ktpData = getCookie('ktpData');
    if (ktpData) {
        const parsedData = JSON.parse(ktpData);
        document.getElementById('nama').value = parsedData.nama;
        document.getElementById('tanggalLahir').value = parsedData.tanggalLahir;
        document.getElementById('alamat').value = parsedData.alamat;
        document.getElementById('jenisKelamin').value = parsedData.jenisKelamin;
        document.getElementById('kewarganegaraan').value = parsedData.kewarganegaraan;
    }
});

// Mengelola form submission
document.getElementById('ktpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form disubmit

    // Mengambil nilai dari input form
    const nama = document.getElementById('nama').value;
    const tanggalLahir = document.getElementById('tanggalLahir').value;
    const alamat = document.getElementById('alamat').value;
    const jenisKelamin = document.getElementById('jenisKelamin').value;
    const kewarganegaraan = document.getElementById('kewarganegaraan').value;

    // Simpan data ke cookie
    const ktpData = {
        nama,
        tanggalLahir,
        alamat,
        jenisKelamin,
        kewarganegaraan
    };

    setCookie('ktpData', JSON.stringify(ktpData), 30); // Simpan data dalam cookie selama 30 hari

    // Menampilkan hasil input
    const output = `
        <p>Nama Lengkap: ${nama}</p>
        <p>Tanggal Lahir: ${tanggalLahir}</p>
        <p>Alamat: ${alamat}</p>
        <p>Jenis Kelamin: ${jenisKelamin}</p>
        <p>Kewarganegaraan: ${kewarganegaraan}</p>
    `;

    document.getElementById('output').innerHTML = output;

    // Menyembunyikan popup form setelah disubmit
    document.getElementById('formPopup').style.display = 'none';
});