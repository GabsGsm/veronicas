<div>
    <x-page-header
        decorative="Vamos conversar"
        title="Entre em Contato"
        subtitle="Estamos aqui para atendê-la com todo carinho e dedicação"
    />

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Cards principais — Instagram + WhatsApp                            --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">

        {{-- Instagram --}}
        <div class="bg-card rounded-2xl p-8 shadow-premium hover:shadow-premium-hover transition-all text-center">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4"
                 style="background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%);">
                <x-icon name="instagram" class="w-8 h-8 text-white" />
            </div>
            <h3 class="font-serif text-2xl mb-2">Instagram</h3>
            <p class="text-muted-foreground font-sans mb-4">Siga-nos para novidades e tendências</p>

            <a
                href="https://instagram.com/{{ ltrim(config('veronica.social.instagram', 'veronicasfashion'), '@') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-block font-sans text-xl text-primary hover:text-rose-600 transition-colors mb-4"
            >
                {{ "@" . ltrim(config('veronica.social.instagram', 'veronicasfashion'), '@') }}
            </a>

            <p class="text-sm text-muted-foreground font-sans">
                Looks do dia • Bastidores • Coleções
            </p>
        </div>

        {{-- WhatsApp --}}
        <div class="bg-card rounded-2xl p-8 shadow-premium hover:shadow-premium-hover transition-all text-center">
            <div class="w-16 h-16 bg-[#25D366] rounded-2xl flex items-center justify-center mx-auto mb-4">
                <x-icon name="phone" class="w-8 h-8 text-white" />
            </div>
            <h3 class="font-serif text-2xl mb-2">WhatsApp</h3>
            <p class="text-muted-foreground font-sans mb-4">Atendimento personalizado</p>

            {{-- QR Code visual premium (igual ao React) --}}
            <div class="w-48 h-48 mx-auto mb-4 bg-white rounded-xl p-4 shadow-md relative">
                <div class="w-full h-full bg-foreground/90 rounded-lg flex items-center justify-center">
                    @php
                        // Padrão visual aproximado do React
                        $filled = [0, 1, 2, 3, 4, 5, 9, 10, 14, 15, 19, 20, 21, 22, 23, 24, 6, 8, 11, 13, 16, 18];
                    @endphp
                    <div class="grid grid-cols-5 gap-1 p-2">
                        @for ($i = 0; $i < 25; $i++)
                            <span class="w-3 h-3 rounded-sm {{ in_array($i, $filled, true) ? 'bg-foreground' : 'bg-background' }}"></span>
                        @endfor
                    </div>
                </div>

                {{-- Logo central --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-2 shadow-sm">
                    <x-icon name="phone" class="w-6 h-6 text-[#25D366]" />
                </div>
            </div>

            <p class="font-sans text-lg mb-2">{{ config('veronica.contact.phone', '(11) 98765-4321') }}</p>
            <p class="text-sm text-muted-foreground font-sans">
                Escaneie o QR Code para conversar
            </p>
        </div>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- Informações da boutique                                            --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="max-w-4xl mx-auto mt-12 bg-editorial-rose rounded-2xl p-8">
        <div class="text-center mb-8">
            <x-icon name="sparkles" class="w-8 h-8 text-primary mx-auto mb-3" />
            <h3 class="font-serif text-2xl mb-2">Nossa Boutique</h3>
            <p class="text-muted-foreground font-sans">Visite-nos e conheça nossa coleção completa</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="map-pin" class="w-6 h-6 text-primary" />
                </div>
                <h4 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">Endereço</h4>
                <p class="font-sans text-sm whitespace-pre-line">{{ config('veronica.contact.address', "Rua das Flores, 123\nJardins - São Paulo/SP") }}</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="clock" class="w-6 h-6 text-primary" />
                </div>
                <h4 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">Horário</h4>
                <p class="font-sans text-sm whitespace-pre-line">{{ config('veronica.contact.hours', "Seg - Sex: 10h às 20h\nSáb: 10h às 18h") }}</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                    <x-icon name="phone" class="w-6 h-6 text-primary" />
                </div>
                <h4 class="font-sans text-sm uppercase tracking-wide text-muted-foreground mb-2">Telefone</h4>
                <p class="font-sans text-sm whitespace-pre-line">{{ config('veronica.contact.phones', "(11) 3456-7890\n(11) 98765-4321") }}</p>
            </div>
        </div>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    {{-- VIP --}}
    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="text-center mt-12 p-8 bg-card rounded-2xl max-w-4xl mx-auto">
        <p class="font-script text-3xl text-primary mb-3">Atendimento VIP</p>
        <p class="font-sans text-muted-foreground max-w-2xl mx-auto">
            Oferecemos consultoria de estilo personalizada, agendamento por WhatsApp
            para atendimento exclusivo e sugestões de looks completos para cada ocasião especial.
        </p>
    </div>
</div>
