<div>
    <x-slot name="header">
        Top Filmes
    </x-slot>
    <div class="py-6">
        Assistido: {{ $filmes->filter(fn ($filme) => $filme->desbloqueado)->count() }}/{{ $filmes->count() }}
    </div>
    <div class="flex flex-wrap">
        @foreach ($filmes as $filme)
        <div id="filme-{{ $filme->id }}" class="rounded overflow-hidden shadow-lg cursor-pointer transition-transform hover:-translate-y-2 p-1 basis-1/2 md:basis-1/4" wire:click='handleClickFilme({{ $filme }})'>
            <div class="w-full">
                <img class="object-cover w-full"
                    src="{{ $filme->desbloqueado ? str_replace('.webp', '-250-350.webp', Storage::url($filme->foto)) : asset('images/cover.webp') }}"
                    alt="Sunset in the mountains">
            </div>
            <div class="px-2 py-2">
                <div class="font-bold text-xl mb-2">{{ $filme->nome }} ({{ $filme->ano }})</div>
                <p class="text-gray-700 text-base">
                    {{ $filme->diretor->nome }}
                </p>
            </div>
        </div>
        @if ($abrirModal === $filme->id)
        <div class="modal" x-data="{ success: false }" x-init="() => {
            var self = this
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
                    self.success = true;
                    const jsConfetti = new window.JSConfetti();
                    jsConfetti.addConfetti({
                        emojis: ['💕', '❤️', '💓', '💘', '💝', '❣️', '💜', '💞', '💖'],
                     });
                    delete sc;
                    sc = null
                }
            })
    
            // Init
            sc.init();
        }">
            <div :class="success ? 'sc__wrapper animate-bounce' : 'sc__wrapper'">
                <div class="sc__container" x-ref="container{{ $filme->id }}">
                    <!-- background image insert here by scratchcard-js -->
                    <!-- canvas generate here -->
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $filme->nome }} ({{ $filme->ano }})</div>
                    <p class="text-gray-700 text-base">
                        {{ $filme->diretor->nome }}<br>
                        {{ $filme->imdb_rating }} ⭐
                    </p>
                </div>
            </div>
            <div class="close" wire:click="abrirModal(0)">X</div>
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
            Livewire.on('modalFechado', ({ filmeId }) => {
                window.document.body.style.overflow = 'auto';
                location.hash = "#filme-" + filmeId;
            })
            Livewire.on('bloquearFilme', ({ filmeId }) => {
                window.Swal.fire({
                    title: '',
                    text: 'Deseja bloquear o filme?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.bloquearFilme(filmeId)
                    }
                })
            })
        });
    </script>
</div>