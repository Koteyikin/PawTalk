<button class="btn" onclick="my_modal_2.showModal()">open modal</button>
<dialog id="my_modal_2" class="modal">
    <div class="modal-box">
        <div class="grid grid-cols-7 grid-rows-7 gap-4">
            <div class="col-span-2 row-span-7 grid grid-cols-1 grid-rows-2 rounded-2xl bg-[#545871]">
                <div class="row-start-2">
                    <img src="{{ asset('img/register/cat.png') }}" class="h-full rounded-b-2xl"  alt="">
                </div>
            </div>
            <div class="col-span-3 col-start-4 row-start-2">2</div>
            <div class="col-span-3 col-start-4 row-start-4">3</div>
            <div class="col-span-3 col-start-4 row-start-5">4</div>
            <div class="col-span-3 col-start-4 row-start-7">5</div>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
