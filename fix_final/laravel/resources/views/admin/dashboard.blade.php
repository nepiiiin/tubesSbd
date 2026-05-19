@extends('admin.layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Statistik</h1>
</div>

<div class="row">

    <!-- USERS -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pengguna
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalUsers }}
                        </div>
                    </div>

                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- SHOTS -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Karya (Shots)
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalShots }}
                        </div>
                    </div>

                    <div class="col-auto">
                        <i class="fas fa-image fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- JOBS -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Lowongan Kerja (Jobs)
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalJobs }}
                        </div>
                    </div>

                    <div class="col-auto">
                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<!-- TITLE -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
    <h1 class="h4 mb-0 text-gray-800">Preview Karya Terbaru</h1>
</div>

<!-- SHOTS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @forelse($shots as $shot)

    <!-- CARD -->
    <div class="relative group cursor-pointer">

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

            <!-- USER + LIKE -->
            <div class="flex items-center justify-between mt-4 px-1">

                <!-- USER -->
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

                <!-- LIKE -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-50">

                    <svg 
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="w-5 h-5 text-[#ea4c89]"
                    >
                        <path 
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                        />
                    </svg>

                    <span class="text-[#3d3d4e] text-[13px] font-medium">
                        {{ $shot->likes_count ?? 0 }}
                    </span>

                </div>

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

                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-400">
                    +{{ $shot->categories->count() - 2 }}
                </span>

                @endif

            </div>

            @endif

        </div>

    </div>

    @empty

    <!-- EMPTY STATE -->
    <div class="col-span-full text-center py-12">

        <div class="flex justify-center mb-4">

            <div class="w-16 h-16 rounded-full bg-[#ea4c89]/10 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     class="w-8 h-8 text-[#ea4c89]">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 3a9 9 0 100 18h1a3 3 0 003-3 2 2 0 012-2h1a3 3 0 003-3 9 9 0 00-9-9z"/>

                </svg>

            </div>

        </div>

        <h3 class="text-lg font-semibold text-gray-700">
            Belum ada karya
        </h3>

    </div>

    @endforelse

</div>

@endsection