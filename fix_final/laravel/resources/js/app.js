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

        const response = await fetch(
            `/shots/${shotId}/like`,
            {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,

                    'Accept': 'application/json'
                }
            }
        );

        const data = await response.json();

        // UPDATE ICON MODAL
        const svg = button.querySelector('svg');

        if (data.liked) {

            svg.setAttribute(
                'fill',
                'currentColor'
            );

            svg.classList.remove(
                'text-gray-600'
            );

            svg.classList.add(
                'text-pink-500'
            );

        } else {

            svg.setAttribute(
                'fill',
                'none'
            );

            svg.classList.remove(
                'text-pink-500'
            );

            svg.classList.add(
                'text-gray-600'
            );
        }

        // UPDATE CARD LUAR
        const outsideLikes = document.querySelector(
            `#likes-count-${shotId}`
        );

        if (outsideLikes) {

            outsideLikes.innerText =
                data.likes_count;
        }

    } catch (e) {

        console.error(
            'LIKE ERROR:',
            e
        );
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

        if (response.status === 401 || response.redirected) {
            window.location.href = '/login';
            return;
        }

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

window.commentShotModal = async function (event, shotId, form) {
    event.preventDefault();

    try {
        const textarea = form.querySelector('textarea[name="body"]');
        const body = textarea.value.trim();

        if (!body) {
            return;
        }

        const response = await fetch(`/shots/${shotId}/comments`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                body: body
            })
        });

        if (response.status === 401 || response.redirected) {
            window.location.href = '/login';
            return;
        }

        const data = await response.json();

        if (!data.success) {
            return;
        }

        const commentsList = document.querySelector(`#comments-list-${shotId}`);
        const emptyComments = document.querySelector(`#empty-comments-${shotId}`);

        if (emptyComments) {
            emptyComments.remove();
        }

        const avatarUrl = data.comment.user.avatar_url 
            ? data.comment.user.avatar_url 
            : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.comment.user.username ?? 'U')}`;

        const commentHtml = `
            <div class="flex gap-3">
                <img
                    src="${avatarUrl}"
                    class="w-10 h-10 rounded-full object-cover"
                >

                <div>
                    <div class="flex items-center gap-2">
                        <h4 class="font-semibold text-gray-900">
                            ${data.comment.user.username}
                        </h4>

                        <span class="text-xs text-gray-400">
                            ${data.comment.created_at}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm mt-1">
                        ${data.comment.body}
                    </p>
                </div>
            </div>
        `;

        commentsList.insertAdjacentHTML('beforeend', commentHtml);

        textarea.value = '';

    } catch (e) {
        console.error('COMMENT ERROR:', e);
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