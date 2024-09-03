<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Custom JS -->
  <script>
    $(document).ready(function() {
      // Example: Smooth scroll for anchor links
      $('a[href^="#"]').on('click', function(event) {
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
          'scrollTop': $target.offset().top
        }, 900, 'swing', function() {
          window.location.hash = target;
        });
      });
    });
  </script>