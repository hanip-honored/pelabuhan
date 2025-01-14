const apiKey = 'd70c5533a8e41ed1d86108e7f999df6a';
const weatherLocation = 'Yogyakarta';
const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

async function fetchWeather() {
    try {
        const weatherResponse = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${weatherLocation}&units=metric&appid=${apiKey}`);
        const weatherData = await weatherResponse.json();

        const weatherIcon = weatherData.weather[0].icon;
        const iconUrl = `https://openweathermap.org/img/wn/${weatherIcon}@2x.png`;

        const currentDate = new Date();
        const day = days[currentDate.getDay()];
        const formattedDate = `${day}, ${currentDate.getDate()} ${currentDate.toLocaleString('id-ID', { month: 'long' })}`;
        const cityName = weatherData.name;
        const countryCode = weatherData.sys.country;
        const temperature = Math.round(weatherData.main.temp);
        const weatherDescription = weatherData.weather[0].description;

        document.getElementById('day').textContent = formattedDate;
        document.getElementById('location').textContent = `${cityName}, ${countryCode}`;

        const weatherImage = document.getElementById('weather-icon');
        weatherImage.src = iconUrl;
        weatherImage.alt = weatherDescription;

        document.getElementById('temperature').textContent = `${temperature}°C`;
        document.getElementById('weather-description').textContent = weatherDescription.charAt(0).toUpperCase() + weatherDescription.slice(1);

    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.getElementById('temperature').textContent = 'Gagal memuat cuaca';
        document.getElementById('weather-description').textContent = '';
    }
}

document.addEventListener('DOMContentLoaded', fetchWeather);