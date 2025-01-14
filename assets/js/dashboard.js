const apiKey = 'd70c5533a8e41ed1d86108e7f999df6a';
const weatherLocation = 'Yogyakarta';
const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

async function fetchWeather() {
    try {
        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${weatherLocation}&units=metric&appid=${apiKey}`);
        const weatherData = await weatherResponse.json();

        const windSpeed = weatherData.wind.speed;
        const windDirection = weatherData.wind.deg;
        const pressure = weatherData.main.pressure;
        const weatherIcon = weatherData.weather[0].icon; // Mengambil kode ikon
        const iconUrl = `https://openweathermap.org/img/wn/${weatherIcon}@2x.png`; // Membuat URL ikon

        // Mengisi data ke elemen HTML
        document.getElementById('wind-speed').textContent = `Kecepatan Angin: ${windSpeed} m/s`;
        document.getElementById('wind-direction').textContent = `Arah Angin: ${windDirection}°`;
        document.getElementById('pressure').textContent = `Tekanan: ${pressure} hPa`;

        const currentDate = new Date();
        const day = days[currentDate.getDay()];
        const formattedDate = `${day}, ${currentDate.getDate()} ${currentDate.toLocaleString('id-ID', { month: 'long' })}`;
        const cityName = weatherData.name;
        const countryCode = weatherData.sys.country;

        document.getElementById('day').textContent = formattedDate;
        document.getElementById('location').textContent = `${cityName}, ${countryCode}`;

        // Menampilkan ikon cuaca
        const weatherImage = document.getElementById('weather-icon');
        weatherImage.src = iconUrl;
        weatherImage.alt = weatherData.weather[0].description;

    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.getElementById('temperature').textContent = 'Gagal memuat cuaca';
    }
}

// Memanggil fungsi fetchWeather saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', fetchWeather);