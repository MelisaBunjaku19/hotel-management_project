<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Contact US</h3>
                    <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Menu Link</h3>
                    <ul class="link_menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="rooms">Our Room</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="contact">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Newsletter</h3>
                    <form class="bottom_form" id="subscribeForm">
                        <input class="enter" placeholder="Enter your email" type="text" name="email" id="email">
                        <button class="sub_btn" type="submit">Subscribe</button>
                    </form>

                    <!-- Notification Popup -->
                    <div id="subscribeNotification" style="display: none; position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 10px; border-radius: 5px;">
                        Successfully subscribed!
                    </div>

                    <ul class="social_icon">
                        <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>More Links</h3>
                    <ul class="link_menu">
                        <li><a href="destinations">Destinations</a></li>
                        <li><a href="hotel-pamphlet">Hotel Pamphlet</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('subscribeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        var email = document.getElementById('email').value;
        
        fetch('{{ route('subscribe') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                email: email
            })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  document.getElementById('subscribeNotification').style.display = 'block';
                  setTimeout(() => {
                      document.getElementById('subscribeNotification').style.display = 'none';
                  }, 3000);
              } else {
                  alert(data.message);
              }
          })
          .catch(error => {
              console.error('Error:', error);
          });
    });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</footer>
