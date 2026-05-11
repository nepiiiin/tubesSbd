<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="flex flex-col items-center text-center mb-16">
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-500 mb-4 overflow-hidden">
                    @if($user->profile_photo)
                        <img src="{{ $user->profile_photo }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->full_name, 0, 2)) }}
                    @endif
                </div>
                
                <h1 class="text-4xl font-bold text-gray-900">{{ $user->full_name }}</h1>
                <p class="text-gray-500 mt-2 text-lg">@ {{ $user->username }}</p>
                
                <div class="mt-6 flex space-x-3">
                    <button class="px-6 py-2 bg-black text-white rounded-full font-semibold hover:bg-gray-800 transition">Follow</button>
                    <button class="px-6 py-2 border border-gray-300 rounded-full font-semibold hover:bg-gray-50 transition">Hire Me</button>
                </div>
            </div>

            <div class="border-b border-gray-200 mb-8">
                <nav class="flex space-x-8">
                    <a href="#" class="border-b-2 border-black pb-4 text-sm font-bold">Work</a>
                    <a href="#" class="pb-4 text-sm font-medium text-gray-500 hover:text-black">Collections</a>
                    <a href="#" class="pb-4 text-sm font-medium text-gray-500 hover:text-black">About</a>
                </nav>
            </div>

// hapus bagian ini biar gak erros, tapi masih berantakan, nanti di edit lagi
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($shots as $shot)
                    <div class="group">
                        <div class="rounded-xl overflow-hidden bg-gray-100 aspect-video mb-3">
                            <img src="{{ $shot->image_url }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-gray-900">{{ $shot->title }}</h3>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 text-gray-400">
                        <p>Belum ada karya yang diunggah.</p>
                    </div>
                @endforelse
            </div>


        </div>
    </div>
</x-app-layout>