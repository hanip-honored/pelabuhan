const apiKey = 'd70c5533a8e41ed1d86108e7f999df6a';
const weatherLocation = 'Yogyakarta';
const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

async function fetchWeather() {
    try {
        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${weatherLocation}&units=metric&appid=${apiKey}`);
        const weatherData = await weatherResponse.json();

        const temperature = weatherData.main.temp;
        const windSpeed = weatherData.wind.speed;
        const windDirection = weatherData.wind.deg;
        const pressure = weatherData.main.pressure;
        const weatherIcon = weatherData.weather[0].icon;
        const iconUrl = `http://openweathermap.org/img/wn/${weatherIcon}@2x.png`;

        document.getElementById('wind-speed').textContent = `Kecepatan Angin: ${windSpeed} m/s`;
        document.getElementById('wind-direction').textContent = `Arah Angin: ${windDirection}°`;
        document.getElementById('pressure').textContent = `Tekanan: ${pressure} hPa`;

        const currentDate = new Date();
        const day = days[currentDate.getDay()];
        const cityName = weatherData.name;

        document.getElementById('temperature').textContent = `${Math.round(temperature)}°`;
        document.getElementById('day').textContent = `${day}`;
        document.getElementById('location').textContent = `${cityName}`;

        const weatherImage = document.getElementById('weather-icon');
        weatherImage.src = iconUrl;

    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.getElementById('temperature').textContent = 'Gagal memuat cuaca';
    }
}

document.addEventListener('DOMContentLoaded', fetchWeather);