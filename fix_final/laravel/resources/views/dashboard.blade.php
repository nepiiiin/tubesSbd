<x-app-layout>

<div
    x-data="dashboardData()"
    x-init="init()"
    class="min-h-screen bg-[#f8f7f4]"
>

    <!-- ========== HERO SECTION (Search Besar) ========== -->
    <!-- Akan fade out saat user scroll ke bawah -->
    <section 
        x-ref="hero"
        data-hero
        class="pt-8 pb-12 px-6 md:px-16 lg:px-24"
    >
        <div class="max-w-[1600px] mx-auto">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                
                <!-- Left: Text + Search -->
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#0d0c22] leading-[1.1] tracking-tight">
                        Discover the<br>World's Top<br>Designers
                    </h1>
                    <p class="text-lg text-gray-500 max-w-lg">
                        Explore work from the most talented community of designers and get inspired for your next project.
                    </p>

                    <!-- Hero Search Bar -->
                    <form 
                        action="#" 
                        method="GET"
                        class="flex items-center bg-white rounded-full px-6 py-4 shadow-sm border border-gray-200 max-w-xl"
                    >
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ request('q') }}"
                            placeholder="What are you looking for?" 
                            class="flex-1 bg-transparent border-none outline-none text-base text-black placeholder-gray-400"
                        >
                        <button type="submit" class="w-10 h-10 bg-[#ea4c89] hover:bg-[#d43f7a] text-white rounded-full flex items-center justify-center transition-colors ml-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right: Decorative Image -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <img 
                            src="https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&auto=format&fit=crop&q=80" 
                            alt="Design inspiration" 
                            class="rounded-[26px] w-full object-cover shadow-lg"
                        >
                        <!-- Floating badge -->
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl px-4 py-3 shadow-md border border-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">🎨</span>
                                <div>
                                    <p class="text-sm font-semibold text-[#0d0c22]">10k+ Shots</p>
                                    <p class="text-xs text-gray-500">Added this week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========== SHOTS GRID ========== -->
    <div class="max-w-[1600px] mx-auto px-6 md:px-16 lg:px-24 pb-20">

        <!-- Filter Tabs (Optional) -->
        <div class="flex items-center gap-4 mb-8 overflow-x-auto pb-2">
            <button class="px-4 py-2 text-sm font-semibold text-black bg-white rounded-full border border-gray-200">Popular</button>
            <button class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-black bg-transparent rounded-full">Recent</button>
            <button class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-black bg-transparent rounded-full">Following</button>
            <div class="flex-1"></div>
            <button class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-black flex items-center gap-1">
                Filters
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($shots as $shot)
            <!-- CARD -->
            <div 
                class="relative group cursor-pointer"
                @click="openShotModal({{ $shot->id }})"
            >
                <div class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <!-- IMAGE -->
                    <div class="overflow-hidden rounded-[22px] bg-gray-100 relative">
                        <img
                            src="{{ $shot->image_url }}"
                            alt="{{ $shot->title }}"
                            onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'"
                            class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.03]"
                        >
                        
                        <!-- Hover overlay (opsional) -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors rounded-[22px]"></div>
                    </div>

                    <!-- USER + LIKES -->
                    <div class="flex items-center justify-between mt-4 px-1">
                        <div class="flex items-center gap-3 min-w-0">
                            <img
                                src="{{ $shot->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($shot->user->username ?? 'U') . '&background=ea4c89&color=fff' }}"
                                alt="{{ $shot->user->username ?? 'User' }}"
                                class="w-8 h-8 rounded-full object-cover shrink-0 border border-gray-100"
                            >
                            <div class="min-w-0">
                                <h3 class="text-[14px] font-semibold text-[#0d0c22] truncate">
                                    {{ $shot->user->username ?? 'Unknown' }}
                                </h3>
                            </div>
                        </div>

                        <!-- LIKE BUTTON -->
                        <button
                            @click.stop="likeShot({{ $shot->id }})"
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors"
                        >
                            <span class="text-lg transition-transform" :class="likedShots[{{ $shot->id }}] ? 'scale-110' : ''">❤️</span>
                            <span 
                                id="likes-count-{{ $shot->id }}"
                                class="text-[#3d3d4e] text-[13px] font-medium"
                            >
                                {{ $shot->likes_count ?? 0 }}
                            </span>
                        </button>
                    </div>

                    <!-- CATEGORIES -->
                    @if($shot->categories && $shot->categories->count())
                    <div class="flex flex-wrap gap-2 mt-3 px-1">
                        @foreach($shot->categories->take(2) as $category)
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors cursor-default">
                            {{ $category->name }}
                        </span>
                        @endforeach
                        @if($shot->categories->count() > 2)
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-400">+{{ $shot->categories->count() - 2 }}</span>
                        @endif
                    </div>
                    @endif

                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-20">
                <div class="text-6xl mb-4">🎨</div>
                <h3 class="text-xl font-semibold text-[#0d0c22] mb-2">No shots yet</h3>
                <p class="text-gray-500 mb-6">Be the first to share your work with the community!</p>
                <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-[#ea4c89] text-white font-semibold rounded-full hover:bg-[#d43f7a] transition-colors">
                    Upload your first shot
                </a>
            </div>
            @endforelse

        </div>

        <!-- Pagination (jika pakai) -->
        @if($shots->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $shots->links() }}
        </div>
        @endif

    </div>

    <!-- ========== MODAL POPUP ========== -->
    <div 
        x-show="showModal" 
        x-transition.opacity.duration.300ms
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
        >
            <!-- Loading State -->
            <div x-show="modalLoading" class="bg-white rounded-[32px] p-16 text-center shadow-2xl">
                <div class="animate-spin w-10 h-10 border-4 border-gray-200 border-t-[#ea4c89] rounded-full mx-auto mb-4"></div>
                <p class="text-gray-500 text-sm">Loading shot...</p>
            </div>
            
            <!-- Error State -->
            <div x-show="modalError && !modalLoading" class="bg-white rounded-[32px] p-12 text-center shadow-2xl">
                <div class="text-4xl mb-4">⚠️</div>
                <p class="text-gray-600 mb-4" x-text="modalError"></p>
                <button @click="closeModal()" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm font-semibold transition-colors">Close</button>
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
        modalError: '',
        likedShots: {}, // Track liked shots: { shotId: true/false }

        init() {
            // Sync scroll antara hero dan navbar
            const hero = this.$refs.hero;
            const navbar = document.querySelector('nav');
            
            if (hero && navbar) {
                window.addEventListener('scroll', () => {
                    const scrollY = window.pageYOffset;
                    const heroHeight = hero.offsetHeight;
                    
                    // Fade hero search saat scroll
                    if (hero) {
                        const opacity = Math.max(0, 1 - (scrollY / (heroHeight * 0.6)));
                        hero.style.opacity = opacity;
                        hero.style.pointerEvents = opacity > 0.1 ? 'auto' : 'none';
                    }
                    
                    // Show/hide navbar search (jika navbar punya logic ini)
                    // Navbar sudah handle sendiri dengan Alpine.js
                }, { passive: true });
            }

            // Keyboard shortcut: ESC to close modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.showModal) {
                    this.closeModal();
                }
            });

            // Initialize likedShots dari data attribute jika ada
            document.querySelectorAll('[id^="likes-count-"]').forEach(el => {
                const shotId = el.id.replace('likes-count-', '');
                // Bisa tambahkan logic cek apakah user sudah like dari backend
                // this.likedShots[shotId] = userAlreadyLiked;
            });
        },

        async openShotModal(shotId) {
            this.showModal = true;
            this.modalLoading = true;
            this.modalContent = '';
            this.modalError = '';
            
            // Prevent body scroll saat modal open
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
                    this.modalError = 'Gagal memuat konten shot. Silakan coba lagi.';
                }
            } catch (e) {
                console.error('Fetch error:', e);
                this.modalError = 'Terjadi kesalahan koneksi. Periksa jaringan Anda.';
            } finally {
                this.modalLoading = false;
            }
        },

        closeModal() {
            this.showModal = false;
            this.modalContent = '';
            this.modalError = '';
            document.body.style.overflow = '';
        },

        async likeShot(shotId) {
            // Optimistic UI update
            const likesEl = document.querySelector(`#likes-count-${shotId}`);
            const currentLikes = parseInt(likesEl?.innerText) || 0;
            const isAlreadyLiked = this.likedShots[shotId];
            
            // Update UI sementara
            if (!isAlreadyLiked) {
                if (likesEl) likesEl.innerText = currentLikes + 1;
                this.likedShots[shotId] = true;
            }
            
            try {
                const response = await fetch(`/shots/${shotId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ shot_id: shotId })
                });

                const data = await response.json();
                
                if (response.ok && likesEl) {
                    // Sync dengan response server
                    likesEl.innerText = data.likes_count ?? data.likes ?? currentLikes;
                } else {
                    // Revert jika error
                    if (!isAlreadyLiked && likesEl) {
                        likesEl.innerText = currentLikes;
                    }
                    this.likedShots[shotId] = isAlreadyLiked;
                    console.error('Like failed:', data);
                }
            } catch (e) {
                // Revert jika network error
                if (!isAlreadyLiked && likesEl) {
                    likesEl.innerText = currentLikes;
                }
                this.likedShots[shotId] = isAlreadyLiked;
                console.error('Like error:', e);
            }
        }
    }
}
</script>

</x-app-layout>