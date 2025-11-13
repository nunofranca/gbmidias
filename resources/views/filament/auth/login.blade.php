@php
$utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'xcod'];
@endphp

<x-filament-panels::page.simple>
    <div style="position: relative; width: 100%; max-width: 360px; margin: auto; height: 0; padding-bottom: 177.77%; overflow: hidden;">
        <iframe
            src="https://www.youtube.com/embed/dNQXlfe6LEA?si=0VccT0cW8f9itShj"
            frameborder="0"
            allowfullscreen
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
        ></iframe>
    </div>

    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

    <!-- Script para capturar UTMs da session -->
    <script>
        (function() {
            const utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'xcod'];

            // Pega UTMs do Blade (session) e salva no localStorage
            const sessionUtm = {
                @foreach($utmKeys as $key)
                    @if(session()->has($key))
                        '{{ $key }}': '{{ session($key) }}',
                    @endif
                @endforeach
            };

            Object.keys(sessionUtm).forEach(key => {
                localStorage.setItem(key, sessionUtm[key]);
            });

            // Adiciona UTMs a todos os links internos
            const links = document.querySelectorAll('a[href^="/"], a[href^="' + window.location.origin + '"]');
            links.forEach(link => {
                const linkUrl = new URL(link.href, window.location.origin);
                utmKeys.forEach(key => {
                    const value = localStorage.getItem(key);
                    if(value) {
                        linkUrl.searchParams.set(key, value);
                    }
                });
                link.href = linkUrl.toString();
            });

            // Adiciona UTMs a todos os forms internos
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                utmKeys.forEach(key => {
                    const value = localStorage.getItem(key);
                    if(value && !form.querySelector('input[name="' + key + '"]')) {
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = key;
                        hidden.value = value;
                        form.appendChild(hidden);
                    }
                });
            });
        })();
    </script>
</x-filament-panels::page.simple>
