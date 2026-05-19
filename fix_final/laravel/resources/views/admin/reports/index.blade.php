@extends('admin.layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Desainer Terpopuler</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-trophy mr-2"></i>Top Desainer Berdasarkan Likes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th class="text-center">Total Karya</th>
                            <th class="text-center">Total Likes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topDesigners as $index => $designer)
                        <tr>
                            <td>{{ $topDesigners->firstItem() + $index }}</td>
                            <td class="font-weight-bold">{{ $designer->full_name }}</td>
                            <td>{{ '@' . $designer->username }}</td>
                            <td class="text-center">
                                <span class="badge badge-info px-3 py-2">{{ $designer->total_karya }} Shots</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-danger px-3 py-2"><i class="fas fa-heart"></i> {{ $designer->total_likes }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada data interaksi desainer nih.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $topDesigners->links() }}
            </div>
        </div>
    </div>
@endsection