<!-- component -->
<div class="2xl:container 2xl:mx-auto md:py-12 lg:px-20 md:px-6 py-9 px-4">
    <div id="viewerBox" class="lg:p-10 md:p-6 p-4 bg-white dark:bg-gray-900">
        <div class="mt-3 md:mt-4 lg:mt-0 flex flex-col lg:flex-row items-strech justify-center lg:space-x-8">
            <div class="lg:w-1/2 flex justify-between items-strech bg-gray-50  px-2 py-20 md:py-6 md:px-6 lg:py-24">
                <img src="{{ $producto->imagen }}" alt="A black chair with wooden legs" class="w-full h-full" />
            </div>
            <div class="lg:w-1/2 flex flex-col justify-center mt-7 md:mt-8 lg:mt-0 pb-8 lg:pb-0">
                <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800 dark:text-white">{{ $producto->nombre }}</h1>
                <p class="text-base leading-normal text-gray-600 dark:text-white mt-2">
                    {{ $producto->descripcion }} .</p>
                <p class="text-3xl font-medium text-gray-600 dark:text-white mt-8 md:mt-10">
                    {{ $producto->precio }} Bs.
                </p>
                <div
                    class="flex items-center flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6 lg:space-x-8 mt-8 md:mt-16">
                    <button wire:click="addCart({{ $producto->id }})"
                        class="w-full md:w-3/5 border border-gray-800 text-base font-medium leading-none text-white uppercase py-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 text-white dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                        Agregar</button>
                </div>
                <div class="mt-6">

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .slider {
        width: 200px;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .slide-ana {
        height: 360px;
    }

    .slide-ana>div {
        width: 100%;
        height: 100%;
        position: absolute;
        transition: all 0.7s;
    }

    @media (min-width: 200px) and (max-width: 639px) {
        .slider {
            height: 300px;
            width: 170px;
        }
    }
</style>
<script>
    // more free and premium Tailwind CSS components at https://tailwinduikit.com/
    let slides = document.querySelectorAll(".slide-ana>div");
    let slideSayisi = slides.length;
    let prev = document.getElementById("prev");
    let next = document.getElementById("next");
    for (let index = 0; index < slides.length; index++) {
        const element = slides[index];
        element.style.transform = "translateX(" + 100 * index + "%)";
    }
    let loop = 0 + 1000 * slideSayisi;

    function goNext() {
        loop++;
        for (let index = 0; index < slides.length; index++) {
            const element = slides[index];
            element.style.transform =
                "translateX(" + 100 * (index - (loop % slideSayisi)) + "%)";
        }
    }

    function goPrev() {
        loop--;
        for (let index = 0; index < slides.length; index++) {
            const element = slides[index];
            element.style.transform =
                "translateX(" + 100 * (index - (loop % slideSayisi)) + "%)";
        }
    }

    function openView() {
        document.getElementById("viewerButton").classList.add("hidden");
        document.getElementById("viewerBox").classList.remove("hidden");
    }

    function closeView() {
        document.getElementById("viewerBox").classList.add("hidden");
        document.getElementById("viewerButton").classList.remove("hidden");
    }
</script>
@push('visitas')
    {{ $visitas }}
@endpush
