</div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Enable tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    
    // Activate current menu item
    $(document).ready(function() {
        var current = location.pathname;
        $('.sidebar ul li a').each(function() {
            var $this = $(this);
            if ($this.attr('href').indexOf(current) !== -1) {
                $this.addClass('active');
            }
        });
    });
</script>
</body>
</html>
