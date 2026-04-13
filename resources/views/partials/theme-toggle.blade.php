{{-- Reusable theme toggle button --}}
<button id="themeToggle" onclick="toggleTheme()" title="Toggle dark/light mode"
    style="background:none;border:1px solid var(--border-color,#e5e7eb);border-radius:50%;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text-dark,#111827);transition:all .2s;flex-shrink:0;">
    <i class="{{ session('theme') === 'dark' ? 'ri-sun-line' : 'ri-moon-line' }}"></i>
</button>

<script>
// ── Theme toggle (shared) ─────────────────────────────────────────────────
(function() {
    // Apply saved theme immediately on load (before paint)
    const serverTheme = '{{ session("theme", "light") }}';
    const localTheme  = localStorage.getItem('theme');
    const theme       = localTheme || serverTheme;

    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        document.querySelectorAll('#themeToggle i').forEach(i => i.className = 'ri-sun-line');
    }

    // Keep localStorage in sync with server session
    if (localTheme !== serverTheme) {
        localStorage.setItem('theme', serverTheme);
    }
})();

function toggleTheme() {
    const isDark = document.body.classList.toggle('dark-mode');
    const theme  = isDark ? 'dark' : 'light';

    localStorage.setItem('theme', theme);

    // Update all toggle icons on the page
    document.querySelectorAll('#themeToggle i, #themeToggleMobile i').forEach(i => {
        i.className = isDark ? 'ri-sun-line' : 'ri-moon-line';
    });

    // Persist to server session
    fetch('{{ route("theme.toggle") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
        },
        body: JSON.stringify({ theme })
    }).catch(() => {});
}
</script>
