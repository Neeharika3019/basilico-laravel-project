<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basilico - About</title>

    <style>
        body { margin: 0; font-family: Arial, sans-serif; color: black; }

        header {
            background-color: #3b873e;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
        }

        header img { height: 60px; }

        nav {
            flex: 1;
            display: flex;
            justify-content: space-evenly;
        }

        nav a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .main {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            min-height: 80vh;
        }

        .green { background: #14823b; padding: 40px; }
        .white { background: #fff; text-align: center; padding: 40px; }
        .red { background: #b21e1e; padding: 40px; }

        .red .content { max-width: 80%; margin: auto; }

        footer {
            background: #e53935;
            color: black;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            padding: 30px;
        }

        #ajaxContent {
            text-align: center;
            padding: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<header>
    <img src="/images/logo.jpeg">

    <nav>
        <a href="/home">Home</a>
        <a href="/about"><b>About</b></a>
        <a href="/menu">Menu</a>
        <a href="/reservation">Reservation</a>
        <a href="/order">Order Online</a>
        <a href="/login">Login</a>
    </nav>
</header>

<div class="main">

    <div class="green">
        <p>Welcome to Basilico, where the flavors of Italy come alive.</p>
        <p>We are passionate about serving authentic Italian spaghetti.</p>
        <img src="/images/spag1.jpeg" width="200">
    </div>

    <div class="white">
        <img src="/images/logo.jpeg" width="150">
    </div>

    <div class="red">
        <div class="content">
            <p>Basilico brings the taste of Italy to your table.</p>
            <img src="/images/spag2.jpeg" width="200">
        </div>
    </div>

</div>

<!-- AJAX OUTPUT -->
<div id="ajaxContent"></div>

<footer>
    <div>Logo</div>
    <div>Navigation</div>
    <div>Contact</div>
</footer>

<script>
fetch('/about-data')
.then(res => res.json())
.then(data => {
    document.getElementById("ajaxContent").innerHTML =
        data.title + " - " + data.message + " (" + data.speciality + ")";
});
</script>

</body>
</html>
