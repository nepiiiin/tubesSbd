@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Statistik</h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Karya (Shots)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalShots }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-image fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Lowongan Kerja (Jobs)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJobs }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
        <h1 class="h4 mb-0 text-gray-800">Preview Karya Terbaru</h1>
    </div>
    
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @forelse($shots as $shot)
    <div class="relative group cursor-pointer">
        <div class="bg-white rounded-[26px] p-3 transition duration-300 hover:-translate-y-1 hover:shadow-xl">

            <div class="overflow-hidden rounded-[22px] bg-gray-100 relative">
                <img
                    src="{{ $shot->image_url }}"
                    alt="{{ $shot->title }}"
                    onerror="this.src='https://placehold.co/600x400/eeeeee/999999?text=No+Image'"
                    class="w-full h-[260px] object-cover transition duration-500 group-hover:scale-[1.03]"
                >
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors rounded-[22px]"></div>
            </div>

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

                <div class="flex items-center gap-1.5 px-3 py-1.5 text-gray-500">
                    <span class="text-lg">❤️</span>
                    <span class="text-[#3d3d4e] text-[13px] font-medium">
                        {{ $shot->likes_count ?? 0 }}
                    </span>
                </div>
            </div>

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
    <div class="col-span-full text-center py-12">
        <div class="text-4xl mb-2">🎨</div>
        <h3 class="text-lg font-semibold text-gray-700">Belum ada karya</h3>
    </div>
    @endforelse

</div>
@endsection