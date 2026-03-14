@php
    $currentLocale = app()->getLocale();
    $available = config('app.available_locales', []);
@endphp

<div class="language-switcher">
    @foreach($available as $label => $code)
        @if($currentLocale === $code)
            <span class="lang-chip active">{{ $label }}</span>
        @else
            <button type="button"
                    class="lang-chip"
                    data-locale="{{ $code }}">
                {{ $label }}
            </button>
        @endif
    @endforeach
</div>

<style>
    .language-switcher {
        display: inline-flex;
        gap: 6px;
        align-items: center;
    }
    .lang-chip {
        border: none;
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 12px;
        cursor: pointer;
        background: #f3f4f6;
        color: #4b5563;
    }
    .lang-chip.active {
        background: #111827;
        color: #f9fafb;
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.lang-chip[data-locale]');
        if (!btn) return;

        const locale = btn.getAttribute('data-locale');
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const response = await fetch('{{ route('language.switch') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ locale }),
            });

            if (response.ok) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Failed to switch language', error);
        }
    });
</script>

