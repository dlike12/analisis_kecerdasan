@extends('layouts.app')

@section('title', 'Tes Kecerdasan Jamak')
@section('header', 'Tes Kecerdasan Jamak (Multiple Intelligences)')

@section('content')
<div class="w-full">
    <!-- Header Petunjuk -->
    <div class="sticky top-0 z-10 bg-gradient-to-r from-green-50 to-emerald-50 shadow-sm p-3 sm:p-5 mb-3 sm:mb-4 border-l-4 border-green-500 rounded-b-xl">
        <div class="text-center">
            <h3 class="text-base sm:text-xl font-bold text-green-800">📝 Petunjuk Pengerjaan</h3>
            <p class="text-xs sm:text-sm text-gray-600 mt-1">Terdapat <strong class="text-green-600">64 pernyataan</strong>. Pilih jawaban yang paling sesuai dengan diri Anda:</p>
            <div class="flex flex-wrap justify-center gap-1 sm:gap-3 mt-2">
                <span class="px-2 py-1 sm:px-4 sm:py-2 bg-red-100 text-red-700 rounded-full text-xs font-semibold"> STS = Sangat Tidak Setuju</span>
                <span class="px-2 py-1 sm:px-4 sm:py-2 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold"> TS = Tidak Setuju</span>
                <span class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">N = Netral</span>
                <span class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">S = Setuju</span>
                <span class="px-2 py-1 sm:px-4 sm:py-2 bg-green-100 text-green-700 rounded-full text-xs font-semibold">SS = Sangat Setuju</span>
            </div>
        </div>
    </div>

    <form action="{{ route('siswa.submit-tes') }}" method="POST" id="tesForm">
        @csrf
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-4 sm:px-6 py-3 sm:py-4">
                <h3 class="text-white font-semibold text-base sm:text-lg flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Daftar Pertanyaan
                </h3>
                <p class="text-white/80 text-xs sm:text-sm mt-1">Silakan jawab semua pertanyaan dengan jujur</p>
            </div>
            
            <div class="p-3 sm:p-6 max-h-[calc(100vh-250px)] overflow-y-auto">
                @foreach($pertanyaan as $index => $p)
                <div class="mb-4 sm:mb-5 p-3 sm:p-5 border rounded-xl hover:shadow-lg bg-white">
                    <p class="font-medium mb-3 text-gray-800 text-sm sm:text-base">{{ $loop->iteration }}. {{ $p->pertanyaan }}</p>
                    <!-- Pilihan jawaban: lebih rapat di mobile, lebih longgar di desktop -->
                    <div class="flex flex-row flex-nowrap gap-1 sm:gap-2 justify-start items-center overflow-x-auto pb-2">
                        <label class="flex flex-col items-center cursor-pointer p-1 sm:p-1.5 rounded-lg hover:bg-red-50 min-w-[40px] sm:min-w-[55px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="1" required class="w-5 h-5 text-red-600">
                            <span class="text-xs mt-1 font-semibold text-red-600">STS</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-1 sm:p-1.5 rounded-lg hover:bg-orange-50 min-w-[40px] sm:min-w-[55px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="2" required class="w-5 h-5 text-orange-600">
                            <span class="text-xs mt-1 font-semibold text-orange-600">TS</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-1 sm:p-1.5 rounded-lg hover:bg-gray-50 min-w-[40px] sm:min-w-[55px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="3" required class="w-5 h-5 text-gray-600">
                            <span class="text-xs mt-1 font-semibold text-gray-600">N</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-1 sm:p-1.5 rounded-lg hover:bg-blue-50 min-w-[40px] sm:min-w-[55px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="4" required class="w-5 h-5 text-blue-600">
                            <span class="text-xs mt-1 font-semibold text-blue-600">S</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-1 sm:p-1.5 rounded-lg hover:bg-green-50 min-w-[40px] sm:min-w-[55px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="5" required class="w-5 h-5 text-green-600">
                            <span class="text-xs mt-1 font-semibold text-green-600">SS</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky bottom-0 z-10">
            <div class="p-3 flex flex-col sm:flex-row justify-between items-center gap-2">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-xs text-gray-500">Pastikan semua soal telah dijawab <strong class="text-green-600">(64 soal)</strong></p>
                </div>
                <button type="button" onclick="showConfirmModal()" 
                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-1.5 rounded-xl hover:opacity-90 transition font-semibold text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Submit Tes
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Peringatan -->
<div id="warningModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all duration-300 scale-95 opacity-0" id="warningModalContent">
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-3 rounded-t-xl">
            <h3 class="text-white font-semibold text-base flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Peringatan
            </h3>
        </div>
        <div class="p-4">
            <p class="text-gray-700 text-center text-sm" id="warningMessage"></p>
            <div class="flex justify-center mt-4">
                <button onclick="closeWarningModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all duration-300 scale-95 opacity-0" id="confirmModalContent">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-4 py-3 rounded-t-xl">
            <h3 class="text-white font-semibold text-base flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Konfirmasi
            </h3>
        </div>
        <div class="p-4">
            <p class="text-gray-700 text-center text-sm">✅ Apakah Anda yakin dengan semua jawaban Anda? Pastikan Anda telah menjawab dengan jujur.</p>
            <div class="flex justify-center gap-3 mt-4">
                <button onclick="closeConfirmModal()" class="px-3 py-1.5 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</button>
                <button onclick="submitForm()" class="px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700">Ya, Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmModal() {
        const radios = document.querySelectorAll('input[type="radio"]');
        const questions = new Set();
        radios.forEach(radio => questions.add(radio.getAttribute('name')));
        let answered = 0;
        questions.forEach(q => { if (document.querySelector(`input[name="${q}"]:checked`)) answered++; });
        const total = questions.size;
        if (answered < total) {
            document.getElementById('warningMessage').innerText = `⚠️ Anda baru menjawab ${answered} dari ${total} soal. Silakan lengkapi semua jawaban.`;
            const modal = document.getElementById('warningModal');
            const content = document.getElementById('warningModalContent');
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => { content.classList.remove('scale-95','opacity-0'); content.classList.add('scale-100','opacity-100'); }, 10);
        } else {
            const modal = document.getElementById('confirmModal');
            const content = document.getElementById('confirmModalContent');
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => { content.classList.remove('scale-95','opacity-0'); content.classList.add('scale-100','opacity-100'); }, 10);
        }
    }
    function closeWarningModal() {
        const modal = document.getElementById('warningModal');
        const content = document.getElementById('warningModalContent');
        content.classList.remove('scale-100','opacity-100'); content.classList.add('scale-95','opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
    }
    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('confirmModalContent');
        content.classList.remove('scale-100','opacity-100'); content.classList.add('scale-95','opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
    }
    function submitForm() { closeConfirmModal(); document.getElementById('tesForm').submit(); }
    window.onclick = function(e) {
        if (e.target === document.getElementById('warningModal')) closeWarningModal();
        if (e.target === document.getElementById('confirmModal')) closeConfirmModal();
    }
</script>
@endsection