<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                {{-- Header --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Edit Profile
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Update your profile information
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data"
                      class="space-y-8">
                    @csrf
                    @method('PATCH')

                    {{-- Avatar --}}
                    <div class="flex items-start gap-6">

                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 shrink-0">
                            @if(auth()->user()->avatar)
                                <img
                                    src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                                    class="w-full h-full object-cover"
                                >
                            @endif
                        </div>

                        <div>
                            <input
                                type="file"
                                name="avatar"
                                class="block text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-xl file:border-0
                                file:bg-gray-100 file:text-gray-700
                                hover:file:bg-gray-200"
                            >

                            <p class="text-sm text-gray-400 mt-3">
                                JPG, PNG or GIF. Max size 800KB
                            </p>

                            @error('avatar')
                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Name --}}
                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-3">
                            Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-black focus:ring-black px-5 py-4 text-lg"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-3">
                            Location
                        </label>

                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', auth()->user()->location) }}"
                            placeholder="Medan, Indonesia"
                            class="w-full rounded-2xl border-gray-200 focus:border-black focus:ring-black px-5 py-4 text-lg"
                        >

                        @error('location')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-lg font-semibold text-gray-800">
                                Bio
                            </label>

                            <span class="text-sm text-gray-400">
                                max 1024 chars
                            </span>
                        </div>

                        <textarea
                            name="bio"
                            rows="6"
                            maxlength="1024"
                            class="w-full rounded-2xl border-gray-200 focus:border-black focus:ring-black px-5 py-4 text-lg resize-none"
                            placeholder="Write something about yourself..."
                        >{{ old('bio', auth()->user()->bio) }}</textarea>

                        @error('bio')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button
                            type="submit"
                            class="bg-pink-500 hover:bg-gray-300 hover:text-black text-white px-8 py-4 rounded-2xl font-semibold transition"
                        >
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>