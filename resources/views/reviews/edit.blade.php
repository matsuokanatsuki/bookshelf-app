<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レビューの編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <p class="text-gray-600">書籍: <span class="font-semibold">{{ $review->book->title }}</span></p>
                    </div>

                    <form action="{{ route('reviews.update', $review) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">評価 <span class="text-red-500">*</span></label>
                            <!-- <div class="flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" {{ old('rating', $review->rating) == $i ? 'checked' : '' }} required>
                                        <span class="text-2xl peer-checked:text-yellow-400 text-gray-300 hover:text-yellow-400">★</span>
                                    </label>
                                @endfor
                            </div> -->
                                <input type="hidden"
                                    id="rating"
                                    name="rating"
                                    value="{{ old('rating', $review->rating) }}">

                                <div id="star-rating" class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button
                                            type="button"
                                            class="star text-3xl text-gray-300"
                                            data-value="{{ $i }}">
                                            ★
                                        </button>
                                    @endfor
                                </div>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">コメント</label>
                            <textarea name="comment" id="comment" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('books.show', $review->book) }}" class="text-gray-600 hover:text-gray-900 mr-4">キャンセル</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                更新する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    function updateStars(value) {

        stars.forEach((star, index) => {

            if (index < value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    updateStars(Number(ratingInput.value));

    stars.forEach(star => {

        star.addEventListener('click', () => {

            const value = star.dataset.value;

            ratingInput.value = value;

            updateStars(Number(value));
        });
    });
});
</script>