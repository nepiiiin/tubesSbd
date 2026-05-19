<x-app-layout>

<div
    x-data="dashboardData()"
    x-init="init()"
    class="min-h-screen bg-[#f8f7f4]"
>

    <div class="max-w-[1600px] mx-auto px-6 md:px-16 lg:px-24 pt-28 pb-10">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($shots as $shot)

            <!-- CARD -->
            <div 
                class="relative group cursor-pointer"
                @click="openShotModal({{ $shot->id }})"
            >

                <div
                    class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                >

                    <!-- IMAGE -->
                    <div
                        class="overflow-hidden rounded-[22px] bg-gray-100"
                    >

                        <img
                            src="{{ $shot->image_url }}"
                            alt="{{ $shot->title }}"
                            onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                            class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.03]"
                        >

                    </div>

                    <!-- USER -->
                    <div class="flex items-center justify-between mt-4 px-1">

                        <div class="flex items-center gap-3 min-w-0">

                            <img
                                src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') }}"
                                alt="{{ $shot->user->username ?? 'User' }}"
                                class="w-8 h-8 rounded-full object-cover shrink-0"
                            >

                            <div class="min-w-0">

                                <h3 class="text-[14px] font-semibold text-[#0d0c22] truncate">
                                    {{ $shot->user->username ?? 'Unknown' }}
                                </h3>

                            </div>

                        </div>

                        <!-- LIKES -->
                        <div
                            id="likes-count-{{ $shot->id }}"
                            class="flex items-center gap-1 text-gray-500 text-sm"
                        >

                            <span>❤️</span>

                            <span class="text-[#3d3d4e] text-[13px]">
                                {{ $shot->likes_count }}
                            </span>

                        </div>

                    </div>

                    <!-- CATEGORIES -->
                    @if($shot->categories && $shot->categories->count())

                    <div class="flex flex-wrap gap-2 mt-4 px-1">

                        @foreach($shot->categories as $category)

                        <span
                            class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600"
                        >
                            {{ $category->name }}
                        </span>

                        @endforeach

                    </div>

                    @endif

                </div>

            </div>

            @endforeach

        </div>

    </div>

    <!-- MODAL POPUP -->
    <div 
        x-show="showModal" 
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        @click.self="closeModal()"
        style="display: none;"
    >
        <!-- Modal Content -->
        <div 
            x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-5xl"
        >
            <!-- Loading -->
            <div x-show="modalLoading" class="bg-white rounded-[32px] p-12 text-center">
                <div class="animate-spin w-8 h-8 border-4 border-gray-200 border-t-[#0d0c22] rounded-full mx-auto mb-4"></div>
                <p class="text-gray-500">Loading shot...</p>
            </div>
            
            <!-- Content (di-load via fetch) -->
            <div x-html="modalContent"></div>
        </div>
    </div>

</div>

<script>

function dashboardData() {

    return {

        showModal: false,
        modalLoading: false,
        modalContent: '',

        init() {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.showModal) {
                    this.closeModal();
                }
            });
        },

        async openShotModal(shotId) {
            this.showModal = true;
            this.modalLoading = true;
            this.modalContent = '';
            
            document.body.style.overflow = 'hidden';
            
            try {
                const response = await fetch(`/shots/${shotId}/modal`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                });
                
                if (response.ok) {
                    const html = await response.text();
                    this.modalContent = html;
                } else {
                    const errorText = await response.text();
                    console.error('Modal error:', response.status, errorText);
                    this.modalContent = '<div class="bg-white p-6 rounded-xl text-center text-red-500">Gagal load konten</div>';
                }
            } catch (e) {
                console.error('Fetch error:', e);
                this.modalContent = '<div class="bg-white p-6 rounded-xl text-center text-red-500">Terjadi kesalahan</div>';
            } finally {
                this.modalLoading = false;
            }
        },

        closeModal() {
            this.showModal = false;
            this.modalContent = '';
            document.body.style.overflow = '';
        },

        async likeShot(id) {
            try {
                const response = await fetch(`/shots/${id}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                const likesContainer = document.querySelector(`#likes-count-${id} span:last-child`);

                if (likesContainer) {
                    likesContainer.innerText = data.likes;
                }
            } catch (e) {
                console.error(e);
            }
        }

    }

}

</script>

</x-app-layout>