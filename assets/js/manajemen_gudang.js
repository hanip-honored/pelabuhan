window.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('table-body');

    const data = [
        {
            no: 1,
            noNota: '100002',
            tanggal: '2022-06-23',
            totalTagihan: '248000',
            diskon: '5%',
            pembeli: 'CV. Nanggala Sukses',
            status: 'belum',
            cc: 'admin'
        },
        {
            no: 2,
            noNota: '100001',
            tanggal: '2022-06-17',
            totalTagihan: '50000',
            diskon: '0%',
            pembeli: 'CV. Nanggala Sukses',
            status: 'dibayar',
            cc: 'admin'
        }
    ];

    data.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.no}</td>
            <td>${item.noNota}</td>
            <td>${item.tanggal}</td>
            <td>${item.totalTagihan}</td>
            <td>${item.diskon}</td>
            <td>${item.pembeli}</td>
            <td>${item.status}</td>
            <td>${item.cc}</td>
        `;
        tableBody.appendChild(row);
    });
});