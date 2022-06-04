<div>
    <x-slot name="header">
        Top Filmes
    </x-slot>

    <div>
        <div class="py-6">
            Desbloqueado: {{ $filmes->filter(fn ($filme) => $filme->desbloqueado)->count() }}/{{ $filmes->count() }}
        </div>
        @foreach ($filmes as $filme)
        <div id="filme-{{ $filme->id }}" class="rounded overflow-hidden shadow-lg" style="width: 250px" wire:click='handleClickFilme({{ $filme }})'>
            <div class="w-full" style="width: 250px; height: 350px">
                <img class="object-cover"
                    src="{{ $filme->desbloqueado ? str_replace('.webp', '-250-350.webp', Storage::url($filme->foto)) : asset('images/cover.webp') }}"
                    alt="Sunset in the mountains">
            </div>
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $filme->nome }} ({{ $filme->ano }})</div>
                <p class="text-gray-700 text-base">
                    {{ $filme->diretor->nome }}
                </p>
            </div>
        </div>
        @if ($abrirModal === $filme->id)
        <div class="modal" x-data x-init="() => {
            const scContainer = $refs.container{{ $filme->id }};
            let sc = new window.ScratchCard($refs.container{{ $filme->id }}, {
            scratchType: window.SCRATCH_TYPE.LINE,
            containerWidth: 250,
            containerHeight: 350,
            imageForwardSrc: '/images/cover.webp',
            imageBackgroundSrc: @js(str_replace('.webp', '-250-350.webp', Storage::url($filme->foto))),
            htmlBackground: '',
            clearZoneRadius: 50,
            nPoints: 30,
            pointSize: 4,
            callback: function () {
                    @this.desbloquearFilme(@js($filme->id))
                    const jsConfetti = new window.JSConfetti();
                    jsConfetti.addConfetti();
                    delete sc;
                    sc = null
                }
            })
    
            // Init
            sc.init();
        }">
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
        @endif
        @endforeach
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('modalAberto', () => {
                window.scrollTo(0,0);
                window.document.body.style.overflow = 'hidden';
            })
            Livewire.on('modalFechado', (filmeId) => {
                window.document.body.style.overflow = 'auto';
                location.hash = "#filme-" + filmeId;
            })
        });
    </script>
</div>