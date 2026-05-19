import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function toggleDarkMode() {
    if (
        localStorage.theme === 'dark' ||
        (
            !('theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        )
    ) {
        localStorage.theme = 'light';
        document.documentElement.classList.remove('dark');
    } else {
        localStorage.theme = 'dark';
        document.documentElement.classList.add('dark');
    }
}

window.toggleDarkMode = toggleDarkMode;


window.likeShotModal = async function (shotId, button) {

    try {

        const response = await fetch(`/shots/${shotId}/like`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content,

                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        const svg = button.querySelector('svg');

        if (data.liked) {

            svg.setAttribute('fill', 'currentColor');

            svg.classList.remove('text-gray-600');
            svg.classList.add('text-pink-500');

        } else {

            svg.setAttribute('fill', 'none');

            svg.classList.remove('text-pink-500');
            svg.classList.add('text-gray-600');
        }

    } catch (e) {

        console.error('LIKE ERROR:', e);

    }
}


window.saveShotModal = async function (shotId, button) {

    try {

        const response = await fetch(`/shots/${shotId}/save`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content,

                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        const svg = button.querySelector('svg');

        if (data.saved) {

            svg.setAttribute('fill', 'currentColor');

            svg.classList.remove('text-gray-600');
            svg.classList.add('text-black');

        } else {

            svg.setAttribute('fill', 'none');

            svg.classList.remove('text-black');
            svg.classList.add('text-gray-600');
        }

    } catch (e) {

        console.error('SAVE ERROR:', e);

    }
}

window.followUser = async function (userId, button) {

    try {

        const response = await fetch(`/users/${userId}/follow`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content,

                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.following) {

            button.innerText = 'Following';

            button.classList.remove('text-gray-500');
            button.classList.add('text-pink-500');

        } else {

            button.innerText = 'Follow';

            button.classList.remove('text-pink-500');
            button.classList.add('text-gray-500');
        }

    } catch (e) {

        console.error('FOLLOW ERROR:', e);

    }
}