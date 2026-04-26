<dialog id="add_modal" class="modal">
    <div class="modal-box rounded-2xl p-7 max-w-lg">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-bold text-lg text-gray-800">Добавить животное</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost">✕</button>
            </form>
        </div>

        <form action="{{ route('profile.animal') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4">

                <!-- Имя -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">Кличка</label>
                    <input type="text" name="name" placeholder="Например: Бобик" class="input input-bordered w-full bg-[#fafbff] border-[#e2e4ec] focus:border-[#4976F0]" />
                </div>

                <!-- Вид -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">Вид животного</label>
                    <input type="text" name="view" placeholder="Например: Собака (Лабрадор)" class="input input-bordered w-full bg-[#fafbff] border-[#e2e4ec] focus:border-[#4976F0]" />
                </div>

                <!-- Статус -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">Статус</label>
                    <select name="status_animal_id" class="select select-bordered w-full bg-[#fafbff] border-[#e2e4ec] focus:border-[#4976F0]">
                        @forelse(\App\Models\StatusAnimal::all() as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @empty
                            <option disabled class="bold">Технические проблемы</option>
                        @endforelse
                    </select>
                </div>

                <!-- Возраст -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">Возраст</label>
                    <input type="text" name="age" placeholder="Например: 3 года" class="input input-bordered w-full bg-[#fafbff] border-[#e2e4ec] focus:border-[#4976F0]" />
                </div>

                <!-- История -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">История</label>
                    <textarea name="description" rows="3" placeholder="Расскажите историю вашего питомца..."
                              class="textarea textarea-bordered w-full bg-[#fafbff] border-[#e2e4ec] focus:border-[#4976F0] resize-none"></textarea>
                </div>

                <!-- Фотографии -->
                <div>
                    <label class="block text-xs text-gray-500 font-medium mb-1.5">Фотографии (можно несколько)</label>
                    <input type="file" name="picture" multiple accept="image/*"
                           class="file-input file-input-bordered w-full text-sm" />
                    <p class="text-xs text-gray-400 mt-1">Загрузите от 1 до 5 фотографий</p>
                </div>

            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn w-full text-white rounded-xl bg-[#4976F0] border-[#4976F0] hover:bg-[#3c5fd0] hover:border-[#3c5fd0]">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
