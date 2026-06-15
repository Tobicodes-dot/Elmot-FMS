<x-app-layout>

    <!-- Page Header -->
    <div class="mb-8 flex justify-between items-center">

        <div>
            <h1 class="text-4xl font-black text-slate-800">
                Upload Record
            </h1>

            <p class="text-slate-500 mt-2 text-lg">
                Add and organize school documents securely.
            </p>
        </div>

        <a href="{{ route('records.index') }}"
           class="bg-slate-900 text-white px-5 py-3 rounded-2xl shadow hover:bg-slate-800 transition">
            View Records
        </a>

    </div>


    <!-- Bento Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Upload Form -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl p-8 border border-slate-100">

            <form method="POST"
                  action="{{ route('records.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Record Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        placeholder="Enter record title"
                        class="w-full rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 p-4 outline-none transition"
                    >
                </div>


                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Write a brief description..."
                        class="w-full rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 p-4 outline-none transition"
                    ></textarea>
                </div>


                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Category
                    </label>

                    <select
                        name="category_id"
                        class="w-full rounded-2xl border border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 p-4 outline-none transition"
                    >

                        <option value="">
                            Select Category
                        </option>

                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach

                    </select>
                </div>


                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Upload File
                    </label>

                    <div class="border-2 border-dashed border-slate-300 rounded-3xl p-8 text-center hover:border-blue-500 transition">

                        <input
                            type="file"
                            name="file"
                            class="block w-full text-sm text-slate-500
                                   file:mr-4
                                   file:py-3
                                   file:px-6
                                   file:rounded-2xl
                                   file:border-0
                                   file:bg-blue-600
                                   file:text-white
                                   hover:file:bg-blue-700
                                   cursor-pointer"
                        >

                        <p class="text-slate-400 text-sm mt-4">
                            Upload PDFs, DOCX, Images and school documents
                        </p>

                    </div>
                </div>


                <!-- Submit -->
                <button
                    class="w-full bg-gradient-to-r from-blue-600 to-slate-900 hover:from-blue-700 hover:to-slate-950 text-white py-4 rounded-2xl font-bold text-lg shadow-lg transition"
                >
                    Upload Record
                </button>

            </form>

        </div>


        <!-- Side Info Panel -->
        <div class="space-y-6">

            <!-- Guidelines -->
            <div class="bg-white rounded-3xl shadow-xl p-6 border border-slate-100">

                <h3 class="text-xl font-bold text-slate-800 mb-4">
                    Upload Guidelines
                </h3>

                <ul class="space-y-3 text-slate-500">

                    <li>
                        • Ensure files are properly named
                    </li>

                    <li>
                        • Upload only authorized school documents
                    </li>

                    <li>
                        • Categorize records correctly
                    </li>

                    <li>
                        • Avoid duplicate uploads
                    </li>

                </ul>

            </div>


            <!-- Quick Stats -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 text-white rounded-3xl shadow-xl p-6">

                <p class="uppercase text-sm tracking-widest text-emerald-100 mb-2">
                    System Status
                </p>

                <h2 class="text-5xl font-black">
                    {{ \App\Models\Record::count() }}
                </h2>

                <p class="mt-3 text-emerald-100">
                    Total Records Stored
                </p>

            </div>

        </div>

    </div>

</x-app-layout>