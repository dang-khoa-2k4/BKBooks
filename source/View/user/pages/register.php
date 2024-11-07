<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="./message.js"></script>
    <link rel="stylesheet" href="./account.css" />
  </head>
  <body>
    <div id="toast"></div>
    <div class="container row">
      <!-- Left Section (Image) -->
      <div class="left-section col-md-6"></div>

      <!-- Right Section (Form) -->
      <div class="right-section col-md-6">
        <div class="logo">
          <img src="assets/01_logobachkhoatoi.png" alt="BK Logo" />
        </div>
        <h4 class="text-center">Nice to meet you!</h4>
        <h5 class="text-center mb-4">Create a new account</h5>
        <form action="" method="post">
          <div class="form-group">
            <label for="name">Your name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Dang Khoa"
              required
            />
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="john@mail.com"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="********"
              required
            />
          </div>

          <button type="submit" onclick="ShowSuccess();" class="btn btn_login">Register</button>
          <div class="text-center mt-3 btn btn_res">
            <a href="#" style="color: #6251dd">Return home</a>
          </div>
        </form>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
