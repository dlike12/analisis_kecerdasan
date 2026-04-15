@extends('layouts.app')

@section('title', 'Tes Kecerdasan Jamak')
@section('header', 'Tes Kecerdasan Jamak (Multiple Intelligences)')

@section('content')
<!-- Full Width Container -->
<div class="w-full">
    <!-- Header Petunjuk -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 shadow-sm p-6 mb-6 border-l-4 border-green-500 -mt-6 -mx-6 rounded-b-xl">
        <div class="text-center">
            <h3 class="text-xl font-bold text-green-800">📝 Petunjuk Pengerjaan</h3>
            <p class="text-gray-600 mt-2">Terdapat <strong class="text-green-600">64 pernyataan</strong>. Pilih jawaban yang paling sesuai dengan diri Anda:</p>
            <div class="flex flex-wrap justify-center gap-3 mt-4">
                <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold">1 = Sangat Tidak Setuju</span>
                <span class="px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-semibold">2 = Tidak Setuju</span>
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold">3 = Netral</span>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">4 = Setuju</span>
                <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">5 = Sangat Setuju</span>
            </div>
        </div>
    </div>

    <!-- Form Tes -->
    <form action="{{ route('siswa.submit-tes') }}" method="POST" id="tesForm">
        @csrf
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Daftar Pertanyaan
                </h3>
                <p class="text-white/80 text-sm mt-1">Silakan jawab semua pertanyaan dengan jujur</p>
            </div>
            
            <div class="p-6 max-h-[600px] overflow-y-auto">
                @foreach($pertanyaan as $index => $p)
                <div class="mb-5 p-5 border rounded-xl hover:shadow-lg transition-all bg-white">
                    <p class="font-medium mb-4 text-gray-800 text-base">{{ $loop->iteration }}. {{ $p->pertanyaan }}</p>
                    <!-- Pilihan jawaban horizontal dengan flex row -->
                    <div class="flex flex-row flex-wrap gap-3 justify-start items-center">
                        <label class="flex flex-col items-center cursor-pointer p-2 rounded-lg hover:bg-red-50 transition-all min-w-[60px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="1" required class="w-5 h-5 text-red-600">
                            <span class="text-xs mt-1 font-semibold text-red-600">STS</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-2 rounded-lg hover:bg-orange-50 transition-all min-w-[60px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="2" required class="w-5 h-5 text-orange-600">
                            <span class="text-xs mt-1 font-semibold text-orange-600">TS</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-2 rounded-lg hover:bg-gray-50 transition-all min-w-[60px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="3" required class="w-5 h-5 text-gray-600">
                            <span class="text-xs mt-1 font-semibold text-gray-600">N</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-2 rounded-lg hover:bg-blue-50 transition-all min-w-[60px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="4" required class="w-5 h-5 text-blue-600">
                            <span class="text-xs mt-1 font-semibold text-blue-600">S</span>
                        </label>
                        <label class="flex flex-col items-center cursor-pointer p-2 rounded-lg hover:bg-green-50 transition-all min-w-[60px]">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="5" required class="w-5 h-5 text-green-600">
                            <span class="text-xs mt-1 font-semibold text-green-600">SS</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Tombol Submit -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-sm text-gray-500">⚠️ Pastikan semua soal telah dijawab <strong class="text-green-600">(64 soal)</strong></p>
                </div>
                <button type="button" onclick="confirmSubmit()" 
                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-10 py-3 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Submit Tes
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function confirmSubmit() {
        const radios = document.querySelectorAll('input[type="radio"]');
        const questions = new Set();
        radios.forEach(radio => {
            questions.add(radio.getAttribute('name'));
        });
        
        let answered = 0;
        questions.forEach(question => {
            const checked = document.querySelector(`input[name="${question}"]:checked`);
            if (checked) answered++;
        });
        
        const totalQuestions = questions.size;
        
        if (answered < totalQuestions) {
            alert(`⚠️ Anda baru menjawab ${answered} dari ${totalQuestions} soal. Silakan lengkapi semua jawaban.`);
        } else {
            if (confirm('✅ Apakah Anda yakin dengan semua jawaban Anda? Pastikan Anda telah menjawab dengan jujur.')) {
                document.getElementById('tesForm').submit();
            }
        }
    }
</script>
@endpush
@endsection
