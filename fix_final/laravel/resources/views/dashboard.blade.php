<x-app-layout>

<div
    x-data="dashboardData()"
    x-init="init()"
    class="min-h-screen bg-[#f8f7f4]"
>

    <!-- ========== HERO SECTION ========== -->
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
                        action="{{ route('search') }}" 
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
                        <button type="submit" class="w-10 h-10 bg-[#ea4c89] hover:bg-[#c73e72] text-white rounded-full flex items-center justify-center transition-colors ml-3">
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

        <div class="mb-8" x-data="{ sortOpen: false }">
            <div class="flex items-center justify-between flex-wrap gap-4">
                
                <!-- Left: Dropdown Following/Popular/New -->
                <div class="relative">
                    <button 
                        @click="sortOpen = !sortOpen"
                        @click.away="sortOpen = false"
                        class="px-4 py-2 rounded-full border border-gray-300 text-sm font-semibold text-gray-700 hover:border-[#ea4c89] hover:text-[#ea4c89] transition whitespace-nowrap flex items-center gap-2"
                    >
                        <span x-text="sortOpen ? 'Sort by' : 'Following'"></span>
                        <svg class="w-4 h-4 transition-transform" :class="sortOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div 
                        x-show="sortOpen"
                        x-transition
                        class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50"
                    >
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Following</button>
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">Popular</button>
                        <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#f8f7f4] hover:text-[#ea4c89]">New & Noteworthy</button>
                    </div>
                </div>

                <!-- Center: Category Pills (Scrollable) -->
                <div class="flex-1 min-w-0 px-4">
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar">
                        
                        <!-- Discover -->
                        <a href="{{ route('category', ['name' => 'discover']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ !request()->has('category') || request('category') == 'discover' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Discover
                        </a>

                        <!-- Animation -->
                        <a href="{{ route('category', ['name' => 'animation']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'animation' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Animation
                        </a>

                        <!-- Branding -->
                        <a href="{{ route('category', ['name' => 'branding']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'branding' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Branding
                        </a>

                        <!-- Illustration -->
                        <a href="{{ route('category', ['name' => 'illustration']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'illustration' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Illustration
                        </a>

                        <!-- Mobile -->
                        <a href="{{ route('category', ['name' => 'mobile']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'mobile' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Mobile
                        </a>

                        <!-- Print -->
                        <a href="{{ route('category', ['name' => 'print']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'print' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Print
                        </a>

                        <!-- Product Design -->
                        <a href="{{ route('category', ['name' => 'product-design']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'product-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Product Design
                        </a>

                        <!-- Typography -->
                        <a href="{{ route('category', ['name' => 'typography']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'typography' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Typography
                        </a>

                        <!-- Web Design -->
                        <a href="{{ route('category', ['name' => 'web-design']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-semibold transition whitespace-nowrap {{ request('category') == 'web-design' ? 'bg-[#ea4c89] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#ea4c89] hover:text-white' }}">
                            Web Design
                        </a>

                    </div>
                </div>

                <!-- ✅ Right: Filters Button DIHAPUS -->

            </div>
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
                <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-[#ea4c89] text-white font-semibold rounded-full hover:bg-[#c73e72] transition-colors">
                    Upload your first shot
                </a>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if(isset($shots) && $shots->hasPages())
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

            <!-- Content -->
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
        likedShots: {},

        init() {
            const hero = this.$refs.hero;
            const navbar = document.querySelector('nav');
            
            if (hero && navbar) {
                window.addEventListener('scroll', () => {
                    const scrollY = window.pageYOffset;
                    const heroHeight = hero.offsetHeight;
                    
                    if (hero) {
                        const opacity = Math.max(0, 1 - (scrollY / (heroHeight * 0.6)));
                        hero.style.opacity = opacity;
                        hero.style.pointerEvents = opacity > 0.1 ? 'auto' : 'none';
                    }
                }, { passive: true });
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.showModal) {
                    this.closeModal();
                }
            });

            document.querySelectorAll('[id^="likes-count-"]').forEach(el => {
                const shotId = el.id.replace('likes-count-', '');
                // this.likedShots[shotId] = userAlreadyLiked;
            });
        },

        async openShotModal(shotId) {
            this.showModal = true;
            this.modalLoading = true;
            this.modalContent = '';
            this.modalError = '';
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
            const likesEl = document.querySelector(`#likes-count-${shotId}`);
            const currentLikes = parseInt(likesEl?.innerText) || 0;
            const isAlreadyLiked = this.likedShots[shotId];
            
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
                    likesEl.innerText = data.likes_count ?? data.likes ?? currentLikes;
                } else {
                    if (!isAlreadyLiked && likesEl) {
                        likesEl.innerText = currentLikes;
                    }
                    this.likedShots[shotId] = isAlreadyLiked;
                    console.error('Like failed:', data);
                }
            } catch (e) {
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

<!-- CSS untuk hide scrollbar -->
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    [x-cloak] { display: none !important; }
</style>

</x-app-layout>