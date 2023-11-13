</body>

{{-- for sidebar button toggle --}}
<script> 
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("sidebtn");
        const sidebar = document.getElementById("logo-sidebar");

        toggleButton.addEventListener("click", function() {
            // Toggle the 'hidden' class to show/hide the sidebar
            sidebar.classList.toggle("translate-x-0");
        });
    });
</script>

</html>
