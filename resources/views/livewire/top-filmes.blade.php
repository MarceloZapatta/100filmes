<div>
    <x-slot name="header">
        Top Filmes
    </x-slot>

    <div>
        @foreach ($filmes as $filme)
        <div class="rounded overflow-hidden shadow-lg" style="width: 250px" x-data 
        x-init="() => {
            if (!$refs.container{{ $filme->id }}) {
                return;
            }
            const scContainer = $refs.container{{ $filme->id }};
            const sc = new window.ScratchCard($refs.container{{ $filme->id }}, {
            scratchType: window.SCRATCH_TYPE.LINE,
            containerWidth: 250,
            containerHeight: 350,
            imageForwardSrc: @js(str_replace('.webp', '-pixelate.webp', Storage::url($filme->foto))),
            imageBackgroundSrc: @js(str_replace('.webp', '-250-350.webp', Storage::url($filme->foto))),
            htmlBackground: '',
            clearZoneRadius: 50,
            nPoints: 30,
            pointSize: 4,
            callback: function () {
                alert('Now the window will reload !')
                // window.location.reload()
            }
            })
    
            // Init
            sc.init();
        }">
            <div class="w-full" style="width: 250px; height: 350px">
                <img class="object-cover" src="{{ str_replace('.webp', '-250-350.webp', Storage::url($filme->foto)) }}"
                    alt="Sunset in the mountains">
            </div>
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $filme->nome }} ({{ $filme->ano }})</div>
                <p class="text-gray-700 text-base">
                    {{ $filme->diretor->nome }}
                </p>
            </div>
            <div class="modal">
                <div class="sc__wrapper">
                    <div class="sc__container" x-ref="container{{ $filme->id }}">
                        <!-- background image insert here by scratchcard-js -->
                        <!-- canvas generate here -->
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $filme->nome }} ({{ $filme->ano }})</div>
                        <p class="text-gray-700 text-base">
                            {{ $filme->diretor->nome }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            const scContainer = document.getElementById('js--sc--container')
            const sc = new window.ScratchCard('#js--sc--container', {
            scratchType: window.SCRATCH_TYPE.LINE,
            containerWidth: 250,
            containerHeight: 350,
            imageForwardSrc: "{{ str_replace('.webp', '-pixelate.webp', Storage::url($filme->foto)) }}",
            imageBackgroundSrc: "{{ str_replace('.webp', '-250-350.webp', Storage::url($filme->foto)) }}",
            htmlBackground: '',
            clearZoneRadius: 50,
            nPoints: 30,
            pointSize: 4,
            callback: function () {
                alert('Now the window will reload !')
                // window.location.reload()
            }
            })
    
            // Init
            sc.init();
        })
    </script>
</div>