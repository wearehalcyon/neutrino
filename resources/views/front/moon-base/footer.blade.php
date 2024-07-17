    <footer class="footer py-5">
        {!! getMenu('Main Menu', '', 'nav justify-content-center border-bottom pb-3 mb-3', false) !!}
        <p class="text-center text-muted">© {{ date('Y') . ', ' . getOption('site_name') }}</p>
    </footer>
    </main>
    {{ getFooter() }}
    <script src="{{ getThemeAssetsUri('/js/bootstrap.min.js') }}"></script>
</body>
</html>
