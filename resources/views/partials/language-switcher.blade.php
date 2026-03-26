@php
    $currentLocale = session('locale', app()->getLocale());
    $languages = [
        'en' => ['label' => 'English', 'flag' => '🇬🇧'],
        'am' => ['label' => 'አማርኛ',  'flag' => '🇪🇹'],
        'om' => ['label' => 'Afaan Oromoo', 'flag' => '🇪🇹'],
    ];
    $current = $languages[$currentLocale] ?? $languages['en'];
@endphp

<div class="lang-dropdown" id="langDropdown">
    <button type="button" class="lang-trigger" onclick="toggleLangDropdown(event)" aria-haspopup="true" aria-expanded="false">
        <span>{{ $current['flag'] }}</span>
        <span class="lang-label">{{ $current['label'] }}</span>
        <i class="ri-arrow-down-s-line lang-arrow"></i>
    </button>
    <div class="lang-menu" id="langMenu" role="menu">
        @foreach($languages as $code => $lang)
            <button type="button"
                    class="lang-option {{ $currentLocale === $code ? 'active' : '' }}"
                    data-locale="{{ $code }}"
                    role="menuitem">
                <span>{{ $lang['flag'] }}</span>
                <span>{{ $lang['label'] }}</span>
                @if($currentLocale === $code)
                    <i class="ri-check-line" style="margin-left:auto;color:#4F46E5;"></i>
                @endif
            </button>
        @endforeach
    </div>
</div>

<style>
    .lang-dropdown {
        position: relative;
    }

    .lang-trigger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border: 1px solid #E5E7EB;
        border-radius: 999px;
        background: #fff;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .lang-trigger:hover {
        border-color: #4F46E5;
        color: #4F46E5;
        background: #EEF2FF;
    }

    .lang-label {
        max-width: 90px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .lang-arrow {
        font-size: 16px;
        transition: transform 0.2s;
    }

    .lang-dropdown.open .lang-arrow {
        transform: rotate(180deg);
    }

    .lang-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 170px;
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        overflow: hidden;
        z-index: 9999;
        animation: langMenuIn 0.15s ease;
    }

    .lang-dropdown.open .lang-menu {
        display: block;
    }

    @keyframes langMenuIn {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .lang-option {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 10px 16px;
        border: none;
        background: transparent;
        font-size: 13px;
        color: #374151;
        cursor: pointer;
        text-align: left;
        transition: background 0.15s;
    }

    .lang-option:hover {
        background: #F9FAFB;
    }

    .lang-option.active {
        background: #EEF2FF;
        color: #4F46E5;
        font-weight: 600;
    }
</style>

<script>
    function toggleLangDropdown(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('langDropdown');
        const isOpen = dropdown.classList.toggle('open');
        dropdown.querySelector('.lang-trigger').setAttribute('aria-expanded', isOpen);
    }

    // Close on outside click
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('langDropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
            dropdown.querySelector('.lang-trigger').setAttribute('aria-expanded', 'false');
        }
    });

    // Handle language selection
    document.addEventListener('click', async function(e) {
        const btn = e.target.closest('.lang-option[data-locale]');
        if (!btn) return;

        const locale = btn.getAttribute('data-locale');
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        btn.style.opacity = '0.6';
        btn.style.pointerEvents = 'none';

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
            btn.style.opacity = '';
            btn.style.pointerEvents = '';
        }
    });
</script>
