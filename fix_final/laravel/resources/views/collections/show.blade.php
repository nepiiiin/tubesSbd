<x-app-layout>
    <div 
        x-data="{
            showModal: false,
            modalLoading: false,
            modalContent: '',

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
                        this.modalContent = await response.text();
                    } else {
                        this.modalContent = '<div class=&quot;bg-white p-6 rounded-xl text-center text-red-500&quot;>Gagal memuat konten shot.</div>';
                    }
                } catch (e) {
                    console.error('Fetch error:', e);
                    this.modalContent = '<div class=&quot;bg-white p-6 rounded-xl text-center text-red-500&quot;>Terjadi error saat membuka modal.</div>';
                } finally {
                    this.modalLoading = false;
                }
            },

            closeModal() {
                this.showModal = false;
                this.modalContent = '';
                document.body.style.overflow = '';
            }
        }"
        @keydown.escape.window="closeModal()"
        class="py-12 bg-white dark:bg-gray-900 min-h-screen"
    >
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-10">
                <a
                    href="{{ url()->previous() }}"
                    class="text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white transition"
                >
                    ← Back to Collections
                </a>

                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-4">
                    {{ $collection->name }}
                </h1>

                @if($collection->description)
                    <p class="text-gray-500 mt-2">
                        {{ $collection->description }}
                    </p>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($collection->shots as $shot)

                <div 
                    class="group cursor-pointer"
                    @click="openShotModal({{ $shot->id }})"
                >

                    <div class="bg-white dark:bg-gray-900 rounded-[26px] p-3 transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        <div class="overflow-hidden rounded-[22px] bg-gray-100 relative">

                            <img
                                src="{{ str_starts_with($shot->image_url, 'http') ? $shot->image_url : asset('storage/' . $shot->image_url) }}"
                                alt="{{ $shot->title }}"
                                onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'"
                                class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.03] pointer-events-none"
                            >

                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors rounded-[22px]"></div>

                        </div>

                        <div class="flex items-center justify-between mt-4 px-1">

                            <div class="min-w-0">

                                <h3 class="text-[14px] font-semibold text-[#0d0c22] dark:text-white truncate">
                                    {{ $shot->title }}
                                </h3>

                                <p class="text-xs text-gray-500 truncate">
                                    by {{ $shot->user->username ?? 'Unknown' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                @empty

                <div class="col-span-full text-center py-20 text-gray-400">
                    Belum ada shot di collection ini.
                </div>

                @endforelse

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
            <div 
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-5xl max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <div x-show="modalLoading" class="bg-white rounded-[32px] p-12 text-center">
                    <div class="animate-spin w-8 h-8 border-4 border-gray-200 border-t-[#ea4c89] rounded-full mx-auto mb-4"></div>
                    <p class="text-gray-500">Loading shot...</p>
                </div>

                <div x-html="modalContent"></div>
            </div>
        </div>

    </div>
</x-app-layout>